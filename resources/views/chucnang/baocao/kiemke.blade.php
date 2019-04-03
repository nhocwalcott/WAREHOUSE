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
                    <form class="form-inline" action="{!! URL::route('chucnang.khohang.postSearch')  !!}" method="post">
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
                                                    <form action="{!! URL::route('chucnang.khohang.postSearch') !!}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <label>Từ ngày: </label>
                                                        <input type="datetime-local" class="from" id="from" name="from">
                                                        <label>Đến ngày: </label>
                                                        <input type="datetime-local" class="to" id="to" name="to">
                                                        {{--<label>Mã:</label>--}}
                                                        {{--<select  class="vattu_id span2" name="vattu_id" id="vattu_id">--}}
                                                            {{--<option>--Chọn--</option>--}}
                                                            {{--@foreach($data1 as $item)--}}
                                                                {{--<option value="{{ $item->id}}">{{ $item->vt_ma}}</option>--}}
                                                            {{--@endforeach--}}
                                                        {{--</select>--}}
                                                        <button type="submit"><i class="icon-plus"></i>Tìm kiếm</button>
                                                    </form>
                                                </fieldset>
                                            </div>
                                            <table class="table table-bordered table-hover tablesorter" id="sample-table">
                                                <thead style="background:#EFEFEF;">
                                                    <tr>
                                                        <th class="span2">Mã VT</th>
                                                        <th class="span4">Tên VT</th>
                                                        <th class="span2">ĐVT</th>
                                                        <th class="span2">SL nhập</th>
                                                        <th class="span2">SL xuất</th>
                                                        <th class="span2">SL tồn</th>
                                                        <th class="span2">Tiền nhập</th>
                                                        <th class="span2">Tiền xuất</th>
                                                        <th class="span2">Giá nhập hiện tại</th>
                                                        <th class="span2">Tiền lãi dự kiến</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                            $vattu = DB::table('vattukho')
                                                                ->whereIn('vt_id',$listvt)
                                                                ->join('vattu','vattu.id','=','vattukho.vt_id')
                                                                ->join('donvitinh','donvitinh.id','=','vattu.dvt_id')
                                                                ->select(
                                                                    'vattukho.sl_nhap','vattukho.sl_xuat',
                                                                    'vattukho.sl_ton','donvitinh.dvt_ten',
                                                                    'vattu.id','vattu.vt_ma','vattu.vt_ten','vattu.vt_giagoc',
                                                                    'vattu.vt_gia','vattu.created_at'
                                                                    )->orderByRaw('vattukho.sl_ton DESC')
                                                                ->get();
                                                            $tongsl = DB::table('vattukho')
                                                                ->where('vattukho.kho_id',1)
                                                                ->sum('sl_ton');

                                                        ?>
                                                    <tr>
                                                        <td colspan="9" style="color:red;"><b>Kho hàng: Tồn: {!! $tongsl !!}   </b></td>
                                                    </tr>
                                                    @foreach ($vattu as $val)
                                                    <tr>
                                                        <td>{!! $val->vt_ma !!}</td>
                                                        <td>{!! $val->vt_ten !!}</td>
                                                        <td>{!! $val->dvt_ten !!}</td>
                                                        <td>{!! number_format($sln[$val->id]) !!}</td>
                                                        <td>{!! number_format($slx[$val->id]) !!}</td>
                                                        <td>{!! $val->sl_ton !!}</td>
                                                        <td>{!! number_format($ctn[$val->id]) !!}</td>
                                                        <td>{!! number_format($ctx[$val->id]) !!}</td>
                                                        <td>{!! number_format($val->vt_giagoc) !!}</td>
                                                        <td>{!! number_format($ctx[$val->id]+$val->vt_giagoc*$val->sl_ton-$ctn[$val->id]) !!}</td>
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
