@extends('layouts.app')

@section('page_header')
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Create Employee') }}</h3>
        </div>
    </div>
@endsection

@section('content')
    @include('components.alerts.success')
    @include('components.alerts.error')

    <form action="{{ route('employees.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf

        <div class="row">
            @include('employee._partials.form')

            @include('components.form-action', [
                'url' => route('employees.index'),
            ])
        </div>
    </form>
@endsection
