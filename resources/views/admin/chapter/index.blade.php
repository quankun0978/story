@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sách các Chapter</div>

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
                                        <th>Tên sách truyện</th>
                                        <th>Trạng thái quan-ly-chapter</th>
                                        <th>Mô tả quan-ly-chapter</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($chapters) > 0)
                                    @foreach($chapters as $quan-ly-chapter)
                                    <tr>
                                        <td>{{ $quan-ly-chapter->id }}</td>
                                        <td>{{ $quan-ly-chapter->title }}</td>
                                        <td>{{ $quan-ly-chapter->slug }}</td>
                                        <td>{{$quan-ly-chapter->story->name}}</td>
                                        <td>@if ($quan-ly-chapter->status=='active')Kích hoạt @else Không kích hoạt @endif</td>
                                        <td>{{ $quan-ly-chapter->description }}</td>

                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('quan-ly-chapter.show', $quan-ly-chapter->id ) }}" class="btn btn-primary btn-sm">Xem</a>
                                                <a href="{{ route('quan-ly-chapter.edit', $quan-ly-chapter->id ) }}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{ route('quan-ly-chapter.destroy', $quan-ly-chapter->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button onclick="return confirm('Bạn có muốn xóa quan-ly-chapter này không ?')" class="btn btn-danger btn-sm">Xóa</button>
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
</div>
@endsection