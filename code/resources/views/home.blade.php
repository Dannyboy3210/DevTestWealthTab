@extends('layouts.app')

@if(session()->get('message'))
    <div class="alert alert-success">
       {{ session()->get('message') }}
    </div>
@endif

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
					
					<a class="nav-link" href="{{ route('pdfUpload') }}">{{ __('Manage PDFs') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
