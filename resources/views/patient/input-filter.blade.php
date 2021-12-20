<div class="row">
    <div class="col-md-6">
        <label class="form-control-label" for="input-date">{{ __('Date From') }}</label>
        <input type="date" name="date_from" id="input-date"
            class="form-control form-control-alternative{{ $errors->has('date_from') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Date From') }}">
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-date">{{ __('Date To') }}</label>
        <input type="date" name="date_to" id="input-date"
            class="form-control form-control-alternative{{ $errors->has('date_to') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Date To') }}" >
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
        <input type="text" name="name" id="input-name"
            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Name') }}">
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
        <input type="text" name="address" id="input-address"
            class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Address') }}">
    </div>
    <div class="col-md-3">
        <label class="form-control-label" for="input-gender">{{ __('Gender') }}</label>
        <select name="gender"
            class="form-control form-control-alternative custom-select {{ $errors->has('gender') ? ' is-invalid' : '' }}">
            <option value="">Select</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
        </select>
    </div>
    <div class="col-md-3">
      <label class="form-control-label" for="input-age">{{ __('Age Max') }}</label>
      <input type="number" name="age_to" id="input-age"
          class="form-control form-control-alternative{{ $errors->has('age_to') ? ' is-invalid' : '' }}"
          placeholder="{{ __('Age Max') }}" min="1">
  </div>
    <div class="col-md-3">
        <label class="form-control-label" for="input-age">{{ __('Age Min') }}</label>
        <input type="number" name="age_from" id="input-age"
            class="form-control form-control-alternative{{ $errors->has('age_from') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Age min') }}" min="1">
    </div>
  

    <div class="col-md-3">
        <label class="form-control-label" for="input-in">{{ __('In') }}</label>
        <select name="in"
            class="form-control form-control-alternative custom-select {{ $errors->has('in') ? ' is-invalid' : '' }}">
            <option value="">Select</option>
            <option value="Y">Year</option>
            <option value="M">Month</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
        <input type="tel" name="phone" id="input-phone"
            class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Phone') }}" >
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
        <input type="email" name="email" id="input-email"
            class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Email') }}" >
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-refferred">{{ __('Referred By') }}</label>
        <input type="text" name="referred" id="input-refferred"
            class="form-control form-control-alternative{{ $errors->has('refferred') ? ' is-invalid' : '' }}"
            placeholder="{{ __('Refferred By') }}">
    </div>
    <div class="col-md-6">
        <label class="form-control-label" for="input-in">{{ __('User By') }}</label>
        <select name="user_id"
            class="form-control form-control-alternative custom-select {{ $errors->has('user_id') ? ' is-invalid' : '' }}">
            <option value="">Select</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>


</div>