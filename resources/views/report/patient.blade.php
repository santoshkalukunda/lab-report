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
                                    <th>Performed By</th>
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
                                        <td style="white-space: nowrap;">
                                            <div class="d-flex">

                                                <a class="btn btn-sm btn-primary fa fa-eye" data-toggle="tooltip"
                                                    data-placement="bottom" title="Report Print"
                                                    href="{{ route('reports.show', $report) }}" target="_blank"></a>


                                                <a class="btn btn-sm btn-primary fa fa-print"
                                                    href="{{ route('reports.invoice', $report) }}" target="_blank"
                                                    data-toggle="tooltip" data-placement="bottom" title="Invoice">
                                                </a>

                                                <a class="btn btn-sm btn-primary fa fa-edit"
                                                    href="{{ route('reports.edit', [$report]) }}" data-toggle="tooltip"
                                                    data-placement="bottom" title="edit"></a>


                                                <form action="{{ route('reports.destroy', $report) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                        onclick="return confirm('Are you sure to delete?')"><i
                                                            class="fa fa-trash" data-toggle="tooltip"
                                                            data-placement="bottom" title="Delete"></i></button>
                                                </form>
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
