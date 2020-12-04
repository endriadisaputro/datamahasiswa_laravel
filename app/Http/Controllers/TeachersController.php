<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Teacher;

class TeachersController extends Controller
{
    public function profile($id)
    {
    	$teachers=Teacher::find($id);
    	return view('teachers.profile', ['teachers'=>$teachers]);
    }
}
