@extends('layouts.app', ['title' => __('Patient Report')])

@section('content')
    @include('users.partials.header', [
        'title' => __(
            'Patient Report -[' .
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
                <div class="card  shadow">
                    <div class="card-body">
                        <form method="post"
                            action="{{ $report->id ? route('reports.update', $report) : route('reports.store', $patient) }}">
                            @csrf
                            @if ($report->id)
                                @method('put')
                            @endif
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="">
                                <div class="row">
                                    <div class="col-xl-3">
                                        <div class="form-group{{ $errors->has('registed_date') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                            <input type="date" name="registed_date" id="input-date"
                                                class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Date') }}"
                                                value="{{ old('registed_date', $report->registed_date ?? date('Y-m-d')) }}"
                                                required>

                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group{{ $errors->has('refer_by') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-refer_by">{{ __('Refer by') }}</label>
                                            <input type="text" name="refer_by" id="input-refer_by"
                                                class="form-control form-control-alternative{{ $errors->has('refer_by') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Refer by') }}"
                                                value="{{ old('refer_by', $report->refer_by) }}">

                                            @if ($errors->has('refer_by'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('refer_by') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>



                                </div>

                                @livewire('test-report-create', ['patient' => $patient, 'report' => $report])

                                <div class="col-xl-12">
                                    <div class="form-group{{ $errors->has('remarks') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="">{{ __('Remarks') }}</label>
                                        <textarea class="summernote" rows="6" type="text" name="remarks" placeholder="{{ __('Remarks') }}">{!! $report->remarks !!}</textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success mt-4">{{ __($report->id ? 'Update' : 'Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endsection
    @push('js')
        <script>
            $('.summernote').summernote({
                height: 100, //set editable area's height
                codemirror: { // codemirror options
                    theme: 'paper'
                }

            });
        </script>
    @endpush
