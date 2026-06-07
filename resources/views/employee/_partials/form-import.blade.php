<div class="col-12 col-lg-9">
    <div class="card mb-3">
        <div class="card-header">{{ __('Employee Information') }}</div>
        <div class="card-body">
            <div class="row mb-3">
                <label for="company_id" class="col-sm-2 col-form-label">{{ __('Company') }}</label>
                <div class="col-sm-10">
                    <select name="company_id" id="company_id" class="form-control w-100"
                        data-placeholder="{{ __('Choose Company...') }}" required>
                        <option value=""></option>

                        @if (old('company_id'))
                            @php
                                $oldCompany = \App\Models\Company::find(old('company_id'));
                            @endphp

                            @if ($oldCompany)
                                <option value="{{ $oldCompany->id }}" selected>{{ $oldCompany->name }}</option>
                            @endif
                        @elseif (isset($employee) && $employee->company)
                            <option value="{{ $employee->company_id }}" selected>{{ $employee->company->name }}</option>
                        @endif
                    </select>

                    @if ($error = $errors->first('company_id'))
                        <span class="d-block invalid-feedback">{{ $error }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="file_excel" class="col-sm-2 col-form-label">{{ __('File Excel') }}</label>
                <div class="col-sm-10">
                    <input type="file" name="file_excel" id="file_excel" class="form-control" required>

                    @if ($error = $errors->first('file_excel'))
                        <span class="d-block invalid-feedback">{{ $error }}</span>
                    @endif

                    <small class="form-text text-muted d-block">
                        {{ __('Recomendation file : .xlsx, .xls, max size 2 MB') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="module">
        $(function() {
            $('#company_id').select2({
                placeholder: "{{ __('Choose Company...') }}",
                minimumInputLength: 0,
                allowClear: true,
                ajax: {
                    url: "{{ route('companies.select') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endpush
