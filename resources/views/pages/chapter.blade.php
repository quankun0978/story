@extends('welcome')
@section('content')


<div class="d-flex flex-column gap-2">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="{{url('quan-ly-danh-muc/xem-quan-ly-danh-muc/'.$chapterBySlug[0]->story->category->slug)}}">{{$chapterBySlug[0]->story->category->name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$chapterBySlug[0]->story->name}}</li>
    </ol>
  </nav>
  <div class="row">
    <h5>{{$chapterBySlug[0]->story->name}}</h5>
    <p>Chương hiện tại {{$chapterBySlug[0]->title}}</p>
    <div class="d-flex gap-2">
      <a href="{{url('doc-truyen/'.$prev_chapter)}}" class="btn btn-outline-primary 
  @if ($min_id->id==$chapterBySlug[0]->id) disabled @endif">
        Tập trước
      </a>
      <a ar href="{{url('doc-truyen/'.$next_chapter)}}" class="btn btn-outline-primary 
      @if ($max_id->id==$chapterBySlug[0]->id) disabled @endif">Tập sau</a>
    </div>
  </div>
  <div class="col-md-12 ">
    <select required name="chapter" id="chapter" type="text" class="form-select">
      @foreach ($chapters as $chapter)
      <option @if ($chapter->slug==$chapterBySlug[0]->slug)
        selected
        @endif value="{{ url('doc-truyen/' . $chapter->slug) }}">{{ $chapter->title }}</option>
      @endforeach
    </select>
  </div>
  <hr>

  <div class="col-md-12 ">
    <p>{!! $chapterBySlug[0]->content !!}</p>

  </div>
  <div class="col-md-12 ">
    <h4>Sách cùng danh mục</h4>
    <div class="row mb-3">
      <div class="col-lg-3 col-md-12">
        <div class="card">
          <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone" />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the bulk
              of the card's content.
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-12">
        <div class="card">
          <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone" />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the bulk
              of the card's content.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-12">
        <div class="card">
          <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone" />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the bulk
              of the card's content.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-12">
        <div class="card">
          <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone" />
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
              Some quick example text to build on the card title and make up the bulk
              of the card's content.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#chapter').on('change', function() {
        window.location.href = $(this).val();
      });
    });
  </script>

</div>

@endsection