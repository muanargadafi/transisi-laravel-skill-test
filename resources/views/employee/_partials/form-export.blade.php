 <form action="{{ route('employees.export') }}" method="POST" role="form">
    @csrf

    <div class="d-flex justify-content-end gap-2">
        <select name="company_id" id="company_id" class="form-control"
            data-placeholder="{{ __('Choose Company...') }}" style="max-width: 300px;" required>
            <option value=""></option>
        </select>
        <button type="submit" class="btn btn-success float-sm-end">{{ __('Export') }}</button>
    </div>
 </form>

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
