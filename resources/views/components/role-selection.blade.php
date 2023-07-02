<div class="form-group">
    <select id="role" type="text"
        class="form-control text-capitalize @error('role_id') is-invalid @enderror" name="role"
        value="{{ old('role') }}" required>
        <option value="">Select role</option>
        @foreach ($roles as $role)
            <option value="{{ $role->name }}" {{ $role->name == implode($user->getRoleNames()->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
        @endforeach
    </select>
    @error('role')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>