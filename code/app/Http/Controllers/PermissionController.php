<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(Request $request)
	{
		return view('managepdfs');
    }
    
    public function addPermission(Request $request, $id, $pdf)
    {
        //Add permission for user to view pdf to permissions table
        /*Permission::create([
            'pdf_id' => $pdf->id,
            'user_id' => $id
        ]);*/
    }

    public function addPermission(Request $request)
    {   
        //Test adding permission
        Permission::create([
            'pdf_id' => 3,
            'user_id' => 1
        ])
        return "User 1 can now see pdf 3";
    }

    public function removePermission(Request $request, $id, $pdf)
    {
        //Remove permission for user from table (delete)
        //Permission::
    }

    public function managePDF(Request $request, $pdf)
    {
        //Manage PDF
        //Generates view where you can see who has access to pdf
        //Can add access by giving an email for a user 
        //Can remove access by pressing button to delete permission
    }
}
