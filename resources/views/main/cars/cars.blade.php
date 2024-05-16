@extends('layout.Navbar')
{{-- <link rel="stylesheet" href=""> --}}
@section('cars')
    <form action="/importcars" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="" placeholder="" required/>
        <button class="btn btn-primary mt-1" type="submit" id="submit">Import</button>
        <button class="btn btn-primary mt-1" type="button" id="" data-bs-toggle="modal"
            data-bs-target="#ModalCar">Thêm</button>

    </form>
@endsection
@section('cartitle')
    CHI TIẾT XE
@endsection
@section('main')
    {{-- Container --}}
    <div class="container">
        <div class="row">
            @if (count($cars) > 0)
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên xe</th>
                                <th scope="col">Xuất xứ</th>
                                <th scope="col">Ghế ngồi</th>
                                <th scope="col">Đời xe</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Giá thuê</th>
                                <th scope="col">Hãng xe</th>
                                <th scope="col">path</th>
                                <th scope="col">Action</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $key => $item)
                                <tr>
                                    <td scope="row">{{ ++$key }}</td>
                                    <td class="" data-id="{{ $item->id }}" data-value="{{ $item->name }}">
                                        {{ $item->name }}
                                    </td>
                                    <td scope="row">{{ $item->brand }}</td>
                                    <td scope="row">{{ $item->seat }}</td>
                                    <td scope="row">{{ $item->date }}</td>
                                    <td scope="row">{{ $item->description }}</td>
                                    <td scope="row">{{ $item->price }}</td>
                                    <td scope="row">{{ $item->catename }}</td>
                                    <td scope="row" ><img width="200" src="{{asset($item->img)}}" alt=""></td>
                                    <td>
                                        <button class="btn btn-danger deleteCarbtn" data-id="{{ $item->id }}">Xóa
                                        </button>
                                        <a class="btn btn-warning " href="{{route("EditCar",$item->id)}}">Sửa</a>

                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    {{-- ================================== --}}

    <!-- Modal -->

    <div class="modal fade" id="ModalCar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Thêm thông tin xe
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/createCar" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 mt-3">
                            <h4>tên xe</h4>
                            <input type="text" name="name" id="name" class="form-control" id=""
                                placeholder="tên loại xe">
                            <h4>xuất xứ</h4>
                            <input type="text" name="brand" id="brand" class="form-control" id=""
                                placeholder="quốc gia xuất xứ">
                            <h4>số chỗ</h4>
                            <input type="text" name="seat" id="seat" class="form-control" id=""
                                placeholder="từ 4 - 30 chỗ">
                            <h4>đời xe</h4>
                            <input type="text" name="date" id="date" class="form-control" id=""
                                placeholder="từ 2015 - 2024">
                            <h4>Hãng xe</h4>
                            <select class="form-control mb-2" name="category" id="category">
                                @if (count($cate) > 0)
                                    @foreach ($cate as $item)
                                        <option value="{{ $item->id }}">
                                            <h5>{{ $item->name }}</h5>
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <h4>mô tả</h4>
                            <input type="text" name="description" id="description" class="form-control" id=""
                                placeholder="Nhập thông tin">
                            <h4>giá</h4>
                            <input type="text" name="price" id="price" class="form-control" id=""
                                placeholder="giá trị xe">
                            <h4>Hình ảnh xe</h4>
                            <input type="file" name="image" id="image" class="form-control" required >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="closemodal btn btn-secondary"
                                data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="addCarbtn">Thêm</button>
                        </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    </html>
    @include('main.cars.js')

@endsection
