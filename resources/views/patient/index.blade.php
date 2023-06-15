@extends('layouts.app', ['title' => __('Patients List')])

@section('content')
    @include('users.partials.header', [
    'title' => __('Patients List'),

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
                    @include('patient.filter-modal')
                </div>

                <div class="card  shadow">

                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <th>Date</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Age/Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Refered by</th>
                            <th>Performed by</th>
                            <th colspan="3">Action</th>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->date }}</td>
                                   <td> <a href="{{ route('patients.show', $patient) }}">{{ $patient->name }}</a></td>
                                    <td>{{ $patient->address }}</td>
                                    <td>{{ $patient->age }} {{ $patient->in }}| {{ $patient->gender }}</td>
                                    <td>{{ $patient->phone }}</td>
                                    <td>{{ $patient->email }}</td>
                                    <td>{{ $patient->referred }}</td>
                                    <td>{{ $patient->user->name }}</td>
                                    <td>
                                        <a href="{{ route('patients.edit', $patient) }}"><button
                                                class="btn btn-sm btn-primary fa fa-edit"></button></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('patients.show', $patient) }}"><button
                                                class="btn btn-sm btn-success fa fa-eye"></button></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('patients.destroy', $patient) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick="return confirm('Are you sure to delete?')"><i
                                                    class="fa fa-trash" data-toggle="tooltip" data-placement="bottom"
                                                    title="Delete"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{ $patients->links() }}
        </div>
    </div>
@endsection
