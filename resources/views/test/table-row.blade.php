<tr>
    <td>
        @if ($level == 1)
            &nbsp; &nbsp; &nbsp; &nbsp;
        @endif
        @if ($level == 2)
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - -
        @endif

        {{ $test->name }}
    </td>
    <td>{{ $test->range }}</td>
    <td>{!! $test->unit !!}</td>
    <td class="text-right">{{ number_format($test->rate, 2) }}</td>
    <td>
        {{ $parentTestName ?? null }}
    </td>
    <td class="text-right">
        <div>
            <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-baseline">
                    ...
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <a class="dropdown-item" href="{{ route('tests.show', $test) }}">Show</a> --}}
                <a class="dropdown-item" href="{{ route('test.edit', [$category, $test]) }}">Edit</a>
                <form class="form-inline d-inline" action="{{ route('tests.destroy', $test) }}"
                    onsubmit="return confirm('Are you sure to delete ?')" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="dropdown-item">Delete</button>
                </form>

            </div>
        </div>
    </td>
</tr>
