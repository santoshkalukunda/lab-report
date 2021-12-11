@extends('layouts.app', ['title' => __('Test Edit')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Test Edit'),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <form action="{{ route('tests.update',$test) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name',$test->name) }}" required
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
                                            placeholder="{{ __('Range') }}" value="{{ old('range',$test->range) }}">

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
                                            placeholder="{{ __('Unit') }}" value="{{ old('unit',$test->unit) }}">

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
                                            placeholder="{{ __('Rate Rs.') }}" value="{{ old('rate',$test->rate) }}">

                                        @if ($errors->has('rate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-2">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
