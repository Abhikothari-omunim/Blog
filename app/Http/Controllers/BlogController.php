<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
   
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
            'name' => 'required|string|max:30|min:3',   
            'data' => 'required|string|max:50|min:3',        
        ]);

        $blog = Blog::create([
            'name' => $validatedData['name'],
            'data' => $validatedData['data'],
        ]);
    
        return response()->json($blog, 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blogs = Blog::all();
        return response()->json($blogs, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update1(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30|min:3',
            'data' => 'required|string|max:50|min:3',
        ]);

        $blog->update([
            'name' => $validatedData['name'],
            'data' => $validatedData['data'],
        ]);

        return response()->json($blog, 200);  
    }

    public function update(Request $request, $id)
   {
        $blog = Blog::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:30|min:3',
            'data' => 'required|string|max:50|min:3',
        ]);

        $blog->update([
            'name' => $validatedData['name'],
            'data' => $validatedData['data'],
        ]);

        return response()->json($blog, 200);
   }


    /**
     * Remove the specified resource from storage.
     */
    
     public function destroy($id)
     {
        dd($id);
         $blog = Blog::findOrFail($id);
         if(!$blog){
            return response()->json(['message' => 'Blog Not Found'], 200);

         }
         $blog->delete();
         return response()->json(['message' => 'Blog deleted successfully'], 200);
     }
     
}
