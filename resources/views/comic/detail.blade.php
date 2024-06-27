@extends('../comic/index')
@section('content')

<div class="d-flex flex-column gap-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <?php
        $slug = $data['params']['slug'];
        $seoOnPage = $data['seoOnPage'];
        $detailComic = $data['item'];
        $chapters = isset($detailComic['chapters'][0]['server_data']) ? $detailComic['chapters'][0]['server_data'] : [];
        $authors = $detailComic['author'] ? $detailComic['author'] : [];
        $commicTypes = $detailComic['category'] ? $detailComic['category'] : []
      ?>
      @if (count($commicTypes)>0)
      @foreach ($commicTypes as $type)
      <li class="breadcrumb-item"><a href="{{url('truyen-tranh/the-loai/'.$type['slug'].'/1')}}">{{$type['name']}}</a></li>
      @endforeach
      @endif
      <li class="breadcrumb-item active" aria-current="page">{{$detailComic['name']}}</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-9">
      <div class="row">
        <div class="col-md-3">
          @if(count($detailComic) > 0)
          <img style="width: 150px;" height="200" src="{{$seoOnPage['seoSchema']['image']}}" alt="">
        </div>
        <div class="col-md-9">
          <ul class="list-unstyled">
            <li>Tên truyện :{{$detailComic['name']}}</li>
            <li>Tác giả :@if (count($authors )==0)
              chưa rõ
              @else
              @foreach ($authors as $author )
              {{$author}}
              @endforeach
              @endif
            </li>
            <li class="d-flex gap-1 align-items-center">Thể loại :
              @if (count($commicTypes )==0)
              chưa rõ
              @else
              @foreach ($commicTypes as $type )
              <div style="color: #fff; border-radius: 2px; padding: 0 2px; height:  20px; font-size: 8px; display: flex ; align-items: center; justify-content: center;" class="bg-success">
                {{$type['name']}}
              </div>
              @endforeach
              @endif
            </li>

            <li>Số chapter :200</li>
            <li>Số lượt đọc :2000</li>
            <li><a href="">Xem mục lục</a></li>
            <div class="@if (count($chapters) > 0) d-flex @endif gap-2">
              @if (count($chapters)>0)
              <li><a href="{{url('truyen-tranh/doc-truyen/'.$slug)}}" class="btn btn-primary">Đọc ngay</a></li>
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
      {!!$detailComic['content']!!}
    </p>
  </div>

</div>

<div class="col-md-12 ">
  <h4>Mục lục</h4>
  @if(count($chapters) > 0)
  <ul>
    @foreach ($chapters as $chapter)
    <li><a href="{{url('truyen-tranh/doc-truyen/'.$slug)}}">Chapter {{$chapter['chapter_name']}}</a></li>

    @endforeach

  </ul>
  @else <p>Hiện đang cập nhật...</p>
  @endif
</div>

<div>
  <input class="comic_id" hidden type="text" value="{{$detailComic['_id']}}" name="id" id="">
  <input class="comic_name" hidden type="text" value="{{$detailComic['name']}}" name="name" id="">
  <input class="comic_slug" hidden type="text" value="{{$detailComic['slug']}}" name="slug" id="">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    const id = $('.comic_id').val();
    const wild_list = $('.wild_list');
    const name = $('.comic_name').val();
    const slug = $('.comic_slug').val();
    const img = $('.comic_img').attr('src');
    const storyFavourite = JSON.parse(localStorage.getItem("favourite_comic")) ? JSON.parse(localStorage.getItem("favourite_comic")) : [];
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
      let wildlist = JSON.parse(localStorage.getItem("favourite_comic")) || [];
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
        localStorage.setItem("favourite_comic", JSON.stringify(wildlist));
      } else {
        wildlist = wildlist.filter(item => item.id !== id);
        if (wildlist.length) {
          localStorage.setItem("favourite_comic", JSON.stringify(wildlist));
        } else {
          localStorage.removeItem("favourite_comic");
        }
      }
    });
  });
</script>
</div>
@endsection