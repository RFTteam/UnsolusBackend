<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    //
    public function postUser(Request $request)
    {
        $rules = array(
            'Username'       => 'required',
            'Email'      => 'required|email',
            'Password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        
        // process the login
        if ($validator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'An error occurred!'
            );
            return response()->json($returnData, 500);
        } else {
            // store
            $user = new User();
            $user->Username = Input::get('Username');
            $user->Email = Input::get('Email');
            $user->Password = Input::get('Password');
            $user->save();
            return response()->json(['user'=>$user],201);
        }
    }
}