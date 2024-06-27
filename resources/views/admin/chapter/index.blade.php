@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sách chapter</div>

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
                                        <th>Tiêu đề</th>
                                        <th>Slug</th>
                                        <th>Tên truyện</th>
                                        <th>Trạng thái chapter</th>
                                        <th>Mô tả chapter</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($chapters) > 0)
                                    @foreach($chapters as $chapter)
                                    <tr>
                                        <td>{{ $chapter->id }}</td>
                                        <td>{{ $chapter->title }}</td>
                                        <td>{{ $chapter->slug }}</td>
                                        <td>{{$chapter->story->name}}</td>
                                        <td>@if ($chapter->status=='active')Kích hoạt @else Không kích hoạt @endif</td>
                                        <td>{{ $chapter->description }}</td>

                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('quan-ly-chapter.show', $chapter->id ) }}" class="btn btn-primary btn-sm">Xem</a>
                                                <a href="{{ route('quan-ly-chapter.edit', $chapter->id ) }}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{ route('quan-ly-chapter.destroy', $chapter->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button onclick="return confirm('Bạn có muốn xóa chapter này không ?')" class="btn btn-danger btn-sm">Xóa</button>
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
    {{ $chapters->links('') }}
    </div>
</div>
@endsection