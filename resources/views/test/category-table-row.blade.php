<tr>
    <td>
        @if ($level == 1)
            <span style="font-weight: bold; font-size: 15px;">
                {{ $category->name }}
            </span>
        @endif
        @if ($level == 2)
            <a href="{{ route('categories.show', $category) }}">
                &nbsp; - -
                <span style="font-weight: bold;">
                    {{ $category->name }}
                </span>
            </a>
        @endif
        @if ($level == 3)
            &nbsp; &nbsp; - - - -
        @endif

    </td>

    <td>

    </td>
    <td>

    </td>
    <td>

    </td>
    <td>
        {{ $parentCategoryName ?? null }}
    </td>
    <td class="text-right">
        {{-- <div>
            <a type="button" class="text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-baseline">
                    ...
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @if ($level == 2)
                    <a class="dropdown-item" href="{{ route('categories.show', $category) }}">Show</a>
                @endif
                <a class="dropdown-item" href="{{ route('categories.edit', $category) }}">Edit</a>
                <form class="form-inline d-inline" action="{{ route('categories.destroy', $category) }}"
                    onsubmit="return confirm('Are you sure to delete ?')" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="dropdown-item">Delete</button>
                </form>

            </div>
        </div> --}}
    </td>
</tr>
