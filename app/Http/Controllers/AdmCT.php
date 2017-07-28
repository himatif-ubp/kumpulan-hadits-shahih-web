<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdmModel;
use Illuminate\Support\Facades\DB;

class AdmCT extends Controller
{
    public function login(Request $request)
    {
    	$admmodel = new AdmModel();
    	$admmodel = $admmodel->where('user_id', $request->user_id)->where('pkey', $request->pkey)->first();
    	// $admmodel->user_id = $request->user_id;
    	// $admmodel->pkey = $request->pkey;
    	if($admmodel != null){
            session(['userid' => $admmodel->user_id]);
            return redirect('/imam');
        }else{
        	return redirect('/')->with('alert-wrong', 'User ID atau Password Salah');
        }
    	
    }

    public function logout(Request $request)
    {
    	$request->session()->forget('userid');
		return redirect('/');
    }
    
}
