<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\TypeStory;
use App\Models\Chapter;
use App\Models\Story;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\Share;

class IndexController extends Controller
{
    public function home(Request $request)
    {

        try {
            $categories = DB::table('categories')->where('status', "active")->get();
            $share = new Share();
            $shareComponent = $share->page($request->url(), 'Chia sẻ')
                ->facebook()
                ->twitter()
                ->reddit()
                ->whatsapp()->telegram()->linkedin();
            $types = DB::table('types')->where('status', "active")->get();
            $stories = Story::orderBy('id', 'DESC')->where('status', "active")->take(12)->get();
            $books = Book::orderBy('id', 'DESC')->where('status', "active")->take(12)->get();

            return view('pages.home', ['books' => $books, 'shareComponent' => $shareComponent, 'stories' => $stories, 'categories' => $categories, 'types' => $types]);
        } catch (\Throwable $th) {
            // return view('errors.500');
        }
    }
    public function readStory($slug)
    {
        $categories = DB::table('categories')->where('status', "active")->get();
        $types = DB::table('types')->where('status', "active")->get();
        $storyBySlug = Story::orderBy('id', 'ASC')->where('slug', $slug)->where('status', "active")->first();
        $share = new Share();
        $shareComponent = $share->page(url('truyen-doc/' . $storyBySlug->slug), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        $stories = Story::orderBy('id', 'ASC')
            ->where('category_id', $storyBySlug->category->id)
            ->where('id', '!=', $storyBySlug->id)->where('status', "active")
            ->get();
        return view('pages.story', ['shareComponent' => $shareComponent, 'categories' => $categories, 'stories' => $stories, 'storyBySlug' => $storyBySlug, 'types' => $types]);
    }
    public function readBook(Request $request, $slug)
    {
        $categories = DB::table('categories')->where('status', "active")->get();
        $types = DB::table('types')->where('status', "active")->get();
        $bookBySlug = Book::orderBy('id', 'ASC')->where('slug', $slug)->where('status', "active")->get();
        $share = new Share();
        $shareComponent = $share->page($request->url(), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        return view('pages.book', ['shareComponent' => $shareComponent, 'bookBySlug' => $bookBySlug, 'categories' => $categories, 'types' => $types]);
    }
    public function category(Request $request, $slug, $page)
    {
        $stories=[];
        $storiesByPage=[];
        $types = DB::table('types')->where('status', "active")->get();
        $categories = DB::table('categories')->where('status', "active")->get();
        $category = Category::orderBy('id', 'ASC')->where('slug', $slug)->where('status', "active")->first();
        if(isset($category->id)){
            $storiesByPage = Story::orderBy('id', 'ASC')->where('category_id', $category->id)->where('status', "active")->paginate(24, ['*'], 'page', $page);
            $stories = Story::orderBy('id', 'ASC')->where('status', "active")->where('category_id', $category->id)->get();
        }
        $share = new Share();
        $shareComponent = $share->page($request->url(), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        return view('pages.category', ['page' => $page, 'storiesByPage' => $storiesByPage, 'shareComponent' => $shareComponent, 'category' => $category, 'stories' => $stories, 'categories' => $categories, 'types' => $types]);
    }
    public function type(Request $request, $slug, $page)
    {
        try {
            $share = new Share();
            $shareComponent = $share->page($request->url(), 'Chia sẻ')
                ->facebook()
                ->twitter()
                ->reddit()
                ->whatsapp()->telegram()->linkedin();
            $types = DB::table('types')->where('status', "active")->get();
            $categories = DB::table('categories')->where('status', "active")->get();
            $type = Type::where('slug', $slug)->orderBy('id', 'ASC')->where('status', "active")->first();
            $stories = TypeStory::with("story")->orderBy('id', 'ASC')->where('type_id', $type->id)->get();
            $storiesByPage = TypeStory::with("story")->orderBy('id', 'ASC')->where('type_id', $type->id)->paginate(24, ['*'], 'page', $page);
    
            return view('pages.type', ['page' => $page, 'storiesByPage' => $storiesByPage, 'shareComponent' => $shareComponent, 'type' => $type, 'stories' => $stories, 'categories' => $categories, 'types' => $types]);
        } catch (\Throwable $th) {
        }
    }
    public function chapters(Request $request, $slug,$id)
    {   
        $share = new Share();
        $shareComponent = $share->page($request->url(), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        $categories = DB::table('categories')->where('status', "active")->get();
        $types = DB::table('types')->where('status', "active")->get();
        $chapterBySlug = Chapter::orderBy('id', 'DESC')->where('slug', $id)->where('status', "active")->first();
        $chapters = Chapter::orderBy('id', 'DESC')->where('story_id', $chapterBySlug->story_id)->where('status', "active")->get();
        $next_chapter = Chapter::where('story_id', $chapterBySlug->story_id)->where('id', '>', $chapterBySlug->id)->min('slug');
        $prev_chapter = Chapter::where('story_id', $chapterBySlug->story_id)->where('id', '<', $chapterBySlug->id)->max('slug');
        $chapters = Chapter::orderBy('id', 'ASC')->where('story_id', $chapterBySlug->story_id)->where('status', "active")->get();
        $max_id  = Chapter::where('story_id', $chapterBySlug->story_id)->orderBy('id', 'DESC')->first();
        $min_id  = Chapter::where('story_id', $chapterBySlug->story_id)->orderBy('id', 'ASC')->first();

        return view('pages.chapter', ['slug'=>$slug,'shareComponent' => $shareComponent, 'chapters' => $chapters, 'chapterBySlug' => $chapterBySlug, 'categories' => $categories, 'next_chapter' => $next_chapter, 'prev_chapter' => $prev_chapter, 'min_id' => $min_id, 'max_id' => $max_id, 'types' => $types]);
    }
    public function search()
    {
        $key = $_GET['key'];
        if (!$key) {
            return redirect()->back();
        }
        $share = new Share();
        $shareComponent = $share->page(url('http://127.0.0.1:8000/'), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        $categories = DB::table('categories')->where('status', "active")->get();
        $types = DB::table('types')->where('status', "active")->get();
        $stories = Story::with('category', 'type')->where('name', 'LIKE', '%' . $key . '%')->orWhere('author', 'LIKE', '%' . $key . '%')->where('status', "active")->get();
        return view('pages.search', ['shareComponent' => $shareComponent, 'key' => $key, 'categories' => $categories, 'types' => $types, 'stories' => $stories]);
    }
    public function show(Request $request)
    {
        $key = $request->get('key');
        $stories = Story::with('category', 'type')
            ->where('name', 'LIKE', '%' . $key . '%')
            ->orWhere('author', 'LIKE', '%' . $key . '%')
            ->limit(10)  // Giới hạn số lượng kết quả trả về
            ->where('status', "active")->get();
        $output = '<ul class="dropdown-menu" style="display:block;">';
        foreach ($stories as $story) {
            $output .= '
                <li class="item-search"><a class="dropdown-item" href="#">' . $story->name . '</a></li>';
        }
        $output .= '</ul>';
        return response()->json(['html' => $output]);
    }
    public function tags(Request $request, $key)
    {
        $categories = DB::table('categories')->where('status', "active")->get();
        $types = DB::table('types')->where('status', "active")->get();
        // $storiesAll = DB::table('stories')->get();
        $share = new Share();
        $shareComponent = $share->page(url($request->url()), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();

        $stories = Story::with('category', 'type')->where('key_word', 'LIKE', '%' . $key . '%')->orWhere('author', 'LIKE', '%' . $key . '%')->where('status', "active")->get();
        return view('pages.tag', ['shareComponent' => $shareComponent, 'key' => $key, 'categories' => $categories, 'types' => $types, 'stories' => $stories]);
    }
    public function tagsBooks(Request $request, $key)
    {
        $categories = DB::table('categories')->where('status', "active")->get();
        $types = DB::table('types')->where('status', "active")->get();
        // $storiesAll = DB::table('stories')->get();
        $share = new Share();
        $shareComponent = $share->page(url($request->url()), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();

        $books = Book::where('key_word', 'LIKE', '%' . $key . '%')->orWhere('author', 'LIKE', '%' . $key . '%')->where('status', "active")->get();
        return view('pages.tagBooks', ['shareComponent' => $shareComponent, 'key' => $key, 'categories' => $categories, 'types' => $types, 'books' => $books]);
    }
    public function books(Request $request, $page)
    {
        $key = isset($page) ? $page : 1;
        $share = new Share();
        $shareComponent = $share->page($request->url(), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->where('status', "active")->get();
        $categories = DB::table('categories')->where('status', "active")->get();
        $books = Book::orderBy('id', 'ASC')->where('status', "active")->get();
        $booksByPage = Book::orderBy('id', 'ASC')->where('status', "active")->paginate(24, ['*'], 'page', $key);
        return view('pages.books', ['booksByPage' => $booksByPage, 'page' => $page, 'shareComponent' => $shareComponent, 'books' => $books, 'categories' => $categories, 'types' => $types]);
    }
    public function favourite(Request $request)
    {
        $share = new Share();
        $shareComponent = $share->page($request->url(), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->where('status', "active")->get();
        $categories = DB::table('categories')->where('status', "active")->get();
        return view('pages.favourite', compact('types', 'categories', 'shareComponent'));
    }
}
