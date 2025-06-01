<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function getAllBlog()
    {
        $blog = Blog::with([
            'category:id,name,slug',
            'user:id,name'
        ])->latest()->paginate(16);

        if ($blog->isEmpty()) {
            return response()->json([
                'message' => 'No blog found'
            ], 404);
        }

        return response()->json([
            'blog' => $blog
        ], 200);
    }

    public function createBlog(Request $request)
    {
        $validatedData  = $request->validate([
            'title' => 'required|string|max:255',
            'category_blog_id' => 'required|exists:category_blogs,id',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        try {
            DB::beginTransaction();


            if ($request->image) {
                $validatedData['image'] = $request->file('image')->store('images/blogs', 'public');
            }

            $blog = Blog::create([
                'title' => $validatedData['title'],
                'user_id' => Auth::user()->id,
                'category_blog_id' => $validatedData['category_blog_id'],
                'slug' => Str::slug($validatedData['title'], '-'),
                'excerpt' => substr($validatedData['content'], 0, 100),
                'content' => $validatedData['content'],
                'image' => $validatedData['image'],
            ]);

            if ($blog) {
                DB::commit();
                return response()->json([
                    'message' => 'Blog created successfully',
                    'data' => $blog
                ], 201);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create blog',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function deleteBlog($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully'
        ], 200);
    }


    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }

        $rules = [
            'title' => 'required|string|max:255',
            'category_blog_id' => 'required|exists:category_blogs,id',
            'content' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];


        $validatedData = $request->validate($rules);

        if ($request->title != $blog->title) {
            // Cek apakah title sudah digunakan oleh blog lain
            $existingBlog = Blog::where('slug', Str::slug($validatedData['title'], '-'))
                ->where('id', '!=', $id)
                ->first();

            if ($existingBlog) {
                return response()->json([
                    'message' => 'Blog title already used'
                ], 400);
            }
        }
        // Handle image jika ada
        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $validatedData['image'] = $request->file('image')->store('images/blogs', 'public');
        }

        $updateData = [
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title'], '-'),
            'category_blog_id' => $validatedData['category_blog_id'],
            'excerpt' => substr($validatedData['content'], 0, 100),
            'content' => $validatedData['content'],
        ];

        if (isset($validatedData['image'])) {
            $updateData['image'] = $validatedData['image'];
        }

        $blog->update($updateData);

        return response()->json([
            'message' => 'Blog updated successfully',
            'data' => $blog
        ], 200);
    }

    public function showDetail($slug)
    {
        $blog = Blog::with(['category' => function ($query) {
            $query->select('id', 'name', 'slug');
        }, 'user' => function ($query) {
            $query->select('id', 'name');
        }])->where('slug', $slug)->first();

        return response()->json([
            'data' => $blog,
            'message' => 'Blog retrieved successfully'

        ], 200);
    }
}
