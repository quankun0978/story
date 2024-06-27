<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.type.index', ['types' => Type::orderBy('id', 'ASC')->paginate(10)]);        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.create');

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
            'name'=>'required|unique:types|max:255',
            'description'=>'required|max:255',
            'slug'=>'required|unique:types|max:255',
        ],[
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.unique' => 'Tên slug đã tồn tại.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'description.max' => 'Mô tả chỉ có tối đa 255 ký tự.',
        ]);
        $data =$request->all();
        DB::table('types')->insert([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'status'=>$data['status'],
            'slug'=>$data['slug'],
        ]);
        return redirect()->route('the-loai.create')->with('success','Thêm mới thể loại thành công');
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
        $type= Type::find($id);
        return view('admin.type.edit',['type' =>$type]);
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
            'slug'=>'required|max:255',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'description.max' => 'Mô tả chỉ có tối đa 255 ký tự.',
        ]);
    
        $type = Type::findOrFail($id);
        $type->name = $request->input('name');
        $type->description = $request->input('description');
        $type->status = $request->input('status');
        $type->slug = $request->input('slug');
        $type->save();
    
        return redirect()->back()->with('success', 'Cập nhật thể loại thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Type::find($id)->delete();
        return redirect()->route('the-loai.index')->with('success','Xóa thể loại thành công');
    }
}
