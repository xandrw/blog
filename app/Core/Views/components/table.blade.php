<table class="table table-striped table-hover" {{ $attributes }}>
    <thead>
    <tr>
        @foreach($columns as $key => $column)
            @can("read.{$table}.{$column}")
                <th>{{ is_string($key) ? $key : $column }}</th>
            @endcan
        @endforeach

        @if($withActions)
            <th class="text-right">Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @php /** @var \Illuminate\Database\Eloquent\Model $item */ @endphp
    @forelse($items as $item)
        @can("read.{$table}", $item->id)
            <tr>
                @foreach($columns as $column)
                    @can("read.{$table}.{$column}")
                        <td>{{ $item->$column }}</td>
                    @endcan
                @endforeach
                @if($withActions)
                    <td class="text-right dropdown">
                        @can("update.{$table}")
                            <a href="{{ route("{$route}.edit", $item->id) }}" class="btn btn-sm btn-default">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        @endcan
                        @can("delete.{$table}")
                            <button class="btn btn-sm btn-danger" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="text-center"
                                        href="{{ route("{$route}.destroy", $item->id) }}">Confirm</a>
                                </li>
                                <li><a class="text-center" href="#">Cancel</a></li>
                            </ul>
                        @endcan
                    </td>
                @endif
            </tr>
        @endcan
    @empty
        <tr>
            <td class="text-center" colspan="5">{{ $emptyMessage }}</td>
        </tr>
    @endforelse
    </tbody>
</table>
