@extends('layouts.app', ['title' => __('Test Entry')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Test List'),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Referrence Range</th>
                                    <th>Unit</th>
                                    <th>Rate Rs.</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                @foreach ($categories as $category)
                                    <tr class="table-light">
                                        <td colspan="4" class="text-center"><a
                                                href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.show', $category) }}"><button
                                                    class="btn btn-sm btn-success fa fa-plus"></button></a>
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
