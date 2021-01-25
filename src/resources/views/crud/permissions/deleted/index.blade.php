@extends(config('roles.bladeExtended'))

@php
    switch (config('roles.bootstapVersion')) {
        case '3':
            $rolesContainerClass = 'panel';
            $rolesContainerHeaderClass = 'panel-heading';
            $rolesContainerBodyClass = 'panel-body padding-0';
            break;
        case '4':
        default:
            $rolesContainerClass = 'card';
            $rolesContainerHeaderClass = 'card-header';
            $rolesContainerBodyClass = 'card-body p-0';
            break;
    }
    $bootstrapCardClasses = (is_null(config('roles.bootstrapCardClasses')) ? '' : config('roles.bootstrapCardClasses'));
@endphp

@section(config('roles.bladePlacementCss'))
    @if(config('roles.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.datatablesCssCDN') }}">
    @endif
    @if(config('roles.enableFontAwesomeCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.fontAwesomeCDN') }}">
    @endif
    @include('laravel-roles::partials.bs-visibility-css')
@endsection

@section('content')

    @include('laravel-roles::partials.flash-messages')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                @include('laravel-roles::tables.permissions-table',['isDeletedPermissions' => true])
            </div>
        </div>

        <div class="clearfix mb-4"></div>

    </div>

    @include('laravel-roles::modals.confirm-modal',[
        'formTrigger' => 'confirmDestroyPermissions',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ])

    @include('laravel-roles::modals.confirm-modal',[
        'formTrigger' => 'confirmRestorePermissions',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
    ])

@endsection

@section(config('roles.bladePlacementJs'))
    @if(config('roles.enablejQueryCDN'))
        <script type="text/javascript" src="{{ config('roles.JQueryCDN') }}"></script>
    @endif

    @include('laravel-roles::scripts.confirm-modal', ['formTrigger' => '#confirmDestroyPermissions'])
    @include('laravel-roles::scripts.confirm-modal', ['formTrigger' => '#confirmRestorePermissions'])

    @if (config('roles.enabledDatatablesJs'))
        @include('laravel-roles::scripts.datatables')
    @endif
    @if(config('roles.tooltipsEnabled'))
        @include('laravel-roles::scripts.tooltips')
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
