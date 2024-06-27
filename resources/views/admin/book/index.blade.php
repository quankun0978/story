@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sách sách</div>

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
                                        <th>Tên sách</th>
                                        <th>Slug</th>
                                        <th>Tên tác giả</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hình ảnh</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($books) > 0)
                                        @foreach($books as $story)
                                            <tr>
                                                <td>{{ $story->id }}</td>
                                                <td>{{ $story->name }}</td>
                                                <td>{{ $story->slug }}</td>
                                                <td>{{ $story->author }}</td>
                                                <td>@if ($story->status == 'active') Kích hoạt @else Không kích hoạt @endif</td>
                                                <td>{{ $story->created_at }}</td>
                                                <td>
                                                    <img width="100px" height="100px" src="{{ asset('uploads/books/'.$story->image) }}" alt="">
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('quan-ly-sach.show', $story->id) }}" class="btn btn-primary btn-sm">Xem</a>
                                                        <a href="{{ route('quan-ly-sach.edit', $story->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                                        <form action="{{ route('quan-ly-sach.destroy', $story->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return confirm('Bạn có muốn xóa sách này không ?')" class="btn btn-danger btn-sm">Xóa</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No data found</td>
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
    {{ $books->links('') }}
    </div>
</div>
@endsection
