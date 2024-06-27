@extends('../comic/index')
@section("list")
<?php
    $page = 1;
    $totalComic = $config['params']['pagination']['totalItems'] ?? 1;
    $totalItemsPerPage = $config['params']['pagination']['totalItemsPerPage'] ?? 0;
    $totalPage = $totalItemsPerPage > 0 ? (int) ceil($totalComic / $totalItemsPerPage) : 1;
    $pages = range(1, $totalPage);
?>
@foreach ($config['items'] as $key => $item)
<div class="row mb-2">
    <div class="col-md-2">
        <img height="100" style="width: 90px;" src="https://img.otruyenapi.com/{{ $config['seoOnPage']['og_image'][$key] }}" alt="">
    </div>
    <div class="col-md-10 ">
        <ul class="list-unstyled d-flex flex-column gap-1">
            <li>
                <a href="{{url('truyen-tranh/'.$item['slug'] )}}">{{ $item['name'] }}</a>
            </li>
            <li>
                @foreach ($item['origin_name'] as $origin_name)
                {{ $origin_name }}
                @endforeach
            </li>
            <li class="d-flex flex-wrap gap-1 align-items-center">Thể loại:
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
                <?php
                $chapterComics = $item['chaptersLatest'] ? $item['chaptersLatest'] : []
                ?>
                @if (count($chapterComics) == 0)
                không có
                @else
                @foreach ($chapterComics as $chapter)
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
<div class="d-flex justify-content-between my-3">
    <div class="d-flex align-items-center" style="flex: 1;">
        <span>Trang {{ strval($page) }} / {{ strval($totalPage) }} | Tổng {{ strval($totalComic) }} Kết quả</span>
    </div>
    <select required name="page" id="page" type="text" class="form-select w-auto">
        @foreach ($pages as $number)
        <option @if ($page==$number) selected @endif value="{{url('/danh-sach/truyen-tranh/'.$config['type_list'].'/'.$number)}}">Trang {{ $number }}</option>
        @endforeach
    </select>

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