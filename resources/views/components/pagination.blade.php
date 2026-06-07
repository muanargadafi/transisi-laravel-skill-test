<div class="row justify-content-between align-items-center">
    <div class="col-auto">
        <span>
            {{ __('Showing') }}
            {{ optional($pages)->firstItem() ?? '0' }}
            {{ __('to') }}
            {{ optional($pages)->lastItem() ?? '0' }}
            {{ __('of total') }}
            {{ optional($pages)->total() ?? '0' }}
            {{ __('entries') }}
        </span>
    </div>
    <div class="col-auto">
        {{ $pages ? $pages->appends(request()->query())->links('pagination::custom') : '' }}
    </div>
</div>
