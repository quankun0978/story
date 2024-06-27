<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Truyện sách</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('font/css/all.min.css')}}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="position-relative">
    <div style="z-index: 99;" class="navbar navbar-expand-md navbar-light bg-white shadow-sm position-fixed top-0 end-0 start-0">
        <div class="container" style="max-width: 992px;">
            <a class="navbar-brand" href="{{url('/')}}">Sachtruyen.com</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Danh mục truyện
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('yeu-thich') }}">Yêu thích</a></li>
                            @foreach ($categories as $category)
                            <li><a class="dropdown-item" href="{{ route('danh-muc',['slug' => $category->slug, 'page' => 1]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Thể loại truyện
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($types as $type)
                            <li><a class="dropdown-item" href="{{ route('the-loai', ['slug' => $type->slug, 'page' => 1]) }}">{{ $type->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/danh-sach/truyen-tranh')}}">Truyện tranh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{url('/danh-sach/sach/1')}}">Sách</a>
                    </li>
                </ul>
                <form action="{{url('/tim-kiem')}}" class="d-flex gap-2" role="search" method="get">
                    @csrf
                    <div class="flex flex-column">
                        <input autocomplete="false" id="key" name="key" class="form-control" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <div style="margin-top: 5px; margin-bottom: -5px;" id="data-search"></div>
                    </div>
                    <button class="btn btn-outline-success" style="width: 120px;" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 992px;margin-top: 75px;">
        <div class="form-check form-switch">
            <input class="form-check-input switch_change_color" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Chế độ tối</label>
        </div>
        <div>
            {!!$shareComponent!!}
        </div>
        @yield('content')
    </div>

    <footer class="position-absolute start-0 end-0 text-mb-center text-lg-start text-white" style="background-color: #1c2331">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-3 bg-primary">
            <!-- Left -->
            <div class="container align-items-center  d-flex justify-content-between  flex-wrap" style="max-width: 992px;">
                <div class="mb-1 mb-md-0">
                    <h5 class="m-0">Sachtruyen.com</h5>
                </div>
                <!-- Right -->
                <div class="mb-1 mb-md-0">
                    <a href="" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="text-white me-4">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </section>
        <!-- Section: Links -->
        <section>
            <div class="container text-mb-center text-md-start mt-2" style="max-width: 992px;">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3  mb-2">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">Giới thiệu</h6>
                        <hr class="mb-2 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px">
                        <p class="m-0 mb-2">
                            Sachtruyen.com - Đọc truyện online, đọc truyện chữ, truyện hay. Website luôn cập nhật những bộ truyện mới thuộc các thể loại đặc sắc như truyện tiên hiệp, truyện kiếm hiệp, hay truyện ngôn tình một cách nhanh nhất. Hỗ trợ mọi thiết bị như di động và máy tính bảng.
                        </p>
                    </div>

                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-2">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Thể loại</h6>
                        <hr class="mb-2 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px">
                        @if (count($types)==0)
                        <p class="m-0 mb-2">Hiện đang cập nhật</p>
                        @else
                        <div class="row ">
                            @foreach ($types as $type)
                            <div class="col col-4">
                                <p class="m-0 mb-2"><a class="text-white" href="{{ route('the-loai', ['slug' => $type->slug, 'page' => 1]) }}">{{ $type->name }}</a></p>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-2">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Liên hệ</h6>
                        <hr class="mb-2 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px">
                        <p class="m-0 mb-2"><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                        <p class="m-0 mb-2"><i class="fas fa-envelope mr-3"></i> info@example.com</p>
                        <p class="m-0 mb-2"><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                        <p class="m-0 mb-2"><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center  p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2024 Create by:
            <a class="text-white" href="/">Sachtruyen.com</a>
        </div>
    </footer>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 7
                }
            }
        })
    </script>

    <script>
        $(document).ready(function() {
            let debounceTimeout;
            $('#key').keyup(function() {
                clearTimeout(debounceTimeout);
                let key = $(this).val();
                if (key !== '') {
                    debounceTimeout = setTimeout(() => {
                        let _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: `/search`,
                            method: 'post',
                            data: {
                                key,
                                _token
                            },
                            success: function(data) {
                                $('#data-search').fadeIn();
                                $('#data-search').html(data.html);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error('Error fetching data:', textStatus, errorThrown);
                            }
                        });
                    }, 0);
                } else {
                    $('#data-search').fadeOut();
                }
            });

            $(document).on('click', '.item-search', function() {
                $('#key').val($(this).text());
                $('#data-search').fadeOut();
            });
        });
    </script>

    <script type="text/javascript">
        const switch_change_color = document.querySelector('.switch_change_color');
        const theme = JSON.parse(localStorage.getItem("theme"));
        if (theme) {
            $("body").toggleClass(theme.class_body)
            $(".card").toggleClass(theme.class_card)
            $("li.breadcrumb-item").toggleClass(theme.class_breadcrumb)
            switch_change_color.checked = "true";
        }
        switch_change_color.addEventListener("change", (e) => {
            const classData = {
                class_body: "switch_color",
                class_card: "switch_color_card",
                class_breadcrumb: "switch_color_breadcrumb"
            }
            $("body").toggleClass(classData.class_body)
            $(".card").toggleClass(classData.class_card)
            $("li.breadcrumb-item").toggleClass(classData.class_breadcrumb)
            if (JSON.parse(localStorage.getItem("theme"))) {
                localStorage.removeItem("theme");
            } else {
                localStorage.setItem("theme", JSON.stringify(classData));
            }
        })
    </script>
</body>

</html>