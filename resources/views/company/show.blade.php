@extends('layouts.app')

@section('page_header')
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Detail Company') }}</h3>
        </div>
    </div>
@endsection

@section('content')
    @include('components.alerts.success')
    @include('components.alerts.error')

    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="card mb-3">
                <div class="card-header">{{ __('Company Information') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <span>{{ @$company->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <span>{{ @$company->email }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="website" class="col-sm-2 col-form-label">{{ __('Website') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <span>{{ @$company->website }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="logo" class="col-sm-2 col-form-label">{{ __('Logo') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            @if(@$company?->file_obj?->file_path)
                                <img src="{{ $company->file_obj->file_path }}" class="img-thumbnail" alt="Logo {{ $company->name }}" style="max-height: 100px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('components.form-action', [
            'url' => route('companies.index'),
            'show' => true
        ])
    </div>
@endsection
