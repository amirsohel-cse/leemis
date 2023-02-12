<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function index(){
        $blog = Blog::get();
        return view('admin.blog.index',compact('blog'));

    }

    public function add(){

        return view('admin.blog.add');

    }

    public function store(Request $req){


       
        $validated = $req->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'body' => 'required',
        ]);





        $input = $req->all();
        //dd($input);

        $description=$req->body;
        $dom = new \DomDocument();
        // $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // $images = $dom->getElementsByTagName('img');
        
        $dom->loadHTML('<?xml encoding="UTF-8">'. $description);
        $images = $dom->getElementsByTagName('img');
        $details = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name="/uploads/blogs/" . time().$k.'.png';

            $path = public_path() . $image_name;



            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        //$details = $dom->saveHTML();
        $details .= $dom->saveHTML( $dom->documentElement );



        $blog = new Blog;
        $blog->title = $req->title;
        $blog->details = $details;
        if ($req->hasFile('image')){
            $extension = $req->image->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $req->image->move('uploads/blogs/',$filename);
            $blog->image = $filename;

        }

        $blog->save();

        session()->flash('success',' New Blog Created');

        return redirect()->back();


    }


    public function edit($id){
        $blog = Blog::findOrFail($id);     
        return view('admin.blog.edit',compact('blog'));

    }

    public function update(Request $req,$id){
         
         $validated = $req->validate([
            'title' => 'required',
            'body' => 'required',
        ]);



        $input = $req->all();
        //dd($input);

        $description=$req->body;
        $dom = new \DomDocument();
        // $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // $images = $dom->getElementsByTagName('img');
        
        $dom->loadHTML('<?xml encoding="UTF-8">'. $description);
        $images = $dom->getElementsByTagName('img');
        $details = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name="/uploads/blogs/" . time().$k.'.png';

            $path = public_path() . $image_name;



            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        //$details = $dom->saveHTML();
         $details .= $dom->saveHTML( $dom->documentElement );




        $blog = Blog::find($id);
        $blog->title = $req->title;
        $blog->details = $details;
        if ($req->hasFile('image')){
            $extension = $req->image->getClientOriginalExtension();
            $filename = rand(10000,99999).time().'.'.$extension;
            $req->image->move('uploads/blogs/',$filename);
            $blog->image = $filename;

        }

        $blog->save();

        session()->flash('success',' Blog Edited Successfully');
        return redirect()->back();

    }

    public function delete($id){
        $blog = Blog::find($id);
        $blog->delete();

        session()->flash('success',' Blog Deleted');
        return redirect()->back();

    }

    public function blogs(){
        $blog = Blog::get();
        return view('frontend.blogs.index',compact('blog'));

    }

    public function viewblog($id){
        $blog = Blog::find($id);
        return view('frontend.blogs.view',compact('blog'));

    }

public function xxx(){
return $this->zzz();
}

public function zzz(){
echo "suuuuuuu";
}


}
