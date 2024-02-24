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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:20',
            'company_logo_path' => 'nullable|string|max:255',
            'bank_dest' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'profpic' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->all());
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
