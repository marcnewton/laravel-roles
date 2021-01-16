<?php

namespace jeremykenedy\LaravelRoles;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use jeremykenedy\LaravelRoles\
{
    App\Http\Middleware\VerifyLevel,
    App\Http\Middleware\VerifyPermission,
    App\Http\Middleware\VerifyRole,
    Database\Seeders\DefaultConnectRelationshipsSeeder,
    Database\Seeders\DefaultPermissionsTableSeeder,
    Database\Seeders\DefaultRolesTableSeeder,
    Database\Seeders\DefaultUsersTableSeeder,
};

class RolesServiceProvider extends ServiceProvider
{
    private $_packageTag = 'laravelroles';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->bootstrap();
        $this->bootstrapConsole();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap resources on any instance type.
     */
    private function bootstrap()
    {
        $this->bootstrapConfigs();

        $this->bootstrapMiddleware();

        $this->loadResources();

        $this->registerBladeDirectives();

    }

    /**
     * Bootstrap resources on console instances only.
     */
    private function bootstrapConsole()
    {
        if ($this->app->runningInConsole())
        {
            $this->loadSeedsFrom();
            $this->publishAssets();
        }
    }

    /**
     * Bootstrap package configurations.
     */
    private function bootstrapConfigs ()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/roles.php', 'roles');
    }

    /**
     * Bootstrap package middleware
     */
    private function bootstrapMiddleware ()
    {
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('level', VerifyLevel::class);
        $router->aliasMiddleware('permission', VerifyPermission::class);
        $router->aliasMiddleware('role', VerifyRole::class);
    }

    /**
     * Bootstrap Consumables
     */
    private function loadResources ()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang/', $this->_packageTag);

        if (config('roles.rolesGuiEnabled'))
        {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        }

        if (config('roles.rolesApiEnabled'))
        {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        }

        if (config('roles.defaultMigrations.enabled'))
        {
            $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        }

        if (config('roles.rolesGuiEnabled'))
        {
            $this->loadViewsFrom(__DIR__ . '/resources/views/', $this->_packageTag);
        }
    }

    /**
     * Loads seeds.
     *
     * @return void
     */
    private function loadSeedsFrom()
    {
        if (config('roles.defaultSeeds.PermissionsTableSeeder'))
        {
            $this->app['seed.handler']->register(
                DefaultPermissionsTableSeeder::class
            );
        }

        if (config('roles.defaultSeeds.RolesTableSeeder'))
        {
            $this->app['seed.handler']->register(
                DefaultRolesTableSeeder::class
            );
        }

        if (config('roles.defaultSeeds.ConnectRelationshipsSeeder'))
        {
            $this->app['seed.handler']->register(
                DefaultConnectRelationshipsSeeder::class
            );
        }

        if (config('roles.defaultSeeds.UsersTableSeeder'))
        {
            $this->app['seed.handler']->register(
                DefaultUsersTableSeeder::class
            );
        }
    }

    /**
     * Register Blade Directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('role', function ($expression)
        {
            return "<?php if (Auth::check() && Auth::user()->hasRole({$expression})): ?>";
        });

        $blade->directive('endrole', function ()
        {
            return '<?php endif; ?>';
        });

        $blade->directive('permission', function ($expression)
        {
            return "<?php if (Auth::check() && Auth::user()->hasPermission({$expression})): ?>";
        });

        $blade->directive('endpermission', function ()
        {
            return '<?php endif; ?>';
        });

        $blade->directive('level', function ($expression)
        {
            $level = trim($expression, '()');

            return "<?php if (Auth::check() && Auth::user()->level() >= {$level}): ?>";
        });

        $blade->directive('endlevel', function ()
        {
            return '<?php endif; ?>';
        });

        $blade->directive('allowed', function ($expression)
        {
            return "<?php if (Auth::check() && Auth::user()->allowed({$expression})): ?>";
        });

        $blade->directive('endallowed', function ()
        {
            return '<?php endif; ?>';
        });
    }

    /**
     * Publish package assets.
     *
     * @return void
     */
    private function publishAssets()
    {
        $tag = $this->_packageTag;

        $configs    = [ __DIR__ . '/config/roles.php' => config_path('roles.php') ];

        $seeds      = [ __DIR__ . '/Database/Seeders/publish' => database_path('seeders') ];

        $migrations = [ __DIR__ . '/Database/Migrations' => database_path('migrations') ];

        $views      = [ __DIR__ . '/resources/views' => resource_path('views/vendor/' . $tag) ];

        $languages  = [ __DIR__ . '/resources/lang' => resource_path('lang/vendor/' . $tag) ];

        // php artisan vendor:publish --tag=laravelroles
        $this->publishes($configs + $seeds + $migrations + $views + $languages, $tag);

        // php artisan vendor:publish --tag=laravelroles-update
        $this->publishes($migrations + $languages, $tag . '-update');

        // php artisan vendor:publish --tag=laravelroles-configs
        $this->publishes($configs,      $tag . '-configs');

        // php artisan vendor:publish --tag=laravelroles-migrations
        $this->publishes($migrations,   $tag . '-migrations');

        // php artisan vendor:publish --tag=laravelroles-seeds
        $this->publishes($seeds,        $tag . '-seeds');

        // php artisan vendor:publish --tag=laravelroles-views
        $this->publishes($views,        $tag . '-views');

        // php artisan vendor:publish --tag=laravelroles-lang
        $this->publishes($languages,    $tag . '-lang');
    }
}
