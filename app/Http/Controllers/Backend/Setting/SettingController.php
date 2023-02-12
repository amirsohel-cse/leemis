<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Footer;
use App\Model\Social;
use App\Model\Favicon;
use App\Model\Shipping;
use App\Model\Service;
use App\Model\Slider;
use App\Model\Advertise;
use App\Model\Contact;
use App\Model\HeaderText;
use App\Model\Campaign;
use App\Model\Term;
use App\ProductSlider;
use Illuminate\Support\Facades\Artisan;
use Intervention\Image\Facades\Image;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\SubCategorySlider;

class SettingController extends Controller
{
    public function campaign()
    {
        $banner1=Campaign::where('type','banner1')->first();
        if($banner1){
            $banner1=$banner1->file;
        }
        else{
            $banner1="common.png";
        }
        $banner2=Campaign::where('type','banner2')->first();
        if($banner2){
            $banner2=$banner2->file;
        }
        else{
            $banner2="common.png";
        }
        $popup=Campaign::where('type','popup')->first();
        if($popup){
            $popup=$popup->file;
        }
        else{
            $popup="common.png";
        }
        $link1=Campaign::where('type','link1')->first();
        $link2=Campaign::where('type','link2')->first();
        return view('admin.setting.campaign-view',['banner1'=>$banner1,'banner2'=>$banner2,'popup'=>$popup,'link1'=>$link1,'link2'=>$link2]);
    }
    public function storeCampaign(Request $req)
    {
        $validated = $req->validate([
            'file' => 'required',
        ]);
        
        $file=Campaign::where('type',$req->logoType)->first();
        if($file){
            $file_name=$file->file;
            $file_path= public_path('storage/storeLogo/'.$file_name);
            @unlink($file_path);
            $file->delete();
        }
        
        $data=new Campaign;
        if($req->file('file')){
            $file=$req->file('file');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $req->file->move('storage/storeLogo/',$filename);
            $data->file=$filename;
        }
     
        $data->type=$req->logoType;
        $data->save();
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
        return redirect()->back();
    }
    public function storeBannerLink(Request $request)
    {
         
 
        $validated = $request->validate([
            'file' => 'required',
        ]);
        
        $file=Campaign::where('type',$request->logoType)->first();
   
        if($file){
          
            $file->file=$request->file;
            $file->save();
        }
        // return $request;
        else{
            $data=new Campaign;
            $data->file=$request->file;
            $data->type=$request->logoType;
            $data->save();
        }
        
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
        return redirect()->back();

    }
    public function logo()
    {
        $header=Logo::where('type','header')->first();
        if($header){
            $header=$header->file;
        }
        else{
            $header="common.png";
        }
        $footer=$file=Logo::where('type','footer')->first();
        if($footer){
            $footer=$footer->file;
        }
        else{
            $footer="common.png";
        }
        $invoice=$file=Logo::where('type','invoice')->first();
        if($invoice){
            $invoice=$invoice->file;
        }
        else{
            $invoice="common.png";
        }

        $sidebar=$file=Logo::where('type','sidebar')->first();
        if($sidebar){
            $sidebar=$sidebar->file;
        }
        else{
            $sidebar="common.png";
        }
        $barText=Logo::where('type','barText')->first();
        if($barText){
            $barText=$barText->file;
        }
        else{
            $barText="";
        }
        
        $barText2=Logo::where('type','version')->first();
        if($barText2){
            $barText2=$barText2->file;
        }
        else{
            $barText2="";
        }
        //return $header;
        return view('admin.setting.logo-view',['header'=>$header,'footer'=>$footer,'invoice'=>$invoice,'sidebar'=>$sidebar,'barText'=>$barText,'barText2'=>$barText2]);
    }
    public function storeLogo(Request $req)
    {
        $validated = $req->validate([
            'file' => 'required',
        ]);
        
        $file=Logo::where('type',$req->logoType)->first();

        if($file){
            $file_name=$file->file;
            $file_path= public_path('storage/storeLogo/'.$file_name);
            @unlink($file_path);
            $file->delete();
        }
        
        $data=new Logo;
        if($req->file('file')){
            $file=$req->file('file');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $req->file->move('storage/storeLogo/',$filename);
            $data->file=$filename;
        }
     
        $data->type=$req->logoType;
        $data->save();
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
        return redirect()->back();
    }
    public function storeBarText(Request $req)
    {
      
        $validated = $req->validate([
            'file' => 'required',
        ]);
        $file=Logo::where('type',$req->logoType)->first();
        if($file){
          
            $file->file=$req->file;
            $file->save();
        }
        else{
            $data=new Logo;
            $data->file=$req->file;
            $data->type=$req->logoType;
            $data->save();
        }
        
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
        return redirect()->back();
    }
    public function footer()
    {
        $data=Footer::first();
        return view('admin.setting.footer-view',['data'=>$data]);
    }
    public function storeFooter(Request $req)
    {
       
        $validated = $req->validate([
            'footer' => 'required',
            'copyright'=>'required',
            'copy'=>'required',
            'phone' => 'required'

        ]);
        $footer=Footer::first();
        if($footer){
            $footer->delete();
        }
  
        $data=new Footer;

        $data->footer=$req->footer;
        $data->copyright=$req->copyright;
        $data->cotact=$req->copy;
        $data->site_number = $req->phone;

        $data->save();
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
       
    }
    public function socialLinks()
    {
      
        $data=Social::first();
        return view('admin.setting.socialLinks',['data'=>$data]);
    }
    public function socialLinksStore(Request $req)
    {
        

        
        $validated = $req->validate([
            'facebook' => 'required',
            'google'=>'required',
            'twitter'=>'required',
            'linkedin'=>'required',
            'dribble'=>'required',
            'link' => 'required',
            'snap' => 'required',
            'tiktok' => 'required',
            'pinterest' => 'required'
        ]);
        $social=Social::first();
        
        if($social){
            $social->facebook=$req->facebook;
            $social->f_status=$req->f_status;
            $social->google=$req->google;
            $social->g_status=$req->g_status;
            $social->twitter=$req->twitter;
            $social->t_status=$req->t_status;
            $social->linkedin=$req->linkedin;
            $social->l_status=$req->l_status;
            $social->dribble=$req->dribble;
            $social->d_status=$req->d_status;
            
            $social->snapchat=$req->snap;
            $social->snap_status=$req->snap_status;
            
            $social->link=$req->link;
            $social->link_status=$req->link_status;
            
            
             $social->tiktok=$req->tiktok;
            $social->tiktok_status=$req->tiktok_status;
            
             $social->pinterest=$req->pinterest;
            $social->pinterest_status=$req->pinterest_status;
           
            $social->save();
            
        }
        
        else{
            $social=new Social;
            $social->facebook=$req->facebook;
            $social->f_status=$req->f_status;
            $social->google=$req->google;
            $social->g_status=$req->g_status;
            $social->twitter=$req->twitter;
            $social->t_status=$req->t_status;
            $social->linkedin=$req->linkedin;
            $social->l_status=$req->l_status;
            $social->dribble=$req->dribble;
            $social->d_status=$req->d_status;
            
             $social->snapchat=$req->snap;
            $social->snap_status=$req->snap_status;
            
            $social->link=$req->link;
            $social->link_status=$req->link_status;
            
            
            
                $social->tiktok=$req->tiktok;
            $social->tiktok_status=$req->tiktok_status;
            
             $social->pinterest=$req->pinterest;
            $social->pinterest_status=$req->pinterest_status;
            
            
            $social->save();
        }
        return response()->json(['success'=>'Ajax request submitted successfully']);
        
    }
    public function favicon()
    {
        $data=Favicon::first();
       
        if($data){
            $data=$data->file;
            
        }
        else{
            $data="common.png";
        }
        return view('admin.setting.favicon-view',['data'=>$data]);
    }
    public function storeFavicon(Request $req)
    {
       
        $validated = $req->validate([
            'file' => 'required',
        ]);
        $data=Favicon::first();
        if($data){
            $data_name=$data->file;
            $data_path= public_path('storage/storeFavicon/'.$data_name);
            @unlink($data_path);
            $data->delete();
        }
  
        $data=new Favicon;
        if($req->file('file')){
            $file=$req->file('file');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $req->file->move('storage/storeFavicon/',$filename);
            $data->file=$filename;
        }
        $data->save();
        
        return response()->json(['success'=>'Ajax request submitted successfully']);
    }
    public function shipping()
    {
        $methods = Shipping::all();
        return view('admin.setting.shipping-view',['methods'=>$methods]);
    }
    public function addShipping(Request $request)
    {
       

        $this->validate($request, [
            'title' => 'required|unique:shippings',
            'price' => 'required|gte:0'
        ]);

        $method = new Shipping();
        $method->title = $request->title;
        $method->price = $request->price;
        $method->save();
        $data = Shipping::latest()->first();
        return response()->json($data, 200);
    }
    public function editShipping(Shipping $method)
    {
        return response()->json($method,200);
    }
    public function updateShipping(Request $request, Shipping $method)
    {
        $this->validate($request, [
            'title' => 'required|unique:shippings,title,'.$method->id,
            'price' => 'required|gte:0'
        ]);
        $method->title = $request->title;
        $method->price = $request->price;
        $method->save();
        return response()->json($method,200);
    }
    
