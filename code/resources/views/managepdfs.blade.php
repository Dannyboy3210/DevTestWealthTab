@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">PDF Management</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Please upload up to two PDF files at once.

                </div>
				
				<div class="card-body">
                <form method="POST" action="{{ route('pdfUpload') }}" aria-label="{{ __('Upload') }}" enctype="multipart/form-data">
                        @csrf
                        						
						<div class="form-group row text-center">
							<h2 class="col-12">PDF 1</h2>
						</div>
						<div class="form-group row">
							<input type="file" name="pdf"> </input>
						</div>
						
						<div class="form-group row">
							<label for="pdf_password" class="form-label">Enter Password for PDF</label>
							<input type="password" class="form-control" name="pdf_password" id="pdf_passwordid" />
						</div>
                        
						<div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
						<div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="/pdf/list" class="btn btn-primary">
                                    List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
				
            </div>
        </div>
    </div>
</div>
@endsection
