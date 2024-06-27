@extends('../welcome')
@section('content')
<?php
  $totalPage = count($books) > 24 ? (int) ceil(count($books) / 24) : 1;
  $pages = range(1, $totalPage);
?>
@if ($page<=0||$page>$totalPage)
  <p>Mục này không tồn tại !!!</p>
  @else
  <div class="">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sách</li>
      </ol>
    </nav>
    <div class="my-3">
      <h4 class="mb-3 " style="text-transform: uppercase;">Sách</h4>
      @if (count($books)==0)
      <p>Hiện đang cập nhật</p>
      @else
      <div class="owl-carousel owl-theme">
        @foreach ($books as $book )
        <div class="item">
          <a href="{{ route('doc-sach',  $book->slug) }}">
            <img style="width: 129px;" height="192" src="{{ asset('uploads/books/'.$book->image) }}" alt="">
          </a>
        </div>

        @endforeach

      </div>
      @endif
      <div class="my-3">
        <h4 class="mb-3 " style="text-transform: uppercase;">Sách</h4>
        <div class="row mb-3">
          @if (count($booksByPage)==0)
          <p>Hiện đang cập nhật...</p>
          @else
          @foreach ($booksByPage as $book )
          <div class="col-lg-2 col-md-2 col-6 position-relative ">

            <div class="text-center mb-2 ">
              <img height="200" src="{{ asset('uploads/books/'.$book->image) }}" class="card-img-top" alt="Fissure in Sandstone" />
              <p class="card-title mt-1">
                <a href="{{ route('doc-sach',  $book->slug) }}">{{$book-> name}} </a>
              </p>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
      <div class="d-flex justify-content-between my-3">
        <div class="d-flex align-items-center" style="flex: 1;">
          <span>Trang {{ strval($page) }} / {{ strval($totalPage) }} | Tổng {{ strval(count($books)) }} Kết quả</span>
        </div>
        <select required name="page" id="page" type="text" class="form-select w-auto">
          @foreach ($pages as $number)
          <option @if ($page==$number) selected @endif value="{{route('sach',$number)}}">Trang {{ $number }}</option>
          @endforeach
        </select>
      </div>
    </div>

  </div>
  @endif

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#page').on('change', function() {
        window.location.href = $(this).val();
      });
    });
  </script>
  @endsection