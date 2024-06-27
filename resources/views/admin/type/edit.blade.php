@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cập nhật thể loại</div>
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

                    <form class="row g-3 needs-validation" method="post" action="{{route('the-loai.update',$type->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Tên thể loại</label>
                            <input onkeyup="ChangeToSlug()" value="{{$type->name}}" name="name" type="text" class="form-control" id="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="convert_slug" class="form-label">Tên slug</label>
                            <input value="{{$type->slug}}" name="slug" type="text" class="form-control" id="convert_slug">
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Mô tả thể loại</label>
                            <input value="{{$type->description}}" name="description" type="text" class="form-control" id="description">
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Kích hoạt</label>
                            <select name="status" class="form-select" id="status">
                                <option @if ($type->status == 'active') selected @endif value="active">Kích hoạt</option>
                                <option @if ($type->status == 'inactive') selected @endif value="inactive">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button name="btn_add" class="btn btn-primary" type="submit">Cập nhật</button>
                            <a class="btn btn-outline-primary" href="{{route('the-loai.index')}}">Quay lại</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection