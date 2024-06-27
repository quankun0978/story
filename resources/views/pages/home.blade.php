@extends('../welcome')
@section('content')

<div>
  <div class="my-3">
    <h4 class="mb-3">TRUYỆN HAY NÊN ĐỌC</h4>
    <div class="owl-carousel owl-theme">
      @foreach ( $stories as $story )
      <a href="{{ route('truyen-doc',  $story->slug) }}" class="item"><img height="192" src="{{ asset('uploads/story/'.$story->image) }}" alt=""></a>
      @endforeach

    </div>

    <div class="my-3 ">
      <h4 class="mb-3">TRUYỆN ĐỌC HAY MỚI CẬP NHẬT</h4>

      <div class="row mb-3">
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

    </div>
    <div class="my-3">
      <h4 class="mb-3">SÁCH HAY MỚI CẬP NHẬT</h4>
      <div class="row mb-3">
        @foreach ($books as $book )
        <div class="col-lg-2 col-md-2 col-6 position-relative ">

          <div class="text-center mb-2 ">
            <img height="200" src="{{ asset('uploads/books/'.$book->image) }}" class="card-img-top" alt="Fissure in Sandstone" />
            <p class="card-title mt-1">
              <a href="{{ route('doc-sach',  $book->slug) }}">{{$book->name}} </a>
            </p>
          </div>
        </div>
        @endforeach
      </div>

    </div>

  </div>
  @endsection