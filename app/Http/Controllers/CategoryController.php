<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allCategory()
    {
        $categories = Category::all();
        if (count($categories) > 0) {
            return response()->json([
                'status' => 200,
                'categories' => $categories
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'error' => "Not found category"
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories|max:255',
            ],
            [
                'name.required' => 'Vui lòng nhập tên danh mục',
                'name.unique' => 'Tên danh mục đã tồn tại',
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'error' => $validator->errors(),
                ]
            );
        } else {
            $category = Category::create($request->all());
            $category->update([
                'slug' => Str::slug($request->name) . '-' . $category->id,
            ]);
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Category Created Successfully',
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json([
                'status' => 200,
                'category' => $category,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Not found category',
            ]);
        }
    }

    public function search($key)
    {
        $categories = Category::where('name', 'like', '%' . $key . '%')->get();
        if ($categories) {
            return response()->json([
                'status' => 200,
                'categories' => $categories,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Not found category',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|unique:categories,name,' . request()->id,
            ],
            [
                'name.required' => 'Vui lòng nhập tên danh mục',
                'name.unique' => 'Tên danh mục đã tồn tại',
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 400,
                    'error' => $validator->errors(),
                ]
            );
        } else {
            $category = Category::find($id);
            $category->update($request->all(),);
            $category->update(['slug' => Str::slug($request->name) . '-' . $id]);
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Category Updated Successfully',
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            if (count($category->products) > 0) {
                return response()->json([
                    'status' => 208,
                    'error' => 'Không thể xoá danh mục',
                ]);
            }
            $category->delete();
            return response()->json([
                'status' => 200,
                'message' => $category->name . ' Deleted Successfuly ',
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'error' => 'Not found category',
            ]);
        }
    }
}
