<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Excel;

class BaocaoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getKhohang()
	{
		$data = DB::table('kho')->get();
		return view('chucnang.baocao.khohang',compact('data'));
	}
    public function getKiemKe()
    {
        $vattu = DB::table('vattukho')->get();
        $ttxuat = DB::table('chitietxuatkho')->select('vt_id');
        $dsvt = DB::table('chitietnhapkho')->select('vt_id')->union($ttxuat)->get();
        $listvt = array();
        $ctn = array();
        $ctx = array();
        $i = 0;
        foreach ($dsvt as $vt) {
            $listvt[$i] = $vt->vt_id;
            $i++;
        }
        for ($i = 0; $i<sizeof($listvt);$i++){
            $j = $listvt[$i];
            $chitietnhap = DB::table('chitietnhapkho')->where('vt_id',$j)->get();
            $chitietxuat = DB::table('chitietxuatkho')->where('vt_id',$j)->get();
            if(empty($chitietnhap)){
                $ctn[$j] = 0;
                $sln[$j] =0;
            }else foreach ($chitietnhap as $ttn){
                $ctn[$j] =+ $ttn->ctnk_soluong * $ttn->ctnk_giagoc;
                $sln[$j]=+ $ttn->ctnk_soluong;
            }
            if(empty($chitietxuat)){
                $ctx[$j] = 0;
                $slx[$j] = 0;
            }else foreach ($chitietxuat as $ttx) {
                $ctx[$j] =+ $ttx->ctxk_soluong * $ttx->ctxk_giaban;
                $slx[$j] =+ $ttx->ctxk_soluong;
            }
        }
        $data1 = DB::table('vattu')->get();
        $data = DB::table('kho')->get();


       return view('chucnang.baocao.kiemke',compact('data','data1','listvt','ctn','ctx','sln','slx'));
    }
    public function getLichSu()
    {
            $chitietnhap = DB::table('chitietnhapkho')->get();
            $chitietxuat = DB::table('chitietxuatkho')->get();
            $data1 = DB::table('vattu')->get();
        return view('chucnang.baocao.lichsu',compact('chitietxuat','chitietnhap','data1'));
    }
    public function postSearch2(Request $request){
        $from = $request->from;
        $to = $request->to;
        $vattu = $request->vattu_id;
        $data1 = DB::table('vattu')->get();
        if( $from == ""|| $to ==""){
            $chitietnhap = DB::table('chitietnhapkho')->where('vt_id',$vattu)->get();
            $chitietxuat = DB::table('chitietxuatkho')->where('vt_id',$vattu)->get();
        }else{

            $chitietnhap = DB::table('chitietnhapkho')->whereBetween('created_at', array($from, $to))->where('vt_id',$vattu)->get();
            $chitietxuat = DB::table('chitietxuatkho')->where('vt_id',$vattu)->whereBetween('created_at', array($from, $to))->get();
        }

        return view('chucnang.baocao.lichsu',compact('chitietxuat','chitietnhap','data1'));
    }
    public function postSearch(Request $request){
        $from = $request->from;
        $to = $request->to;
        $vattu = $request->vattu_id;
            $vattu = DB::table('vattukho')->get();
            $ttxuat = DB::table('chitietxuatkho')->whereBetween('created_at', array($from, $to))->select('vt_id');
            $dsvt = DB::table('chitietnhapkho')->whereBetween('created_at', array($from, $to))->select('vt_id')->union($ttxuat)->get();
            $listvt = array();
            $ctn = array();
            $ctx = array();
            $i = 0;
            foreach ($dsvt as $vt) {
                $listvt[$i] = $vt->vt_id;
                $i++;
            }
            for ($i = 0; $i<sizeof($listvt);$i++){
                $j = $listvt[$i];
                $chitietnhap = DB::table('chitietnhapkho')->whereBetween('created_at', array($from, $to))->where('vt_id',$j)->get();
                $chitietxuat = DB::table('chitietxuatkho')->where('vt_id',$j)->whereBetween('created_at', array($from, $to))->get();
                if(empty($chitietnhap)){
                    $ctn[$j] = 0;
                    $sln[$j] = 0;
                }else foreach ($chitietnhap as $ttn){
                    $ctn[$j] =+ $ttn->ctnk_soluong * $ttn->ctnk_giagoc;
                    $sln[$j] =+ $ttn->ctnk_soluong;
                }
                if(empty($chitietxuat)){
                    $ctx[$j] = 0;
                    $slx[$j] = 0;
                }else foreach ($chitietxuat as $ttx) {
                    $ctx[$j] =+ $ttx->ctxk_soluong * $ttx->ctxk_giaban;
                    $slx[$j] =+ $ttx->ctxk_soluong;
                }
            }
            $data1 = DB::table('vattu')->get();
            $data = DB::table('kho')->get();


            return view('chucnang.baocao.kiemke',compact('data','data1','listvt','ctn','ctx','sln','slx'));
    }
	public function export(){
        $vattu = DB::table('vattukho')
            ->join('vattu','vattu.id','=','vattukho.vt_id')
            ->join('donvitinh','donvitinh.id','=','vattu.dvt_id')
            ->select(
                'vattu.id',  'vattu.vt_ma','vattu.vt_ten','donvitinh.dvt_ten', 'vattu.vt_gia',
                'vattukho.sl_nhap','vattukho.sl_xuat',
                'vattukho.sl_ton', 'vattu.created_at'
            )
            ->get();
        var_dump($vattu);
        $data = array();
        $data=array('id','vt_ma','vt_ten','dvt_ten','vt_gia','sl_nhap','sl_xuat','sl_ton','created_at');
        foreach ($vattu as $item){
            $data['id']= $item->id;
            $data['vt_ma'] = $item->vt_ma;
        }


    }

	public function thekho()
	{

		$data = DB::table('vattu')
			->get();
		return view('chucnang.baocao.thekho',compact('data'));
	}

	public function tongton()
	{
		$data = DB::table('kho')->get();
		return view('chucnang.baocao.baocaokho',compact('data'));
	}

	public function nhomton()
	{
		$data = DB::table('nhomvattu')
			->get();
		return view('chucnang.baocao.baocaonhomvt',compact('data'));
	}

	public function chatluongton()
	{
		$data = DB::table('chatluong')
			->get();
		return view('chucnang.baocao.baocaochatluong',compact('data'));
	}

	public function nppton()
	{
		$data = DB::table('nhaphanphoi')
			->get();
		return view('chucnang.baocao.baocaonpp',compact('data'));
	}
    public function getExport(){
        $serial = DB::table('vattukho')->get();
        $data = array();
        foreach ($serial as $sr){
            $vattu = DB::table('vattu')->where('id',$sr->vt_id)->first();
            $kho = DB::table('kho')->where('id',$sr->kho_id)->first();
            $sr->mavattu = $vattu->vt_ma;
            $sr->model = $vattu->vt_gia;
            $sr->tenvattu = $vattu->vt_ten;
            $sr->kho = $kho->kho_ten;
            $data[]= (array)$sr;
        }
        \Maatwebsite\Excel\Facades\Excel::create('Tonkho',function($excel) use($data){
            $excel->sheet('Sheet1', function($sheet) use($data){
                $sheet->fromArray($data);
            });
        })->export('xlsx');
    }

}
