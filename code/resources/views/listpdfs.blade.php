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
                        <?php if(count($pdfs) > 0) : ?>
                            <ul class="list-group">
                                @foreach($pdfs as $pdf)
                                    <li class="list-group-item " id="pdf-{{$pdf->id}}">
                                        <input type="hidden" name="currentPDFs[]" value="{{$pdf->id}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="pull-left">
                                                    {{$pdf->pdf_name}}
                                                </div>
												<div class="form-group row">
													<label for="pdf_password" class="form-label">Enter Password to view PDF</label>
													<input type="password" class="form-control" name="pdf_password" id="pdf_passwordid" />
												</div>
                                                <div class="pull-right">
                                                    <a class='nav-link' href="{{ route('showPdf',['id'=>$pdf->id]) }}" style="cursor: pointer; color: blue;">View PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </li>
                                @endforeach
                            </ul>
                        @else :
                            <h2>No PDFs uploaded</h2>
                        @endif
                </div>
				
            </div>
        </div>
    </div>
</div>
@endsection
