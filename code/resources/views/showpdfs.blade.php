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
						//echo "test";
						header('Content-type: application/pdf');
						//dd $pdf;
						echo $pdf;
					?>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
