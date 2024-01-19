<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Topic;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    //

    public function __construct() {
        // $this->var = $var;
    }


    public function index()  {
        
        // return Inertia::render("Topics/Index",[
        //     'topics' => Topic::all()->map(function($topic){
        //         return [
        //             "id" => $topic->id,
        //             "name" => $topic->name,
        //             "image" => asset('storage/'.$topic->image),
                    
        //         ];
        //     })->sortByDesc('created_at'),
        // ]);
        $topics = Topic::orderByDesc('created_at')->get();
        return Inertia::render("Topics/Index", [
            'topics' => $topics->map(function ($topic) {
                return [
                    "id" => $topic->id,
                    "name" => $topic->name,
                    "image" => asset('storage/' . $topic->image),
                    "created_at" => $topic->created_at->toDateTimeString(), // Assuming 'created_at' is a Carbon instance
                ];
            }),
        ]);
    }

    public function create()  {
        
        return Inertia::render("Topics/Create");
    }

    public function store(Request $request )  {

        $image = $request::file('image')->store('topics','public');
        
     

        Topic::create([
            "name"=> Request::input("name"),
            "image" => $image
        ]);

        
        return redirect()->route("topics.index");
    }

    public function edit(Topic $topic){
        return Inertia::render("Topics/Edit",[
            "topic" => $topic,
            "image" => asset('storage/' . $topic->image)
        ]);
    }

    public function update(Topic $topic, Request $request){

        $image = $topic->image;
        if($request::file("image")){
            Storage::delete("public/".$topic->image);

            $image = $request::file('image')->store('topics','public');
        }


        $topic->update([
            "name" => $request::input("name"),
            "image" => $image
        ]);

        return redirect()->route("topics.index");
    }

    public function destroy(Topic $topic){

       
        Storage::delete("public/".$topic->image);

        // $topic->destroy($topic->id);
        $topic->delete();

      

        return redirect()->route("topics.index");
    }



}
