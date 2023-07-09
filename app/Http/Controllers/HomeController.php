<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\product\Category;
use App\models\product\Product;
use App\models\blog\Blog;
use Session;
use App\models\website\Partner;
use App\models\blog\BlogCategory;
use App\models\BannerAds;
use App\models\product\ProductCombo;
use App\models\product\TypeProduct;
use App\models\Promotion;
use  App\models\ReviewCus;
use App\models\website\Banner;
use App\models\website\Prize;
use App\models\website\Video;

class HomeController extends Controller
{
    public function home()
    {
        $data['bannerAds'] = BannerAds::where('status',1)->first(['name','image','id']);
        $data['comboPro'] = ProductCombo::where(['status'=>1])->get(['id', 'name', 'slug', 'link', 'image'])->map(function ($query) {
            $query->setRelation('products', $query->products);
            return $query;
        });
        $data['videos'] = Video::where(['status'=>1])->get();
        $data['flashSale'] = Product::where(['status'=>1,'discountStatus'=>1])->where('discount','>',0)->orderBy('id','DESC')->get(['id','category','name','discount','price','images','slug','cate_slug','type_slug', 'discountStatus','origin','hang_muc']);
        $data['cateHome'] = Category::with([
            'typeCate' => function ($query) {
                $query->where('status',1)->orderBy('id','DESC')->select('cate_id','id', 'name','avatar','slug','cate_slug');
            }
        ])->where(['quiz_id'=>1])->orderBy('id','ASC')->get(['id','quiz_id','name','home_title','avatar','slug','path_1','banner_1','path_2','banner_2'])->map(function ($query) {
            $query->setRelation('products', $query->products);
            return $query;
        });
        $data['categorySpecial'] = Category::all();
        $data['homeCateBlog'] = BlogCategory::where(['status'=>1, 'home_status'=>1])
        ->orderBy('id','desc')->limit(2)
        ->get(['id','name','slug','avatar'])->map(function ($query) {
            $query->setRelation('listBlog', $query->listBlog->where('status',1)->where('home_status',1)->take(5));
            return $query;
        });;
        $data['typeCateHome'] = TypeProduct::where(['status'=>1, 'quiz_id'=>1])->get();
        return view('home',$data);
    }
}
