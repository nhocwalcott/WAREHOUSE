@extends('master')
@section('danhmuc')
<div class="body-nav body-nav-horizontal body-nav-fixed">
                        <div class="container">
                            @if (Auth::user()->nguoidung_id == 1 || Auth::user()->nguoidung_id == 2)
                            <ul>
                                <li>
                                    <a href="{!! URL::route('chucnang.nhapkho.getList') !!}">
                                        <img src="http://wh.adcare.vn/public/lib/images/nhapkho.png"width="40px" height="20px" style="margin-top:-9px;" ><br> Nhập kho
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('chucnang.xuatkho.getList') !!}">
                                        <img src="http://wh.adcare.vn/public/lib/images/xuatkho.png" width="40px" height="30px" style="margin-top:-10px;"><br> Xuất kho
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('chucnang.khohang.getKhohang') !!}">
                                        <img src="http://wh.adcare.vn/public/lib/images/kho.png" width="39px" height="30px" style="margin-top:-10px;"><br> Tồn kho
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('chucnang.khohang.getKiemKe') !!}">
                                        <img src="http://wh.adcare.vn/public/lib/images/kho.png" width="39px" height="30px" style="margin-top:-10px;"><br> KIỂM KÊ
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('chucnang.khohang.getLichSu') !!}">
                                        <img src="http://wh.adcare.vn/public/lib/images/kho.png" width="39px" height="30px" style="margin-top:-10px;"><br> LỊCH SỬ
                                    </a>
                                </li>
                            </ul>
                            @else
                            <ul>

                                <li>
                                    <a href="{!! URL::route('chucnang.khohang.getKhohang') !!}">
                                        <img src="http://wh.adcare.vn/public/lib/images/kho.png" width="39px" height="30px" style="margin-top:-10px;"><br> Tồn kho
                                    </a>
                                </li>

                            </ul>
                            @endif
                        </div>
                    </div>

@stop
@section('header')

@stop
@section('content')

@stop