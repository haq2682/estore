<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        $wishlists = Wishlist::where('user_id', '=' ,$user->id)->get();
        $address = Address::where('user_id', $user->id)->first();
        return view('user.profile', compact('user', 'address', 'orders', 'wishlists'));
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $u = User::find($user->id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->save();
        return redirect('/user/profile');
    }

    public function updateAvatar()
    {
        $user = User::find(auth()->user()->id);
        $inputs = request()->validate([
            'avatar' => 'mimes:jpg,png,bmp,gif',
        ]);
        if (request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images', 'public');
        }
        $user->update($inputs);
        return back();
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $oldpass = $request->oldpass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
        if (!$oldpass) {
            session()->flash('message', 'Old password field must not be empty.');
            return back();
        } elseif (!$newpass) {
            session()->flash('message', 'New password field must not be empty.');
            return back();
        } elseif (!$confirmpass) {
            session()->flash('message', 'Confirm password field must not be empty.');
            return back();
        } elseif (!Hash::check($oldpass, $user->password)) {
            session()->flash('message', 'Old password does not match.');
            return back();
        } elseif ($confirmpass !== $newpass) {
            session()->flash('message', 'New password does not match the confirm password.');
            return back();
        } elseif (Hash::check($oldpass, $user->password) && $newpass == $confirmpass) {
            $user->password = Hash::make($newpass);
            $user->save();
            session()->flash('success', 'Password changed successfully.');
            return back();
        }
    }
    public function updateAddress(Request $request) {
        $id = Auth::user()->id;
        $address = Address::where('user_id', $id);
        $inputs = $request->validate([
           'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'city' => 'required',
            'postal_code' => 'required',
            'province' => 'required',
            'country' => 'required',
        ]);
        $address->update($inputs);
        return back();
    }
    public function createAddress(Request $request) {
        $inputs = $request->validate([
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
            'city' => 'required',
            'postal_code' => 'required',
            'province' => 'required',
            'country' => 'required',
        ]);
        auth()->user()->address()->create($inputs);
        return back();
    }
}
