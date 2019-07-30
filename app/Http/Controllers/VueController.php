<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VueController extends Controller
{
    public function storeItem(Request $request)
    {
    	$data = array(
    		'name' 	=> $request->name,
    		'email' => $request->email
    	);
    	$user = User::create($data);
    	return $user;
    }
    public function getItem()
    {
    	$data = User::all();
    	return $data;
    }
    public function deleteItem(Request $request)
    {
    	$user = User::find($request->id)->delete();
    }
    public function editItem(Request $request, $id)
    {
    	$data = array(
    		'name' 	=> $request->val1,
    		'email' => $request->val2
    	);	
    	$user = User::where('id',$id)->update($data);
    	return $user;
    }
}
