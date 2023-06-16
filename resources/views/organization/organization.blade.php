@extends('layouts.app', ['title' => __('Organization Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Organization Profile'),
    ])

    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-secondary shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">

                                <img src="{{ asset('storage/' . $organization->logo) }}" class="border"
                                    style=" max-height:200px;">

                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('organizations.store') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf


                            <h6 class="heading-small text-muted mb-4">{{ __('Organization Profil') }}</h6>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class=" pl-lg-4">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('logo') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-logo">{{ __('Logo') }} (it
                                                should be in .JPG only)</label>
                                            <input type="file" name="logo" id="input-logo"
                                                class="form-control form-control-alternative{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Logo') }}"
                                                value="{{ old('logo', $organization->logo) }}" accept="image/jpeg">

                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="input-name"
                                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Name') }}"
                                                value="{{ old('name', $organization->name) }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-address">{{ __('Address') }}</label>
                                            <input type="text" name="address" id="input-address"
                                                class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Address') }}"
                                                value="{{ old('address', $organization->address) }}" required>

                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                                            <input type="tel" name="phone" id="input-phone"
                                                class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Phone') }}"
                                                value="{{ old('phone', $organization->phone) }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="input-email"
                                                class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Email') }}"
                                                value="{{ old('email', $organization->email) }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('Web Site') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-pan-vat">{{ __('Web-site') }}</label>
                                            <input type="text" name="url" id="input-pan-vat"
                                                class="form-control form-control-alternative{{ $errors->has('url') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Web-site') }}"
                                                value="{{ old('url', $organization->url) }}">

                                            @if ($errors->has('url'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('url') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('pan_vat_type') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-pan_vat_type">{{ __('PAN/VAT Type') }}</label>
                                            <select name="pan_vat_type"
                                                class="form-control form-control-alternative custom-select {{ $errors->has('pan_vat_type') ? ' is-invalid' : '' }}"
                                                required>
                                                <option value="PAN" {{$organization->pan_vat_type == "PAN" ? "selected" : ""}} >PAN</option>
                                                <option value="VAT" {{$organization->pan_vat_type == "VAT" ? "selected" : ""}}>VAT</option>
                                            </select>
                                            @if ($errors->has('pan_vat_type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('pan_vat_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group{{ $errors->has('Web Site') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-pan-vat">{{ __('PAN/VAT No.') }}</label>
                                            <input type="number" name="pan_vat_number" id="input-pan-vat"
                                                class="form-control form-control-alternative{{ $errors->has('pan_vat_number') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('PAN/VAT No.') }}"
                                                value="{{ old('pan_vat_number', $organization->pan_vat_number) }}">

                                            @if ($errors->has('pan_vat_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('pan_vat_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
