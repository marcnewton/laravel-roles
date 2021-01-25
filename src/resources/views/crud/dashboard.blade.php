@extends(config('roles.bladeExtended'))

@section(config('roles.bladePlacementCss'))
    @if(config('roles.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.datatablesCssCDN') }}">
    @endif
    @if(config('roles.enableFontAwesomeCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.fontAwesomeCDN') }}">
    @endif
    @include('laravel-roles::partials.bs-visibility-css')
@endsection

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <x-laravel-roles::alert type="error" :message="Session::get('status')" />

                    <div class="row">
                        <x-laravel-roles::cards.roles-card :items="$sortedRolesWithPermissionsAndUsers" />
{{--                        @include('laravel-roles::cards.permissions-card', ['items' => $sortedPermissionsRolesUsers])--}}
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
{{--                            @include('laravel-roles::tables.roles-table')--}}
                        </div>
                    </div>

                    <div class="clearfix mb-4"></div>

                    <div class="row">
                        <div class="col-sm-12">
{{--                            @include('laravel-roles::tables.permissions-table')--}}
                        </div>
                    </div>

                    <div class="clearfix mb-4"></div>

                    <x-laravel-roles::confirm-modal formTrigger="confirmDelete" modalClass="danger" actionBtnIcon="fa-trash-o" />

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

@section(config('roles.bladePlacementJs'))
    @if(config('roles.enablejQueryCDN'))
        <script type="text/javascript" src="{{ config('roles.JQueryCDN') }}"></script>
    @endif
    @include('laravel-roles::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'])
    @if (config('roles.enabledDatatablesJs'))
        @include('laravel-roles::scripts.datatables')
    @endif
    @if(config('roles.tooltipsEnabled'))
        @include('laravel-roles::scripts.tooltips')
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
