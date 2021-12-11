@extends('layouts.app',['title' => __('Dashboard')])

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container">
       
        <div class="row justify-content-center mt-md-5 mt-3">
            <div class="col-md-6">
                <img class="img img-center" src="{{asset('storage/'.$organization->logo) }}" alt="Logo" height="150px" width="150px">
                <div class=" text-center">
                    <h2>{{$organization->name}}</h2>
                    <h4>{{$organization->address}}</h4>
                    <h4>{{$organization->phone}}</h4>
                    <h4>{{$organization->email}}</h4>

                    <h5>Lab Report System</h5>
                </div>
               
            </div>
        </div>
    </div>
@endsection