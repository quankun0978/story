@extends('layouts.app')
@section('content')
<div class="container">
    <div class="w-w-100">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Trang chủ</div>
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Xin chào {{ Auth::user()->name }}

                </div>
                <!-- <x-package-input/> -->
            </div>
        </div>
    </div>
</div>
@endsection