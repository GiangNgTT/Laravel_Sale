<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Facades\Date;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        $products = Product::simplePaginate();
        $new_products  = Product::where('new', 1)->paginate(4);
        return view('banhang.index', compact('slide', 'new_products', 'products'));
    }
    public function getLoaiSp($type)
    {
        $loai_sp = ProductType::all();
        $sp_theoloai = Product::where('id_type', $type)->get();
        $sp_khac =  Product::where('id_type', '<>', $type)->paginate(3);
        return view('banhang.loai_sanpham', compact('sp_theoloai', 'loai_sp', 'sp_khac'));
    }
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }
    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return redirect()->back();
    }
    public function getCheckout()
    {
        return view('banhang.checkout')->with('dathang', 'Đặt hàng thành công');
    }
    public function postCheckout(Request $request)
    {
        if ($request->input('payment_method') != "VNPAY") {

            $cart = Session::get('cart');
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone_number = $request->phone;
            $customer->note = $request->notes;
            $customer->save();

            $bill = new Bill;
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->payment_method;
            $bill->note = $request->notes;
            $bill->save();

            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail;
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity =  $value['qty'];
                $bill_detail->unit_price = ($value['price'] / $value['qty']);
                $bill_detail->save();
            }
        } else { //nếu thanh toán là vnpay
            $cart = Session::get('cart');
            return view('/vnpay/vnpay-index', compact('cart'));
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao', 'Đặt hàng thành công');
    }

    //hàm xử lý nút Xác nhận thanh toán trên trang vnpay-index.blade.php, hàm này nhận request từ trang vnpay-index.blade.php
    public function createPayment(Request $request)
    {
        $cart = Session::get('cart');
        $vnp_TxnRef = $request->transaction_id; //Mã giao dịch. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_Amount = str_replace(',', '', $cart->totalPrice * 100);
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


        $vnpay_Data = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => route('vnpayReturn'),
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $vnpay_Data['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($vnpay_Data);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($vnpay_Data as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASHSECRECT')) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            //$vnpSecureHash = hash('sha256', env('VNP_HASHSECRECT'). $hashdata);
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, env('VNP_HASHSECRECT')); //  
            // $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        //dd($vnp_Url);
        return redirect($vnp_Url);
        die();
    }

    //ham nhan get request tra ve tu vnpay
    public function vnpayReturn(Request $request)
    {
        //dd($request->all());
        // if($request->vnp_ResponseCode=='00'){
        //     $secureHash = $request->query('vnp_SecureHash');
        //     if ($secureHash == env('VNP_HASHSECRECT')) {
        //      $cart=Session::get('cart');

        //      //lay du lieu vnpay tra ve
        //      $vnpay_Data=$request->all();

        //      //insert du lieu vao bang payments
        //      //.........

        //     //truyen vnpay_Data vao trang vnpay_return
        //     return view('vnpay_return',compact('vnpay_Data'));
        //     }
        // }
        //PHIEEN BAN 2022
        $vnp_SecureHash = $request->vnp_SecureHash;
        //echo $vnp_SecureHash;
        $vnpay_Data = array();
        foreach ($request->query() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $vnpay_Data[$key] = $value;
            }
        }

        unset($vnpay_Data['vnp_SecureHash']);
        ksort($vnpay_Data);
        $i = 0;
        $hashData = "";
        foreach ($vnpay_Data as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRECT'));
        // echo $secureHash;


        if ($secureHash == $vnp_SecureHash) {
            if ($request->query('vnp_ResponseCode') == '00') {
                $cart = Session::get('cart');
                //lay du lieu vnpay tra ve
                $vnpay_Data = $request->all();

                //insert du lieu vao bang payments
                //.........

                //truyen vnpay_Data vao trang vnpay_return
                return view('/vnpay/vnpay-return', compact('vnpay_Data'));
            }
        }
    }

    public function getLogin()
    {
        return view('banhang.login');
    }

    public function getSignup()
    {
        return view('banhang.signup');
    }
    public function postSignup(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'fullname' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'email.unique' => 'Email đã có người sử dụng',
                'password.required' => 'Vui long nhập mật khẩu',
                're_password.same' => 'Mật khẩu không giống nhau',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự'

            ]
        );
        $user = new User();
        $user->full_name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');
    }

    public function postLogin(Request $req)
    {
        $this->validate(
            $req,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 kí tự',
                'password.max' => 'Mật khẩu không quá 20 kí tự',

            ]
        );

        $credentials = array('email' => $req->email, 'password' => $req->password);
        if (Auth::attempt($credentials)) {
            return redirect()->back()->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }
    public function postLogout()
    {
        Auth::logout();
        return redirect()->route('banhang.index');
    }
}
