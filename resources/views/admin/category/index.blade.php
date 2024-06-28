@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sách danh mục</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên danh mục</th>
                                        <th>Slug</th>
                                        <th>Mô tả danh mục</th>
                                        <th>Trạng thái danh mục</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($categories) > 0)
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>@if ($category->status == 'active') Kích hoạt @else Không kích hoạt @endif</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('quan-ly-danh-muc.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                                    <form action="{{ route('quan-ly-danh-muc.destroy', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Bạn có muốn xóa danh mục này không?')" class="btn btn-danger btn-sm">Xóa</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">No data found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2 justify-content-end d-flex">
    {{ $categories->links('') }}
    </div>
</div>
@endsection
