 <form action="{{ url()->current() }}" method="GET">
    <div class="d-flex" style="gap: .5rem">
        <input type="search" name="search" class="form-control"
        value="{{ request('search') }}" placeholder="Search..." style="max-width: 300px;" />
        <button type="submit" class="btn btn-outline-primary">
            <i class="fas fa-search" aria-hidden="true"></i>
        </button>
    </div>
</form>
