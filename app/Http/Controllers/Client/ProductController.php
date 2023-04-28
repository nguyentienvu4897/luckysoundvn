<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use App\models\product\Category;
use App\models\blog\Blog;
use App\models\product\TypeProduct;
use App\models\construction\Construction;
use App\models\product\ProductBrands;
use App\models\product\ProductCombo;
use  App\models\product\TypeProductTwo;
use App\models\Promotion;
use Session;

class ProductController extends Controller
{
    public function suggestProduct($slug)
    {
        $data['suggest'] = Promotion::where(['slug' => $slug, 'status' =>1])->first(['id','name','slug','link','image']);
        $data['suggest_id'] = $data['suggest']->id;
        $data['brands'] = ProductBrands::where('status', 1)->get();
        $data['list'] = Product::where(['promotion_id'=>$data['suggest_id']])->orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','origin','hang_muc')
        ->paginate(20);
        $data['title'] = $data['suggest']->name;
        return view('product.list',$data);
    }

    public function allProductCombo($slug)
    {
        $data['combo'] = ProductCombo::where(['slug' => $slug, 'status' =>1])->first(['id','name','slug','link']);
        $data['combo_id'] = $data['combo']->id;
        $data['brands'] = ProductBrands::where('status', 1)->get();
        $data['list'] = Product::where(['combo_id'=>$data['combo_id']])->orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','origin','hang_muc')
        ->paginate(20);
        $data['title'] = $data['combo']->name;
        return view('product.list',$data);
    }

    public function flashSale()
    {
        $data['brands'] = ProductBrands::where('status', 1)->get();
        $data['list'] = Product::where(['status'=>1,'discountStatus'=>1])->where('discount','>',0)->orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','origin','hang_muc')
        ->paginate(20);
        $data['title'] = 'Flash sale';
        return view('product.list',$data);
    }

    public function allProduct()
    {
        $data['list'] = Product::orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','origin','hang_muc')
        ->paginate(20);
        $data['title'] = "Tất cả sản phẩm";
        $data['content'] = 'none';
        $data['brands'] = ProductBrands::where('status', 1)->get();
        return view('product.list',$data);
    }

    public function allListCate($cate)
    {
        $data['list'] = Product::where(['cate_slug'=>$cate])
        ->orderBy('id','DESC')
        ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','origin','hang_muc')
        ->paginate(20);
        $data['cateno'] = Category::where('slug',$cate)->first(['id','name','avatar','content','slug']);
        $data['types'] = TypeProduct::where(['status'=>1, 'cate_slug'=>$cate])->get(['id','name','slug','cate_slug']);
        $cate_id = $data['cateno']->id;
        $data['cate_id'] = $cate_id;
        $allBrands = ProductBrands::where('status', 1)->get();
        $listBrand = [];
        foreach ($allBrands as $key => $brand) {
            foreach (json_decode($brand->cate_id) as $key => $cate) {
                if ($cate == $cate_id) {
                    $listBrand[] = $brand;
                }
            }
        }
        $data['brands'] = $listBrand;
        $data['title'] = languageName($data['cateno']->name);
        $data['content'] = $data['cateno']->content;
        return view('product.list',$data);
    }

    public function allListType($cate,$type){
        $data['list'] = Product::where(['cate_slug'=>$cate,'type_slug'=>$type])
        ->orderBy('id','DESC')
        ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','origin','hang_muc')
        ->paginate(20);
        $data['pronew'] = Product::where('status',1)->orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug')
        ->paginate(5);
        $data['cateno'] = Category::where('slug',$cate)->first(['id','name','avatar','content','slug']);
        $data['types'] = TypeProduct::where(['status'=>1, 'cate_slug'=>$cate])->get(['id','name','slug','cate_slug']);
        $data['type'] = TypeProduct::where('slug',$type)->first(['id','name','cate_id','content']);
        $data['type_id'] = $data['type']->id;
        $cate_id = $data['type']->cate_id;
        $allBrands = ProductBrands::where('status', 1)->get();
        $listBrand = [];
        foreach ($allBrands as $key => $brand) {
            foreach (json_decode($brand->cate_id) as $key => $cate) {
                if ($cate == $cate_id) {
                    $listBrand[] = $brand;
                }
            }
        }
        $data['brands'] = $listBrand;
        $data['title'] = languageName($data['cateno']->name).' / '.languageName($data['type']->name);
        $data['content'] = $data['type']->content;
        return view('product.list',$data);
    }

    public function allListTypeTwo($danhmuc,$loaidanhmuc,$thuonghieu){
        $data['list'] = Product::where(['status'=>1,'cate_slug'=>$danhmuc,'type_slug'=>$loaidanhmuc,'type_two_slug'=>$thuonghieu])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description','origin','hang_muc')
            ->paginate(12);
        $data['type'] = TypeProductTwo::where('slug',$thuonghieu)->first(['id','name','cate_id','content']);
        // $cate_id = $data['type']->cate_id;
        // $data['typeCate'] = TypeProduct::where([
        //     ['status', '=', 1],
        //     ['cate_id', '=',$cate_id]
        // ])->orderBy('id','DESC')
        // ->get(['cate_id','id', 'name','avatar']);
        $data['title'] = languageName($data['type']->name);
        $data['content'] = $data['type']->content;
        return view('product.list',$data);
    }
    public function CateProList($cate)
    {
        $data['list'] = Product::with('customer','cate')
        ->where('category',$cate)
        ->orderBy('id','ASC')
        ->paginate(12);
        $data['cate'] = Category::where('id',$cate)->first();
        return view('product.list',$data);
    }
    public function TypeProList($type)
    {
        $data['list'] = Product::with('customer','cate')
        ->where('type_cate',$type)
        ->orderBy('id','ASC')
        ->paginate(12);
        $cate = TypeProduct::where('id',$type)->first();
        $data['title_page'] = languageName($cate->name);
        return view('product.list',$data);
    }
    public function getproajax(Request $request)
    {
        if($request->cate == "all"){
            $product = Product::where([
                ['status', '=', 1]
            ])->limit(9)->orderBy('id','ASC')->get(['id','name','discount','price','images']);
        }else{
            $product =  Product::where(['status'=>1,'category'=>$request->cate])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images')
            ->get();
        }
        $view = view("layouts.product.getproajax",compact('product'))->render();
        return response()->json(['html'=>$view]);
    }
    public function filterProduct(Request $request)
    {
        $product = Product::query()->where('status',1);
        if($request->cate != null){
            if(isset($request->price)){
                if($request->price == '2'){
                    $product = $product->where('category',$request->cate)->where('price', '<', 2000000);
                }elseif($request->price == '2-5'){
                    $product = $product->where('category',$request->cate)->whereBetween('price', [2000000, 5000000]);
                }elseif($request->price == '5-10'){
                    $product = $product->where('category',$request->cate)->whereBetween('price', [5000000, 10000000]);
                }elseif($request->price == '10-20'){
                    $product = $product->where('category',$request->cate)->whereBetween('price', [10000000, 20000000]);
                }elseif($request->price == '20-35'){
                    $product = $product->where('category',$request->cate)->whereBetween('price', [20000000, 35000000]);
                }elseif($request->price == '35-50'){
                    $product = $product->where('category',$request->cate)->whereBetween('price', [35000000, 50000000]);
                }elseif($request->price == '50-80'){
                    $product = $product->where('category',$request->cate)->whereBetween('price', [50000000, 80000000]);
                }
                else{
                    $product = $product->where('category',$request->cate)->where('price', '>', 80000000);
                }
            }
            if(isset($request->sortby)){
                if($request->sortby == 'created-asc'){
                    $product = $product->where('category',$request->cate)->orderBy('id','desc');
                }elseif($request->sortby == 'default'){
                    $product = $product->where('category',$request->cate)->orderBy('id','asc');
                }elseif($request->sortby == 'price-desc'){
                    $product = $product->where('category',$request->cate)->orderBy('price','desc');
                }elseif($request->sortby == 'price-asc'){
                    $product = $product->where('category',$request->cate)->orderBy('price','asc');
                }
            }
            if(isset($request->brand)){
                $product = $product->where('category',$request->cate)->where('brand_id',$request->brand);
            }
        }elseif($request->type != null){
            if(isset($request->price)){
                if($request->price == '2'){
                    $product = $product->where('type_cate',$request->type)->where('price', '<', 2000000);
                }elseif($request->price == '2-5'){
                    $product = $product->where('type_cate',$request->type)->whereBetween('price', [2000000, 5000000]);
                }elseif($request->price == '5-10'){
                    $product = $product->where('type_cate',$request->type)->whereBetween('price', [5000000, 10000000]);
                }elseif($request->price == '10-20'){
                    $product = $product->where('type_cate',$request->type)->whereBetween('price', [10000000, 20000000]);
                }elseif($request->price == '20-35'){
                    $product = $product->where('type_cate',$request->type)->whereBetween('price', [20000000, 35000000]);
                }elseif($request->price == '35-50'){
                    $product = $product->where('type_cate',$request->type)->whereBetween('price', [35000000, 50000000]);
                }elseif($request->price == '50-80'){
                    $product = $product->where('type_cate',$request->type)->whereBetween('price', [50000000, 80000000]);
                }
                else{
                    $product = $product->where('type_cate',$request->type)->where('price', '>', 80000000);
                }
            }
            if(isset($request->sortby)){
                if($request->sortby == 'created-asc'){
                    $product = $product->where('type_cate',$request->type)->orderBy('id','desc');
                }elseif($request->sortby == 'default'){
                    $product = $product->where('type_cate',$request->type)->orderBy('id','asc');
                }elseif($request->sortby == 'price-desc'){
                    $product = $product->where('type_cate',$request->type)->orderBy('price','desc');
                }elseif($request->sortby == 'price-asc'){
                    $product = $product->where('type_cate',$request->type)->orderBy('price','asc');
                }
            }
            if(isset($request->brand)){
                $product = $product->where('type_cate',$request->type)->where('brand_id',$request->brand);
            }
        }elseif($request->combo != null) {
            if(isset($request->price)){
                if($request->price == '2'){
                    $product = $product->where('combo_id',$request->combo)->where('price', '<', 2000000);
                }elseif($request->price == '2-5'){
                    $product = $product->where('combo_id',$request->combo)->whereBetween('price', [2000000, 5000000]);
                }elseif($request->price == '5-10'){
                    $product = $product->where('combo_id',$request->combo)->whereBetween('price', [5000000, 10000000]);
                }elseif($request->price == '10-20'){
                    $product = $product->where('combo_id',$request->combo)->whereBetween('price', [10000000, 20000000]);
                }elseif($request->price == '20-35'){
                    $product = $product->where('combo_id',$request->combo)->whereBetween('price', [20000000, 35000000]);
                }elseif($request->price == '35-50'){
                    $product = $product->where('combo_id',$request->combo)->whereBetween('price', [35000000, 50000000]);
                }elseif($request->price == '50-80'){
                    $product = $product->where('combo_id',$request->combo)->whereBetween('price', [50000000, 80000000]);
                }
                else{
                    $product = $product->where('combo_id',$request->combo)->where('price', '>', 80000000);
                }
            }
            if(isset($request->sortby)){
                if($request->sortby == 'created-asc'){
                    $product = $product->where('combo_id',$request->combo)->orderBy('id','desc');
                }elseif($request->sortby == 'default'){
                    $product = $product->where('combo_id',$request->combo)->orderBy('id','asc');
                }elseif($request->sortby == 'price-desc'){
                    $product = $product->where('combo_id',$request->combo)->orderBy('price','desc');
                }elseif($request->sortby == 'price-asc'){
                    $product = $product->where('combo_id',$request->combo)->orderBy('price','asc');
                }
            }
            if(isset($request->brand)){
                $product = $product->where('combo_id',$request->combo)->where('brand_id',$request->brand);
            }
        }else {
            if(isset($request->price)){
                if($request->price == '2'){
                    $product = $product->where('promotion_id',$request->suggest)->where('price', '<', 2000000);
                }elseif($request->price == '2-5'){
                    $product = $product->where('promotion_id',$request->suggest)->whereBetween('price', [2000000, 5000000]);
                }elseif($request->price == '5-10'){
                    $product = $product->where('promotion_id',$request->suggest)->whereBetween('price', [5000000, 10000000]);
                }elseif($request->price == '10-20'){
                    $product = $product->where('promotion_id',$request->suggest)->whereBetween('price', [10000000, 20000000]);
                }elseif($request->price == '20-35'){
                    $product = $product->where('promotion_id',$request->suggest)->whereBetween('price', [20000000, 35000000]);
                }elseif($request->price == '35-50'){
                    $product = $product->where('promotion_id',$request->suggest)->whereBetween('price', [35000000, 50000000]);
                }elseif($request->price == '50-80'){
                    $product = $product->where('promotion_id',$request->suggest)->whereBetween('price', [50000000, 80000000]);
                }
                else{
                    $product = $product->where('promotion_id',$request->suggest)->where('price', '>', 80000000);
                }
            }
            if(isset($request->sortby)){
                if($request->sortby == 'created-asc'){
                    $product = $product->where('promotion_id',$request->suggest)->orderBy('id','desc');
                }elseif($request->sortby == 'default'){
                    $product = $product->where('promotion_id',$request->suggest)->orderBy('id','asc');
                }elseif($request->sortby == 'price-desc'){
                    $product = $product->where('promotion_id',$request->suggest)->orderBy('price','desc');
                }elseif($request->sortby == 'price-asc'){
                    $product = $product->where('promotion_id',$request->suggest)->orderBy('price','asc');
                }
            }
            if(isset($request->brand)){
                $product = $product->where('promotion_id',$request->suggest)->where('brand_id',$request->brand);
            }
        }
        
        $products = $product->get();
        $view = view("layouts.product.filter",compact('products'))->render();

        return response()->json(['html'=>$view]);
    }
    public function detail_product($cate,$slug)
    {
        $data['product'] = Product::with([
            'typeCate' => function ($query) {
                $query->select('id', 'name','avatar','slug'); 
            },
            'cate' => function ($query) {
                $query->where('status',1)->limit(5)->select('id','name','avatar','slug'); 
            },
        ])->where('slug',$slug)->first(['id','name','images','type_cate','category','sku','discount','price','content','size','description','slug','preserve','cate_slug','type_slug','species','thickness','origin', 'status', 'brand_id', 'type_cate']);
        $data['news'] = Blog::where('status',1)->limit(8)->get(['id','title','image','description','created_at','slug']);
        $data['productlq'] = Product::where(['cate_slug'=>$cate, 'status'=>1])->get(['id','name','images','discount','price','slug','cate_slug','type_slug','description','origin','hang_muc']);
        $viewoldpro = session()->get('viewoldpro', []);

        if(isset($viewoldpro[$slug])) {
            session()->put('viewoldpro', $viewoldpro);
        } else {
            $viewoldpro[$slug] = [
                "idpro" => $data['product']->id,
                "name" => $data['product']->name,
                "image" => json_decode($data['product']->images)[0],
                "cate_slug" => $data['product']->cate_slug,
                "type_slug" => $data['product']->type_slug,
                "slug" => $data['product']->slug, 
                "discount" => $data['product']->discount,
                "price" => $data['product']->price, 
            ];
        }
        
        session()->put('viewoldpro', $viewoldpro);
        return view('product.detail',$data);
    }
    public function compare(Request $request)
    {
//         $request->session()->flush();
// return;
        $id = $request->id;
        $data['product'] = Product::where('id',$id)->first(['id','name','images','category','discount','price','size']);
        $compare = session()->get('compareProduct', []);
        if(isset($compare[$id])) {
            session()->put('compareProduct', $compare);
            return response()->json([
                'message' => 'exist'
            ]);
        }
        else {
            if(empty($compare)){
                $compare[$id] = [
                    "idpro" => $id,
                    "name" => $data['product']->name,
                    "cate" => $data['product']->category,
                    "discount" => $data['product']->discount,
                    "price" => $data['product']->price,
                    "size" => $data['product']->size,
                    "image" => json_decode($data['product']->images)[0]
                ];
            }else{
                foreach($compare as $val){
                    if($data['product']->category != $val['cate']){
                        return response()->json([
                            'data'=> [],
                            'message' => 'error'
                        ]);
                    }
                }
                if(count($compare) == 3){
                    return response()->json([
                        'data'=> [],
                        'message' => 'limit3'
                    ]);
                }
                $compare[$id] = [
                    "idpro" => $id,
                    "name" => $data['product']->name,
                    "cate" => $data['product']->category,
                    "discount" => $data['product']->discount,
                    "price" => $data['product']->price,
                    "size" => $data['product']->size,
                    "image" => json_decode($data['product']->images)[0]
                ];
            }
            session()->put('compareProduct', $compare);
            $compareProduct = session()->get('compareProduct', []);
            
            return response()->json([
                'data'=> $compareProduct,
                'qty'=> count($compareProduct),
                'message' => 'success'
            ]);
            
        }
        
    }
    public function removeCompare(Request $request)
    {
        if($request->id) {
            $compare = session()->get('compareProduct');
            if(isset($compare[$request->id])) {
                unset($compare[$request->id]);
                session()->put('compareProduct', $compare);
            }
            $list = session()->get('compareProduct', []);
            $view = view("layouts.product.compare",compact('list'))->render();
            return response()->json(['html'=>$view]);
        }

        
    }
    public function compareList()
    {
        $data['list'] = session()->get('compareProduct', []);
        return view('compare.product',$data);
    }
    public function search_product(Request $request)
    {
        $language_current = Session::get('locale');
        $keyword = $request->keyword;
         $data['product'] = Product::where(['language'=>$language_current])
         ->where('name', 'LIKE', '%'.$keyword.'%')
         ->paginate(12);
         return view('product.search',$data);
    }

    public function ajaxTab(Request $request)
    {
        $id = $request->id;
        $data['suggest'] = Promotion::findOrFail($id);
        $data['products'] = Product::where(['status'=>1, 'promotion_id'=>$data['suggest']->id])->get();
        $html = view('layouts.product.getproajax', $data)->render();
        return response()->json(['html'=>$html]);
    }
    
}
