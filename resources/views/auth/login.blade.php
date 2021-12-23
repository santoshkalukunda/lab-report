@extends('layouts.app', [ 'title' => __('[Login]'),'class' => 'bg-white'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 my-5">
                <div class=" text-center">
                    <h3>Geruwa Community Health Center</h3>
                    <h4>Geruwa-5, Bardiya</h4>
                    <h5>Lab Report System</h5>
                </div>
                <img class="img img-center" src=" {{asset('microscope.jpg')}}" alt="Logo" height="100px" width="100px">
                <div>
                    <div >
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                --}}
                                <div class="col-md-12 text-center mb-3">
                                    <span style="font-size: 30px;">Login</span>
                                </div>
    
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" placeholder="Email" required
                                        autocomplete="email" autofocus>
    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                --}}
    
                                <div class="col-md-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="Password" required autocomplete="current-password">
    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary form-control">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-md-8 offset-md-4">
                                    {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
