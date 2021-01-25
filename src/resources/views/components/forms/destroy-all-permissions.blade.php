<form action="{{ route('laravel-roles::destroy-all-deleted-permissions') }}" method="POST" accept-charset="utf-8" class="mb-0">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="dropdown-item text-danger mt-2 pointer" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDestroyPermissions" data-title="{{ trans('laravel-roles::admin.modals.destroyAllPermissionsTitle') }}" data-message="{{ trans('laravel-roles::admin.modals.destroyAllPermissionsMessage') }}" >
        <i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>
        {!! trans('laravel-roles::admin.buttons.destroy-all-permissions') !!}
    </button>
</form>
