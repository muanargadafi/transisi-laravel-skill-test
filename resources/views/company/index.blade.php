@extends('layouts.app')

@section('page_header')
    <div class="row mb-3 align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Company') }}</h3>
        </div>
         <div class="col-sm-6">
            <a href="{{ route('companies.create') }}" class="btn btn-primary float-sm-end" role="button">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                {{ __('Create') }}
            </a>
         </div>
    </div>
@endsection

@section('content')
    @include('components.alerts.success')
    @include('components.alerts.error')

    <div class="card">
        <div class="card-header">{{ __('Table Data Company') }}</div>

        <div class="card-body">
            <div class="action mb-3">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        @include('components.search-form')
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" role="table">
                    <thead>
                        <tr>
                            <th style="width: 15px" scope="col">{{ __('No.') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Website') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                            <tr>
                                <td scope="row" align="center">{{ $loop->iteration }}</td>
                                <td>{{ @$data->name }}</td>
                                <td>{{ @$data->email }}</td>
                                <td>{{ @$data->website }}</td>
                                <td>
                                    <div class="d-flex justify-content-start gap-2" >
                                        <a href="{{ route('companies.show', $data->id) }}" class="btn btn-success btn-sm px-2 py-1">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </a>

                                        <a href="{{ route('companies.edit', $data->id) }}" class="btn btn-primary btn-sm px-2 py-1">
                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                        </a>

                                        <form action="{{ route('companies.destroy', $data->id) }}" method="POST" role="form"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm px-2 py-1">
                                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">
                                    {{ __('No data is displayed') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @include('components.pagination', [
                'pages' => $datas,
            ])
        </div>
    </div>
@endsection
