<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Story;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\Share;

class ComicController extends Controller
{
    public function index(Request $request)
    {
        try {
            $categories = DB::table('categories')->get();
            $share = new Share();
            $shareComponent = $share->page( $request->url(), 'Chia sẻ')
            ->facebook()
            ->twitter()
            ->reddit()
            ->whatsapp()->telegram()->linkedin();
            $types = DB::table('types')->get();
            $stories = Story::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
            $books = Book::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
            $client = new Client();
            $response = $client->get('https://otruyenapi.com/v1/api/home');
            $responseType = $client->get('https://otruyenapi.com/v1/api/the-loai');
            $typeComics =$responseType->getStatusCode()==200 ?json_decode($responseType->getBody(), true):[];
            $config =$response->getStatusCode()==200 ?json_decode($response->getBody(), true):[];
            return view('comic.home', ['typeComics'=>$typeComics['data']['items'],'config' => $config['data'],'books'=>$books,'shareComponent'=>$shareComponent,'stories' => $stories,'categories'=>$categories,'types'=>$types]);
        } catch (\Throwable $th) {
            return view('errors.500');
        }
    }


    public function show(Request $request,$type,$page)
    {
        $categories = DB::table('categories')->get();
        $share = new Share();
        // $page=$page==0?1:$page;
        $shareComponent = $share->page( $request->url(), 'Chia sẻ')
        ->facebook()
        ->twitter()
        ->reddit()
        ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->get();
        $stories = Story::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $books = Book::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $client = new Client();
        $responseConfig = $client->get('https://otruyenapi.com/v1/api/home');
        $responseType = $client->get('https://otruyenapi.com/v1/api/the-loai');
        $response = $client->get('https://otruyenapi.com/v1/api/danh-sach/'.$type.'?page='.$page);
        $data =$response->getStatusCode()==200 ?json_decode($response->getBody(), true):[];
        $config =$responseConfig->getStatusCode()==200 ?json_decode($responseConfig->getBody(), true):[];
        $typeComics =$responseType->getStatusCode()==200 ?json_decode($responseType->getBody(), true):[];
        return view('comic.show', ['page'=>$page,'slug'=>$type,'typeComics'=>$typeComics['data']['items'],'data' => $data['data'],'config'=>$config['data'],'books'=>$books,'shareComponent'=>$shareComponent,'stories' => $stories,'categories'=>$categories,'types'=>$types]);

    }
    public function detail(Request $request,$slug)
    {
        $categories = DB::table('categories')->get();
        $share = new Share();
        $shareComponent = $share->page( $request->url(), 'Chia sẻ')
        ->facebook()
        ->twitter()
        ->reddit()
        ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->get();
        $stories = Story::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $books = Book::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $client = new Client();
        $responseConfig = $client->get('https://otruyenapi.com/v1/api/home');
        $response = $client->get('https://otruyenapi.com/v1/api/truyen-tranh/'.$slug);
        $data =$response->getStatusCode()==200 ?json_decode($response->getBody(), true):[];
        $responseType = $client->get('https://otruyenapi.com/v1/api/the-loai');
        $typeComics =$responseType->getStatusCode()==200 ?json_decode($responseType->getBody(), true):[];
        $config =$responseConfig->getStatusCode()==200 ?json_decode($responseConfig->getBody(), true):[];
        return view('comic.detail', ['typeComics'=>$typeComics['data']['items'], 'data' => $data['data'],'config'=>$config['data'],'books'=>$books,'shareComponent'=>$shareComponent,'stories' => $stories,'categories'=>$categories,'types'=>$types]);
    }
    public function chapter(Request $request,$slug)
    {
        $categories = DB::table('categories')->get();
        $share = new Share();
        $shareComponent = $share->page( $request->url(), 'Chia sẻ')
        ->facebook()
        ->twitter()
        ->reddit()
        ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->get();
        $stories = Story::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $books = Book::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $client = new Client();
        $responseConfig = $client->get('https://otruyenapi.com/v1/api/home');
        $response = $client->get('https://otruyenapi.com/v1/api/truyen-tranh/'.$slug);
        $responseType = $client->get('https://otruyenapi.com/v1/api/the-loai');
        $data =$response->getStatusCode()==200 ?json_decode($response->getBody(), true):[];
        $typeComics =$responseType->getStatusCode()==200 ?json_decode($responseType->getBody(), true):[];
        $config =$responseConfig->getStatusCode()==200 ?json_decode($responseConfig->getBody(), true):[];
        return view('comic.chapter', ['typeComics'=>$typeComics['data']['items'],'data' => $data['data'],'config'=>$config['data'],'books'=>$books,'shareComponent'=>$shareComponent,'stories' => $stories,'categories'=>$categories,'types'=>$types]);
    }

