<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function contact() {
        return view('contact');
    }
    public function shipping() {
        return view('shipping');
    }
    public function returns() {
        return view('returns');
    }
    public function faq() {
        return view('faq');
    }
    public function policies() {
        return view('policies');
    }
    public function sendMessage() {
        if(Auth::check()) {
            $name = auth()->user()->name;
            $email = auth()->user()->email;
        } else {
            $name = request()->name;
            $email = request()->email;
        }
        $data = array('name'=>$name,'body'=>request()->message, 'email'=>$email);
        Mail::send('emails.contact', $data, function($message) use ($name, $email){
            $message->to('cyberdemon2682@gmail.com', 'Abdul Haq Khalid')->subject('Contact Message');
            $message->from($email);
        });
        return back();
    }
}
