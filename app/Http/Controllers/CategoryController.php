<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', ['categories' => Category::orderBy('id', 'ASC')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
            'slug' => 'required|unique:categories|max:255',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.unique' => 'Tên slug đã tồn tại.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'description.max' => 'Mô tả chỉ có tối đa 255 ký tự.',
        ]);
        $data = $request->all();
        DB::table('categories')->insert([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
            'slug' => $data['slug'],
        ]);
        return redirect()->route('quan-ly-danh-muc.create')->with('success', 'Thêm mới danh mục thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);
        return view('admin.category.edit', ['category' => $category]);
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
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'slug' => 'required|max:255',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'description.max' => 'Mô tả chỉ có tối đa 255 ký tự.',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');
        $category->slug = $request->input('slug');
        $category->save();

        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('quan-ly-danh-muc.index')->with('success', 'Xóa danh mục thành công');
    }
}
