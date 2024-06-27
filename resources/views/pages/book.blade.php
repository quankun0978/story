@extends('welcome')
@section('content')

<div class="d-flex flex-column gap-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$bookBySlug[0]->name}}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-3">
          @if(count($bookBySlug) > 0)
          <img class="book_img" height="200" style="width: 150px;" src="{{asset('uploads/books/'.$bookBySlug[0]->image)}}" alt="">
        </div>
        <div class="col-md-9">
          <ul class="list-unstyled">
            <li>Tên sách :{{$bookBySlug[0]->name}}</li>
            <li>Tác giả :{{$bookBySlug[0]->author}}</li>

            <li>Ngày đăng : @if ($bookBySlug[0] ->created_at!=null)
              {{ $bookBySlug[0]  ->created_at->diffForHumans()}}
              @else chưa rõ
              @endif
            </li>
            <li>Số quan-ly-chapter :200</li>
            <li>Số lượt đọc :2000</li>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Xem nhanh
            </button>
            <a class="btn btn-warning" href="{{$bookBySlug[0]->link_pdf}}">Tải ngay</a>
            <li class="btn btn-danger btn_favourite">
              <i class="fa-solid fa-heart"></i>
              Yêu thích
            </li>
        </div>
        </ul>
      </div>
    </div>
    @endif
    <div class="col-md-3">

      <h5>Sách yêu thích</h5>
      <div class="wild_list">
      </div>
      <div class="d-flex justify-content-end">
        <a href="{{route('yeu-thich')}}" class="float-left">Xem tất cả</a>
      </div>
    </div>
  </div>
</div>
<hr>
<div class="col-md-12 ">
  <h4>Tóm tắt nội dung</h4>
  <p class="">
    {!! $bookBySlug[0]->description !!}
  </p>
</div>
<div>
  <p>Từ khóa tìm kiếm :</p>
  <?php
    $keys = explode(',', $bookBySlug[0]->key_word);
  ?>
  @if (count($keys)==1)
  <p>
    Hiện chưa có...
  </p>
  @else
  <div class="tagcloud05">
    <ul>

      @foreach ($keys as $key)
      <li><a href="{{route('tags-sach', ['key' =>  $key])}}"><span>{{$key}}</span></a></li> @endforeach
    </ul>
  </div>
  @endif
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Đọc sách</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! html_entity_decode($bookBySlug[0]->content ) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>

  <div>
    <input class="book_id" hidden type="text" value="{{$bookBySlug[0]->id}}" name="id" id="">
    <input class="book_name" hidden type="text" value="{{$bookBySlug[0]->name}}" name="name" id="">
    <input class="book_slug" hidden type="text" value="{{$bookBySlug[0]->slug}}" name="slug" id="">
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      const id = $('.book_id').val();
      const wild_list = $('.wild_list');
      const name = $('.book_name').val();
      const slug = $('.book_slug').val();
      const img = $('.book_img').attr('src');
      const storyFavourite = JSON.parse(localStorage.getItem("favourite_book")) ? JSON.parse(localStorage.getItem("favourite_book")) : [];
      const dataFavourite = storyFavourite.slice(storyFavourite.length - 2);
      const strory = storyFavourite.length > 0 && storyFavourite.find(item => item.id === id);
      const iconHeart = $('.fa-heart');

      let html = '';
      if (storyFavourite.length === 0) {
        html = '<p>Hiện chưa có...</p>';
      } else {
        html = '<div >';
        dataFavourite.forEach(function(story) {
          html += '<div class="d-flex gap-2 mb-2">';
          html += '<img style="width: 80px; height: 100px;" src="' + story.img + '" alt="">';
          html += '<a href="' + story.slug + '">' + story.name + '</a>';
          html += '</div>';
        });
        html += '</div>';
      }
      wild_list.html(html);
      if (strory) {
        iconHeart.addClass('favourite_story');
      }

      $('.btn_favourite').on('click', function() {
        let wildlist = JSON.parse(localStorage.getItem("favourite_book")) || [];
        const stroryById = wildlist.find(item => item.id === id);
        const data = {
          name,
          id,
          slug,
          img
        };

        iconHeart.toggleClass('favourite_story');
        if (data && !stroryById) {
          wildlist = [...wildlist, data];
          localStorage.setItem("favourite_book", JSON.stringify(wildlist));
        } else {
          wildlist = wildlist.filter(item => item.id !== id);
          if (wildlist.length) {
            localStorage.setItem("favourite_book", JSON.stringify(wildlist));
          } else {
            localStorage.removeItem("favourite_book");
          }
        }
      });
    });
  </script>
</div>
@endsection