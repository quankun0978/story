<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Story;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book.index', ['books' => Book::orderBy('id', 'ASC')->paginate(10)]);
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
        return view('admin.book.create', compact('categories', 'types'));
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
            'name' => 'required|unique:books|max:255',
            'author' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'key_word' => 'required',
            'link_pdf' => 'required',
            'slug' => 'required|unique:books|max:255',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.unique' => 'Tên sách đã tồn tại.',
            'author.required' => 'Vui lòng không bỏ trống tên tác giả.',
            'author.max' => 'Tên tác giả chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống tên slug.',
            'slug.unique' => 'Tên slug đã tồn tại.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'content.required' => 'Vui lòng không bỏ trống nội dung.',
            'key_word.required' => 'Vui lòng không bỏ trống từ khóa.',
            'link_pdf.required' => 'Vui lòng không bỏ trống từ link PDF.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
        ]);

        $data = $request->all();
        $get_image = $request->image;
        $path = 'uploads/books/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        Book::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => $data['content'],
            'link_pdf' => $data['link_pdf'],
            'key_word' => $data['key_word'],
            'status' => $data['status'],
            'slug' => $data['slug'],
            'author' => $data['author'],
            'image' => $new_image,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        return redirect()->route('quan-ly-sach.create')->with('success', 'Thêm mới sách thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('admin.book.edit', ['book' => $book]);
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
            'content' => 'required',
            'link_pdf' => 'required',
            'key_word' => 'required',
            'slug' => 'required|max:255',
        ], [
            'name.required' => 'Vui lòng không bỏ trống tên.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'name.unique' => 'Tên sách đã tồn tại.',
            'author.required' => 'Vui lòng không bỏ trống tên tác giả.',
            'author.max' => 'Tên tác giả chỉ có tối đa 255 ký tự.',
            'slug.required' => 'Vui lòng không bỏ trống slug.',
            'slug.unique' => 'Tên slug đã tồn tại.',
            'slug.max' => 'Slug chỉ có tối đa 255 ký tự.',
            'description.required' => 'Vui lòng không bỏ trống mô tả.',
            'content.required' => 'Vui lòng không bỏ trống nội dung.',
            'key_word.required' => 'Vui lòng không bỏ trống từ khóa.',
            'link_pdf.required' => 'Vui lòng không bỏ trống từ link PDF.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
        ]);

        $book = Book::findOrFail($id);
        $book->name = $request->input('name');
        $book->description = $request->input('description');
        $book->status = $request->input('status');
        $book->slug = $request->input('slug');
        $book->author = $request->input('author');
        $book->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $book->key_word = $request->input('key_word');
        $book->content = $request->input('content');
        $book->link_pdf = $request->input('link_pdf');
        if ($request->image != null) {
            if (file_exists('uploads/books/' . $book->image)) {
                unlink('uploads/books/' . $book->image);
            }
            $get_image = $request->image;
            $path = 'uploads/books/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $book->image = $new_image;
        }
        $book->save();


        return redirect()->back()->with('success', 'Cập nhật sách thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $path = 'uploads/books/' . $book->image;
        if (file_exists($path)) {
            unlink($path);
        }
        Book::find($id)->delete();
        return redirect()->route('quan-ly-quan-ly-sach.index')->with('success', 'Xóa sách thành công');
    }
}
