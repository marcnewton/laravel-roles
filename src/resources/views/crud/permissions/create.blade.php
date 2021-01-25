@extends(config('roles.bladeExtended'))

@php
    switch (config('roles.bootstapVersion')) {
        case '3':
            $containerClass = 'panel';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
            break;
        case '4':
        default:
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
    }
    $bootstrapCardClasses = (is_null(config('roles.bootstrapCardClasses')) ? '' : config('roles.bootstrapCardClasses'));
@endphp

@section(config('roles.bladePlacementCss'))
    @if(config('roles.enableFontAwesomeCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.fontAwesomeCDN') }}">
    @endif
    @include('laravel-roles::partials.bs-visibility-css')
    @if(config('roles.enableSelectizeJsCssCDN'))
        <link rel="stylesheet" type="text/css" href="{{ config('roles.SelectizeJsCssCDN') }}">
    @endif
@endsection


@section('content')

    @include('laravel-roles::partials.flash-messages')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-post" id="post_card">
                    <div class="card-header">
                        {!! trans('laravel-roles::admin.titles.create-permission') !!}
                        <div class="pull-right">
                            <a href="{{ route('laravel-roles::roles.index') }}" class="btn btn-outline-secondary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('laravel-roles::admin.tooltips.back-roles') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('laravel-roles::admin.buttons.back-to-roles') !!}
                            </a>
                        </div>
                    </div>
                    @include('laravel-roles::forms.create-permission-form')
                </div>
            </div>
        </div>
    </div>

@endsection

@section(config('roles.bladePlacementJs'))
    @if(config('roles.enablejQueryCDN'))
        <script type="text/javascript" src="{{ config('roles.JQueryCDN') }}"></script>
    @endif
    @if(config('roles.tooltipsEnabled'))
        @include('laravel-roles::scripts.tooltips')
    @endif
    @if(config('roles.enableSelectizeJsCDN'))
        <script type="text/javascript" src="{{ config('roles.SelectizeJsCDN') }}"></script>
    @endif
    @if(config('roles.enableSelectizeJs'))
        @include('laravel-roles::scripts.selectizePermission')
    @endif
@endsection

@yield('inline_template_linked_css')
@yield('inline_footer_scripts')
