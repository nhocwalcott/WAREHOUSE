@extends('chucnang.chucnang')
@section('header')
    <section class="nav nav-page">
        <div class="container">
            <div class="row">
                <div class="span7">
                    <header class="page-header">
                        <h3>Quản lý Xuất kho<br/>
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
                        <p><b>Xuất kho</b></p>
                        <a href="{!! URL::route('chucnang.xuatkho.getList') !!}"><i class="icon-plus"></i>&nbspXuất kho</a><br><br>
                        <p><b>Bảng kê xuất</b></p>
                        <a href="{!! URL::route('chucnang.xuatkho.getVattu') !!}"><i class="icon-plus"></i>&nbspChi tiết</a><br>
                        <a href="{!! URL::route('chucnang.xuatkho.getChungtu') !!}"><i class="icon-plus"></i>&nbspDanh sách phiếu xuất</a><br>
                    </form>
                </div>
            </div>
        </div>
        <div style="margin-left:-1px" class="span13">
            <div class="box">
                <div class="box-header">
                    <p><b>Thông tin phiếu xuất</b></p>
                </div>
                <div class="box-content">
                    <div class="form-inline">
                        <div class="container">
                            <form action="{!! URL::route('chucnang.xuatkho.import') !!}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="text" name="excelfile">
                                <button type="submit"><i class="icon-plus"></i>&nbspImport Excel</button>
                            </form>
                            <div class="row">
                                <div id="acct-password-row" class="span13">
                                    <form action="" method="POST" accept-charset="utf-8">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div id="acct-password-row" class="span8">
                                            <fieldset>
                                                <div class="control-group ">
                                                    <label>Khách hàng:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                                    <input type="text" name="selCT" class="span7">
                                                </div>
                                                <div class="control-group">
                                                    <label>Thông tin KH:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                                    <input type="text" name="txtDC" class="span7">
                                                </div>
                                                <div class="control-group">
                                                    <label>Khu vực:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                                    <input type="text" name="txtLyDo" class="span7">
                                                </div>
                                                <div class="control-group">
                                                    <label>Nhân viên:&nbsp</label>
                                                    <?php
                                                    $nv = DB::table('nhanvien')->where('user_id',Auth::user()->id)->first();

                                                    ?>
                                                    <input type="text" value="{{ $nv->nv_ten}}" class="span7">
                                                    <input type="hidden" name="txtNV" value="{{ $nv->id }}">
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div id="acct-password-row" class="span4">
                                            <fieldset>
                                                <div class="control-group ">
                                                    <label>Mã phiếu:&nbsp</label>
                                                    <input type="text" name="txtID" value="PXK{!! date('dmYhms') !!}" class="span3">
                                                </div>
                                                <div class="control-group">
                                                    <label>Ngày xuất:</label>
                                                    <input type="text" name="" value="{!! date('d-m-Y') !!}" class="span3">
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i>&nbsp&nbspLưu</button>
                                        </div>
                                    </form>
                                    <form action="" method="POST" accept-charset="utf-8">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div id="acct-password-row" class="span12">
                                            <div>
                                                <u><p><b>Danh sách vật tư</b></p></u>
                                            </div>
                                            <div class="control-group">
                                                <label>Mã:</label>
                                                <select name="vattu_id" id="vattu_id" class="vattu_id span2">
                                                    <option>--Chọn--</option>
                                                    @foreach($data1 as $item)
                                                        <option value="{{$item->id}}">{{ $item->vt_ma}}</option>
                                                    @endforeach
                                                </select>
                                                <label>Tên:</label>
                                                <select name="ten" id="country" class="span4">
                                                    <option value=""></option>
                                                </select>
                                                <label>Giá gốc:</label>
                                                <select class="span2" name="dvt" id="country1" >
                                                    <option value="" ></option>
                                                </select>
                                                <div class="control-group">
                                                <label>Giá bán</label>
                                                <p id="country2"> &nbsp&nbsp</p>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label>Số lượng:</label>
                                                <input type="number" name="sluong" id="sluong" class="sluong span2" value="">&nbsp&nbsp
                                                <a href="#" class="add btn btn-default " type="submit"><i class="icon-plus"></i>&nbsp&nbspThêm</a>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="acct-password-row" class="span12">
                                        <div>
                                            <form action="" method="POST" accept-charset="utf-8">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <table class="tb table table-bordered table-hover" id="myTable" name="myTable">
                                                    <thead style="background:#EFEFEF;">
                                                    <tr>
                                                        <th>Mã VT</th>
                                                        <th>Tên VT</th>
                                                        <th>Giá gốc</th>
                                                        <th>Giá bán</th>
                                                        <th>Số lượng</th>
                                                        <th class="span1"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($content as $item)

                                                        <tr>
                                                            <td>{{ $item['id'] }}</td>
                                                            <td>{{ $item['name'] }}</td>
                                                            <td>{{ $item->options->size }}</td>
                                                            <td>{{ $item->options->kho }}</td>
                                                            <td>{{ $item['qty'] }}</td>

                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </form>
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
                    $(".add").click(function() {
                        var id = $(this).parent().parent().find(".vattu_id").val();
                        var qty = $(this).parent().parent().find(".sluong").val();
                        var giaban = $(this).parent().parent().find(".giaban").val();
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url:'xuathang/'+id+'/'+qty+'/'+giaban,
                            type:'GET',
                            cache:false,
                            data:{"_token":token,"id":id,"qty":qty,"giaban":giaban},
                            success: function(data) {
                                if(data == "oke") {
                                    window.location = "xuatkho";
                                }
                                else {
                                    alert("Error!");
                                }
                            }
                        });
                    });
                });

                $(document).ready(function() {
                    $(".del").click(function(){

                        $(this).parents("tr").remove();
                    });
                });
            </script>


            <!-- Ajax Vật tư -->
            <script>
                $('#vattu_id').on('change', function(e) {
                    var vattu_id = e.target.value;
                    //ajax

                    $.getJSON("vattu/ajax-call?vattu_id="+vattu_id, function (data) {

                        console.log(data);

                        $('#country').empty();
                        $.each(data, function(index, countryObj){

                            $('#country').append('<option value="'+countryObj.id+'  selected="{{ old("ten") === "'+countryObj.vt_id+'" ? true : false }} ">'+countryObj.vt_ten+'</option>');
                        });

                        $('#country1').empty();
                        $.each(data, function(index, countryObj){

                            $('#country1').append('<option value="'+countryObj.id+'  selected="{{ old("dvt") === "'+ countryObj.vt_id + '" ? true : false }} ">'+ countryObj.vt_giagoc + '</option>');
                        });

                        $('#country2').empty();
                        $.each(data, function(index, countryObj){

                            $('#country2').append('<input class = "giaban span2" type="number" name="giaban" value= "'+ countryObj.vt_giaban + '">');
                        });

                    });

                });
            </script>
@stop
