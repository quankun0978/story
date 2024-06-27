<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\TypeStory;
use App\Rules\IsComma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\fileExists;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.story.index', ['stories' => Story::orderBy('id', 'ASC')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->get();
        $types = DB::table('types')->get();
        return view('admin.story.create', compact('categories', 'types'));
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
            'name' => 'required|unique:stories|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'key_word' => 'required',
            'type_id' => 'required',
            'slug' => 'required|unique:stories|max:255',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.unique' => 'Tên truyện đã tồn tại.',
            'author.required' => 'Vui lòng không bỏ trống tên tác giả.',
            'author.max' => 'Tên tác giả chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.unique' => 'Tên slug đã tồn tại.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'type_id.required' => 'Vui lòng không bỏ trống thể loại.',
            'key_word.required' => 'Vui lòng không bỏ trống từ khóa.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
        ]);

        $data = $request->all();
        $get_image = $request->image;
        $path = 'uploads/story/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $story = Story::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'key_word' => $data['key_word'],
            'status' => $data['status'],
            'slug' => $data['slug'],
            'author' => $data['author'],
            'category_id' => $data['category_id'],
            'image' => $new_image,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);

        $typeIds = $request->input('type_id', []);
        $payload = [];
        foreach ($typeIds as $typeId) {
            $payload[] = [
                'story_id' => $story->id,
                'type_id' => $typeId,
            ];
        }
        TypeStory::insert($payload);

        return redirect()->route('quan-ly-truyen.create')->with('success', 'Thêm mới truyện thành công');
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
        $categories = DB::table('categories')->get();
        $types = DB::table('types')->get();
        $story = Story::find($id);
        return view('admin.story.edit', ['story' => $story, 'categories' => $categories, 'types' => $types]);
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
            'author' => 'required|max:255',
            'description' => 'required',
            'slug' => 'required|max:255',
            'key_word' => 'required',
            'type_id' => 'required',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'author.required' => 'Vui lòng không bỏ trống tên tác giả.',
            'author.max' => 'Tên tác giả chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'type_id.required' => 'Vui lòng không bỏ trống thể loại.',
            'key_word.required' => 'Vui lòng không bỏ trống từ khóa.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
        ]);

        $story = Story::findOrFail($id);
        $story->name = $request->input('name');
        $story->description = $request->input('description');
        $story->status = $request->input('status');
        $story->slug = $request->input('slug');
        $story->author = $request->input('author');
        $story->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $story->category_id = $request->input('category_id');
        $story->key_word = $request->input('key_word');
        if ($request->image != null) {
            if (file_exists('uploads/story/' . $story->image)) {
                unlink('uploads/story/' . $story->image);
            }
            $get_image = $request->image;
            $path = 'uploads/story/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $story->image = $new_image;
        }
        $story->save();
        $typeIds = $request->input('type_id', []);

        // Xóa các bản ghi cũ trong bảng TypeStory
        TypeStory::where('story_id', $id)->delete();

        // Thêm các bản ghi mới vào bảng TypeStory
        foreach ($typeIds as $typeId) {
            TypeStory::create([
                'story_id' => $id,
                'type_id' => $typeId,
            ]);
        }

        return redirect()->back()->with('success', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = Story::find($id);
        $path = 'uploads/story/' . $story->image;
        if (file_exists($path)) {
            unlink($path);
        }
        Story::find($id)->delete();
        return redirect()->route('quan-ly-truyen.index')->with('success', 'Xóa truyện thành công');
    }
}
