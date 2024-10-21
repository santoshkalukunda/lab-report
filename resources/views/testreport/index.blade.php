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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
                        Filter
                    </button>
                    @include('testreport.filter-modal')
                </div>
                <div class="card  shadow">

                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <th>Date</th>
                            <th>Report No.</th>
                            <th>Patient Name</th>
                            <th>Age/Gender</th>
                            <th>Test Name</th>
                            <th>Result</th>
                            <th>Unit</th>
                            <th>Method</th>
                            @foreach ($testreports as $testreport)
                                <tr>
                                    <td>{{ date('Y-m-d', strtotime($testreport->report->registed_date)) }}</td>
                                    <td>
                                        <a href="{{ route('reports.show', $testreport->report) }}" target="_blank"
                                            data-toggle="tooltip" data-placement="bottom" title="Report Print">
                                            {{ $testreport->report->id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('patients.show', $testreport->report->patient) }}" data-toggle="tooltip"
                                            data-placement="bottom" title="View Report">
                                            {{ $testreport->report->patient->name }}
                                        </a>
                                    </td>
                                    <td>{{ $testreport->report->patient->age }}{{ $testreport->report->patient->in }}|
                                        {{ $testreport->report->patient->gender }}</td>
                                    <td>{{ $testreport->test->name }}</td>
                                    <td class="{{ $testreport->status == 1 ? 'font-bold' : '' }}">{{ $testreport->result }}
                                    </td>
                                    <td>{!! $testreport->test->unit !!}</td>
                                    <td>{{ $testreport->remarks }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{ $testreports->links() }}
        </div>
    </div>
@endsection
