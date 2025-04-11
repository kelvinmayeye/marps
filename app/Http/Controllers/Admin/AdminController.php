<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\School;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function academicYears(Request $request){

        return view();
    }

    public function getSchools(Request $request){
        $schools = School::all();
        return view('pages.schools.schools-list',compact('schools'));
    }

    public function saveSchool(Request $request){
        try {
            $schoolArray = $request->except('_token');
            $schoolArray['is_active'] = $schoolArray['is_active'] === 'on' ? 1 : 0;

            // Check if code is unique during insertion and updating
            $registrationNo = $schoolArray['registration_no'];
            $schoolId = $schoolArray['school_id'] ?? null;

            $existingSchool = School::where('registration_no', $registrationNo);

            if ($schoolId)  $existingSchool = $existingSchool->where('id', '!=', $schoolId);


            $existingSchool = $existingSchool->first();

            if ($existingSchool) {
                return redirect()->back()->with('error', 'School registration no already exists');
            }

            if (empty($schoolArray['school_id'])) {
                unset($schoolArray['school_id']);
                $schoolArray['created_by'] = \Auth::id();
                School::create($schoolArray);
            } else {
                $subject = School::findOrFail($schoolArray['school_id']);
                unset($schoolArray['school_id']);
                $subject->update($schoolArray);
            }
            toastr()->success('School saved successfully');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
