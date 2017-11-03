<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\Hash;

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
            $user->Password = bcrypt(Input::get('Password'));
            $user->save();
            return response()->json(['user'=>$user],201);
        }
    }
    public function signin(Request $request)
    {
        $rules = array(
            'Email'      => 'required|email',
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
            //$credentials= $request->only('Email','Password');
            $input = $request->only('Email', 'Password');
            $credentials = [
                'Email' =>$input['Email'],
                'password' => $input['Password']
            ];
            try{
                if(! $token=JWTAuth::attempt($credentials))
                {
                    return response()->json([
                        'error'=>'Invalid credentials!',
                        'val'=>$credentials
                    ],401);
                }
            }catch(JWTException $e)
            {
                return response()->json([
                    'error'=>'Could not create token!'
                ],500);
            }
            return response()->json(['token'=>$token],200);
        }
    }
    public function getUsers()
    {
        /*try{
            if(! $user=JWTAuth::parseToken()->authenticate())
            {
                return response()->json(['message'=>'User not found'],401);
            }
        }catch(JWTException $e)
        {
            return response()->json(['message'=>'Exception'],400);
        }*/
        $users=User::all();
        $response=[
            'users'=>$users
        ];
        return response()->json($response,200);
    }
    
}