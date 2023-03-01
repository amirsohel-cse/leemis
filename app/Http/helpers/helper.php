<?php

use App\Model\Advertise;




function languageChange($key)
{


    $lang = session('lang') ?? 'EN';





    $website = json_decode(file_get_contents(resource_path('lang/'.$lang.'.json')),true);




    $key = ucwords(trim($key));

    if(array_key_exists($key,$website)){

        if(session('lang') == null || session('lang') == 'en'){

            return $key;
        }

        return $website[$key];
    }

    $website[$key] = $key;

    file_put_contents(resource_path('lang/'.$lang.'.json'),json_encode($website));

    if(session('lang') == null || session('lang') == 'en'){
        return $key;
    }

    return $website[$key];

}

function translate()
{
    # code...
}


function advertisements($size, $fixed = 0)
{


    if($fixed){
        $ad = Advertise::select('redirect_url', 'ad_image','status','is_slider','script','resolution','type')->where('resolution', $size)->where('status', 1)->where('is_slider', $fixed)->first();
    }else{
        $ad = Advertise::select('redirect_url', 'ad_image','status','is_slider','script','resolution','type')->where('resolution', $size)->where('status', 1)->inRandomOrder()->first();

    }

    if (!empty($ad)) {
        if ($ad->type == 1) {
            return  '<a style="height:100%; width:100%"  target="_blank" href="' . $ad->redirect_url . '"><img data-src="'.getImage('assets/images/advertisement/' . $ad->ad_image)  .'"  src="' . getImage('assets/images/advertisement/' . $ad->ad_image) . '" alt="image" class="w-100 lazy"></a>';
        }
        if ($ad->type == 2) {
            return $ad->script;
        }
    } else {
        return '';
    }
}

function makeDirectory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function removeFile($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function uploadImage($file, $location, $size = null, $old = null, $thumb = null)
{

    $path = makeDirectory($location);
    if (!$path) throw new Exception('File could not been created.');

    if ($old) {
        removeFile($location . '/' . $old);
        removeFile($location . '/thumb_' . $old);
    }
    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();

    if ($file->getClientOriginalExtension() == 'gif') {
        copy($file->getRealPath(), $location . '/' . $filename);
    }else{
        $image = Image::make($file);
        if ($size) {
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[1]);
        }
        $image->save($location . '/' . $filename);

        if ($thumb) {
            $thumb = explode('x', $thumb);
            Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
        }
    }


    return $filename;
}

function getImage($image,$size = null)
{
    $clean = '';
    if (file_exists($image) && is_file($image)) {
        return asset($image) . $clean;
    }
    if ($size) {
        return route('placeholder.image',$size);
    }
    return asset('assets/images/default.png');
}

