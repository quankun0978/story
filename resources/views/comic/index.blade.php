@extends('../welcome')
@section("content")
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <div class="row">
            <div class="col-md-3">

                <div class="card ">
                    <div class="card-header">
                        Thống kê
                    </div>
                    <div class="card-body">
                        <p>Cập nhật hôm nay : {{ $config['params']['itemsUpdateInDay'] }}</p>
                        <p>Tổng số truyện : @if (isset($config['params']['pagination']['totalItems']))
                            {{ $config['params']['pagination']['totalItems'] }}
                            @else
                            N/A
                            @endif
                        </p>

                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        Danh sách
                    </div>
                    <div class="card-body">
                        <li><a href="{{url('/danh-sach/truyen-tranh/truyen-moi/1')}}">Truyện mới</a></li>
                        <li><a href="{{url('/danh-sach/truyen-tranh/dang-phat-hanh/1')}}">Đang phát hành</a></li>
                        <li><a href="{{url('/danh-sach/truyen-tranh/hoan-thanh/1')}}">Hoàn thành</a></li>
                        <li><a href="{{url('/danh-sach/truyen-tranh/sap-ra-mat/1')}}">Sắp ra mắt</a></li>

                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">Thể loại</div>
                    <div class="card-body">
                        @if (count($typeComics)==0)
                        Hiện dang cập nhật
                        @else
                        @foreach ($typeComics as $typeComic)
                        <li><a href="{{url('truyen-tranh/the-loai/'.$typeComic['slug'].'/1')}}">{{$typeComic['name']}}</a></li>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-9">
                <form action="{{url('/truyen-tranh/tim-kiem')}}" class="d-flex gap-2 mb-2 mt-2 mt-md-0" role="search" method="get">
                    @csrf
                    <div class="flex flex-column " style="flex: 1;">
                        <input autocomplete="false" id="keyword" name="keyword" class="form-control " type="search" placeholder="Tìm kiếm " aria-label="Search">
                        <div style="margin-top: 5px; margin-bottom: -5px;" id="data-search">
                        </div>
                    </div>
                    <button class="btn btn-outline-success" style="width: 120px;" type="submit">Tìm kiếm</button>
                </form>
                @yield("list")
            </div>

        </div>
</body>

</html>
@endsection