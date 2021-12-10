<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add() {
        $arr = ['laptop', 'monitor','processor', 'graphics card', 'random access memory', 'power supply unit', 'cooler', 'case', 'keyboard', 'mouse', 'headphones', 'hard disk drive', 'solid state drive', 'miscellaneous'];
        for ($i = 0; $i < count($arr); $i++) {
            Category::create([
                'name' => $arr[$i],
            ]);
        }
    }
}
