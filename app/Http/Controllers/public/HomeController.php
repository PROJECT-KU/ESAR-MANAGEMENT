<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home.index');
    }

    public function editor()
    {
        return view('public.home.editor');
    }



    public function digitalservice()
    {
        return view('public.home.digital_service');
    }

    public function contact()
    {
        return view('public.home.contact');
    }
}
