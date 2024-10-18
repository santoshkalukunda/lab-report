@extends('layouts.app', ['title' => __('Test Category Entry')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Test Category Entry'),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <form
                            action="{{ $category->id ? route('categories.update', $category) : route('categories.store') }}"
                            method="post">
                            @csrf
                            @if ($category->id)
                                @method('put')
                            @endif
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $category->name) }}"
                                            required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label" for="parent_id">{{ __('Parent Category') }}</label>
                                    <select name="parent_id" class="custom-select @error('parent_id') is-invalid @enderror "
                                        id="parent_id">
                                        <option value="">None</option>
                                        @foreach ($categories as $firstLevelCategory)
                                            <option value="{{ $firstLevelCategory->id }}"
                                                @if ($category->parentCategory && $category->parentCategory->id == $firstLevelCategory->id) selected @endif>
                                                {{ $firstLevelCategory->name }}
                                            </option>
                                            @foreach ($firstLevelCategory->childcategories as $secondLevelCat)
                                                <option value="{{ $secondLevelCat->id }}"
                                                    @if ($category->parentCategory && $category->parentCategory->id == $secondLevelCat->id) selected @endif>
                                                    -- {{ $secondLevelCat->name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('parent_id')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-xl-1 mt-2">
                                    <button type="submit" class="btn btn-success mt-4">{{ __($category->id ? 'Update' :'Add') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Parent</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                <tbody>
                                    @forelse($categories as $firstLevelCategory)
                                        @include('category.table-row', [
                                            'category' => $firstLevelCategory,
                                            'level' => 1,
                                        ])

                                        {{-- Second level --}}
                                        @foreach ($firstLevelCategory->childCategories as $secondLevelCategory)
                                            @include('category.table-row', [
                                                'category' => $secondLevelCategory,
                                                'level' => 2,
                                                'parentCategoryName' => $firstLevelCategory->name,
                                            ])

                                            {{-- Third level --}}
                                            @foreach ($secondLevelCategory->childCategories as $thirdLevelCategory)
                                                @include('category.table-row', [
                                                    'category' => $thirdLevelCategory,
                                                    'level' => 3,
                                                    'parentCategoryName' => $secondLevelCategory->name,
                                                ])
                                            @endforeach
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="42" class="font-italic text-center">No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                {{-- @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category) }}"><button
                                                    class="btn btn-sm btn-primary fa fa-edit"></button></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.show', $category) }}"><button
                                                    class="btn btn-sm btn-success fa fa-eye"></button></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('categories.destroy', $category) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit"
                                                    onclick="return confirm('Are you sure to delete?')"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="bottom"
                                                        title="Delete"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
