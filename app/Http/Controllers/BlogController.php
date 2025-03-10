<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
   
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:30|min:3',   
            'data' => 'required|string|max:50|min:3', 
            'user_id'=>'required'       
        ]);


        $blog = Blog::create([
            'name' => $validatedData['name'],
            'data' => $validatedData['data'],
            'user_id' => $validatedData['user_id']
        ]);

        $userData = User::find($validatedData['user_id']);

        if ($userData) {
            $userInfo = [
                'id' => $userData->id,
                'name' => $userData->name,
                'email' => $userData->email,
            ];
        } else {
            $userInfo = null; 
        }

        return response()->json([
            'blog' => $blog,
            'user' => $userInfo, 
        ], 200);
    }


    public function show(Blog $blog)
    {
        $blogs = Blog::all();
        return response()->json($blogs, 200);
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

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if(!$blog){
            return response()->json(['message' => 'Blog Not Found'], 200);

        }
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully'], 200);
    }
     
}
