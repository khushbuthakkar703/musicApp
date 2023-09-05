<?php

namespace App\Http\Controllers;

use App\MusicType;
use Illuminate\Http\Request;


class MusicTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $musicTypes=MusicType::paginate(5);
        return view('genre.viewgenre',compact('musicTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('genre.creategenre');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'genre'=>'required'
        ]);

        $genre=new MusicType();
        $genre->name=$request->genre;
        $genre->save();
        return redirect()->route('genres')->with('message',"Genre Successfully Created");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MusicType  $musicType
     * @return \Illuminate\Http\Response
     */
    public function edit(MusicType $musicType)
    {
        //
        $genre=MusicType::find($musicType)->first();
        return view('genre.editgenre',compact('genre'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MusicType  $musicType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MusicType $musicType)
    {
        //
        $this->validate(request(),[
            'genre'=>'required'
        ]);
        $musicType->name = $request->genre;
        $musicType->save();

        return redirect()->route('genres')->with('message',"Genre Successfully Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MusicType  $musicType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MusicType $musicType)
    {
        //

        $genre=MusicType::find($musicType)->first();
        if($genre) {
            $genre->delete();
        }
        return redirect()->route('genres')->with('message',"Genre Successfully Deleted");
    }

    public function getAllApi(){
        return MusicType::select('id','name')->get();
    }
}
