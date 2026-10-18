<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Str;
use File;
use DB;
use Session;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Media;
use App\Models\Attribute;
use App\Models\PostAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    //Products use the Services permissions
    private function allPer(){
      return empty(json_decode(Auth::user()->permission->permission, true)['services']['all']);
    }

    // Products Management Function

    public function products(Request $r){

      $allPer = $this->allPer();
      // Filter Action Start

      if($r->action){
        if($r->checkid){

        $datas=Post::latest()->where('type',2)->whereIn('id',$r->checkid)->get();

        foreach($datas as $data){

          if($allPer && $data->addedby_id!=Auth::id()){
            // You are unauthorized Try!!
          }else{

            if($r->action==1){
              $data->status='active';
              $data->save();
            }elseif($r->action==2){
              $data->status='inactive';
              $data->save();
            }elseif($r->action==3){
              $data->fetured=true;
              $data->save();
            }elseif($r->action==4){
              $data->fetured=false;
              $data->save();
            }elseif($r->action==5){
              $this->deleteProduct($data);
            }

          }

        }

        Session()->flash('success','Action Successfully Completed!');

        }else{
          Session()->flash('info','Please select at least one product');
        }

        return redirect()->back();
      }

      //Filter Action End

      $products =Post::latest()->where('type',2)->where('status','<>','temp')
        ->where(function($q) use ($r,$allPer) {

            if($r->search){
                $q->where('search_key','LIKE','%'.$r->search.'%');
            }

            if($r->startDate || $r->endDate)
            {
                $from =$r->startDate?:Carbon::now()->format('Y-m-d');
                $to =$r->endDate?:Carbon::now()->format('Y-m-d');
                $q->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to);
            }

            if($r->status){
             $q->where('status',$r->status);
            }

            // Check Permission
            if($allPer){
             $q->where('addedby_id',auth::id());
            }

        })
        ->select(['id','name','slug','view','type','tags','created_at','addedby_id','status','fetured'])
        ->paginate(25)->appends([
          'search'=>$r->search,
          'status'=>$r->status,
          'startDate'=>$r->startDate,
          'endDate'=>$r->endDate,
        ]);

        //Total Count Results
        $totals = DB::table('posts')
        ->where('type',2)->where('status','<>','temp')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when status = 'active' then 1 end) as active")
        ->selectRaw("count(case when status = 'inactive' then 1 end) as inactive")
        ->first();

        return view(adminTheme().'products.productsAll',compact('products','totals'));
    }

    public function productsAction(Request $r,$action,$id=null){

        //Add Product Start
        if($action=='create'){

          $product =Post::where('type',2)->where('status','temp')->where('addedby_id',Auth::id())->first();
          if(!$product){
            $product =new Post();
            $product->type =2;
            $product->status ='temp';
            $product->addedby_id =Auth::id();
          }
          $product->created_at =Carbon::now();
          $product->save();

          return redirect()->route('admin.productsAction',['edit',$product->id]);
        }
        //Add Product End

        $product =Post::where('type',2)->find($id);
        if(!$product){
        Session()->flash('error','This Product Was Not Found');
        return redirect()->route('admin.products');
        }

        //Check Authorized User
        if($this->allPer() && $product->addedby_id!=Auth::id()){
          Session()->flash('error','You are unauthorized Try!!');
          return redirect()->route('admin.products');
        }

        //Update Product Start
        if($action=='update'){

            $r->validate([
                'name' => 'required|max:191',
                'link' => 'nullable|url|max:500',
                'seo_title' => 'nullable|max:200',
                'seo_description' => 'nullable|max:250',
                'categoryid.*' => 'nullable|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'gallery_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $product->name=$r->name;
            $product->short_description=$r->short_description;
            // Projects: live site link is stored in the (otherwise unused) "tags" column
            $product->tags=$r->link?:null;
            $product->description=$r->description;
            $product->seo_title=$r->seo_title;
            $product->seo_description=$r->seo_description;
            $product->seo_keyword=$r->seo_keyword;

            ///////Image Upload Start////////////
            if($r->hasFile('image')){
              uploadFile($r->image,$product->id,1,1);
            }
            ///////Image Upload End////////////

            ///////Gallery Upload Start////////////
            $files=$r->file('gallery_image');
            if($files){
                foreach($files as $file){
                    uploadFile($file,$product->id,1,3,Auth::id(),false);
                }
            }
            ///////Gallery Upload End////////////

            $slug =Str::slug($r->name);
            if($slug==null){
              $product->slug=$product->id;
            }else{
              if(Post::where('type',2)->where('slug',$slug)->whereNotIn('id',[$product->id])->count() >0){
                $product->slug=$slug.'-'.$product->id;
              }else{
                $product->slug=$slug;
              }
            }
            if($r->created_at){
              $product->created_at =$r->created_at;
            }
            $product->status =$r->status?'active':'inactive';
            $product->fetured =$r->fetured?1:0;
            $product->editedby_id =Auth::id();
            $product->save();

            //Category products
            if($r->categoryid){

              $product->productCtgs()->whereNotIn('reff_id',$r->categoryid)->delete();

              for ($i=0; $i < count($r->categoryid); $i++) {
                $ctg = $product->productCtgs()->where('reff_id',$r->categoryid[$i])->first();
                if(!$ctg){
                  $ctg =new PostAttribute();
                  $ctg->src_id=$product->id;
                  $ctg->reff_id=$r->categoryid[$i];
                  $ctg->type=3;
                }
                $ctg->drag=$i;
                $ctg->save();
              }

            }else{
              $product->productCtgs()->delete();
            }

            ///////Search Key Start////////
            $key=$product->name;
            foreach($product->productCategories()->get() as $ctg){
                $key.=' '.$ctg->name;
            }
            $product->search_key=Str::limit($key,450);
            $product->save();
            ///////Search Key End////////

            Session()->flash('success','Your Are Successfully Done');
            return redirect()->back();

        }
        //Update Product End

        //Delete Product Start
        if($action=='delete'){
            $this->deleteProduct($product);
            Session()->flash('success','Your Are Successfully Done');
            return redirect()->back();
        }
        //Delete Product End

        $categories =Attribute::where('type',10)->where('status','<>','temp')->where('parent_id',null)->get();

        return view(adminTheme().'products.productsEdit',compact('product','categories'));
    }

    private function deleteProduct($product){
        $medias =Media::latest()->where('src_type',1)->where('src_id',$product->id)->get();
        foreach($medias as $media){
          foreach(['file_url','file_url_sm','file_url_md','file_url_lg'] as $col){
            if($media->$col && File::exists($media->$col)){
              File::delete($media->$col);
            }
          }
          $media->delete();
        }

        $product->productCtgs()->delete();
        $product->delete();
    }

    // Products Management Function End


    //Product Category Function
    public function productsCategories(Request $r){

      $allPer = $this->allPer();
      // Filter Action Start

      if($r->action){
        if($r->checkid){

        $datas=Attribute::where('type',10)->whereIn('id',$r->checkid)->get();

        foreach($datas as $data){

          if($allPer && $data->addedby_id!=Auth::id()){
            // You are unauthorized Try!!
          }else{

            if($r->action==1){
              $data->status='active';
              $data->save();
            }elseif($r->action==2){
              $data->status='inactive';
              $data->save();
            }elseif($r->action==3){
              $data->fetured=true;
              $data->save();
            }elseif($r->action==4){
              $data->fetured=false;
              $data->save();
            }elseif($r->action==5){
              $this->deleteCategory($data);
            }

          }

        }

        Session()->flash('success','Action Successfully Completed!');

        }else{
          Session()->flash('info','Please Need To Select Minimum One Category');
        }

        return redirect()->back();
      }

      //Filter Action End

      $categories =Attribute::latest()->where('type',10)->where('status','<>','temp')
      ->where(function($q) use ($r,$allPer) {

            if($r->search){
                $q->where('name','LIKE','%'.$r->search.'%');
            }

            if($r->status){
               $q->where('status',$r->status);
            }

           // Check Permission
            if($allPer){
             $q->where('addedby_id',auth::id());
            }

      })
      ->select(['id','name','slug','parent_id','view','type','created_at','addedby_id','status','fetured'])
      ->paginate(25)->appends([
        'search'=>$r->search,
        'status'=>$r->status,
      ]);

      //Total Count Results
      $totals = DB::table('attributes')
      ->where('type',10)->where('status','<>','temp')
      ->selectRaw('count(*) as total')
      ->selectRaw("count(case when status = 'active' then 1 end) as active")
      ->selectRaw("count(case when status = 'inactive' then 1 end) as inactive")
      ->first();

      return view(adminTheme().'products.category.productsCategories',compact('categories','totals'));
    }

    public function productsCategoriesAction(Request $r,$action,$id=null){

        //Add Product Category Start
        if($action=='create'){

            $category =new Attribute();
            $category->type =10;
            $category->status ='temp';
            $category->addedby_id =Auth::id();
            $category->save();

            return redirect()->route('admin.productsCategoriesAction',['edit',$category->id]);
        }
        //Add Product Category End

        $category =Attribute::where('type',10)->find($id);
        if(!$category){
        Session()->flash('error','This Category Are Not Found');
        return redirect()->route('admin.productsCategories');
        }

        //Check Authorized User
        if($this->allPer() && $category->addedby_id!=Auth::id()){
        Session()->flash('error','You are unauthorized Try!!');
        return redirect()->route('admin.productsCategories');
        }

        //Update Product Category Start
        if($action=='update'){

            $r->validate([
                'name' => 'required|max:191',
                'seo_title' => 'nullable|max:200',
                'seo_description' => 'nullable|max:250',
                'parent_id' => 'nullable|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $category->name=$r->name;
            $category->description=$r->description;
            $category->seo_title=$r->seo_title;
            $category->seo_description=$r->seo_description;
            $category->seo_keyword=$r->seo_keyword;
            if($r->parent_id!=$category->id){
              $category->parent_id=$r->parent_id?:null;
            }

            ///////Image Upload////////////
            if($r->hasFile('image')){
                uploadFile($r->image,$category->id,3,1);
            }

            ///////Banner Upload////////////
            if($r->hasFile('banner')){
                uploadFile($r->banner,$category->id,3,2);
            }

            $slug =Str::slug($r->name);
            if($slug==null){
              $category->slug=$category->id;
            }else{
              if(Attribute::where('type',10)->where('slug',$slug)->whereNotIn('id',[$category->id])->count() >0){
                $category->slug=$slug.'-'.$category->id;
              }else{
                $category->slug=$slug;
              }
            }
            $category->view =(int) $r->view;
            $category->status =$r->status?'active':'inactive';
            $category->fetured =$r->fetured?1:0;
            $category->editedby_id =Auth::id();
            $category->save();

            Session()->flash('success','Your Are Successfully Done');
            return redirect()->back();
        }
        //Update Product Category End

        //Delete Product Category Start
        if($action=='delete'){
            $this->deleteCategory($category);
            Session()->flash('success','Your Are Successfully Done');
            return redirect()->back();
        }
        //Delete Product Category End

        $parents =Attribute::where('type',10)->where('status','<>','temp')->where('parent_id',null)->get();
        return view(adminTheme().'products.category.productsCategoryEdit',compact('category','parents'));
    }

    private function deleteCategory($category){
        $medias =Media::latest()->where('src_type',3)->where('src_id',$category->id)->get();
        foreach($medias as $media){
          if(File::exists($media->file_url)){
            File::delete($media->file_url);
          }
          $media->delete();
        }

        //Sub Category move to parent
        foreach($category->subCtgs as $subctg){
          $subctg->parent_id=$category->parent_id;
          $subctg->save();
        }

        $category->ctgProducts()->delete();
        $category->delete();
    }

    //Product Category Function End

}
