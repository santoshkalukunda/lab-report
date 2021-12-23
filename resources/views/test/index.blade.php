@extends('layouts.app', ['title' => __('Test Entry')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Test Entry'),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Test Category') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Test Category') }}" value="{{ old('name') }}" required
                                            autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-1 mt-2">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Referrence Range</th>
                                    <th>Unit</th>
                                    <th>Rate Rs.</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                @foreach ($categories as $category)
                                    <tr class="table-light">
                                        <td colspan="4" class="text-center"><a
                                                href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                                        </td>
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
                                    @foreach ($tests as $test)

                                        @if ($category->id == $test->category_id)

                                            <tr>
                                                <td>{{ $test->name }}</td>
                                                <td>{{ $test->range }}</td>
                                                <td>{!! $test->unit !!}</td>
                                                <td>{{ $test->rate }}</td>
                                                <td>
                                                    <a href="{{ route('tests.edit', $test) }}"><button
                                                            class="btn btn-sm btn-primary fa fa-edit"></button></a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('tests.destroy', $test) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirm('Are you sure to delete?')"><i
                                                                class="fa fa-trash" data-toggle="tooltip"
                                                                data-placement="bottom" title="Delete"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
