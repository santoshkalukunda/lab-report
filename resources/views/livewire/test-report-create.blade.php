<div>

    <div class="row">
        <div class="col-xl-3">
            <label class="form-control-label" for="input-gender">{{ __('Test Category') }}</label>
            <select name="category_id" wire:model.live="categoryId"
                class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-xl-4">
            <label class="form-control-label" for="input-gender">{{ __('Test Sub-Category') }}</label>
            <select name="sub_category_id" wire:model="subCategoryId"
                class="form-control @error('sub_category_id') is-invalid @enderror">
                <option value="">Select Sub-Category</option>
                @foreach ($subCategories as $category)
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
        <div class="col-xl-1 mt-2">
            <button type="button" class="btn btn-success mt-4" wire:click="loadTests">{{ __('Load Test') }}</button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Test</th>
                <th>Result</th>
                <th>Unit</th>
                <th>Referrence Range</th>
                <th>Status</th>
                <th>Method</th>
                <th>Action</th>
            </tr>
            @php
                $newCategoryId = '';
                $newSubCategoryId = '';
            @endphp
            @foreach ($testList as $index => $test)
                @if ($test['category_id'] != $newCategoryId)
                    <tr>
                        <td colspan="6" class="text-center">

                            <b>
                                {{ $test['category_name'] }}
                            </b>
                        </td>
                    </tr>
                @endif
                @if ($test['sub_category_id'] != $newSubCategoryId)
                    <tr>
                        <td colspan="6">

                            <b>
                                {{ $test['sub_category_name'] }}
                            </b>
                        </td>
                    </tr>
                @endif
                <tr>

                    <td style="{{ $test['parent_id'] ? 'padding-left:40px;' : '' }}">
                        <input type="text" name="category_id[{{ $index }}]"
                            class="form-control form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('category_id') }}"
                            value="{{ old('category_id', $test['category_id']) }}" hidden>
                        <input type="text" name="sub_category_id[{{ $index }}]"
                            class="form-control form-control-alternative{{ $errors->has('sub_category_id') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('sub_category_id') }}"
                            value="{{ old('sub_category_id', $test['sub_category_id']) }}" hidden>
                        <input type="text" name="test_id[{{ $index }}]"
                            class="form-control form-control-alternative{{ $errors->has('test_id') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('test_id') }}" value="{{ old('test_id', $test['test_id']) }}" hidden>
                            <input type="text" name="parent_id[{{ $index }}]"
                            class="form-control form-control-alternative{{ $errors->has('parent_id') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('parent_id') }}" value="{{ old('parent_id', $test['parent_id']) }}" hidden>
                        {{ $test['name'] }}
                    </td>
                    <td>

                        <input type="text" name="result[{{ $index }}]"
                            class="form-control form-control-alternative{{ $errors->has('result') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Result') }}" value="{{ old('result', $test['result']) }}">

                        @if ($errors->has('result[{{ $index }}]'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('result') }}</strong>
                            </span>
                        @endif
                    </td>



                    <td>{!! $test['unit'] !!}</td>
                    <td>{{ $test['range'] }}</td>
                    <td>
                        <select class="form-control" name="status[{{ $index }}]">
                            <option value="0" {{ old('status', $test['status']) == 0 ? 'selected' : '' }}>Normal
                            </option>
                            <option value="1" {{ old('status', $test['status']) == 1 ? 'selected' : '' }}>Detected
                            </option>
                        </select>
                    </td>
                    <td>

                        <input type="text" name="method[{{ $index }}]"
                            class="form-control form-control-alternative {{ $errors->has('method') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Method') }}" value="{{ old('method', $test['method']) }}">


                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" wire:click="removeTest({{ $index }})"
                            type="button"><i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom"
                                title="Remove"></i></button>
                    </td>
                </tr>
                @php
                    $newCategoryId = $test['category_id'];
                    $newSubCategoryId = $test['sub_category_id'];
                @endphp
            @endforeach

        </table>
    </div>
</div>
