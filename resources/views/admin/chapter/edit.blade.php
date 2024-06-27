@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cập nhật Chapter</div>
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

                    <form enctype="multipart/form-data" class="row g-3 needs-validation" method="post" action="{{route('quan-ly-chapter.update',$quan-ly-chapter->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Tiêu đề quan-ly-chapter</label>
                            <input onkeyup="ChangeToSlug()" value="{{$quan-ly-chapter->title}}" name="title" type="text" class="form-control" id="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="convert_slug" class="form-label">Tên slug</label>
                            <input value="{{$quan-ly-chapter->slug}}" name="slug" type="text" class="form-control" id="convert_slug">
                        </div>

                        <div class="col-md-6">
                            <label for="story_id" class="form-label">Tên sách truyện</label>
                            <select required name="story_id" id="story_id" type="text" class="form-select">
                                @foreach ($stories as $story )
                                <option @if ($quan-ly-chapter->story_id == $story->id) selected @endif value="{{$story->id}}">{{$story->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select" id="status">
                                <option @if ($quan-ly-chapter->status == 'active') selected @endif value="active">Kích hoạt</option>
                                <option @if ($quan-ly-chapter->status == 'inactive') selected @endif value="inactive">Không kích hoạt</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Tóm tắt sách truyện</label>
                            <textarea class="form-control" name="description" id="description" rows="5" style="resize: none;">{{$quan-ly-chapter->description}}</textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="content" class="form-label">Nội dung sách truyện</label>
                            <textarea class="form-control" name="content" id="content" rows="5" style="resize: none;">{{$quan-ly-chapter->content}}</textarea>
                        </div>

                        <div class="col-12">
                            <button name="btn_add" class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection