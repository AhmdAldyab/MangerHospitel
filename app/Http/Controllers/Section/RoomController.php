<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequestRoom;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms=Room::all();
        $sections=Section::all();
        return view('Rooms.index',compact('rooms','sections'));
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
    public function store(StoreRequestRoom $request)
    {
        try {
            Room::create([
                'name'       => $request->Name,
                'desciption' => $request->Notes,
                'section_id' => $request->Section
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequestRoom $request)
    {
        try {
            $room=Room::findOrFail($request->id);
            $room->update([
                'name'       => $request->Name,
                'desciption' => $request->Notes,
                'section_id' => $request->Section
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
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $room=Room::findOrFail($request->id)->delete();
            toastr()->success('Data has been saved successfully!', 'Deleted');
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error('Oops! Something went wrong!');
            return redirect()->back();
        }
    }
}
