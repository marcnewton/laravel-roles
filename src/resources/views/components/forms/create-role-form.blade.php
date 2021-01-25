<form action="{{ route('laravel-roles::roles.store') }}" method="POST" accept-charset="utf-8" id="store_role_form" class="mb-0 needs-validation" enctype="multipart/form-data" role="form" >
    {{ method_field('POST') }}
    <div class="card-body">
        @include('laravel-roles::forms.role-form')
    </div>
    <div class="card-footer">
        <div class="row ">
            <div class="col-md-6">
                <span data-toggle="tooltip" title="{!! trans('laravel-roles::admin.tooltips.save-role') !!}">
                    <button type="submit" class="btn btn-success btn-lg btn-block" value="save" name="action">
                        <i class="fa fa-save fa-fw">
                            <span class="sr-only">
                                 {!! trans("laravel-roles::forms.roles-form.buttons.save-role.sr-icon") !!}
                            </span>
                        </i>
                        {!! trans("laravel-roles::forms.roles-form.buttons.save-role.name") !!}
                    </button>
                </span>
            </div>
        </div>
    </div>
</form>

@include('laravel-roles::scripts.form-inputs-helpers')
