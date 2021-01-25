<div class="table-responsive permissions-table">
    <table class="table table-sm table-striped data-table permissions-table">
        <caption class="p-1 pb-0">
            @if($tabletype == 'normal')
                {!! trans_choice('laravel-roles::permissions-table.caption', $items->count(), ['count' => $items->count()]) !!}
            @endif
            @if($tabletype == 'deleted')
                {!! trans_choice('laravel-roles::permissions-deleted-table.caption', $items->count(), ['count' => $items->count()]) !!}
            @endif
        </caption>
        <thead class="thead">
            <tr>
                <th scope="col">
                    {!! trans('laravel-roles::admin.permissions-table.id') !!}
                </th>
                <th scope="col">
                    {!! trans('laravel-roles::admin.permissions-table.name') !!}
                </th>
                <th scope="col">
                    {!! trans('laravel-roles::admin.permissions-table.slug') !!}
                </th>
                <th scope="col" class="hidden-xs">
                    {!! trans('laravel-roles::admin.permissions-table.desc') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm">
                    {!! trans('laravel-roles::admin.permissions-table.roles') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm ">
                    {!! trans('laravel-roles::admin.permissions-table.createdAt') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm ">
                    {!! trans('laravel-roles::admin.permissions-table.updatedAt') !!}
                </th>
                @if($tabletype == 'deleted')
                    <th scope="col" class="hidden-xs hidden-sm ">
                        {!! trans('laravel-roles::admin.permissions-table.deletedAt') !!}
                    </th>
                @endif
                <th class="no-search no-sort " colspan="3">
                    {!! trans('laravel-roles::admin.permissions-table.actions') !!}
                </th>
            </tr>
        </thead>
        <tbody class="permissions-table-body">
            @if($items->count() > 0)
                @foreach($items as $item)
                    <tr>
                        <td>
                            @if($tabletype == 'normal')
                                {{ $item['permission']->id }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->id }}
                            @endif
                        </td>
                        <td>
                            @if($tabletype == 'normal')
                                {{ $item['permission']->name }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->name }}
                            @endif
                        </td>
                        <td>
                            @if($tabletype == 'normal')
                                {{ $item['permission']->slug }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->slug }}
                            @endif
                        </td>
                        <td class="hidden-xs">
                            @if($tabletype == 'normal')
                                {{ $item['permission']->description }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->description }}
                            @endif
                        </td>
                        <td class="hidden-xs hidden-sm">
                            @if($tabletype == 'normal')
                                @if($item['roles']->count() > 0)
                                    @foreach($item['roles'] as $itemUserKey => $subItem)
                                        <span class="badge badge-pill badge-secondary mb-1">
                                            {{ $subItem->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="badge badge-pill badge-default">
                                        {!! trans('laravel-roles::admin.cards.none-count') !!}
                                    </span>
                                @endif
                            @endif
                            @if($tabletype == 'deleted')
                                @if($item->roles()->count() > 0)
                                    @foreach($item->roles()->get() as $itemUserKey => $subItem)
                                        <span class="badge badge-pill badge-secondary mb-1">
                                            {{ $subItem->name }}
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
                                {{ $item['permission']->created_at->format(trans('laravel-roles::admin.date-format')) }}
                            @endif
                            @if($tabletype == 'deleted')
                                {{ $item->created_at->format(trans('laravel-roles::admin.date-format')) }}
                            @endif
                        </td>
                        <td class="hidden-xs hidden-sm">
                            @if($tabletype == 'normal')
                                {{ $item['permission']->updated_at->format(trans('laravel-roles::admin.date-format')) }}
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
                                <a class="btn btn-sm btn-outline-info btn-block" href="{{ route('laravel-roles::permissions.show', $item['permission']->id) }}" data-toggle="tooltip" title="{{ trans('laravel-roles::admin.tooltips.show-permission') }}">
                                    {!! trans("laravel-roles::buttons.show") !!}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-secondary btn-block" href="{{ route('laravel-roles::permissions.edit', $item['permission']->id) }}" data-toggle="tooltip" title="{{ trans('laravel-roles::admin.tooltips.edit-permission') }}">
                                    {!! trans("laravel-roles::buttons.edit") !!}
                                </a>
                            </td>
                            <td>
                                @include('laravel-roles::forms.delete-sm', ['type' => 'Permission' ,'item' => $item['permission']])
                            </td>
                        @endif
                        @if($tabletype == 'deleted')


                            <td>
                                <a class="btn btn-sm btn-outline-info btn-block" href="{{ route('laravel-roles::permission-show-deleted', $item->id) }}" data-toggle="tooltip" title="{{ trans('laravel-roles::admin.tooltips.show-deleted-permission') }}">
                                    {!! trans("laravel-roles::buttons.show-deleted-permission") !!}
                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
@include('laravel-roles::forms.restore-item', ['style' => 'small', 'type' => 'permission', 'item' => $item])
                            </td>
                            <td>
@include('laravel-roles::forms.destroy-sm', ['type' => 'Permission' ,'item' => $item])
                            </td>



                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{!! trans("laravel-roles::permissions-table.none") !!}</td>
                    <td></td>
                    <td></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs hidden-sm"></td>
                    <td class="hidden-xs hidden-sm"></td>
                    <td class="hidden-xs hidden-sm"></td>
                    @if($tabletype == 'deleted')
                        <td class="hidden-sm hidden-xs"></td>
                    @endif
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
