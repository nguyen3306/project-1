@extends('layout.Navbar')
@section('Category')
@endsection
<!-- Button trigger modal -->
@section('main')
    <!-- Modal -->
    <div>
        @if ($errors->has('role'))
            <div class="d-flex">
                <div class="text-small text-secondary">
                    <span class="text-danger">{{ $errors->first('role') }}</span>
                </div>
            </div>
        @endif
        <form method="post" action="/createRole">
            @csrf
            <div class="">
                <h1 class="" id="">Thêm loại tài khoản</h1>
            </div>
            <div class="">
                <input type="text" class="form-control" value="{{ old('role') }}" id="addRole" name="role" placeholder="Nhập loại tài khoản">
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary" id="">Lưu</button>
            </div>
        </form>
    </div>
@endsection
