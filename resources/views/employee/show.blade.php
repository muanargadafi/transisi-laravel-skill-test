@extends('layouts.app')

@section('page_header')
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Detail Employee') }}</h3>
        </div>
    </div>
@endsection

@section('content')
    @include('components.alerts.success')
    @include('components.alerts.error')

    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="card mb-3">
                <div class="card-header">{{ __('Employee Information') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <span>{{ @$employee->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{ __('Company') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <span>{{ @$employee->company->name }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <span>{{ @$employee->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('components.form-action', [
            'url' => route('employees.index'),
            'show' => true
        ])
    </div>
@endsection
