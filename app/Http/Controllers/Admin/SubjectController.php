<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subjectList(Request $request){
        $subjects = Subject::with('creator')->get();
        return view('pages.subjects.subject-list',compact('subjects'));
    }

    public function saveSubject(Request $request)
    {
        try {
            $subjectArray = $request->except('_token');
            $subjectArray['status'] = $subjectArray['status'] === 'on' ? 1 : 0;

            if (empty($subjectArray['subject_id'])) {
                unset($subjectArray['subject_id']);
                $subjectArray['created_by'] = \Auth::id();
                Subject::create($subjectArray);
            } else {
                $subject = Subject::findOrFail($subjectArray['subject_id']);
                unset($subjectArray['subject_id']);
                $subject->update($subjectArray);
            }

            return back()->with('success', 'Subject saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

}
