@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cập nhật truyện</div>
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

                    <form enctype="multipart/form-data" class="row g-3 needs-validation" method="post" action="{{route('quan-ly-truyen.update',$story->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Tên truyện</label>
                            <input onkeyup="ChangeToSlug()" value="{{$story->name}}" name="name" type="text" class="form-control" id="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="convert_slug" class="form-label">Tên slug</label>
                            <input value="{{$story->slug}}" name="slug" type="text" class="form-control" id="convert_slug">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tên tác giả</label>
                            <input value="{{$story->author}}" name="author" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Danh mục truyện</label>
                            <select name="category_id" id="category_id" type="text" class="form-select">
                                @foreach ($categories as $categoryItem )
                                <option @if ($story->category_id == $categoryItem->id) selected @endif value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Từ khóa tìm kiếm</label>
                            <input placeholder="eg : siêu nhân,cổ tích" value="{{$story->key_word}}" name="key_word" type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select" id="status">
                                <option @if ($story->status == 'active') selected @endif value="active">Kích hoạt</option>
                                <option @if ($story->status == 'inactive') selected @endif value="inactive">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="type_id" class="form-label">Thể loại sách truyện</label>
                            <div class="row">
                                <?php
                                $typeIds = array_map(function ($item) {
                                    return "{$item['type_id']}";
                                }, $story->typeStory->toArray());

                                ?>

                                @foreach ($types as $type )
                                <div class="col-md-3">
                                    <div class="form-check ">
                                        <input @if (in_array($type->id, $typeIds))
                                        checked
                                        @endif class="form-check-input" name="type_id[]" type="checkbox" value="{{$type->id}}" id="{{$type->id}}" />
                                        <label class="form-check-label" for="flexCheckDefault">{{$type->name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <label for="image" class="form-label">Hình ảnh sách truyện</label>
                            <input type="file" id="image" name="image" class="form-control-file d-block" aria-label="file example">
                            <br>
                            <img width="100px" height="100px" src="{{ asset('uploads/story/'.$story->image) }}" alt="">
                        </div>
                        <div class="col-md-12">
                            <label for="description" class="form-label">Tóm tắt sách truyện</label>
                            <textarea value="" class="form-control" name="description" id="content" rows="5" style="resize: none;">{{$story->description}}</textarea>

                        </div>

                        <div class="col-12">
                            <a name="" href="{{url('quan-ly-truyen')}}" class="btn btn-outline-primary">Quay lại</a>
                            <button name="btn_add" class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection