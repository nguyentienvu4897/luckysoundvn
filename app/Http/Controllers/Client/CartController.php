<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use Cart,Auth,Redirect,DB;
use App\models\Bill\BillDetail;
use App\models\Bill\Bill;
use App\models\website\Setting;

class CartController extends Controller
{
    public function checkout(){
        if (session()->has('cart')) {
            $data['cart'] = session()->get('cart', []);
            $data['profile'] = Auth::guard('customer')->user();
            return view('cart.checkout',$data);
        }else{
            return back();
        }
        
    }
    public function postBill(Request $request){
        $profile = Auth::guard('customer')->user();
        $cart = session()->get('cart', []);
        $code_bill = rand();
        $address = $request->billingAddress . ', ' . $request->billingAddress2 .', '. $request->billingAddress1;
        $data['webMail'] = Setting::first();
        DB::beginTransaction();
			try {
				$data['query'] = new Bill();
				$data['query']->code_bill = $code_bill;
				$data['query']->code_customer = $profile ? $profile->id : 0;
				$data['query']->total_money = $request->total_money;
				$data['query']->statu = 0;
				$data['query']->note = $request->note;
                $data['query']->cus_name = $request->billingName;
                $data['query']->cus_phone = $request->billingPhone;
                $data['query']->cus_email= $request->billingEmail;
                $data['query']->cus_address= $address;
                $data['query']->transport_price = $request->shippingMethod ? $request->shippingMethod : 0;
				$data['query']->save();
                $data['cart'] = $cart;
					
                foreach($cart as $key => $item){
                    $data['billdetail'] = new BillDetail();
                    $data['billdetail']->code_bill = $code_bill;
                    $data['billdetail']->code_product = $item['id'];
                    $data['billdetail']->name =languageName($item['name']);
                    $data['billdetail']->price = $item['price'];
                    $data['billdetail']->discount = $item['discount'];
                    $data['billdetail']->qty = $item['quantity'];
                    $data['billdetail']->images = $item['image'];
                    $data['billdetail']->save();
                }
				DB::commit();
                \Mail::send('cart.send-mail', $data, function($message) use ($data){
                    $message->to($data['webMail']['email'])
                            ->from($data['query']['cus_email'], $data['query']['cus_name'])
                            ->subject('#'.$data['query']['code_bill'].' - Đơn hàng cần kiểm tra ' . date('d-m-Y', strtotime(now())));
                });
                \Mail::send('cart.send-mail-customer', $data, function($message) use ($data){
                    $message->to($data['query']['cus_email'])
                            ->from($data['webMail']['email'], $data['webMail']['company'])
                            ->subject('Đặt hàng thành công từ website Luckysound.vn');
                });

                $request->session()->forget('cart');
                // return Redirect::to('/')->with('success', 'Gửi đơn hàng thành công');
                return view('cart.checkout-success', $data);
			} catch (\Throwable $e) {
			DB::rollBack();
			throw $e;
                return back()->with('error','Gửi đơn hàng thất bại');
			}
            

    }
    public function listCart(){
        $data['cart'] = session()->get('cart', []);
        return view('cart.list',$data);
    }
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($request->quantity)) {
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $request->quantity;
                $cart[$id]['type'] = $request->type;
            } else {
                $cart[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $request->quantity,
                    "price" => $product->price,
                    "discount" => $product->discount,
                    "cate_slug" => $product->cate_slug,
                    "type_slug" => $product->type_slug,
                    "slug"=>$product->slug,
                    "image" => json_decode($product->images)[0],
                    "type" =>$request->type,
                    "preserve" => $product->preserve
                ];
            }
        } else {
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                $cart[$id]['type'] = $request->type;
            } else {
                $cart[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "discount" => $product->discount,
                    "cate_slug" => $product->cate_slug,
                    "type_slug" => $product->type_slug,
                    "slug"=>$product->slug,
                    "image" => json_decode($product->images)[0],
                    "type" =>$request->type,
                    "preserve" => $product->preserve
                ];
            }
        }
        session()->put('cart', $cart);
        $data['cart'] = session()->get('cart',[]);
        $view = view('cart.count-cart', $data)->render();
        return response()->json([
            'html' => $view
        ]);
    }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            $data['cart'] = session()->get('cart',[]);
            $view = view('cart.list-cart-ajax', $data)->render();
            return response()->json([
                'html' => $view
            ]);
        }
        
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            $data['cart'] = session()->get('cart',[]);
            $view1 = view('cart.list-cart-ajax', $data)->render();
            $view2 = view('cart.count-cart', $data)->render();
            return response()->json([
                'html1'=>$view1,
                'html2'=>$view2,
            ]);
        }
    }

    public function removeAll()
    {
        $cart = session()->get('cart');
        session()->forget('cart', $cart);
        $data['cart'] = session()->get('cart',[]);
        $view1 = view('cart.list-cart-ajax', $data)->render();
        $view2 = view('cart.count-cart', $data)->render();
        return response()->json([
            'html1'=>$view1,
            'html2'=>$view2,
        ]);
    }
}
