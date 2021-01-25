<div class="table-responsive roles-table">
    <table class="table table-sm table-striped data-table roles-table">
        <caption class="p-1 pb-0">
            @if($tabletype == 'normal')
                {!! trans_choice('laravel-roles::roles-table.caption', $items->count(), ['count' => $items->count()]) !!}
            @endif
            @if($tabletype == 'deleted')
                {!! trans_choice('laravel-roles::roles-deleted-table.caption', $items->count(), ['count' => $items->count()]) !!}
            @endif
        </caption>
        <thead class="thead">
            <tr>
                <th scope="col">
                    {!! trans('laravel-roles::admin.roles-table.id') !!}
                </th>
                <th scope="col">
                    {!! trans('laravel-roles::admin.roles-table.name') !!}
                </th>
                <th scope="col" class="hidden-xs ">
                    {!! trans('laravel-roles::admin.roles-table.desc') !!}
                </th>
                <th scope="col">
                    {!! trans('laravel-roles::admin.roles-table.level') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm">
                    {!! trans('laravel-roles::admin.roles-table.permissons') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm ">
                    {!! trans('laravel-roles::admin.roles-table.createdAt') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm ">
                    {!! trans('laravel-roles::admin.roles-table.updatedAt') !!}
                </th>
                @if($tabletype == 'deleted')
                    <th scope="col" class="hidden-xs hidden-sm ">
                        {!! trans('laravel-roles::admin.roles-table.deletedAt') !!}
                    </th>
                @endif
                <th class="no-search no-sort " colspan="3">
                    {!! trans('laravel-roles::admin.roles-table.actions') !!}
                </th>
            </tr>
        </thead>
        <tbody class="roles-table-body">
            @if($items->count() > 0)
                @foreach($items as $item)
                    <tr>
                        <td>
                            @if($tabletype == 'normal')
                                {{ $item['role']->id }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->id }}
                            @endif
                        </td>
                        <td>
                            @if($tabletype == 'normal')
                                {{ $item['role']->name }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->name }}
                            @endif
                        </td>
                        <td class="hidden-xs">
                            @if($tabletype == 'normal')
                                {{ $item['role']->description }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->description }}
                            @endif
                        </td>
                        <td>
                            @if($tabletype == 'normal')
                                {{ $item['role']->level }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->level }}
                            @endif
                        </td>
                        <td class="hidden-xs hidden-sm">
                            @if($tabletype == 'normal')
                                @if($item['permissions']->count() > 0)
                                    @foreach($item['permissions'] as $itemPermKey => $itemPerm)
                                        <span class="badge badge-pill badge-primary mb-1">
                                            {{ $itemPerm->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge badge-pill badge-default">
                                        {!! trans('laravel-roles::admin.cards.none-count') !!}
                                    </span>
                                @endif
                            @endif
                            @if($tabletype == 'deleted')
                                @if($item->permissions()->count() > 0)
                                    @foreach($item->permissions()->get() as $itemPermKey => $itemPerm)
                                        <span class="badge badge-pill badge-primary mb-1">
                                            {{ $itemPerm->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge badge-pill badge-default">
                                        {!! trans('laravel-roles::admin.cards.none-count') !!}
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td class="hidden-xs hidden-sm">
                            @if($tabletype == 'normal')
                                {{ $item['role']->created_at->format(trans('laravel-roles::admin.date-format')) }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->created_at->format(trans('laravel-roles::admin.date-format')) }}
                            @endif
                        </td>
                        <td class="hidden-xs hidden-sm">
                            @if($tabletype == 'normal')
                                {{ $item['role']->updated_at->format(trans('laravel-roles::admin.date-format')) }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->updated_at->format(trans('laravel-roles::admin.date-format')) }}
                            @endif
                        </td>
                        @if($tabletype == 'deleted')
                            <td class="hidden-xs hidden-sm">
                                {{ $item->deleted_at->format(trans('laravel-roles::admin.date-format')) }}
                            </td>
                        @endif
                        @if($tabletype == 'normal')
                            <td>
                                <a class="btn btn-sm btn-outline-info btn-block" href="{{ route('laravel-roles::roles.show', $item['role']->id) }}" data-toggle="tooltip" title="{{ trans('laravel-roles::admin.tooltips.show-role') }}">
                                    {!! trans("laravel-roles::buttons.show") !!}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-secondary btn-block" href="{{ route('laravel-roles::roles.edit', $item['role']->id) }}" data-toggle="tooltip" title="{{ trans('laravel-roles::admin.tooltips.edit-role') }}">
                                    {!! trans("laravel-roles::buttons.edit") !!}
                                </a>
                            </td>
                            <td>
                                @include('laravel-roles::forms.delete-sm', ['type' => 'Role' ,'item' => $item['role']])
                            </td>
                        @endif
                        @if($tabletype == 'deleted')
                            <td>
                                <a class="btn btn-sm btn-outline-info btn-block" href="{{ route('laravel-roles::role-show-deleted', $item->id) }}" data-toggle="tooltip" title="{{ trans('laravel-roles::admin.tooltips.show-deleted-role') }}">
                                    {!! trans("laravel-roles::buttons.show-deleted-role") !!}
                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                @include('laravel-roles::forms.restore-item', ['style' => 'small', 'type' => 'role', 'item' => $item])
                            </td>
                            <td>
                                @include('laravel-roles::forms.destroy-sm', ['type' => 'Role' ,'item' => $item])
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{!! trans("laravel-roles::roles-table.none") !!}</td>
                    <td></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs hidden-md"></td>
                    <td class="hidden-sm hidden-xs hidden-md"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
