@extends('layouts.app', ['title' => __('Patient Report')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Patient Report'),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">

                <div class="text-center">
                    <h2 class="text-capitalize">{{ $patient->name }}</h2>
                    <div><b>Address:</b> {{ $patient->address }}</div>
                    <div><b>Age :</b> {{ $patient->age }}{{ $patient->in }} | <b>Gender:</b>
                        @if ($patient->gender == 'M')
                            <span>Male</span>
                        @endif
                        @if ($patient->gender == 'F')
                            <span>Female</span>
                        @endif
                        @if ($patient->gender == 'O')
                            <span>Other</span>
                        @endif

                        <div><b>Referred By:</b> {{ $patient->referred }}</div>
                        <div><b>Date:</b> {{ $patient->date }}</div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('test-reports-pdf', $patient) }}" class="btn btn-sm btn-primary fa fa-print m-2"
                            target="_blank"> 
                            Print Report
                        </a>
                            <a href="{{ route('test-bill-pdf', $patient) }}" class="btn btn-sm btn-success fa fa-print m-2"
                            target="_blank"> 
                            Print Bill
                        </a>
                    </div>
                    <div class="card  shadow">
                        <div class="card-body">
                            @livewire('test-report-create', ['patient' => $patient])
                      
                            @php
                                $i = 1;
                                $j = 0;
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Test</th>
                                        <th>Result</th>
                                        <th>Unit</th>
                                        <th>Referrence Range</th>
                                        <th>Method</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($tests as $test)
                                        @foreach ($testreports as $testreport)
                                            @if ($test->id == $testreport->test_id)
                                                @if ($j < $test->category->id)
                                                    <tr>
                                                        <td colspan="6"><b><u class="Capitalization">{{ $test->category->name }} Report</u></b></td>
                                                    </tr>
                                                    @php
                                                        $j = $test->category->id;
                                                    @endphp
                                                @endif
                                                <tr>
                                                    <td>{{ $testreport->test->name }}</td>
                                                    <td> <div style="{{$testreport->status == true ? "font-weight: bold; text-decoration-line: underline;" : ""}}">{{ $testreport->result }}</div></td>
                                                    <td>{!! $testreport->test->unit !!}</td>
                                                    <td>{{ $testreport->test->range }}</td>
                                                    <td>{{ $testreport->remarks }}</td>
                                                    <td>
                                                        <form action="{{ route('testreports.destroy', $testreport) }}"
                                                            method="post">
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
