@extends('../comic/index')

@section("list")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        $totalComic = $data['params']['pagination']['totalItems'] ?? 1;
        $totalItemsPerPage = $data['params']['pagination']['totalItemsPerPage'] ?? 0;
        $totalPage = $totalItemsPerPage > 0 ? (int) ceil($totalComic / $totalItemsPerPage) : 1;
        $pages = range(1, $totalPage);
    ?>

    @if (count($data['items']) == 0)
    <p>Hiện đang cập nhật</p>
    @else
    @foreach ($data['items'] as $key => $item)
    <div class="row mb-2">
        <div class="col-md-2">
            <img height="100" style="width: 90px;" src="https://img.otruyenapi.com/{{ $data['seoOnPage']['og_image'][$key] }}" alt="">
        </div>
        <div class="col-md-10">
            <ul class="list-unstyled">
                <li>
                    <a href="{{ url('truyen-tranh/'.$item['slug']) }}">{{ $item['name'] }}</a>
                </li>
                <li>
                    @foreach ($item['origin_name'] as $origin_name)
                    {{ $origin_name }}
                    @endforeach
                </li>
                <li class="d-flex gap-1 flex-wrap align-items-center">Thể loại:
                    @if (count($item['category']) == 0)
                    chưa rõ
                    @else
                    @foreach ($item['category'] as $type)
                    <div style="color: #fff; border-radius: 2px; padding: 0 2px; height: 20px; font-size: 8px; display: flex; align-items: center; justify-content: center;" class="bg-success">
                        {{ $type['name'] }}
                    </div>
                    @endforeach
                    @endif
                </li>
                <li class="d-flex gap-1 align-items-center">Chapter mới nhất:
                    @if (count($item['chaptersLatest'] ?? []) == 0)
                    không có
                    @else
                    @foreach ($item['chaptersLatest'] as $chapter)
                    <a href="#">
                        {{ $chapter['filename'] }}
                    </a>
                    @endforeach
                    @endif
                </li>
            </ul>
        </div>
    </div>
    @endforeach

    <div class="d-flex justify-content-end my-3">
        <div class="d-flex align-items-center" style="flex: 1;">
            <span>Trang {{ strval($page) }} / {{ strval($totalPage) }} | Tổng {{ strval($totalComic) }} Kết quả</span>
        </div>
        <select required name="page" id="page" type="text" class="form-select w-auto">
            @foreach ($pages as $number)
            <option @if ($page==$number) selected @endif value="{{  url('/danh-sach/truyen-tranh/'.$slug.'/'.$number)}}">Trang {{ $number }}</option>
            @endforeach
        </select>

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
</body>

</html>
@endsection