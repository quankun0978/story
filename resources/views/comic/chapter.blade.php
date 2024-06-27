@extends('../comic/index')
@section("content")
<?php
$detailComic = $data['item'];
$chapters = $detailComic['chapters'][0]['server_data'] ? $detailComic['chapters'][0]['server_data'] : [];
?>
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
                <div class="card">
                    <div class="card-header">
                        Các chapter
                    </div>
                    <div class="card-body">
                        @if (count($chapters)==0)
                        Hiện chưa cập nhật
                        @else
                        <select name="chapter" id="chapter" type="text" class="form-select">
                            <option value="init">Vui lòng chọn</option>
                            @foreach ($chapters as $chapter)
                            <option value="{{ $chapter['chapter_api_data']}}">Chapter {{ $chapter['chapter_name'] }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-9 " style=" height: 80vh; overflow: auto;" id="content_chapter">
            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                let debounceTimeout;
                $('#content_chapter').html(`<div class="card"><div class="card-body">Vui lòng chọn chapter</div> </div>`);
                $('#chapter').change(function() {
                    clearTimeout(debounceTimeout);

                    let key = $(this).val();
                    if (key !== '' && key !== 'init') {
                        debounceTimeout = setTimeout(() => {
                            $.ajax({
                                url: `${key}`,
                                method: 'get',
                                success: function(data) {
                                    const domain = data.data.domain_cdn
                                    const chapter_path = data.data.item.chapter_path
                                    const chapters = data && data.data && data.data.item && data.data.item.chapter_image;
                                    let imagesHtml = chapters.map((item) => {
                                        return `<img src="${domain+"/"+chapter_path+"/"+item.image_file}" alt="Chapter Image" />`;
                                    }).join('');

                                    $('#content_chapter').html(
                                        `<div>
                                    ${imagesHtml}
                                    <div/>`
                                    );
                                    $('#content_chapter').scrollTop(0);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error fetching data:', textStatus, errorThrown);
                                }
                            });
                        }, 0); // Chỉ gửi yêu cầu sau 300ms kể từ lần nhập cuối
                    } else {
                        $('#content_chapter').html(`<div class="card"><div class="card-body">Vui lòng chọn chapter</div> </div>`);
                    }
                });
            });
        </script>
    </div>
</body>

</html>

@endsection