<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use DB;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Registering the user.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUser(Request $request)
    {
        /*$this->validate($request,[
            'Username' => 'required|unique:Users',
            'Email'      => 'required|email|unique:Users',
            'Password' => 'required|min:2'
        ]);
        $user = new User([
            'Username' => $request->input('Username'),
            'Email' => $request->input('Email'),
            'Password' => bcrypt($request-> input('Password'))
        ]);
        $user->save();
        return response()->json(['user'=>$user],201);*/

        $rules = array(
            'Username'       => 'required|unique:Users',
            'Email'      => 'required|email|unique:Users',
            'Password' => 'required|min:2'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $returnData = array(
                'status' => 401,
                'message' => $messages
            );
            return response()->json($returnData, 500);
        } else {
            $user = new User();
            $user->Username = Input::get('Username');
            $user->Email = Input::get('Email');
            $user->Password = bcrypt(Input::get('Password'));
            $user->save();
            return response()->json(['user'=>$user],201);
        }
    }

    /**
     * Sign in, sending the token back.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signin(Request $request)
    {
        $rules = array(
            'Email'      => 'required|email',
            'Password' => 'required|min:2'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $returnData = array(
                'status' => 401,
                'message' => $messages
            );
            return response()->json($returnData, 500);
        } else {
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

    /**
     * Calculates date diff in years.
     * @param $date
     * @return mixed
     */
    public function age($date)
    {
        $carbon=new Carbon();
        $diff=$date->diffInYears($carbon);
        return $diff;
    }

    /**
     * Gets all users.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        $users=User::all();
        foreach ($users as $user)
        {
            $array=json_decode($user,true);
            $date = new Carbon($array['DateOfBirth']);
            $year = UserController::age($date);
            $user->setYear($year);
            $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
            $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
            $user->setCountry($country);
            $user->setLanguage($language);
        }

        $response=[
            'users'=>$users,
        ];
        return response()->json($response,200);
    }


    /**
     * Gets one user by id.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($id)
    {
        $user=User::find($id);
        $array=json_decode($user,true);
        $date = new Carbon($array['DateOfBirth']);
        $year = UserController::age($date);
        $user->setYear($year);
        $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
        $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
        $user->setCountry($country);
        $user->setLanguage($language);
        $response=[
            'user'=>$user,
            'year'=>$year
        ];
        return response()->json($response,200);
    }

    /**
     * Gets the authenticated user.
     */
    public function getCurrentUser()
    {
        $user=JWTAuth::user();
        $array=json_decode($user,true);
        $date = new Carbon($array['DateOfBirth']);
        $year = UserController::age($date);
        $user->setYear($year);
        $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
        $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
        $user->setCountry($country);
        $user->setLanguage($language);
        $response=[
            'user'=>$user
        ];
        return response()->json($response,200);
    }

    /**
     * Update the authenticated user info.
     */
    public function updateUser(Request $request)
    {
        $user=JWTAuth::user();
        $rules = array(
            'Username'       => 'required|unique:Users'.$user->id.',UserID',
            'Email'      => 'required|email|unique:Users'.$user->id.',UserID',
            'Password' => 'required|min:2'.$user->id.',UserID',
            'DateOfBirth' => 'nullable|date',
            'Country'=> 'nullable',
            'Language'=> 'nullable'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $returnData = array(
                'status' => 401,
                'message' => $messages
            );
            return response()->json($returnData, 500);
        } else {
            $user->Username = Input::get('Username');
            $user->Email = Input::get('Email');
            $user->Password = bcrypt(Input::get('Password'));
            $user->DateOfBirth = Input::get('DateOfBirth');
            $countryid=DB::table('Countries')->where('CountryName',$request->input('Country'))->value('CountryID');
            $languageid=DB::table('Languages')->where('LanguageName',$request->input('Language'))->value('LanguageID');
            $user->CountryID = $countryid;
            $user->LanguageID = $languageid;
            $user->save();

            //year,countryname,languagename
            $array=json_decode($user,true);
            $date = new Carbon($array['DateOfBirth']);
            $year = UserController::age($date);
            $user->setYear($year);
            $country= DB::table('Countries')->where('CountryID',$user->CountryID)->value('Countryname');
            $language=DB::table('Languages')->where('LanguageID',$user->LanguageID)->value('Languagename');
            $user->setCountry($country);
            $user->setLanguage($language);
            return response()->json(['user'=>$user],201);
        }
    }
}