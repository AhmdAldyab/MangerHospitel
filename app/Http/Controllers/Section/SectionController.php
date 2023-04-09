<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequestSection;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Section::all();
        return view('sections.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestSection $request)
    {
        try {
            Section::create([
                'name'       => $request->Name,
                'desciption' => $request->Notes
            ]);
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequestSection $request)
    {
        try {
            $section=Section::findOrFail($request->id);
            $section->update([
                'name'       => $request->Name,
                'desciption' => $request->Notes
            ]);
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $section=Section::findOrFail($request->id)->delete();
            toastr()->success('Data has been saved successfully!', 'Deleted');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
}
