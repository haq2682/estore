<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
