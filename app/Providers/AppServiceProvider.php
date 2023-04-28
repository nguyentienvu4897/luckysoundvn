<?php

namespace App\Providers;

use App\models\blog\Blog;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Session,View;
use App\models\website\Setting;
use App\models\website\Banner;
use Cart,Auth;
use App\models\PageContent;
use Laravel\Dusk\DuskServiceProvider;
use App\models\product\Category;
use App\models\language\Language;
use App\models\Province;
use App\models\Services;
use App\models\Promotion;
use App\models\blog\BlogCategory;
use App\models\website\Partner;
use App\models\website\Prize;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            if(Auth::guard('customer')->user() != null){
                $profile = Auth::guard('customer')->user();
            }else{
                $profile = "";
            }
            $language_current = Session::get('locale');
            $promotion = Promotion::where('status',1)->orderBy('id','asc')->get();
            $servicehome = Services::where('status',1)->orderBy('id','DESC')->get();
            $setting = Setting::first();
            $lang = Language::get();
            $chiNhanh = Partner::where(['status'=>1])->get();
            $categoryhome = Category::with([
                'typeCate' => function ($query) {
                    $query->with(['typetwo'])->where('status',1)->orderBy('id','DESC')->select('cate_id','id', 'name','avatar','slug','cate_slug'); 
                }
            ])->where('status',1)->orderBy('id','ASC')->get(['id','quiz_id','name','home_title','avatar','slug'])->map(function ($query) {
                $query->setRelation('products', $query->products->take(10));
                return $query;
            });
            $bannerSmall = Banner::where(['status'=>2])->get(['id','image','link','title','description']);
            $banners = Banner::where(['status'=>1])->get(['id','image','link','title','description']);
            $cartcontent = session()->get('cart', []);
            $viewold = session()->get('viewoldpro', []);
            $compare = session()->get('compareProduct', []);
            $blogCate = BlogCategory::with([
                'typeCate' => function ($query){
                    $query->select('id','slug','name','avatar','category_slug');
                },
                'listBlog' => function ($query) {
                    $query->where(['status'=>1])->select();
                }
            ])
            ->where('status',1)
            ->orderBy('id','desc')
            ->get(['id','name','slug','avatar']);
            $helpCus = PageContent::where(['status'=>1, 'language'=>'vi','type'=>'ho-tro-khanh-hang'])->get(['id','title','slug', 'type']);
            $aboutUsMenu = PageContent::where(['status'=>1, 'language'=>'vi','type'=>'ve-chung-toi'])->first(['id','title','slug', 'type']);
            $partner = Partner::where(['status'=>1])->get(['id','image','name','link']);
            $homeBlog = Blog::where(['status'=>1, 'home_status'=>1])->get();
            $view->with([
                'promotion' => $promotion,
                'setting' => $setting,
                'lang' => $lang,
                'banners'=>$banners,
                'profile' =>$profile,
                'categoryhome'=> $categoryhome,
                'cartcontent'=>$cartcontent,
                'viewold'=>$viewold,
                'compare'=>$compare,
                'blogCate'=>$blogCate,
                'servicehome'=>$servicehome,
                'bannerSmall'=>$bannerSmall,
                'helpCus'=>$helpCus,
                'partner'=>$partner,
                'aboutUsMenu'=>$aboutUsMenu,
                'chiNhanh'=>$chiNhanh,
                'homeBlog'=>$homeBlog
                ]);    
        });  
    }
}
