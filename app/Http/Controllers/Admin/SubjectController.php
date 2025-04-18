<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function subjectList(){
        $subjects = Subject::with('creator')->get();
//        toastr()->error('An error has occurred please try again later.');
        return view('pages.subjects.subject-list',compact('subjects'));
    }

    public function ajax_subjectList(Request $request){
        $search = $request->get('search');
        $isselect2 = $request->has('select2');

        $subjects = collect();
        if (!empty($search)) {
            $subjects = Subject::query()->where('name', 'like', "%$search%")->where('status', 1)->get();
            if ($isselect2) {
                $subjects->transform(function ($d) {
                    $d->text = $d->name;
                    return $d;
                });
            }
        }
        return response()->json([
            'status' => 'success',
            'data' => $subjects
        ]);
    }

    public function saveSubject(Request $request)
    {
        try {
            $subjectArray = $request->except('_token');
            $subjectArray['status'] = $subjectArray['status'] === 'on' ? 1 : 0;

            // Check if code is unique during insertion and updating
            $subjectCode = $subjectArray['code'];
            $subjectId = isset($subjectArray['subject_id']) ? $subjectArray['subject_id'] : null;

            $existingSubject = Subject::where('code', $subjectCode);

            if ($subjectId) {
                // If updating, exclude the current subject from the check
                $existingSubject = $existingSubject->where('id', '!=', $subjectId);
            }

            $existingSubject = $existingSubject->first();

            if ($existingSubject) {
                return redirect()->back()->with('error', 'Subject code already exists');
            }

            if (empty($subjectArray['subject_id'])) {
                unset($subjectArray['subject_id']);
                $subjectArray['created_by'] = \Auth::id();
                Subject::create($subjectArray);
            } else {
                $subject = Subject::findOrFail($subjectArray['subject_id']);
                unset($subjectArray['subject_id']);
                $subject->update($subjectArray);
            }


//            toastr()->success('Subject saved successfully');
//            return back()->with('success', 'Subject saved successfully');
            toastr()->success('Subject saved successfully');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteSubject(Request $request)
    {
        $subjectId = $request->get('object_id');

        try {
            // Check if subject is related to other classes (Todo: Implement this check later)
            $subject = Subject::find($subjectId);
            if (!$subject)  return redirect()->back()->with('error', 'Subject not found');
            // Perform the deletion
            $subject->delete();
            return redirect()->back()->with('success', 'Subject Deleted Successfully');
        } catch (\Exception $exception) {
            // In case of error, return with the error message
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


}
