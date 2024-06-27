@extends('../welcome')
@section('content')

<div>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page">từ khóa</li>
    </ol>
  </nav>
  <div class="my-3">
    <div class="row mb-3">
      @if (count($stories)==0)
      <p>Không tìm thấy...</p>
      @else
      <p>Bạn đang tìm kiếm từ khóa {{$key}}</p>
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
      @endif
    </div>
  </div>
  @endsection