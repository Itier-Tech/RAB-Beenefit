<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class Profile extends Component
{
    use WithFileUploads;

    public $full_name, $email, $phone, $company_name, $company_address, $company_phone, $company_logo_path, $bank_dest, $account_number, $account_name, $profpic;

    public function rules()
    {
        return [
            'full_name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'passwordLama' => ['required'],
            'passwordBaru' => ['required', 'min:8', 'different:passwordLama'],
            'retypePasswordBaru' => ['required', 'same:passwordBaru'],
        ];
    }

    public function mount()
    {
        $user = auth()->user();
        $this->full_name = $user->full_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->company_name = $user->company_name;
        $this->company_address = $user->company_address;
        $this->company_phone = $user->company_phone;
        $this->company_logo_path = $user->company_logo_path;
        $this->bank_dest = $user->bank_dest;
        $this->account_number = $user->account_number;
        $this->account_name = $user->account_name;
        $this->profpic = $user->profpic;
    }

    // public function update()
    // {
    //     $this->validate();

    //     $user = Auth::user();
    //     $user->update([
    //         'full_name' => $this->full_name,
    //         'email' => $this->email,
    //         'phone' => $this->phone,
    //         'company_name' => $this->company_name,
    //         'company_address' => $this->company_address,
    //         'company_phone' => $this->company_phone,
    //         'company_logo_path' => $this->company_logo_path,
    //         'bank_dest' => $this->bank_dest,
    //         'account_number' => $this->account_number,
    //         'account_name' => $this->account_name,
    //         'profpic' => $this->profpic,
    //     ]);

    //     session()->flash('message', 'Profile updated successfully.');
    //     redirect('/user-update');
    // }

    // public $passwordLama;
    // public $passwordBaru;
    // public $retypePasswordBaru;

    // public function resetPassword()
    // {
    //     // $this->validate();
    //     // dd('tes');

    //     $user = Auth::user();
    //     if(!$user) {
    //         return redirect('/');
    //     }

    //     if (Hash::check($this->passwordLama, $user->password)) {
    //         $user->password = Hash::make($this->passwordBaru);
    //         $user->save();

    //         session()->flash('message', 'Password berhasil diubah.');
    //     } else {
    //         session()->flash('message', 'Password lama tidak cocok.');
    //     }

    //     $this->reset(['passwordLama', 'passwordBaru', 'retypePasswordBaru']);
    //     redirect('/user-update');
    // }

    // public function updateProfilePicture(Request $request)
    // {
    //     dd($request);
    //     $request->validate([
    //         'newProfPic' => 'image',
    //     ]);

    //     if ($request->hasFile('newProfPic')) {
    //         $imageName = time() . '.' . $request->file('newProfPic')->extension();

    //         $request->file('newProfPic')->storeAs('public', $imageName);

    //         $user = Auth::user();
    //         $user->update(['profpic' => $imageName]);

    //         session()->flash('message', 'Profile picture updated successfully.');
    //     } else {
    //         session()->flash('message', 'No image selected.');
    //     }

    //     return redirect('/user-update');
    // }

    public function render()
    {
        return view('livewire.profile')->extends('components.layouts.app')->section('content');
    }
}
