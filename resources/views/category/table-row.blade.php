<tr>
    <td>
        @if ($level == 1)
        @endif
        @if ($level == 2)
            &nbsp; - -
        @endif
        @if ($level == 3)
            &nbsp; &nbsp; - - - -
        @endif
        {{ $category->name }}
    </td>
    <td>
        {{ $parentCategoryName ?? null }}
    </td>

    <td style="white-space: nowrap;">
        <div class="d-flex">
            @if ($level == 2)
                <a class="btn btn-sm btn-primary fa fa-eye" data-toggle="tooltip" data-placement="bottom"
                    title="Test Create" href="{{ route('categories.show', $category) }}" target="_blank"></a>
            @endif

            <a class="btn btn-sm btn-primary fa fa-edit" href="{{ route('categories.edit', $category) }}"
                data-toggle="tooltip" data-placement="bottom" title="edit"></a>


            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm" type="submit"
                    onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash" data-toggle="tooltip"
                        data-placement="bottom" title="Delete"></i></button>
            </form>
        </div>


    </td>
</tr>
