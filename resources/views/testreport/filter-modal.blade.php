  <!-- Modal -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="filterModalLabel">Search Test Report</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form method="get" action="{{ route('filter-test-report') }}">
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
                                  placeholder="{{ __('Date To') }}">
                          </div>
                          <div class="col-md-6">
                            <label class="form-control-label" for="input-patient_id">{{ __('Pateint name') }}</label>
                            <select class="selectpicker form-control @error('patient_id') is-invalid @enderror"
                                name="patient_id" id="product" data-live-search="true" data-size="4">
                                <option value="" selected>Select Test</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" data-content="<b>{{ $patient->name }}</b>
                          <br>{{ $patient->name }}
                          <br>{{ $patient->address }}
                          <br>{{ $patient->date }}
                          <br>{{ $patient->phone }}
                          "></option>
                                @endforeach
                            </select>
                        </div>
                          <div class="col-md-6">
                              <label class="form-control-label" for="input-gender">{{ __('Test name') }}</label>
                              <select class="selectpicker form-control @error('test_id') is-invalid @enderror"
                                  name="test_id" id="product" data-live-search="true" data-size="4">
                                  <option value="" selected>Select Test</option>
                                  @foreach ($tests as $test)
                                      <option value="{{ $test->id }}" data-content="<b>{{ $test->name }}</b>
                            <br>{{ $test->range }}
                            <br>{{ $test->unit }}
                            <br>{{ $test->rate }}
                            "></option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-6">
                            <label class="form-control-label" for="input-result">{{ __('Result') }}</label>
                            <input type="text" name="result" id="input-result"
                                class="form-control form-control-alternative{{ $errors->has('result') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Result') }}" value="{{ old('result') }}">

                          </div>
                          <div class="col-md-6">
                              <label class="form-control-label" for="input-remarks">{{ __('Method') }}</label>
                              <input type="text" name="remarks" id="input-remarks"
                                  class="form-control form-control-alternative{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                  placeholder="{{ __('Method') }}" value="{{ old('remarks') }}">

                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
