@extends('layouts.app', ['title' => __('Test Entry')])

@section('content')
    <style>
        /* Hide spinners in Chrome, Safari, Edge, and Opera */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hide spinners in Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
    @include('users.partials.header', [
        'title' => __('Test Entry in - ' . $category->name),
    ])
    <div class="container">
        @include('message.message')
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="card  shadow">
                    <div class="card-body">
                        <form action="{{ $test->id ? route('tests.update', $test) : route('tests.store', $category) }}"
                            method="post">
                            @csrf
                            @if ($test->id)
                                @method('put')
                            @endif
                            <div class="row">
                                <div class="col-xl-3" style="padding-right: 2px;">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $test->name) }}"
                                            required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-2" style="padding-right: 2px;">
                                    <div class="form-group{{ $errors->has('range') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-range">{{ __('Range') }}</label>
                                        <input type="text" name="range" id="input-range"
                                            class="form-control form-control-alternative{{ $errors->has('range') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Range') }}" value="{{ old('range', $test->range) }}">

                                        @if ($errors->has('range'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('range') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-2" style="padding-right: 2px;">
                                    <div class="form-group{{ $errors->has('unit') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-unit">{{ __('Unit') }}</label>
                                        <input type="text" name="unit" id="input-unit"
                                            class="form-control form-control-alternative{{ $errors->has('unit') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Unit') }}" value="{{ old('unit', $test->unit) }}">

                                        @if ($errors->has('unit'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-1" style="padding-right: 2px;">
                                    <div class="form-group{{ $errors->has('rate') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-rate">{{ __('Rate Rs.') }}</label>
                                        <input type="number" name="rate" id="input-rate" min="0"
                                            class="form-control form-control-alternative{{ $errors->has('rate') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Rate Rs.') }}" value="{{ old('rate', $test->rate) }}">

                                        @if ($errors->has('rate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-right: 2px;">
                                    {{-- @dd($test); --}}
                                    <label class="form-control-label" for="parent_id">{{ __('Parent Test') }}</label>
                                    <select name="parent_id" class="custom-select @error('parent_id') is-invalid @enderror "
                                        id="parent_id">
                                        <option value="">None</option>

                                        @foreach ($tests as $firstLevelTest)
                                            <option value="{{ $firstLevelTest->id }}"
                                                @if ($test->parentTest && $test->parentTest->id == $firstLevelTest->id) selected @endif>
                                                {{ $firstLevelTest->name }}
                                            </option>
                                            {{-- @foreach ($firstLevelTest->childtests as $secondLevelCat)
                                                <option value="{{ $secondLevelCat->id }}"
                                                    @if ($Test->parentTest && $Test->parentTest->id == $secondLevelCat->id) selected @endif>
                                                    -- {{ $secondLevelCat->name }}
                                                </option>
                                            @endforeach --}}
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('parent_id')
                                            {{ $message }}
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-xl-1 mt-2" style="padding-right: 2px;">
                                    <button type="submit"
                                        class="btn btn-success mt-4">{{ __($test->id ? 'Update' : 'Add') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>Test Name</th>
                                    <th>Referrence Range</th>
                                    <th>Unit</th>
                                    <th>Rate Rs.</th>
                                    <th>Parent</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <tbody>
                                    @forelse($tests as $firstLevelTest)
                                        @include('test.table-row', [
                                            'test' => $firstLevelTest,
                                            'level' => 1,
                                        ])

                                        {{-- Second level --}}
                                        @foreach ($firstLevelTest->childtests as $secondLevelTest)
                                            @include('test.table-row', [
                                                'test' => $secondLevelTest,
                                                'level' => 2,
                                                'parentTestName' => $firstLevelTest->name,
                                            ])

                                            {{-- Third level --}}
                                            @foreach ($secondLevelTest->childtests as $thirdLevelTest)
                                                @include('test.table-row', [
                                                    'test' => $thirdLevelTest,
                                                    'level' => 3,
                                                    'parentTestName' => $secondLevelTest->name,
                                                ])
                                            @endforeach
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="42" class="font-italic text-center">No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                {{-- @foreach ($tests as $test)
                                    <tr>
                                        <td>{{ $test->name }}</td>
                                        <td>{{ $test->range }}</td>
                                        <td>{!! $test->unit !!}</td>
                                        <td>{{ $test->rate }}</td>
                              
                                        <td>
                                            <a href="{{ route('tests.edit', $test) }}"><button
                                                    class="btn btn-sm btn-primary fa fa-edit"></button></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('tests.destroy', $test) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit"
                                                    onclick="return confirm('Are you sure to delete?')"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="bottom"
                                                        title="Delete"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
