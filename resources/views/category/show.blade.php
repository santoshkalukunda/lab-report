@extends('layouts.app', ['title' => __('Test Entry')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Test Entry in - '.$category->name),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <form action="{{ route('tests.store',$category) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name') }}" required
                                            autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('range') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-range">{{ __('Range') }}</label>
                                        <input type="text" name="range" id="input-range"
                                            class="form-control form-control-alternative{{ $errors->has('range') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Range') }}" value="{{ old('range') }}">

                                        @if ($errors->has('range'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('range') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('unit') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-unit">{{ __('Unit') }}</label>
                                        <input type="text" name="unit" id="input-unit"
                                            class="form-control form-control-alternative{{ $errors->has('unit') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Unit') }}" value="{{ old('unit') }}">

                                        @if ($errors->has('unit'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <div class="form-group{{ $errors->has('rate') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-rate">{{ __('Rate Rs.') }}</label>
                                        <input type="number" name="rate" id="input-rate" min="0"
                                            class="form-control form-control-alternative{{ $errors->has('rate') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Rate Rs.') }}" value="{{ old('rate') }}">

                                        @if ($errors->has('rate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rate') }}</strong>
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
                            <table class="table table-hover">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Referrence Range</th>
                                    <th>Unit</th>
                                    <th>Rate Rs.</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td>{{$test->name}}</td>
                                        <td>{{$test->range}}</td>
                                        <td>{!! $test->unit !!}</td>
                                        <td>{{$test->rate}}</td>
                                        <td>
                                            <a href="{{route('tests.edit',$test)}}"><button class="btn btn-sm btn-primary fa fa-edit"></button></a>
                                        </td>
                                        <td>
                                            <form action="{{route('tests.destroy',$test)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit"
                                                    onclick="return confirm('Are you sure to delete?')"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="bottom"
                                                        title="Delete"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
