<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Excel;

class ExportController extends Controller
{
    public function downloadRegisterStudentsTemplate(){
        try {
            $templates_path = '..' . DIRECTORY_SEPARATOR . 'excel_templates' . DIRECTORY_SEPARATOR . 'register_students_template.xlsx';
            if (file_exists($templates_path)) {
                if(empty(Auth::user()->school->name)) throw new \Exception("Failed to download template, user not assigned to school");
                return Response::download($templates_path, Auth::user()->school->name.' students template.xlsx');
            } else {
                return redirect()->back()->with('error', 'Template file not found!');
            }
        }catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
}
