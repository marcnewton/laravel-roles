<?php

namespace jeremykenedy\LaravelRoles\Test;

use jeremykenedy\LaravelRoles\RolesFacade;
use jeremykenedy\LaravelRoles\RolesServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders(): array
    {
        return [RolesServiceProvider::class];
    }

    /**
     * Load package alias.
     *
     * @return array
     */
    protected function getPackageAliases(): array
    {
        return [
            'laravelroles' => RolesFacade::class,
        ];
    }
}
