@extends('layouts.app')

@section('page_header')
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Create Company') }}</h3>
        </div>
    </div>
@endsection

@section('content')
    @include('components.alerts.success')
    @include('components.alerts.error')

    <form action="{{ route('companies.store') }}" method="POST" role="form" enctype="multipart/form-data">
        @csrf

        <div class="row">
            @include('company._partials.form')

            @include('components.form-action', [
                'url' => route('companies.index'),
            ])
        </div>
    </form>
@endsection
