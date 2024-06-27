@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Danh sách thể loại</div>

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
                                        <th>Tên thể loại</th>
                                        <th>Slug</th>
                                        <th>Mô tả thể loại</th>
                                        <th>Trạng thái thể loại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($types) > 0)
                                    @foreach($types as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->slug }}</td>
                                        <td>{{ $type->description }}</td>
                                        <td>@if ($type->status=='active')Kích hoạt @else Không kích hoạt @endif</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('the-loai.show', $type->id ) }}" class="btn btn-primary btn-sm">Xem</a>
                                                <a href="{{ route('the-loai.edit', $type->id ) }}" class="btn btn-warning btn-sm">Sửa</a>
                                                <form action="{{ route('the-loai.destroy', $type->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button onclick="return confirm('Bạn có muốn xóa thể loại này không ?')" class="btn btn-danger btn-sm">Xóa</button>
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
    {{ $types->links('') }}
    </div>
</div>
@endsection