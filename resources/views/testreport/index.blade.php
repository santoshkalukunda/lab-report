@extends('layouts.app', ['title' => __('Test Report List')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Test Report List'),

    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="m-2">
                    <a class="btn btn-success" href="{{ route('patients.create') }}">New</a>
                </div>
                <div class="card  shadow">

                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <th>Date</th>
                            <th>Patient Name</th>
                            <th>Test Name</th>
                            <th>Result</th>
                            <th>Unit</th>
                            <th>Method</th>
                            <th>Action</th>
                            @foreach ($testreports as $testreport)
                                <tr>
                                    <td>{{$testreport->patient->date}}</td>
                                    <td>{{$testreport->patient->name}}</td>
                                    <td>{{$testreport->test->name}}</td>
                                    <td>{{$testreport->result}}</td>
                                    <td>{!!$testreport->test->unit!!}</td>
                                    <td>{{$testreport->remarks}}</td>
                                    <td>
                                        <a href="{{route('patients.show',$testreport->patient->id)}}"><button class="btn btn-sm btn-success fa fa-eye"></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{$testreports->links()}}
        </div>
    </div>
@endsection
