<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function updateProfilePicture(Request $request)
    {
        // dd($request);
        $request->validate([
            'newProfPic' => 'image',
        ]);

        if ($request->hasFile('newProfPic')) {
            $imageName = time() . '.' . $request->file('newProfPic')->extension();
            $request->file('newProfPic')->storeAs('public', $imageName);

            $user = Auth::user();
            $user->update(['profpic' => $imageName]);

            session()->flash('message', 'Profile picture updated successfully.');
        } else {
            session()->flash('message', 'No image selected.');
        }

        return redirect('/userUpdate');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company_name' => 'nullable',
            'company_address' => 'nullable',
            'company_phone' => 'nullable',
            'company_logo_path' => 'nullable|image',
        ]);

        $userData = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'company_phone' => $request->input('company_phone'),
        ];

        if ($request->hasFile('company_logo_path')) {
            $image = $request->file('company_logo_path');
            $imageName = time() . '.' . $image->extension();

            $image->storeAs('public', $imageName);
            $userData['company_logo_path'] = $imageName;
        }

        $user->update($userData);
        session()->flash('message', 'Profile updated successfully.');
        return redirect('/userUpdate');
    }
}
