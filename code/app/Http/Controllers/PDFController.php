<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pdf;
use Auth;

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
		$name = $pdf->getFilename();
		$extension = $pdf->getClientOriginalExtension();
		
		$location = $name .'.'.$extension;
		
        \Storage::disk('public')->put($location,  \File::get($pdf));
		
		//Store pdf in database
		return Pdf::create([
			'user_id' => Auth::user()->id,
			'pdf_name' => $pdf->getFilename(),
			'password' => 'testpass',
			'pdf' => base64_encode(file_get_contents($pdf->getRealPath()))
		]);
	}
	
	public function listPdf(Request $request)
	{
		return Pdf::all();
		//return view('listpdfs'); //Not yet working
	}
	
	public function show(Request $request, $id)
	{	//Check if user authorized to view pdf
		if (Auth::user()->id == Pdf::findOrFail($id)->user->id)
		{
			return Pdf::findOrFail($id);
		}
		else
		{
			return 'You are not authorized to view this pdf';
		}
	}
}
