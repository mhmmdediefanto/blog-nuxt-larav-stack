<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryBlogController extends Controller
{
    public function getAllCategory()
    {
        $categories = CategoryBlog::latest()->get();

        if (!$categories->isEmpty()) {
            return response()->json([
                'data' => $categories
            ], 200);
        }

        return response()->json([
            'message' => 'No categories found'
        ], 404);
    }


    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = CategoryBlog::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name'], '-'),
        ]);

        if ($categories) {
            return response()->json([
                'message' => 'Category created successfully',
                'data' => $categories
            ], 201);
        }

        return response()->json([
            'message' => 'Failed to create category'
        ], 500);
    }

    public function editCategory(Request $request, $id)
    {
        $category = CategoryBlog::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        if ($category->name === $validatedData['name']) {
            return response()->json([
                'message' => 'Category name is the same as before'
            ], 400);
        }

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name'], '-');
        $category->save();


        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);
    }


    public function deleteCategory($id)
    {
        try {
            $idCategory = CategoryBlog::find($id);
            if (!$idCategory) {
                return response()->json([
                    'message' => 'Category not found'
                ], 404);
            }
            $idCategory->delete();
            return response()->json([
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to delete category'
            ], 500);
        }
    }
}
