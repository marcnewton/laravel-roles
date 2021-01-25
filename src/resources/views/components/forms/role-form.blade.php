{{ csrf_field() }}
<div class="row">
    <div class="col-md-8">
        @include('laravel-roles::forms.partials.role-name-input')
        @include('laravel-roles::forms.partials.role-slug-input')
        @include('laravel-roles::forms.partials.role-desc-input')
    </div>
    <div class="col-12 col-md-4">
        @include('laravel-roles::forms.partials.role-level-input')
        @include('laravel-roles::forms.partials.role-permissions-select')
    </div>
</div>
