<div class="col-12 col-lg-3">
    <div class="card">
        <div class="card-header">{{ __('Action') }}</div>
        <div class="card-body">
            <div class="d-flex justify-content-end gap-2">
                @if(!@$show)
                    <button type="submit" class="btn btn-primary w-100">{{ @$label ?? __('Save') }}</button>
                @endif

                @if (@$url)
                    <a href="{{ @$url }}" class="btn btn-secondary w-100">{{ __('Back') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
