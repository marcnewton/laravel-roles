{{ csrf_field() }}
<div class="row">
    <div class="col-md-8">
        @include('laravel-roles::forms.partials.permission-name-input')
        @include('laravel-roles::forms.partials.permission-slug-input')
        @include('laravel-roles::forms.partials.permission-desc-input')
    </div>
    <div class="col-12 col-md-4">
        @include('laravel-roles::forms.partials.permissions-model-select')
    </div>
</div>
