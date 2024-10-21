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
    <td style="white-space: nowrap;">
        <div class="d-flex">

            <a class="btn btn-sm btn-primary fa fa-edit" href="{{ route('test.edit', [$category, $test]) }}"
                data-toggle="tooltip" data-placement="bottom" title="edit"></a>


            <form action="{{ route('tests.destroy', $test) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm" type="submit"
                    onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash" data-toggle="tooltip"
                        data-placement="bottom" title="Delete"></i></button>
            </form>
        </div>
    </td>
</tr>
