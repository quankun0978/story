@extends('../welcome')
@section('content')
<?php
    $comics = $data['items'] ? $data['items'] : [];
    $domain = $data['APP_DOMAIN_CDN_IMAGE'];
    $images = $data['seoOnPage']['og_image'] ? $data['seoOnPage']['og_image'] : [];
    $totalComic = $data['params']['pagination']['totalItems'] ?? 1;
    $totalItemsPerPage = $data['params']['pagination']['totalItemsPerPage'] ?? 0;
    $totalPage = $totalItemsPerPage > 0 ? (int) ceil($totalComic / $totalItemsPerPage) : 1;
    $pages = range(1, $totalPage);
?>
<div class="">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{url('danh-sach/truyen-tranh')}}">Truyện tranh</a></li>
            <li class="breadcrumb-item active" aria-current="page">tìm kiếm</li>
        </ol>
    </nav>

    <div class="my-3">
        <div class="row mb-3">
            @if (count($comics)==0)
            <p>Không tìm thấy...</p>
            @else
            <p>Bạn đang tìm kiếm từ khóa {{$keyword}}</p>
            @foreach ($comics as $key => $comic)
            <div class="row mb-2">
                <div class="col-md-1">
                    <img style="width: 70px;" width="50" height="100" src="{{ url($domain.'/uploads/'.$images[$key])}}" alt="">
                </div>
                <div class="col-md-10 ">
                    <ul class="list-unstyled d-flex flex-column gap-1">
                        <li>
                            <a href="{{url('truyen-tranh/'.$comic['slug'] )}}">{{ $comic['name'] }}</a>
                        </li>
                        <li>
                            @foreach ($comic['origin_name'] as $origin_name)
                            {{ $origin_name }}
                            @endforeach
                        </li>

                    </ul>
                </div>

            </div>
            @endforeach
            @endif
        </div>
        <div class="d-flex justify-content-end my-3">
            <div class="d-flex align-items-center" style="flex: 1;">
                <span>Trang {{ strval($page) }} / {{ strval($totalPage) }} | Tổng {{ strval($totalComic) }} Kết quả</span>
            </div>
            <select required name="page" id="page" type="text" class="form-select w-auto">
                @foreach ($pages as $number)
                <option @if ($page==$number) selected @endif value="{{ url('truyen-tranh/tim-kiem?_token='.$token.'&keyword='.$keyword.'&page='.$number) }}">Trang {{ $number }}</option>
                @endforeach
            </select>

        </div>

    </div>
    <form hidden action="">
        <input autocomplete="false" value="{{$token}}" id="token" name="token" class="form-control " type="text" placeholder="Tìm kiếm " aria-label="Search">
        <input autocomplete="false" value="{{$key}}" id="key" name="key" class="form-control " type="text" placeholder="Tìm kiếm " aria-label="Search">
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let token = $('input[name="token"]').val();
            let key = $('input[name="key"]').val();
            $('#page').on('change', function() {
                window.location.href = $(this).val();
            });
        });
    </script>
    @endsection