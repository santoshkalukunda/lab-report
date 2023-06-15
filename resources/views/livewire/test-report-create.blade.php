<div>
    <form action="{{ route('testreports.store', $patient) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-xl-2">
                <label class="form-control-label" for="input-gender">{{ __('Test Category') }}</label>
                <select name="category_id" wire:model="categoryId"
                    class="form-control @error('test_id') is-invalid @enderror" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('test_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('test_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-xl-3">
                <label class="form-control-label" for="input-gender">{{ __('Test name') }}</label>
                <select name="test_id" class="form-control @error('test_id') is-invalid @enderror" required>
                    @if (!$categoryId)
                        <option value="" selected>Select Test</option>
                    @else
                        @foreach ($tests as $test)
                            @if ($categoryId == $test->category_id)
                                <option value="{{ $test->id }}">
                                    {{ $test->name }}
                                </option>
                            @endif
                        @endforeach
                    @endif

                </select>
                @if ($errors->has('test_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('test_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-xl-2">
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
            <div class="col-xl-2">
                <label class="form-control-label" for="status">{{ __('Status') }}</label>
                <select class="form-control" name="status" aria-label="Default select example" id="status">
                    <option value="0">Normal</option>
                    <option value="1">Detected</option>
                </select>
            </div>
            <div class="col-xl-2">
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
            <div class="col-xl-1 mt-2">
                <button type="submit" class="btn btn-success mt-4">{{ __('Add') }}</button>
            </div>
        </div>
    </form>
</div>
