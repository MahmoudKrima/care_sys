<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    use ApiResponseTrait;

    //registration

    public function register(Request $request)
    {
        $validation = validator()->make($request->all(),[
            'contact' => ['required','unique:users,contact'],
            'password' => ['required','confirmed','min:6','max:20']
        ]);
        if($validation->fails())
        {
            return ApiResponseTrait::apiResponse([],$validation->errors(),422);
        }
        $user = User::create([
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'confirmation_code' => rand(100000,999999),
        ]);
        $token = $user->generateApiToken();
        $confirmation_code = $user->confirmation_code;
        return ApiResponseTrait::apiResponse(['user' => $user, 'token' => $token,'confirmation_code' =>$confirmation_code],__('site.success_register'),200);
    }


    //Complete registration

    public function completeRegister(Request $request)
{
    $user = User::where('api_token', $request->header('Authorization'))->where('contact',$request->contact)->first();

    if ($user->confirmation_code == null) {
        $validation = validator($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'date_birth' => ['required', 'date'],
            'contact' => ['required'],
            'gender' => ['required'],
            'blood' => ['required'],
        ]);

        if ($validation->fails()) {
            return ApiResponseTrait::apiResponse([], $validation->errors(), 422);
        }

        if ($user->contact == $request->contact) {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'date_birth' => $request->date_birth,
                'gender' => $request->gender,
                'blood_group' => $request->blood,
            ]);

            $token = $user->generateApiToken();

            return ApiResponseTrait::apiResponse(['user' => $user, 'token' => $token],'Done', 200);
        } else {
            return ApiResponseTrait::apiResponse([], 'Phone Number Is Not Registered', 422);
        }
    } else {
        return ApiResponseTrait::apiResponse([], 'Please Verify Your Account', 422);
    }
}


    //confirmation of code

    public function confirmCode(Request $request){
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user){
            if($user->confirmation_code != null && $user->confirmation_code == $request->confirmation_code){
                $user->update([
                    'confirmation_code' => null,
                ]);
                return ApiResponseTrait::apiResponse(['user' => $user, 'token' => $user->api_token],__('site.success_register'),200);
            }else{
                return ApiResponseTrait::apiResponse([],'Please Verify Your Account',422);
            }
        }else{
            return ApiResponseTrait::apiResponse([],'No Data Found',422);
        }
    }


    // login

    public function login(Request $request)
    {
        $user=User::where('contact',$request->contact)->first();
        if($user->confirmation_code != null){
            return ApiResponseTrait::apiResponse([],__('Please Verify Your Account'),401);
        }else{
        $validation = validator()->make($request->all(),[
            'contact' => ['required','exists:users,contact'],
            'password' => ['required'],
        ]);
        if($validation->fails())
        {
            return ApiResponseTrait::apiResponse([],$validation->errors(),422);
        }
        if(Auth::attempt($request->all()))
        {
            $user = Auth::user();
            $token = $user->generateApiToken();
            return ApiResponseTrait::apiResponse(['user' => $user, 'token' => $token],__('site.success_login'),200);
        }
        return ApiResponseTrait::apiResponse([],__('site.failed_login'),401);
    }
}


// logout
    public function logout(Request $request)
    {
        $user = User::where('api_token', $request->header('Authorization'))->first();
    
        if ($user) {
            $user->api_token = null;
            $user->save();
            return ApiResponseTrait::apiResponse([], __('site.success_logout'), 200);
        } else {
            return ApiResponseTrait::apiResponse([], __('site.failed_logout'), 401);
        }
    }
}
