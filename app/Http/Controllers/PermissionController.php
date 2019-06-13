<?php

namespace App\Http\Controllers;

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
        if(Auth::user()->id == $request->pdf->creator_id){
            $pdf = $request->pdf;
            $email = $request->email;
            $users = $request->users;
            $pdfid = $request->id;
            $user = User::where('email', '=', $email)->firstOrFail();   //See if email is valid
            $userID = $user->id;
        
            $permExists = Permission::where('pdf_id', $pdfid)->where('user_id', $userID);

            //If email exists && permission does not previously exist: add permission
            if (isset($user) && $permExists->count()==0) {
                Permission::create([
                'pdf_id' => $pdfid,
                'user_id' => $userID
                ]);
                echo 'test1';
            };
            //return view('permissions', ['users' => $users])->with(['pdf' => $request->pdf]);  //Bad idea to use this >=[

            return "Go back and refresh";
        }
        else{
            return "You are not authorized to perform this action";
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
