@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm mới truyện</div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form enctype="multipart/form-data" class="row g-3 needs-validation" method="post" action="{{route('quan-ly-truyen.store')}}">
                        @csrf
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Tên truyện</label>
                            <input onkeyup="ChangeToSlug()" value="{{old('name')}}" name="name" type="text" class="form-control" id="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="convert_slug" class="form-label">Tên slug</label>
                            <input value="{{old('slug')}}" name="slug" type="text" class="form-control" id="convert_slug">
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Tên tác giả</label>
                            <input value="{{old('author')}}" name="author" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Danh mục truyện</label>
                            <select required name="category_id" id="category_id" type="text" class="form-select">
                                @foreach ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Từ khóa tìm kiếm</label>
                            <input placeholder="eg : siêu nhân,cổ tích" value="{{old('key_word')}}" name="key_word" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Kích hoạt</label>
                            <select value="{{old('status')}}" name="status" class="form-select" id="status">
                                <option selected value="active">Kích hoạt</option>
                                <option value="inactive">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="type_id" class="form-label">Thể loại truyện</label>
                            <div class="row">
                                @foreach ($types as $type )
                                <div class="col-md-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" name="type_id[]" type="checkbox" value="{{$type->id}}" id="{{$type->id}}" />
                                        <label class="form-check-label" for="flexCheckDefault">{{$type->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <label for="image" class="form-label">Hình ảnh truyện</label>
                            <input type="file" id="image" name="image" class="form-control-file d-block" aria-label="file example" required>
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Tóm tắt truyện</label>
                            <textarea class="form-control" name="description" id="description" rows="5" style="resize: none;"></textarea>
                        </div>

                        <div class="col-12">
                            <button name="btn_add" class="btn btn-primary" type="submit">Thêm mới</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection