<!--NOT YET WORKING-->

<!-- Code from: https://appdividend.com/2018/08/15/laravel-file-upload-example/#3_Create_a_View_and_Route_for_uploading_files
Used and adopted for this purpose -->

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

                    Please select PDF to view.
                </div>
				
				<div class="card-body">
                
				<label for="pdf[]">Existing pdfs:</label><br>
						@//dd()
                        @//if(count() > 0)
                            <ul class="list-group">
                                @foreach($form->pdf as $key => $pdf)
                                    <li class="list-group-item " id="pdf-{{$pdf->id}}">
                                        <input type="hidden" name="currentPDFs[]" value="{{$pdfs->id}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="pull-left">
                                                    {{$pdf->name}}
                                                </div>
                                                <div class="pull-right">
                                                    <a style="cursor: pointer; color: blue;" onClick="preview('/uploads/{{$pdf->url}}')">View PDF</a> | 
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </li>
                                @endforeach
                            </ul>
                        @//else
                            <h2>No PDFs uploaded</h2>
                        @//endif				
                </div>
				
            </div>
        </div>
    </div>
</div>
@endsection