    public function types(Request $request,$slug,$page)
    {
        $categories = DB::table('categories')->get();
        $share = new Share();
        $shareComponent = $share->page( $request->url(), 'Chia sẻ')
        ->facebook()
        ->twitter()
        ->reddit()
        ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->get();
        $stories = Story::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $books = Book::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $client = new Client();
        $responseConfig = $client->get('https://otruyenapi.com/v1/api/home');
        $response = $client->get('https://otruyenapi.com/v1/api/the-loai/'.$slug.'?page='.$page);
        $responseType = $client->get('https://otruyenapi.com/v1/api/the-loai');
        $data =$response->getStatusCode()==200 ?json_decode($response->getBody(), true):[];
        $typeComics =$responseType->getStatusCode()==200 ?json_decode($responseType->getBody(), true):[];
        // dd($data['data']['items']);
        $config =$responseConfig->getStatusCode()==200 ?json_decode($responseConfig->getBody(), true):[];
        return view('comic.type', ['page'=>$page,'slug'=>$slug,'typeComics'=>$typeComics['data']['items'],'data' => $data['data'],'config'=>$config['data'],'books'=>$books,'shareComponent'=>$shareComponent,'stories' => $stories,'categories'=>$categories,'types'=>$types]);
    }
    public function search(Request $request)
    {
        $currentUrl = $request->url();
        $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
        $page = isset($_GET['page'])?$_GET['page']:1;

        $token= isset($_GET['_token'])?$_GET['_token']:'';
        if(!$keyword){
            return redirect("/danh-sach/truyen-tranh");
        }
        $categories = DB::table('categories')->get();
        $share = new Share();
        $shareComponent = $share->page($currentUrl, 'Chia sẻ')
        ->facebook()
        ->twitter()
        ->reddit()
        ->whatsapp()->telegram()->linkedin();
        $types = DB::table('types')->get();
        $stories = Story::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $books = Book::orderBy('id', 'DESC')->where('status',"active")->take(12)->get();
        $client = new Client();
        $responseConfig = $client->get('https://otruyenapi.com/v1/api/home');
        $response = $client->get('https://otruyenapi.com/v1/api/tim-kiem?keyword=/'.$keyword.'&page='.$page);
        $responseType = $client->get('https://otruyenapi.com/v1/api/the-loai');
        $data =$response->getStatusCode()==200 ?json_decode($response->getBody(), true):[];
        $typeComics =$responseType->getStatusCode()==200 ?json_decode($responseType->getBody(), true):[];
        // dd($data['data']['items']);
        $config =$responseConfig->getStatusCode()==200 ?json_decode($responseConfig->getBody(), true):[];
        return view('comic.search', ['token'=>$token,'page'=>$page,'keyword'=>$keyword,'typeComics'=>$typeComics['data']['items'],'data' => $data['data'],'config'=>$config['data'],'books'=>$books,'shareComponent'=>$shareComponent,'stories' => $stories,'categories'=>$categories,'types'=>$types]);
    }

}
