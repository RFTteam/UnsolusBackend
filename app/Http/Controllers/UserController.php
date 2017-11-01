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
            'Username'       => 'required|unique:Users',
            'Email'      => 'required|email|unique:Users',
            'Password' => 'required|min:2'
        );
        $validator = Validator::make(Input::all(), $rules);
        
        // process the login
        if ($validator->fails()) {
            $messages = $validator->messages();
            $returnData = array(
                'status' => 401,
                'message' => $messages
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