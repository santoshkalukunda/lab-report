<form method="get" action="{{ route('pdf-test-report') }}" id="pdf-form">
    <input type="date" name="date_from" value="{{ request()->date_from }}" hidden>
    <input type="date" name="date_to" value="{{ request()->date_to }}" hidden>
    <select name="patient_id" hidden>
        <option value="{{ request()->patient_id }}"></option>
        </option>
    </select>
    <select name="test_id" hidden>
        <option value="{{ request()->test_id }}" selected>Select Test</option>
    </select>
    <input type="text" name="result"  value="{{request()->result}}" hidden>
        <input type="text" name="remarks" value="{{request()->remarks}}" hidden>
</form>
