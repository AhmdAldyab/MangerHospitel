<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Image;
use App\Models\specialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequestDoctor;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=Doctor::all();
        return view('employees.doctors.index', compact('doctors'));
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
        return view('employees.doctors.create',compact('genders','specializations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestDoctor $request)
    {
        try {
            DB::beginTransaction();
            
            $docter=Doctor::create([
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
                    $file->storeAs('attachments/doctorss/' . $docter->name, $file->getClientOriginalName(), 'upload_attachments');
                    Image::create([
                        'filename' =>$name,
                        'imageable_id'=>$docter->id,
                        'imageable_type'=>'App\Models\Doctor',
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
    public function show(Doctor $doctor)
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
        $doctor=Doctor::findOrFail($id);
        $genders=Gender::all();
        $specializations=specialization::all();
        return view('employees.doctors.edit',compact('doctor','genders','specializations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequestDoctor $request)
    {
        try {
            DB::beginTransaction();
            $doctor=Doctor::findOrFail($request->id);
            $doctor->update([
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
                    $file->storeAs('attachments/doctorss/' . $docter->name, $file->getClientOriginalName(), 'upload_attachments');
                    Image::create([
                        'filename' =>$name,
                        'imageable_id'=>$docter->id,
                        'imageable_type'=>'App\Models\Doctor',
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
        
            $doctor=Doctor::findOrFail($request->id);
            $image=Image::where('imageable_id',$request->id);
            if (!empty($image)) {
                
                Storage::disk('upload_attachments')->deleteDirectory('attachments/doctorss/'.$doctor->name);
            }
            Doctor::findOrFail($request->id)->delete();
            toastr()->success('Data has been saved successfully!', 'Deleted');
            return redirect()->back();
        
    }
}
