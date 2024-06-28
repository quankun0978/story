@extends('../comic/index')
@section('content')
<?php
  $comics = $data['items'] ? $data['items'] : [];
  $totalComic = $data['params']['pagination']['totalItems'] ?? 1;
  $totalItemsPerPage = $data['params']['pagination']['totalItemsPerPage'] ?? 0;
  $totalPage = $totalItemsPerPage > 0 ? (int) ceil($totalComic / $totalItemsPerPage) : 1;
  $pages = range(1, $totalPage);
  $domain = $data['APP_DOMAIN_CDN_IMAGE'];
  $images = $data['seoOnPage']['og_image'] ? $data['seoOnPage']['og_image'] : [];
  $titleHead = $data['seoOnPage']['titleHead'];
?>
<div class="">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item " aria-current="page"><a href="{{url('danh-sach/truyen-tranh')}}">Truyện tranh</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$titleHead}}</li>
    </ol>
  </nav>
  <div class="my-3">
    <h4 class="mb-3 " style="text-transform: uppercase;">{{$titleHead}}</h4>
    <div class="owl-carousel owl-theme">
      @if (count($images)==0)
      <p>Hiện đang cập nhật...</p>
      @else
      @foreach ($images as $key => $image )
      <a href="{{url('truyen-tranh/'.$comics[$key]['slug'] )}}">
        <div class="item"><img height="192" src="{{url($domain.$image)}}" alt=""></div>
      </a>
      @endforeach
      @endif

    </div>

    <div class="my-3">
      <h4 class="mb-3 " style="text-transform: uppercase;">{{$titleHead}}</h4>
      <div class="row mb-3">
        @if (count($comics)==0)
        <p style="height: 50vh;">Hiện đang cập nhật...</p>
        @else
        @foreach ($comics as $key => $comic )
        <div class="col-lg-2 col-md-2 col-6 position-relative ">

          <div class="text-center mb-2 ">
            <img height="200" src="{{ url($domain.$images[$key])}}" class="card-img-top" alt="Fissure in Sandstone" />
            <p class="card-title mt-1">
              <a href="{{url('truyen-tranh/'.$comic['slug'] )}}">{{$comic['name']}} </a>
            </p>
          </div>
        </div>
        @endforeach
        @endif
      </div>

    </div>
    <div class="d-flex justify-content-between my-3">
      <div class="d-flex align-items-center" style="flex: 1;">
        <span>Trang {{ strval($page) }} / {{ strval($totalPage) }} | Tổng {{ strval($totalComic) }} Kết quả</span>
      </div>
      <select required name="page" id="page" type="text" class="form-select w-auto">
        @foreach ($pages as $number)
        <option @if ($page==$number) selected @endif value="{{url('truyen-tranh/the-loai/'.$slug.'/'.$number)}}">Trang {{ $number }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#page').on('change', function() {
        window.location.href = $(this).val();
      });
    });
  </script>
  @endsection