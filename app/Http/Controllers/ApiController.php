<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
	public function editnilai(Request $request, $id)
	{
		$students=\App\Student::find($id);
		$students->makul()->updateExistingPivot($request->pk,['nilai'=>$request->value]);
	}
}
