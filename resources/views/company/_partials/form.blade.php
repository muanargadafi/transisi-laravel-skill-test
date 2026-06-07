<div class="col-12 col-lg-9">
    <div class="card mb-3">
        <div class="card-header">{{ __('Company Information') }}</div>
        <div class="card-body">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Input Name') }}" value="{{ old('name', @$company->name) }}" required>
                    @if ($error = $errors->first('name'))
                        <span class="d-block invalid-feedback">{{ $error }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('Input Email') }}" value="{{ old('email', @$company->email) }}" required>

                    @if ($error = $errors->first('email'))
                        <span class="d-block invalid-feedback">{{ $error }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="website" class="col-sm-2 col-form-label">{{ __('Website') }}</label>
                <div class="col-sm-10">
                    <input type="url" name="website" id="website" class="form-control" placeholder="{{ __('Input Website') }}" value="{{ old('website', @$company->website) }}" required>

                    @if ($error = $errors->first('website'))
                        <span class="d-block invalid-feedback">{{ $error }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="logo" class="col-sm-2 col-form-label">{{ __('Logo') }}</label>
                <div class="col-sm-10">
                    <input type="hidden" name="temp_logo" value="{{ $company?->file_obj?->file_title ?? '' }}">
                    <input type="file" name="logo" id="logo" class="form-control">

                    @if ($error = $errors->first('logo'))
                        <span class="d-block invalid-feedback">{{ $error }}</span>
                    @endif

                    <small class="form-text text-muted d-block">
                        {{ __('Recomendation image : minimum 100x100 px, png, max size 2 MB') }}
                    </small>
                    <small class="form-text text-muted">
                        {{ __('Last Update :') }} {{ $company?->file_obj?->file_title ?? '-' }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
