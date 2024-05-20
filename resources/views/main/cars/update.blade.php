@extends('layout.Navbar')
@section('user')
    <button type="submit" class="btn btn-primary" id="userModalbtn">Thêm</button>
@endsection
@section('Users')
    CHỈNH SỬA TÀI KHOẢN
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            <div>
                <form action="{{ route('UpdateCar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 mt-3">
                        <input type="text" name="id" class="form-control" id="UserId"
                            value="{{ old('name', $car->id) }}" hidden>
                        Tên xe
                        <input type="text" name="name" class="form-control" id="UserName"
                            value="{{ old('name', $car->name) }}">
                        xuất xứ
                        <input type="text" name="brand" class="form-control" id="UserEmail"
                        value="{{ old('email', $car->brand) }}">
                        ghế ngồi
                        <input type="text" name="seat" class="form-control" id="UserEmail"
                        value="{{ old('email', $car->seat) }}">
                        đời xe
                        <input type="text" name="date" class="form-control" id="UserEmail"
                        value="{{ old('email', $car->date) }}">
                        mô tả xe
                        <input type="text" name="description" class="form-control" id="UserEmail"
                        value="{{ old('email', $car->description) }}">
                        giá thuê
                        <input type="text" name="price" class="form-control" id="UserEmail"
                        value="{{ old('email', $car->price) }}">
                        Hãng xe
                        <select name="cate" class="form-control mb-2"  id="Roleid">
                            @foreach ($cate as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <input type="file" id="files" name="image" class="form-control" >
                    </div>
                        <button type="submit" class="btn btn-primary" id="">xác nhận</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        
    </script>


    @include('main.cars.js')
@endsection
