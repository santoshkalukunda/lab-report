<form method="get" action="{{ route('pdf-patient') }}" id="pdf-patient">
    <input type="date" name="date_from" value="{{ request()->date_from }}" hidden>
    <input type="date" name="date_to"  value="{{ request()->date_to }}" hidden>
    <input type="text" name="name" value="{{ request()->date_name }}" hidden>
    <input type="text" name="address" value="{{ request()->address }}" hidden>
    <input type="text" name="gender" value="{{ request()->gender }}" hidden>
    <input type="number" name="age_to"  value="{{ request()->age_to }}" hidden>
    <input type="number" name="age_from" value="{{ request()->age_from }}" hidden>
    <select name="in"hidden>
        <option value="{{ request()->in }}"></option>
    </select>
    <input type="tel" name="phone"  value="{{ request()->phone }}" hidden>
    <input type="email" name="email"  value="{{ request()->email }}" hidden>
    <input type="text" name="referred" value="{{ request()->referred }}" hidden>
    <select name="user_id" hidden>
        <option value="{{ request()->user_id }}"></option>
    </select>
</form>
