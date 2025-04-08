<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AcademicClass;
use Illuminate\Http\Request;

class AcademicClassController extends Controller
{
    public function classesList(Request $request){
        $classes = AcademicClass::with('creator')->get();
        return view('pages.classes.class-list',compact('classes'));
    }

    public function saveClasses(Request $request)
    {
//        mydebug($request->all());
        try {
            $classArray = $request->except('_token');
            $classArray['status'] = $classArray['status'] === 'on' ? 1 : 0;

            if (empty($classArray['class_id'])) {
                unset($classArray['class_id']);
                $classArray['created_by'] = \Auth::id();
                AcademicClass::create($classArray);
            } else {
                $ac_class = AcademicClass::findOrFail($classArray['class_id']);
                unset($classArray['class_id']);
                $ac_class->update($classArray);
            }

            return back()->with('success', 'Subject saved successfully');
        } catch (\Exception $e) {
            throw $e;
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteClass(Request $request){
        $classId = $request->get('object_id');

        try {
            $academicClass = AcademicClass::find($classId);
            if (!$academicClass)  return redirect()->back()->with('error', 'Class not found');
            $academicClass->delete();
            return redirect()->back()->with('success', 'Class Deleted Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function examList(Request $request){
        $classes = AcademicClass::with('creator')->get();
        return view('pages.classes.class-list',compact('classes'));
    }

    public function saveexam(Request $request)
    {
//        mydebug($request->all());
        try {
            $classArray = $request->except('_token');
            $classArray['status'] = $classArray['status'] === 'on' ? 1 : 0;

            if (empty($classArray['class_id'])) {
                unset($classArray['class_id']);
                $classArray['created_by'] = \Auth::id();
                AcademicClass::create($classArray);
            } else {
                $ac_class = AcademicClass::findOrFail($classArray['class_id']);
                unset($classArray['class_id']);
                $ac_class->update($classArray);
            }

            return back()->with('success', 'Subject saved successfully');
        } catch (\Exception $e) {
            throw $e;
            return back()->with('error', $e->getMessage());
        }
    }
}
