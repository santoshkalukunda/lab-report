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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                        Filter
                    </button>
                    <button class="btn btn-danger" onclick="document.getElementById('pdf-form').submit();">Export To PDF
                    </button>
                    @include('testreport.pdf-form')
                    @include('testreport.filter-modal')
                </div>
                <div class="card  shadow">

                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <th>Date</th>
                            <th>Patient Name</th>
                            <th>Age/Gender</th>
                            <th>Test Name</th>
                            <th>Result</th>
                            <th>Unit</th>
                            <th>Method</th>
                            <th>Action</th>
                            @foreach ($testreports as $testreport)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($testreport->created_at)) }}</td>
                                    <td>{{ $testreport->patient->name }}</td>
                                    <td>{{ $testreport->patient->age }}{{ $testreport->patient->in }}|
                                        {{ $testreport->patient->gender }}</td>
                                    <td>{{ $testreport->test->name }}</td>
                                    <td>{{ $testreport->result }}</td>
                                    <td>{!! $testreport->test->unit !!}</td>
                                    <td>{{ $testreport->remarks }}</td>
                                    <td>
                                        <a href="{{ route('patients.show', $testreport->patient->id) }}"><button
                                                class="btn btn-sm btn-success fa fa-eye"></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
