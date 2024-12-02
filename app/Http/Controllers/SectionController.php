<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.section',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required',

        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
            'description.required' => 'يرجي ادخال البيان',
        ]);

        // Check if the user is authenticated
        $user = Auth::user();
        if ($user) {
            Section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => $user->name,
            ]);

            session()->flash('Add', 'تم اضافة القسم بنجاح');
            return redirect('/sections');
        }

        // Handle the case where the user is not authenticated
        return redirect('/login')->with('error', 'Please log in to add a section.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section_name' => 'required|max:255|unique:sections,section_name,'.$request->id,
            'description' => 'required',
        ], [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
            'description.required' => 'يرجي ادخال البيان',
        ]);

        if ($validator->fails()) {
            return redirect('/sections')
                ->withErrors($validator)
                ->withInput();
        }

        $section = Section::find($request->id);

        if (!$section) {
            return redirect('/sections')->with('error', 'القسم غير موجود');
        }

        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('edit', 'تم تعديل القسم بنجاح');
        return redirect('/sections');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }

    public function restore($id)
{
    $section = Section::withTrashed()->find($id);
    if ($section) {
        $section->restore();
        session()->flash('restore', 'تم استعادة القسم بنجاح');
    }
    return redirect('/sections');
}

}
