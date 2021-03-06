<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\User;
use App\Pdf;
use App\Permission;
use Auth;
use response;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(Request $request)
	{
		return view('permissions');
    }
    
    public function addPermission(Request $request)
    {
        //If requester is the creator of the pdf and the user gaining permission is not the creator
        $email = $request->email;
        $pdfid = $request->id;
        try {
            $userAdding = User::where('email', '=', $email)->firstOrFail();
        }
        catch(ModelNotFoundException $e){
            return "User not found";
        }
        //$userAdding = User::where('email', '=', $email)->firstOrFail();   //See if email is valid
        $hasAccess = ($userAdding->hasAccess(Pdf::find($pdfid)));
        $userID = $userAdding->id;
        if($userAdding->id == Auth::user()->id){
            Return "You already own this pdf";
        }
        else if(!$userAdding->hasAccess(Pdf::find($pdfid))){
        
            //$permExists = Permission::where('pdf_id', $pdfid)->where('user_id', $userID)->first();
            //dd($permExists);
            //dd($user);
            //If email exists && permission does not previously exist: add permission
           // if (isset($userAdding) && $hasAccess) {
                Permission::create([
                'pdf_id' => $pdfid,
                'user_id' => $userID
                ]);
                
                return "Go back and refresh";
            //}
            //else {
                
            //}

        }
        else{
            return "User already had permission";
        }
    }

    public function removePermission(Request $request, $userID, $pdfID)
    {
        //Remove permission for user from table (delete) when requester is pdf's owner
        $pdf = Pdf::find($pdfID);
        if(Auth::user()->id == $pdf->creator_id){
            $toDelete = Permission::where('pdf_id', $pdfID)->where('user_id', $userID);
            $toDelete->delete();
            return "Go back and refresh";
        }

    }

    public function managePdf(Request $request)
    {
        //Manage PDF
        //Generates view where you can see who has access to pdf
        //Can add access by giving an email for a user 
        //Can remove access by pressing button to delete permission *****Not implemented yet*****
        $permissionList = Permission::get()->where('pdf_id', $request->pdf);
        $userList = User::get();
        $userListFiltered = collect();

        foreach ($userList as $user) {
			foreach ($permissionList as $perm) {
				if ($perm->user_id == $user->id) {
                    $userListFiltered->push($user);
				}
			}
        };
        return view('permissions', ['users' => $userListFiltered])->with(['pdf' => $request->pdf]);
    }
}
