<tr>
    
    <td style="{{ $level == 2 ? 'padding-left:40px;' : '' }}">{{ $test['name'] }}</td>
    <td>
        <div class="{{ $errors->has('result') ? ' has-danger' : '' }}">
            <input type="text" name="result" id="input-result"
                class="form-control form-control-alternative{{ $errors->has('result') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Result') }}" value="{{ old('result', $test['result']) }}" required>

            @if ($errors->has('result'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('result') }}</strong>
                </span>
            @endif
        </div>
    </td>
    <td>{!! $test['unit'] !!}</td>
    <td>{{ $test['range'] }}</td>
    <td>
        <div class="{{ $errors->has('method') ? ' has-danger' : '' }}">
            <input type="text" name="method" id="input-method"
                class="form-control form-control-alternative{{ $errors->has('method') ? ' is-invalid' : '' }}"
                placeholder="{{ __('Method') }}" value="{{ old('method', $test['method']) }}" required>

            @if ($errors->has('method'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('method') }}</strong>
                </span>
            @endif
        </div>
    </td>
    <td>
        <button class="btn btn-danger btn-sm" wire:click="removeTest({{ $index }})" type="button"><i
                class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Remove"></i></button>
    </td>
</tr>
