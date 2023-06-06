<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;


class RegisterController extends Controller
{
    Use ApiResponseTrait;

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email',
            'password' => ['required', 'confirmed', 'min:6'],
            'toc' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => User::PATIENT,
        ]);

        $user->patient()->create([
            'patient_unique_id' => mb_strtoupper(Patient::generatePatientUniqueId()),
        ]);

        $user->assignRole('patient');

        // $user->sendEmailVerificationNotification();

        return ApiResponseTrait::apiResponse([],('User Registered In Successfully'),200);
    }
}
