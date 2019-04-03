@extends('chucnang.chucnang')
@section('header')
<section class="nav nav-page">
    <div class="container">
        <div class="row">
            <div class="span7">
                <header class="page-header">
                    <h3>Quản lý Kho hàng<br/>
                        <small></small>
                    </h3>
                </header>
            </div>                      
        </div>
    </div>
</section>
@stop
@section('content')
    <div class="row">
        <div class="span16">
            <div class="box">
                <div class="box-header">
                    <p><b>Bảng kê Kho hàng</b></p>
                </div>
                <div class="box-content">
                    <form class="form-inline" action="{!! URL::route('chucnang.khohang.postSearch2')  !!}" method="post">
                        <div class="container">
                            <div class="row">
                                <div id="acct-password-row" class="span15">

                                    {{--<div class="" >--}}
                                        {{--<fieldset>--}}
                                            {{--<input id="current-pass-control" name="" class="span4" type="text" value="" autocomplete="false">--}}
                                            {{--<a href="{!! URL::route('chucnang.khohang.getExport') !!}" class="btn btn-info" style="margin-top: -8px"><i class="icon-search"></i>Export Excel</a>--}}
                                        {{--</fieldset>--}}
                                    {{--</div>--}}
                                        <br>
                                        <div>
                                            <div class="" >
                                                <fieldset>
                                                    <form action="{!! URL::route('chucnang.khohang.postSearch2') !!}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <label>Từ ngày: </label>
                                                        <input type="datetime-local" class="from" id="from" name="from">
                                                        <label>Đến ngày: </label>
                                                        <input type="datetime-local" class="to" id="to" name="to">
                                                        <label>Mã:</label>
                                                        <select  class="vattu_id span2" name="vattu_id" id="vattu_id">
                                                            <option>--Chọn--</option>
                                                            @foreach($data1 as $item)
                                                                <option value="{{ $item->id}}">{{ $item->vt_ma}}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit"><i class="icon-plus"></i>Tìm kiếm</button>
                                                    </form>
                                                </fieldset>
                                            </div>
                                            <table class="table table-bordered table-hover tablesorter" id="sample-table">
                                                <thead style="background:#EFEFEF;">
                                                    <tr>
                                                        <th class="span2">Mã VT</th>
                                                        <th class="span4">Tên VT</th>
                                                        <th class="span2">SL nhập</th>
                                                        <th class="span2">Ngày nhập</th>
                                                        <th class="span2">Giá nhập</th>
                                                        <th class="span2">Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($chitietnhap as $ctnk)
                                                <tr>
                                                        <?php $vattu = DB::table('vattu')->where('id',$ctnk->vt_id)->first();?>
                                                       <td>{!! $vattu->vt_ma !!}</td>
                                                        <td>{!! $vattu->vt_ten !!}</td>
                                                        <td>{!! $ctnk->ctnk_soluong !!}</td>
                                                        <td>{!! $ctnk->created_at !!}</td>
                                                        <td>{!! number_format($ctnk->ctnk_giagoc) !!}</td>
                                                        <td>{!! number_format($ctnk->ctnk_giagoc * $ctnk->ctnk_soluong) !!}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered table-hover tablesorter" id="sample-table">

                                                <thead style="background:#EFEFEF;">
                                                <tr>
                                                    <th class="span2">Mã VT</th>
                                                    <th class="span4">Tên VT</th>
                                                    <th class="span2">SL xuất</th>
                                                    <th class="span2">Ngày xuất</th>
                                                    <th class="span2">Giá bán</th>
                                                    <th class="span2">Thành tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($chitietxuat as $ctxk)
                                                    <tr>
                                                        <?php $vattu = DB::table('vattu')->where('id',$ctxk->vt_id)->first();?>
                                                        <td>{!! $vattu->vt_ma !!}</td>
                                                        <td>{!! $vattu->vt_ten !!}</td>
                                                        <td>{!! $ctxk->ctxk_soluong !!}</td>
                                                        <td>{!! $ctxk->created_at !!}</td>
                                                        <td>{!! number_format($ctxk->ctxk_giaban) !!}</td>
                                                        <td>{!! number_format($ctxk->ctxk_giaban * $ctxk->ctxk_soluong) !!}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
