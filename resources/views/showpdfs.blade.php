@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PDF Viewer</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
				</div>
				<div>
					<?php 
						header('Content-type: application/pdf');
						echo $pdf;
					?>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
