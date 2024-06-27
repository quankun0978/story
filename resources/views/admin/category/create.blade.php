@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thêm mới danh mục</div>
                
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
                    
                    <form class="row g-3 needs-validation" method="post" action="{{ route('quan-ly-danh-muc.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <label for="slug" class="form-label">Tên danh mục</label>
                            <input onkeyup="ChangeToSlug()" value="{{ old('name') }}" name="name" type="text" class="form-control" id="slug">
                        </div>
                        <div class="col-md-6">
                            <label for="convert_slug" class="form-label">Tên slug</label>
                            <input value="{{ old('slug') }}" name="slug" type="text" class="form-control" id="convert_slug">
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label">Mô tả danh mục</label>
                            <textarea class="form-control" name="description" id="description" rows="5" style="resize: none;"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Kích hoạt</label>
                            <select name="status" class="form-select" id="status">
                                <option selected value="active">Kích hoạt</option>
                                <option value="inactive">Không kích hoạt</option>
                            </select>
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
