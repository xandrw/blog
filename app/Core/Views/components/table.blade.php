<table class="table table-striped table-hover" {{ $attributes }}>
    <thead>
    <tr>
        @foreach($columns as $key => $column)
            @can("read.{$name}.{$column}")
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
        @can("read.{$name}", $item->id)
            <tr>
                @foreach($columns as $column)
                    @can("read.{$name}.{$column}")
                        <td>{{ $item->$column }}</td>
                    @endcannot
                @endforeach
                @if($withActions)
                    <td class="text-right dropdown">
                        <a href="{{ route("{$route}.edit", $item->id) }}" class="btn btn-sm btn-default">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <button class="btn btn-sm btn-danger" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="text-center" href="{{ route("{$route}.destroy", $item->id) }}">Confirm</a>
                            </li>
                            <li><a class="text-center" href="#">Cancel</a></li>
                        </ul>
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
