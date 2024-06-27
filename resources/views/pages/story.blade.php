@extends('welcome')
@section('content')

<div class="d-flex flex-column gap-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="{{url('quan-ly-danh-muc/xem-quan-ly-danh-muc/'.$storyBySlug[0]->category->slug)}}">{{$storyBySlug[0]->category->name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$storyBySlug[0]->name}}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-3">
          @if(count($storyBySlug) > 0)
          <img class="story_img" height="200" style="width: 150px;" src="{{asset('uploads/story/'.$storyBySlug[0]->image)}}" alt="">
        </div>
        <div class="col-md-9">
          <ul class="list-unstyled">
            <li>Tên truyện :{{$storyBySlug[0]->name}}</li>
            <li>Tác giả :{{$storyBySlug[0]->author}}</li>
            <li class="d-flex gap-1 align-items-center">Thể loại :
              @if (count($storyBySlug[0]->typeStory )==0)
              chưa rõ
              @else
              @foreach ($storyBySlug[0]->typeStory as $type )
              <div style="color: #fff; border-radius: 2px; padding: 0 2px; height:  20px; font-size: 8px; display: flex ; align-items: center; justify-content: center;" class="bg-success">
                {{$type->type->name}}
              </div>
              @endforeach
              @endif
            </li>
            <li>Danh mục :{{$storyBySlug[0]->category->name}}</li>
            <li>Ngày đăng : @if ($storyBySlug[0] ->created_at!=null)
              {{ $storyBySlug[0]  ->created_at->diffForHumans()}}
              @else chưa rõ
              @endif
            </li>
            <li>Số chapter :200</li>
            <li>Số lượt đọc :2000</li>
            <li><a href="">Xem mục lục</a></li>
            <div class="@if (count($storyBySlug[0]->chapter) > 0) d-flex @endif gap-2">
              @if (count($storyBySlug[0]->chapter)>0)
              <li><a href="{{route('doc-truyen',$storyBySlug[0]->chapter[0]->slug)}}" class="btn btn-primary">Đọc ngay</a></li>
              @else <p class="m-0">Hiện đang cập nhật...</p>
              @endif
              <li class="btn btn-danger btn_favourite">
                <i class="fa-solid fa-heart"></i>
                Yêu thích
              </li>
            </div>
          </ul>
        </div>
      </div>
      @endif
    </div>
    <div class="col-md-3">

      <h5>Truyện yêu thích</h5>
      <div class="wild_list">
      </div>
      <div class="d-flex justify-content-end">
        <a href="{{route('yeu-thich')}}" class="float-left">Xem tất cả</a>
      </div>

    </div>

  </div>
  <hr>
  <div class="col-md-12 ">
    <h4>Tóm tắt nội dung</h4>
    <p class="">
      {!! $storyBySlug[0]->description !!}
    </p>
  </div>
  <div>
    <p>Từ khóa tìm kiếm :</p>
    <?php
      $keys = explode(',', $storyBySlug[0]->key_word);
    ?>
    @if (count($keys)==1)
    <p>
      Hiện chưa có...
    </p>
    @else
    <div class="tagcloud05">
      <ul>

        @foreach ($keys as $key)
        <li><a href="{{route('tags-truyen-doc', ['key' =>  $key])}}"><span>{{$key}}</span></a></li> @endforeach
      </ul>
    </div>
    @endif
  </div>

  <div class="col-md-12 ">
    <h4>Mục lục</h4>
    @if(count($storyBySlug[0]->chapter) > 0)
    <ul>
      @foreach ($storyBySlug[0]->chapter as $chapter)
      <li><a href="{{route('doc-truyen',$chapter->slug)}}">{{$chapter->title}}</a></li>

      @endforeach

    </ul>
    @else <p>Hiện đang cập nhật...</p>
    @endif
  </div>
  <div>
    <input class="story_id" hidden type="text" value="{{$storyBySlug[0]->id}}" name="id" id="">
    <input class="story_name" hidden type="text" value="{{$storyBySlug[0]->name}}" name="name" id="">
    <input class="story_slug" hidden type="text" value="{{$storyBySlug[0]->slug}}" name="slug" id="">

  </div>
  <div class="row">
    @foreach ($stories as $story )
    <div class="col-lg-2 col-md-2 col-6 position-relative ">

      <div class="text-center mb-2 ">
        <img height="200" src="{{ asset('uploads/story/'.$story->image) }}" class="card-img-top" alt="Fissure in Sandstone" />
        <p class="card-title mt-1">
          <a href="{{ route('truyen-doc',  $story->slug) }}">{{$story->name}} </a>
        </p>
      </div>
    </div>

    @endforeach
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      const id = $('.story_id').val();
      const wild_list = $('.wild_list');
      const name = $('.story_name').val();
      const slug = $('.story_slug').val();
      const img = $('.story_img').attr('src');
      const storyFavourite = JSON.parse(localStorage.getItem("favourite")) ? JSON.parse(localStorage.getItem("favourite")) : [];
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

      // Thêm HTML vào element
      wild_list.html(html);
      if (strory) {
        iconHeart.addClass('favourite_story');
      }

      $('.btn_favourite').on('click', function() {
        let wildlist = JSON.parse(localStorage.getItem("favourite")) || [];
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
          localStorage.setItem("favourite", JSON.stringify(wildlist));
        } else {
          wildlist = wildlist.filter(item => item.id !== id);
          if (wildlist.length) {
            localStorage.setItem("favourite", JSON.stringify(wildlist));
          } else {
            localStorage.removeItem("favourite");
          }
        }
      });
    });
  </script>
</div>
@endsection