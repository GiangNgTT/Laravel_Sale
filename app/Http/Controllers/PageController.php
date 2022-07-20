<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Facades\Date;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slide;


class PageController extends Controller
{
    public function index(){
        $slide = Slide ::all();
        $products = Product::simplePaginate();
        $new_products  = Product::where('new', 1)->paginate(4);
        return view('banhang.index', compact('slide','new_products', 'products'));
    }
    public function getLoaiSp($type){
        $loai_sp = ProductType::all();
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac =  Product::where ('id_type','<>',$type)->paginate(3);
        return view ('banhang.loai_sanpham',compact('sp_theoloai', 'loai_sp', 'sp_khac'));
    }

}
