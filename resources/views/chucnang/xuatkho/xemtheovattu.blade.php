@extends('chucnang.chucnang')
@section('header')
<section class="nav nav-page">
    <div class="container">
        <div class="row">
            <div class="span7">
                <header class="page-header">
                    <h3>Quản lý Xuất kho<br/>
                        <small>Xem Chi tiết phiếu</small>
                    </h3>
                </header>
            </div>                      
        </div>
    </div>
</section>
@stop
@section('content')
    <div class="row">
        <div class="span3">
            <div class="box">
                <div class="box-header">
                    <p><b>Chức năng</b></p>
                </div>
                <div class="box-content">
                    <form class="form-inline">
                        <p><b>Xuất kho</b></p>
                        <a href="{!! URL::route('chucnang.xuatkho.getList') !!}"><i class="icon-plus"></i>&nbspXuất kho</a><br><br>
                        <p><b>Bảng kê xuất</b></p>
                        <a href="{!! URL::route('chucnang.xuatkho.getVattu') !!}"><i class="icon-plus"></i>&nbspChi tiết phiếu</a><br>
                        <a href="{!! URL::route('chucnang.xuatkho.getChungtu') !!}"><i class="icon-plus"></i>&nbspDanh sách phiếu xuất</a><br>
                    </form>
                </div>
            </div>
        </div>
        <div style="margin-left:-1px" class="span13">
            <div class="box">
                <div class="box-header">
                    <p><b>Bảng kê tổng hợp</b></p>
                </div>
                <div class="box-content">
                    <form class="form-inline">
                        <div class="container">
                            <div class="row">
                                <div id="acct-password-row" class="span13">
                                    <div id="acct-password-row" class="span12">

                                        <br>
                                        <div>
                                            <table class="table table-bordered table-hover tablesorter" id="sample-table">
                                                <thead style="background:#EFEFEF;">
                                                    <tr>
                                                        <th class="span3">Mã XK</th>
                                                        <th class="span2">Mã VT</th>
                                                        <th class="span3">Vật tư</th>
                                                        <th class="span1">Số lượng</th>
                                                        <th class="span1">ĐVT</th>
                                                        <th class="span6"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                               @foreach ($chitiet as $chitiet)
                                                    <?php
                                                    $vt = DB::table('vattu')->where('id',$chitiet->vt_id)->first();
                                                    $dvt = DB::table('donvitinh')->where('id',$vt->dvt_id)->first();
                                                    ?>
                                                    <tr>
                                                        <td>{!! $chitiet->xk_id !!}</td>
                                                        <td >{!! $vt->vt_ma !!}</td>
                                                        <td>{!! $vt->vt_ten !!}</td>
                                                        <td>{!! $chitiet-> ctxk_soluong !!}</td>
                                                        <td>{!! $dvt->dvt_ten !!}</td>

                                                        <td class="td-actions">
                                                            <a href="{!! URL::route('chucnang.xuatkho.getEdit1' ,$chitiet->id) !!}" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit">EDIT</i></a>
                                                            <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')"  href="{!! URL::route('chucnang.xuatkho.getDeletePro',[$vt->id,$chitiet->xk_id]) !!}" class="btn btn-small btn-danger"><i class="btn-icon-only icon-remove">DELETE</i></a>
                                                            <a href="{!! URL::route('chucnang.xuatkho.getSerial' ,$chitiet->id) !!}" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit">INPUT</i></a>
                                                            <a href="{!! URL::route('chucnang.xuatkho.getSerial1' ,$chitiet->id) !!}" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit">SERIAL</i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop