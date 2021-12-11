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
                    <h1>{{ $patient->name }}</h1>
                    <h3><b>Address:</b> {{ $patient->address }}</h3>
                    <h3><b>Date:</b> {{ $patient->date }}</h3>
                    <h3><b>Age :</b> {{ $patient->age }}{{ $patient->in }} | <b>Gender:</b>
                        {{ $patient->gender = 'M' ? 'Male' : 'Female' }}</h3>
                    <h3><b>Phone: </b>{{ $patient->phone }} <b>Email: </b>{{ $patient->email }}</h3>
                </div>
                <div class="text-right">
                    <a href="{{route('test-reports-pdf',$patient)}}" class="btn btn-sm btn-primary fa fa-print m-2" target="_blank"> Print</a>
                </div>
                <div class="card  shadow">
                    <div class="card-body">
                        <form action="{{route('testreports.store',$patient)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-4">
                                    <label class="form-control-label" for="input-gender">{{ __('Test name') }}</label>
                                    <select class="selectpicker form-control @error('test_id') is-invalid @enderror" name="test_id"
                                    id="product" data-live-search="true" data-size="4" required>
                                    <option value="" selected>Select Test</option>
                                    @foreach ($tests as $test)
                                    <option value="{{$test->id}}" data-content="<b>{{$test->name}}</b>
                                        <br>{{$test->range}}
                                        <br>{{$test->unit}}
                                        <br>{{$test->rate}}
                                        "></option>
                                    @endforeach
                                  </select>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('result') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-result">{{ __('Result') }}</label>
                                        <input type="text" name="result" id="input-result"
                                            class="form-control form-control-alternative{{ $errors->has('result') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Result') }}" value="{{ old('result') }}" required>

                                        @if ($errors->has('result'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('result') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-remarks">{{ __('Method') }}</label>
                                        <input type="text" name="remarks" id="input-remarks"
                                            class="form-control form-control-alternative{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Method') }}" value="{{ old('remarks') }}">

                                        @if ($errors->has('remarks'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('remarks') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-2 mt-2">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
                                </div>
                            </div>
                        </form>
                        @php
                            $i=1;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>SN</th>
                                    <th>Test Name</th>
                                    <th>Result</th>
                                    <th>Unit</th>
                                    <th>Referrence Range</th>
                                    <th>Method</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($testreports as $testreport)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ $testreport->test->name }}</td>
                                    <td>{{ $testreport->result }}</td>
                                    <td>{!! $testreport->test->unit !!}</td>
                                    <td>{{ $testreport->test->range}}</td>
                                    <td>{{$testreport->remarks}}</td>
                                    <td>
                                        <form action="{{ route('testreports.destroy', $testreport) }}" method="post">
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
            </div>
        </div>
    </div>
@endsection
