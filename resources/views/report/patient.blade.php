@extends('layouts.app', ['title' => __('Patient Report')])

@section('content')
    @include('users.partials.header', [
        'title' => __(
            'Patient Report List - [' .
                $patient->name .
                '] - [' .
                $patient->age .
                ' ' .
                $patient->in .
                ' | ' .
                $patient->gender .
                ']'),
    ])
    <div class="container">
        @include('message.message')

        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="m-2">
                    <a class="btn btn-success" href="{{ route('reports.create', $patient) }}">New</a>
                </div>

                <div class="card  shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>SN</th>
                                    <th>Report No.</th>
                                    <th>Registed Date</th>
                                    <th>Referred By</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>

                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a class="dropdown-item" href="{{ route('reports.edit', [$report]) }}">
                                                {{ $report->id }}
                                            </a>
                                        </td>
                                        <td>{{ $report->registed_date }}</td>
                                        <td>{{ $report->refer_by }}</td>
                                        <td>{{ $report->user->name }}</td>
                                        <td>
                                            <div>
                                                <a type="button" class="text-primary" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <span class="svg-icon svg-baseline">
                                                        ...
                                                    </span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    {{-- <a class="dropdown-item" href="{{ route('report.show', $test) }}">Show</a> --}}
                                                    <a class="dropdown-item"
                                                        href="{{ route('reports.edit', [$report]) }}">Edit</a>
                                                    <form class="form-inline d-inline"
                                                        action="{{ route('reports.destroy', $report) }}"
                                                        onsubmit="return confirm('Are you sure to delete ?')"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                            {{ $reports->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
