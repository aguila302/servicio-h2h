<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function welcome() {
        return response()->json(['welcome'=>'Buenos días desde finsus']);
    }
}
