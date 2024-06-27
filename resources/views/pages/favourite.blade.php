@extends('../welcome')
@section('content')

<div>
    <div class="my-3">
        <h4 class="mb-3">TRUYỆN ĐỌC YÊU THÍCH</h4>
        <div class="row mb-3 list_story"></div>
    </div>
    
    <div class="my-3">
        <h4 class="mb-3">SÁCH YÊU THÍCH</h4>
        <div class="row mb-3 list_book"></div>
    </div>
    
    <div class="my-3">
        <h4 class="mb-3">TRUYỆN TRANH YÊU THÍCH</h4>
        <div class="row mb-3 list_comic"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const storyFavourite = JSON.parse(localStorage.getItem("favourite")) || [];
        const comicFavourite = JSON.parse(localStorage.getItem("favourite_comic")) || [];
        const bookFavourite = JSON.parse(localStorage.getItem("favourite_book")) || [];
        
        updateView('.list_story', storyFavourite, '/truyen-doc/');
        updateView('.list_book', bookFavourite, '/sach/');
        updateView('.list_comic', comicFavourite, '/truyen-tranh/');
    });

    function updateView(classView, data, path) {
        let html = '';
        if (data.length === 0) {
            html = '<p>Hiện chưa có...</p>';
        } else {
            data.forEach(function(story) {
                html += '<div class="col-lg-2 col-md-2 col-6 position-relative">';
                html += '<img class="card-img-top" height="200" src="' + story.img + '" alt="">';
                html += '<p class="mt-1"><a href="' + path + story.slug + '">' + story.name + '</a></p>';
                html += '</div>';
            });
        }
        $(classView).html(html);
    }
</script>

@endsection
