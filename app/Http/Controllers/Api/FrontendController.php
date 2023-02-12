<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use App\Model\Campaign;
use App\Model\Vendor;
use App\Model\Logo;
use App\Model\Shipping;
use App\Model\Brand;
use App\Model\Rating;
use App\Model\Product;
use App\Model\Category;
use App\User;
use App\Model\SubCategory;
use Illuminate\Http\Request;
use App\Model\Advertise;


class FrontendController extends Controller
{
    public function slider(){
        return response()->json(Slider::get(), 200);
    }
    
    
     public function banners(){
        return response()->json(Campaign::whereNotIn('type',['link1','link2'])->get(), 200);
        
    }
    
    
     public function vendors(){
         
        $vendors = vendor::where('s_status',1)->get();
       
        return response()->json($vendors, 200);
        
    }
    

    public function shipping(){
      return Shipping::where('status','=',1)->get();
    }
    
    
    public function search(Request $req){
        
           $products = Product::with('ratings')->whereHas('vendor',function($q){$q->where('s_status',1);})->where('name','LIKE','%'.$req->search.'%')->where('status',1)->get();

            $brands = Brand::whereHas('products',function($q){$q->where('status',1);})->where('name','LIKE','%'.$req->search.'%')->where('status',1)->get();
            
            $vendors = Vendor::whereHas('products',function($q){$q->where('status',1);})->where('shop_name','LIKE','%'.$req->search.'%')->where('s_status',1)->get();
            
        
            return response()->json(['products'=>$products,'brands'=>$brands,'vendors'=>$vendors],200);
    }
    
     public function socialLogin(Request $request){
         
         $user = User::where('email', $request->email)->first();
         
         if(!$user){
             
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $request->photo;
            $user->social_id = $request->social_id;
            $user->status = '1';
            $user->password= bcrypt(uniqid());
            $user->save();
            
             $user = User::where('email', $request->email)->first();
            
         }
         
           $token = $user->createToken('auth_token')->plainTextToken;
            
           return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user'=>$user
        ]);
    }
    
    
    public function categoryProduct(Request $request){
       $products = Product::with('ratings')
       
       ->when($request->category_id, function($q) use($request){
           $q->where('category_id', $request->category_id);
           
       })
       ->when($request->subcategory_id, function($q) use($request){
           $q->where('subcategory_id', $request->subcategory_id);
           
       })
       ->when($request->childcategory_id, function($q) use($request){
           $q->where('childcategory_id', $request->childcategory_id);
       })
       ->paginate();
       
       return response()->json($products, 200);
    }
    
    public function vendorProduct(Request $request){
       $vendors = Product::with('ratings')->where('vendor_id', $request->vendor_id)->paginate();
       
       return response()->json($vendors, 200);
    }
    
    
    public function review(Request $req){
       $user = auth('sanctum')->user();
       
      
      
        if ($req->product_id){
            $product = Product::whereId($req->product_id)->first();
            $vendor_id = $product->vendor_id;
            
        }
        
        $rating = new Rating;
        $rating->product_id = $req->product_id;
        $rating->vendor_id = $vendor_id;
        $rating->review = $req->comment;
        $rating->rating = $req->review;
        $rating->user_id = $user->id;
        $rating->name = $user->name;
        if($user->email != null){
            $rating->email = $user->email;
        }
        
        $existingReview=Rating::where('user_id',$user->id)->where('product_id', $req->product_id)->first();
        if($existingReview){
             return response()->json('You already comment on this product',400);
        }else{
            $rating->save();
        }


        $reviews = Rating::where('product_id',$req->product_id)->get();

        if (sizeof($reviews) > 0){
              $ratingCount = $reviews->count();
              $sum = $reviews->sum('rating');
              $avg_rating = $sum/$ratingCount;
        }
        else{
              $ratingCount = 0;
              $avg_rating = 0;
        }
        // return $avg_rating;
        $product = Product::with('ratings')->find($req->product_id);
        $product->avg_rating = $avg_rating;
        $product->save();


        return response()->json($product, 200);
        
    }
    
    public function relatedProduct(Request $request){
        
    $productDetails= Product::where('id',$request->id)->first();
        
    $relatedProducts = Product::with('ratings')->whereHas('vendor',function($q){$q->where('s_status',1);})->where('category_id',$productDetails->category_id)->limit(10)->get();

     return response()->json($relatedProducts, 200);
    }
    
      public function subcategory(){
           $SubCategory = SubCategory::where('status',1)->get();
           return response()->json($SubCategory, 200); 
          
      }
      
      public function recommended(Request $request){
          if($request->limit == 0){
            $recommended = Product::where('offer_product',1)->latest()->get();
          }else{
             $recommended = Product::where('offer_product',1)->latest()->take($request->limit)->get();
          }
           return response()->json($recommended, 200); 
          
      }
      
       public function trending(Request $request){
           
            if($request->limit == 0){
                    $trending = Product::where('trending',1)->latest()->get();
            }else{
                $trending = Product::where('trending',1)->latest()->take($request->limit)->get();
            }
           return response()->json($trending, 200); 
          
      }
      
       public function featured(Request $request){
            if($request->limit == 0){
                $featured = Product::where('featured',1)->latest()->get();
            }else{
                $featured = Product::where('featured',1)->latest()->take($request->limit)->get();
            }
            
           return response()->json($featured, 200); 
          
      }
        public function topselling(Request $request){
            if($request->limit == 0){
                
                $topselling = Product::where('top',1)->latest()->get();
                
            }else{
                
                 $topselling = Product::where('top',1)->latest()->take($request->limit)->get();
            }
           return response()->json($topselling, 200); 
          
      }
      
       public function latest(Request $request){
           if($request->limit == 0){
                $latest = Product::orderBy("id",'DESC')->latest()->get();
               
           }else{
               $latest = Product::orderBy("id",'DESC')->latest()->take($request->limit)->get();
           }
           return response()->json($latest, 200); 
          
      }
       public function subcategorywithproduct(){
           
           $latest = Category::with('sub_categories')->where('status', true)->get();
           return response()->json($latest, 200); 
          
      }
      
      public function advertisement(Request $request){
         $ad = Advertise::where('resolution', $request->size)->where('status', 1)->inRandomOrder()->first();
         
         return $ad;
      }
      
      public function productDetails(Request $request){
          $product = Product::with('ratings')->findOrFail($request->product_id);
          
          return $product;
      }
      
      public function appVersion(){
          $version=Logo::where('type','version')->first();
          
          return $version;
      }
      
      public function myPlace(Request $request){
           $user = auth('sanctum')->user();

        if(!$user){
            return response()->json('please login', 201);
        }

        $user->my_place = $request->address;

        $user->save();
        
        
        return response()->json($user, 200);


      }
     
    
    
    
}