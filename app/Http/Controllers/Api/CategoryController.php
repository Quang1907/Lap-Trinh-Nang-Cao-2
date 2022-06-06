<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Categories\CategoryReponsitoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryReponsitory;

    public function __construct(CategoryReponsitoryInterface $categoryReponsitory)
    {
        $this->categoryReponsitory = $categoryReponsitory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.category.index');
    }

    public function allCategory()
    {
        $categories = $this->categoryReponsitory->getAll();
        return response()->json([
            'status' => 200,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->categoryReponsitory->create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Category Created Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryReponsitory->find($id);
        return response()->json([
            'status' => 200,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->categoryReponsitory->find($id)->update($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Category Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryReponsitory->delete($id);
        return response()->json([
            'status' => 200,
            'message' => 'Category Deleted Successfully',
        ]);
    }
}
