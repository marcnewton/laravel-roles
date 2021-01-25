@php
    $formClass  = '';
    $btnClass   = 'btn-outline-danger btn-sm';
    $btnText    = trans("laravel-roles::buttons.delete");
    $btnTooltip = trans('laravel-roles::admin.tooltips.delete-role');
    $formAction = route('laravel-roles::roles.destroy', $item->id);
    if(isset($large)) {
        $formClass  = 'mb-0';
        $btnClass   = 'btn-danger btn-sm mb-0';
        $btnText    = trans("laravel-roles::buttons.delete-large");
    }
    if($type == 'Permission') {
        $btnTooltip = trans('laravel-roles::admin.tooltips.delete-permission');
        $formAction = route('laravel-roles::permissions.destroy', $item->id);
    }
@endphp

<form action="{{ $formAction }}" method="POST" accept-charset="utf-8" data-toggle="tooltip" title="{{ $btnTooltip }}" class="{{ $formClass }}" >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="btn btn-block {{ $btnClass }}" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="{!! trans('laravel-roles::admin.modals.delete_modal_title', ['type' => $type, 'item' => $item->name]) !!}" data-message="{!! trans('laravel-roles::admin.modals.delete_modal_message', ['type' => $type, 'item' => $item->name]) !!}" >
        {!! $btnText !!}
    </button>
</form>
