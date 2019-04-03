@extends('chucnang.chucnang')
@section('header')
    <section class="nav nav-page">
        <div class="container">
            <div class="row">
                <div class="span7">
                    <header class="page-header">
                        <h3>Quản lý Nhập kho<br/>
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
        <div class="span3">
            <div class="box">
                <div class="box-header">
                    <p><b>Chức năng</b></p>
                </div>
                <div class="box-content">
                    <form class="form-inline">
                        <p><b>Nhập kho</b></p>
                        <a href="{!! URL::route('chucnang.nhapkho.getList') !!}"><i class="icon-plus"></i>&nbspNhập kho</a><br><br>
                        <p><b>Bảng kê nhập</b></p>
                        <a href="{!! URL::route('chucnang.nhapkho.getVattu') !!}"><i class="icon-plus"></i>&nbspChi tiết phiếu</a><br>
                        <a href="{!! URL::route('chucnang.nhapkho.danhsach') !!}"><i class="icon-plus"></i>&nbspDanh sách phiếu nhập</a><br>
                    </form>
                </div>
            </div>
        </div>
        <div style="margin-left:-1px" class="span13">
            <div class="box">
                <div class="box-header">
                    <p><b>Nhập kho thông thường</b></p>
                </div>
                <div class="box-content">
                    <div class="form-inline">
                        <div class="container">
                            <div class="row">
                                <div id="acct-password-row" class="span13">
                                    <div id="acct-password-row" class="span12">
                                        <div>
                                            <form action="" method="POST" accept-charset="utf-8">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <table class="tb table table-bordered table-hover" id="myTable" name="myTable">
                                                    <thead style="background:#EFEFEF;">
                                                    <tr>
                                                        <th>Mã VT</th>
                                                        <th>Tên VT</th>
                                                        <th>ĐVT</th>
                                                        <th>Số lượng</th>
                                                        <th>Giá gốc</th>
                                                        <th>Giá bán</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($chitiet as $val)
                                                        <tr>
                                                            <?php
                                                            $vt = DB::table('vattu')->where('id',$val->vt_id)->first();
                                                            $vtl = DB::table('vattu')->get();
                                                            $dvt = DB::table('donvitinh')->where('id',$vt->dvt_id)->first();

                                                            ?>
                                                            <td>{!! $val->vt_id !!}</td>
                                                            <td>{!! $vt->vt_ten !!}</td>
                                                            <td>{!! $dvt->dvt_ten !!}</td>
                                                            <td>
                                                                <input name = "ctnk_soluong" id = "ctnk_soluong" class="ctnk_soluong" type="number" value="{!! $val->ctnk_soluong !!}" class="qty">
                                                            </td>
                                                                <td>
                                                                    <input name = "ctnk_giagoc" id = "npp_id" class="ctnk_giagoc" type="text" value="{!! number_format($val->ctnk_giagoc) !!}" >
                                                                </td>
                                                                <td>
                                                                    <input name = "ctnk_giabandk" id = "kho_id" class="ctnk_giabandk" type="text" value="{!! number_format($val->ctnk_giabandk) !!}" >
                                                                </td>
                                                                <td>
                                                                <a href="{!! URL::route('chucnang.nhapkho.getDeletePro',[$val->vt_id,$val->nk_id]) !!}">xóa</a>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button type="submit" class="btn btn-primary"><i class="icon-save"></i>&nbsp&nbsp&nbspLưu</button>
                                                @endforeach
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $(".del").click(function(){
                    var nkID = $(this).parent().parent().find(".nkID").val();
                    var vtID = $(this).parent().parent().find(".vtID").val();
                    var qty = $(this).parent().parent().find(".qty").val();
                    var token = $("input[name='_token']").val();
                    // alert(xkID);
                    $.ajax({
                        url:'http://localhost/quanlykho/chucnang/nhapkho/suavattu/'+vtID+'/'+qty,
                        type:'GET',
                        cache:false,
                        data:{"_token":token,"nkID":nkID,"qty":qty,"vtID":vtID},
                        success: function(data) {
                            if(data == "oke") {
                                window.location = "http://localhost/quanlykho/chucnang/nhapkho/sua-theo-vat-tu/"+nkID;
                            }
                            else {
                                alert("Error!");
                            }
                        }
                    });
                });
            });
        </script>
@stop
