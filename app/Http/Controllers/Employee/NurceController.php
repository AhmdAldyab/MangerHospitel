<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Nurce;
use App\Models\Gender;
use App\Models\Image;
use App\Models\specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequestNurce;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class NurceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nurces=Nurce::all();
        return view('employees.nurces.index', compact('nurces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders=Gender::all();
        $specializations=specialization::all();
        return view('employees.nurces.create',compact('genders','specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestNurce $request)
    {
        try {
            DB::beginTransaction();
            
            $nurce=Nurce::create([
                'name'       => $request->name,
                'hiring_date' => $request->hiring,
                'birth_date' => $request->birth,
                'gender_id'       => $request->gender,
                'Specialization_id'       => $request->specialization,
                'adress'       => $request->adress,
                'email'       => $request->email,
                'number_phone'       => $request->number,
            ]);
            if ($request->hasfile('photes')) {
                foreach ($request->file('photes') as $file) {
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/nurces/' . $nurce->name, $file->getClientOriginalName(), 'upload_attachments');
                    Image::create([
                        'filename' =>$name,
                        'imageable_id'=>$nurce->id,
                        'imageable_type'=>'App\Models\Nurce',
                    ]);
                }
            }
            DB::commit();
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->back();   
        } catch (\Throwable $th) {
            DB::rollback();
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Nurce $nurce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nurce=Nurce::findOrFail($id);
        $genders=Gender::all();
        $specializations=specialization::all();
        return view('employees.nurces.edit',compact('nurce','genders','specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequestNurce $request)
    {
        try {
            DB::beginTransaction();
            $nurce=Nurce::findOrFail($request->id);
            $nurce->update([
                'name'       => $request->name,
                'hiring_date' => $request->hiring,
                'birth_date' => $request->birth,
                'gender_id'       => $request->gender,
                'Specialization_id'       => $request->specialization,
                'adress'       => $request->adress,
                'email'       => $request->email,
                'number_phone'       => $request->number,
            ]);
            if ($request->hasfile('photes')) {
                foreach ($request->file('photes') as $file) {
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/nurces/' . $nurce->name, $file->getClientOriginalName(), 'upload_attachments');
                    Image::create([
                        'filename' =>$name,
                        'imageable_id'=>$nurce->id,
                        'imageable_type'=>'App\Models\Nurce',
                    ]);
                }
            }
            DB::commit();
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->back();   
        } catch (\Throwable $th) {
            DB::rollback();
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $nurce=Nurce::findOrFail($request->id);
            $image=Image::where('imageable_id',$request->id);
            if (!empty($image)) {
                
                Storage::disk('upload_attachments')->deleteDirectory('attachments/nurces/'.$nurce->name);
            }
            Nurce::findOrFail($request->id)->delete();
            toastr()->success('Data has been saved successfully!', 'Deleted');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
}
