<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subjectList(Request $request){
        return view('pages.subjects.subject-list');
    }
}
