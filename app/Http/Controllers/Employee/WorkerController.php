<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\Gender;
use App\Models\Image;
use App\Models\specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequestWorkers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers=Worker::all();
        return view('employees.wokers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders=Gender::all();
        return view('employees.wokers.create',compact('genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestWorkers $request)
    {
        try {
            DB::beginTransaction();
            
            $worker=Worker::create([
                'name'       => $request->name,
                'hiring_date' => $request->hiring,
                'birth_date' => $request->birth,
                'gender_id'       => $request->gender,
                'adress'       => $request->adress,
                'email'       => $request->email,
                'number_phone'       => $request->number,
            ]);
            if ($request->hasfile('photes')) {
                foreach ($request->file('photes') as $file) {
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/wokers/' . $worker->name, $file->getClientOriginalName(), 'upload_attachments');
                    Image::create([
                        'filename' =>$name,
                        'imageable_id'=>$worker->id,
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
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker=Worker::findOrFail($id);
        $genders=Gender::all();
        return view('employees.wokers.edit',compact('worker','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequestWorkers $request)
    {
        try {
            DB::beginTransaction();
            $worker=Worker::findOrFail($request->id);
            $worker->update([
                'name'       => $request->name,
                'hiring_date' => $request->hiring,
                'birth_date' => $request->birth,
                'gender_id'       => $request->gender,
                'adress'       => $request->adress,
                'email'       => $request->email,
                'number_phone'       => $request->number,
            ]);
            if ($request->hasfile('photes')) {
                foreach ($request->file('photes') as $file) {
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/wokers/' . $worker->name, $file->getClientOriginalName(), 'upload_attachments');
                    Image::create([
                        'filename' =>$name,
                        'imageable_id'=>$worker->id,
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
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $woker=Worker::findOrFail($request->id);
            $image=Image::where('imageable_id',$request->id);
            if (!empty($image)) {
                
                Storage::disk('upload_attachments')->deleteDirectory('attachments/wokers/'.$woker->name);
            }
            Worker::findOrFail($request->id)->delete();
            toastr()->success('Data has been saved successfully!', 'Deleted');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
}