    public function deleteShipping(Shipping $method)
    {

        $method->delete();
        return response()->json('Successfully Deleted!!!',200);
    }

    public function updateShippingStatus(Request $request, Shipping $method)
    {
        $method->status = $request->status;
        $method->save();
        return response()->json('Status Successfully Updated!!!');
    }
    public function services()
    {
        $services = Service::all();
        return view('admin.setting.services-view',['services'=>$services]);
    }
    public function storeService(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'details' => 'required'
        ]);      
  
        $service = new Service();
        $service->title = $request->title;
        $service->details = $request->details;
        $service->save();
        $data = Service::latest()->first();
        return response()->json($data, 200);
    }
    public function editService(Service $service)
    {
        return response()->json($service,200);
    }
    public function updateService(Request $request, Service $service)
    {
        $service->title = $request->title;
        $service->details = $request->details;
      
        $service->save();
        return response()->json($service,200);
    }
    public function deleteService(Service $service)
    {
        $service->delete();
        return response()->json('Successfully Deleted!!!',200);
    }
    public function contactUs()
    {
       $contacts=Contact::first();
        return view('admin.setting.contactUs-view',['data'=>$contacts]);
    }
    public function storeContacts(Request $req)
    {
        // return $req;
        $validated = $req->validate([
            'contactTitle' => 'required',
            'contactText'=>'required',
            'contactEmail'=>'required',
            'contactFormSuccess'=>'required',
            'email'=>'required',
            'website'=>'required',
            'streetAddress'=>'required',
            'phone'=>'required',
            'fax'=>'required',
        ]);
        $contacts=Contact::first();
        
        if($contacts){
            $contacts->contact_title=$req->contactTitle;
            $contacts->contact_text=$req->contactText;
            $contacts->contact_email=$req->contactEmail;
            $contacts->contact_success_text=$req->contactFormSuccess;
            $contacts->email=$req->email;
            $contacts->website=$req->website;
            $contacts->street=$req->streetAddress;
            $contacts->phone=$req->phone;
            $contacts->fax=$req->fax;
           
           
            $contacts->save();
            
        }
        
        else{
            $contacts=new Contact;
            $contacts->contact_title=$req->contactTitle;
            $contacts->contact_text=$req->contactText;
            $contacts->contact_email=$req->contactEmail;
            $contacts->contact_success_text=$req->contactFormSuccess;
            $contacts->email=$req->email;
            $contacts->website=$req->website;
            $contacts->street=$req->streetAddress;
            $contacts->phone=$req->phone;
            $contacts->fax=$req->fax;
           
           
            $contacts->save();
        }
        return response()->json(['success'=>'Ajax request submitted successfully']);
        
    }
    public function headerText()
    {
        $left1=HeaderText::where('type','=','left1')->first();
        if($left1)
        {
            $left1= $left1->text;
        }
        $left2=HeaderText::where('type','=','left2')->first();
        if($left2)
        {
            $left2= $left2->text;
        }
        $right=HeaderText::where('type','=','right')->first();
        if($right)
        {
            $right= $right->text;
        }


        $right2=HeaderText::where('type','=','right2')->first();
        if($right2)
        {
            $right2= $right2->text;
        }


        return view('admin.setting.headerText',['left1'=>$left1,'left2'=>$left2,'right'=>$right,'right2'=>$right2]);
    }
    public function addHeaderText(Request $req)
    {
        // return $req;
        // $validated = $req->validate([
        //      'file' => 'required',
            
          
        // ]);

        $text=HeaderText::where('type','=',$req->type)->first();
       // return $req;
        if($text){
            $text->text=$req->text;
            $text->save();
            
        }
        
        else{
            $text=new HeaderText;
            $text->text=$req->text;
            $text->type=$req->type;
            $text->save();
        }
        return response()->json(['success'=>'Ajax request submitted successfully']);
        
    }
    public function sliders()
    {
        $sliders = Slider::all();
        return view('admin.setting.sliders-view',['sliders'=>$sliders]);
    }
    public function storeSlider(Request $request)
    {
        $this->validate($request, [
           
            'photo'=>'required',
            'link' => 'required',
           
        ]);
      
        
        $slider = new Slider();
        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $input['imagename'] = rand(10000,99999).time().'.'.$image->extension();

            $filePath = public_path('storage/storeSliders/');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$input['imagename']);
            $slider->image_file = $input['imagename'];
        }
        
        
       
         $slider->link = $request->link;
       
        $slider->save();
        $data = Slider::latest()->first();
        return response()->json($data, 200);
    }
    public function editSlider(Slider $slider)
    {
       // return $slider;
        return response()->json($slider,200);
    }
    public function updateSlider(Request $request, Slider $slider)
    {
       // return $request;
        if ($request->hasFile('photo')){
            unlink('storage/storeSliders/'.$slider->image_file);
            $image = $request->file('photo');
            $input['imagename'] = rand(10000,99999).time().'.'.$image->extension();

            $filePath = public_path('storage/storeSliders/');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$input['imagename']);
            $slider->image_file = $input['imagename'];
        }
       
         $slider->link = $request->edit_link;
        
      
        $slider->save();
        return response()->json($slider,200);
    }
    public function deleteSlider(Slider $slider)
    {
        @unlink('storage/storeSliders/'.$slider->image_file);

        $slider->delete();
        return response()->json('Successfully Deleted!!!',200);
    }


    public function advertise()
    {
        $advertise = Advertise::all();
        return view('admin.setting.advertise-view',['advertise'=>$advertise]);
    }
    public function storeAdvertise(Request $request)
    {
        $this->validate($request, [
            'photo'=>'required',
             'link' => 'required',
        ]);
      
  
        $advertise = new Advertise();
        if ($request->hasFile('photo')){
            $extension = $request->photo->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->photo->move('storage/advertise/',$filename);
            $advertise->image_file=$filename;
        }
        $advertise->subtitle = $request->subtitle;
        $advertise->title = $request->title;
        $advertise->description = $request->description;
        $advertise->link = $request->link;
        $advertise->text_position = $request->position;
        $advertise->save();
        $data = Advertise::latest()->first();
        return response()->json($data, 200);
    }
    public function editAdvertise(Advertise $advertise)
    {
       // return $advertise;
        return response()->json($advertise,200);
    }
    public function updateAdvertise(Request $request, Advertise $advertise)
    {
       // return $request;
        if ($request->hasFile('photo')){
            unlink('storage/advertise/'.$advertise->image_file);
            $extension = $request->photo->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $request->photo->move('storage/advertise/',$filename);
            $advertise->image_file = $filename;
        }

        $advertise->subtitle = $request->edit_subtitle;
        $advertise->title = $request->edit_title;
        $advertise->description = $request->edit_description;
        $advertise->link = $request->edit_link;
        $advertise->text_position = $request->edit_position;
      
        $advertise->save();
        return response()->json($advertise,200);
    }
    public function deleteAdvertise(Advertise $advertise)
    {
        @unlink('storage/advertise/'.$advertise->image_file);

        $advertise->delete();
        return response()->json('Successfully Deleted!!!',200);
    }


    public function banner(){
        return view('vendor.setting.banner');
    }




    //cacheclear


    public function Cache(){
        Artisan::call('cache:clear');
        return redirect('/admin/dashboard')->with('cache', 'Cache Cleared Successfully');
    
    }

    // terms and conditaion
    public function termsCondition()
    {
        $terms = Term::first();

        return view('admin.setting.terms',compact('terms'));
    }

    public function termsConditionStore(Request $request)
    {
        $request->validate(['terms' => 'required']);

        $terms = Term::first();

        $terms->terms = $request->terms;

        $terms->save();

        return response()->json(['success'=>'Ajax request submitted successfully']);
    }


    public function productSliders()
    {
       $sliders = ProductSlider::latest()->get();
       
        $category = Category::all();

       return view('admin.setting.product_slider',['sliders'=>$sliders,'category' => $category]);
    }

    public function productSlidersStore(Request $request)
    {
        
        
        $this->validate($request, [
           'subcategorysliderstore'=>'required',
            'photo'=>'required',
            'link' => 'required',
           
        ]);
      
        
        $slider = new ProductSlider();
        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $input['imagename'] = rand(10000,99999).time().'.'.$image->extension();

            $filePath = public_path('storage/storeSliders/');

            $img = Image::make($image->path());
            $img->save($filePath.'/'.$input['imagename']);
            $slider->photo = $input['imagename'];
        }
        
        
       
         $slider->link = $request->link;
         $slider->category_id = $request->subcategorysliderstore;
       
        $slider->save();
        $data = ProductSlider::latest()->first();
       

        return redirect()->back();
    }


    public function productSlidersUpdate(Request $request, $id)
    {
     
        $this->validate($request, [
           'subcategorysliderstore'=>'required',
            'link' => 'required',
        ]);
        
        $slider = ProductSlider::findOrFail($id);
        if ($request->hasFile('photo')){
            @unlink('storage/storeSliders/'.$slider->photo);
            $image = $request->file('photo');
            $input['imagename'] = rand(10000,99999).time().'.'.$image->extension();

            $filePath = public_path('storage/storeSliders/');

            $img = Image::make($image->path());
            $img->resize(1000, 1000, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$input['imagename']);
            $slider->photo = $input['imagename'];
        }
       
         $slider->link = $request->edit_link;
        $slider->category_id = $request->subcategorysliderstore;
      
        $slider->save();
        return redirect()->back();
    }


    public function productSlidersDelete ($id)
    {
        $slider = ProductSlider::findOrFail($id);

        @unlink('storage/storeSliders/'.$slider->photo);

        $slider->delete();
        
        return redirect()->back();
    }
    
    
    
    public function subcategoryslider (){
      
         $subcategory = SubCategory::all();
         $sliders = SubCategorySlider::latest()->get();

       return view('admin.setting.subcategoryslider',['sliders'=>$sliders, 'subcategory'=>$subcategory]);
    }
    
    public function subcategorysliderstore(Request $request)
    {
        $this->validate($request, [
            'subcategorysliderstore'=>'required',
            'photo'=>'required',
            'link' => 'required',
           
        ]);
      
        
        $slider = new SubCategorySlider();
        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $input['imagename'] = rand(10000,99999).time().'.'.$image->extension();

            $filePath = public_path('storage/subcategorysliderstore/');

            $img = Image::make($image->path());
            $img->save($filePath.'/'.$input['imagename']);
            $slider->photo = $input['imagename'];
        }
        
        
         $slider->subcategory_id = $request->subcategorysliderstore;
         $slider->link = $request->link;
       
        $slider->save();
        $data = SubCategorySlider::latest()->first();
       

        return redirect()->back();
    }
    
    
    public function subcategorysliderUpdate(Request $request, $id)
    {
                
        $this->validate($request, [
            'subcategorysliderstore'=>'required',
            'edit_link' => 'required',
           
        ]);
     

        $slider = SubCategorySlider::findOrFail($id);
        

        

        if ($request->hasFile('photo')){
            @unlink('storage/subcategorysliderstore/'.$slider->photo);
            $image = $request->file('photo');
            $input['imagename'] = rand(10000,99999).time().'.'.$image->extension();

            $filePath = public_path('storage/subcategorysliderstore/');

            $img = Image::make($image->path());
            $img->save($filePath.'/'.$input['imagename']);
            $slider->photo = $input['imagename'];
        }
        $slider->subcategory_id = $request->subcategorysliderstore;
         $slider->link = $request->edit_link;

        
      
        $slider->save();
        return redirect()->back();
    }
    
     public function subcategorysliderDelete ($id)
    {
        $slider = SubCategorySlider::findOrFail($id);

        @unlink('storage/subcategorysliderstore/'.$slider->photo);

        $slider->delete();
        
        return redirect()->back();
    }

}
