<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pdf;
use Auth;
use response;
use Storage;

class PDFController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(Request $request)
	{
		return view('managepdfs');
	}
	
	public function uploadPDF (Request $request)
	{
		//Store pdf locally (will be needed to display image most likely)
		$pdf = $request->pdf;
		$password = $request->pdf_password;
		//Hash password for pdf
		$password = bcrypt($password);
		$name = $pdf->getClientOriginalName();
		$name = rtrim($name, '.pdf');
		$extension = $pdf->getClientOriginalExtension();
		$location = $name .'.'.$extension;
        \Storage::disk('public')->put($location,  \File::get($pdf));
		
		//Store pdf in database
		return Pdf::create([
			'user_id' => Auth::user()->id,
			'pdf_name' => $name,
			'password' => $password,
			'pdf' => base64_encode(file_get_contents($pdf->getRealPath()))
		]);
	}
	
	public function listPdf(Request $request)
	{
		//List all pdfs user uploaded
		$pdflistfull = Pdf::get();
		$pdflistfiltered = $pdflistfull->where('user_id', 3);
		
		return view('listpdfs', ['pdfs' => $pdflistfiltered]);
	}
	
	public function show(Request $request, $id)
	{	//Check if user authorized to view pdf
		//***Does not yet check if password is correct***
		if (Auth::user()->id == Pdf::findOrFail($id)->user->id)
		{
			$pdf = Pdf::findOrFail($id);
			$data = base64_decode($pdf->pdf);
			//$pdfname = $pdf->name;
			//dd($pdfname);
			
			//IT WORKS!!!!!!!!!!!!
			
			if (\Storage::disk('public')->exists('DummyPDF.pdf'))
				return response()->file(public_path()."/uploads/DummyPDF.pdf");
		}
		else
		{
			echo "Not authorized";
			return 'You are not authorized to view this pdf';
		}
	}
}
