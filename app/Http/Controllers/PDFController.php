<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\User;
use App\Pdf;
use App\Permission;
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
		//$password = bcrypt($password);
		$name = $pdf->getClientOriginalName();
		$name = rtrim($name, '.pdf');
		$extension = $pdf->getClientOriginalExtension();
		$location = $name .'.'.$extension;
        \Storage::disk('public')->put($location,  \File::get($pdf));
		
		//Store pdf locally
		Pdf::create([
			'creator_id' => Auth::user()->id,
			'pdf_name' => $name
		]);

		return view('managepdfs');
	}

	//Is this even needed?
	//Referenced the following to learn how to do this: https://stackoverflow.com/questions/28984278/complex-query-3-tables-with-2-inner-join-1-subquery-2-group-by-in-laravel
	public function getPermissions(){
		$permissions = Permission::get()->where('user_id', Auth::user()->id)->where();
		dd($permissions);
		return $permissions;
	}

	public function listPdf(Request $request)
	{

		//List all pdfs user uploaded
		$pdflistfull = Pdf::get();
		$pdflistfiltered = $pdflistfull->where('creator_id', Auth::user()->id);
		//dd($pdflistfiltered);
		$permissions = Permission::get()->where('user_id', Auth::user()->id);

		//*** REMOVE DUPLICATES ****
		//$uniquesmallpermissions = array_unique($smallpermissions); // Doesn't work!
		//dd($uniquesmallpermissions);

		//Finds each pdf that has a permission that matches the logged in user
		foreach ($pdflistfull as $pdf) {
			foreach ($permissions as $perm) {
				if ($perm->pdf->id == $pdf->id) {
					$pdflistfiltered->push($pdf);
				}
			}
		};
		return view('listpdfs', ['pdfs' => $pdflistfiltered]);
	}
	
	public function show(Request $request, $id)
	{	//Check if user authorized to view pdf
		//Creator and authorized users may view PDF
		//Only creator can manage permissions of PDF
		$pdfperms = Permission::get()->where('user_id', Auth::user()->id);
		$userauthorized = false;
		foreach ($pdfperms as $pdfperm) {
			if ($pdfperm->pdf_id == $id)
				$userauthorized = true;
		}

		if (Auth::user()->id == Pdf::findOrFail($id)->creator_id || $userauthorized) //***This changes when permissions are implemented***
		{
			$pdf = Pdf::findOrFail($id);
			$data = base64_decode($pdf->pdf);
			$pdfname = $pdf->pdf_name . ".pdf";

			if (\Storage::disk('public')->exists($pdfname)) //If pdf exists
				return response()->file(public_path()."/uploads/" . $pdfname);
			else 
				return $pdfname . " not found. File missing.";
		}
		else
		{
			return 'You are not authorized to view this pdf';
		}
	}
}
