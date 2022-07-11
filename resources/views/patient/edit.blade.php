@extends('layouts.app', ['title' => __('Patient Edit')])

@section('content')
@include('users.partials.header', [
    'title' => __('Patient Edit'),

    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <form method="post" action="{{ route('patients.update',$patient) }}">
                            @csrf
                            @method('put')
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                            <input type="date" name="date" id="input-date"
                                                class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Date') }}"
                                                value="{{old('email',$patient->date) }}" required>

                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name"
                                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Name') }}"
                                                value="{{ old('name',$patient->name) }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                  
                                    <div class="col-xl-2">
                                        <div class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-gender">{{ __('Gender') }}</label>
                                                <select name="gender" class="form-control form-control-alternative custom-select {{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                                                    <option {{$patient->gender == 'M' ? 'selected' : ''}} value="M">Male</option>
                                                    <option {{$patient->gender == 'F' ? 'selected' : ''}} value="F">Female</option>
                                                    <option {{$patient->gender == 'O' ? 'selected' : ''}} value="O">Other</option>
                                                  </select>
                                            @if ($errors->has('gender'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-1">
                                        <div class="form-group{{ $errors->has('age') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-age">{{ __('Age') }}</label>
                                            <input type="number" name="age" id="input-age" 
                                                class="form-control form-control-alternative{{ $errors->has('age') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Age') }}"
                                                value="{{ old('age',$patient->age) }}" required min="1">

                                            @if ($errors->has('age'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('age') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-2">
                                        <div class="form-group{{ $errors->has('in') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-in">{{ __('In') }}</label>
                                                <select name="in" class="form-control form-control-alternative custom-select {{ $errors->has('in') ? ' is-invalid' : '' }}" required>
                                                    <option {{$patient->gender == 'Y' ? 'selected' : ''}} value="Y">Year</option>
                                                    <option {{$patient->gender == 'M' ? 'selected' : ''}} value="M">Month</option>
                                                  </select>
                                            @if ($errors->has('in'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('in') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-address">{{ __('Address') }}</label>
                                            <input type="text" name="address" id="input-address"
                                                class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Address') }}"
                                                value="{{ old('address',$patient->address) }}" required>

                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                            <input type="tel" name="phone" id="input-phone"
                                                class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Phone') }}"
                                                value="{{ old('phone',$patient->phone) }}">

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="input-email"
                                                class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Email') }}"
                                                value="{{ old('email',$patient->email) }}">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-3">
                                        <div class="form-group{{ $errors->has('referred') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-refferred">{{ __('Referred By') }}</label>
                                            <input type="text" name="referred" id="input-refferred"
                                                class="form-control form-control-alternative{{ $errors->has('refferred') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Refferred By') }}"
                                                value="{{ old('refferred',$patient->referred) }}">

                                            @if ($errors->has('refferred'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('refferred') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="">{{ __('Remarks') }}</label>
                                            <textarea class="summernote" rows="6" type="text" name="remarks" placeholder="{{ __('Remarks') }}">{!!$patient->remarks !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
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
@push('js')
    <script>
        $('.summernote').summernote({
            height: 100, //set editable area's height
            codemirror: { // codemirror options
                theme: 'paper'
            }
          
        });
    </script>
@endpush
