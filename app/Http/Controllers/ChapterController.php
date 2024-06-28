<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.chapter.index', ['chapters' => Chapter::orderBy('id', 'ASC')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stories = DB::table('stories')->get();
        return view('admin.chapter.create', compact('stories'));
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
            'title' => 'required|unique:chapters|max:255',
            'description' => 'required|max:255',
            'content' => 'required',
            'slug' => 'required|unique:chapters|max:255',

        ], [
            'title.required' => 'Vui lòng không bỏ trống tên.',
            'title.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'title.unique' => 'Tên truyện đã tồn tại.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.unique' => 'Tên slug đã tồn tại.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'description.max' => 'Mô tả chỉ có tối đa 255 ký tự.',
            'content.required' => 'Vui lòng không bỏ trống nội dung.',

        ]);
        $data = $request->all();
        DB::table('chapters')->insert([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'slug' => $data['slug'],
            'story_id' => $data['story_id'],
            'content' => $data['content'],
        ]);

        return redirect()->route('quan-ly-chapter.create')->with('success', 'Thêm mới chapter thành công');
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
        $stories = DB::table('stories')->get();
        $chapter = Chapter::find($id);
        return view('admin.chapter.edit', ['stories' => $stories, 'chapter' => $chapter]);
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
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'content' => 'required',
            'slug' => 'required|max:255',

        ], [
            'title.required' => 'Vui lòng không bỏ trống tên.',
            'title.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'description.max' => 'Mô tả chỉ có tối đa 255 ký tự.',
            'content.required' => 'Vui lòng không bỏ trống nội dung.',

        ]);

        $story = Chapter::findOrFail($id);
        $story->title = $request->input('title');
        $story->description = $request->input('description');
        $story->status = $request->input('status');
        $story->slug = $request->input('slug');
        $story->story_id = $request->input('story_id');
        $story->content = $request->input('content');
        $story->save();
        return redirect()->back()->with('success', 'Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->route('quan-ly-chapter.index')->with('success', 'Xóa chapter thành công');
    }
}
