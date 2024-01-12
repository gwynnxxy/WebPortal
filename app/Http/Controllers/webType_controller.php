<?php

namespace App\Http\Controllers;

use App\Models\webType;
use Illuminate\Http\Request;

class webType_controller extends Controller
{
    public function index()
    {
        return webType::all();
    }
}
