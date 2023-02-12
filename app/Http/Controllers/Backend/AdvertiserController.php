<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Advertise;
use Illuminate\Http\Request;

class AdvertiserController extends Controller
{
    public function advertisements(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $pageTitle = "Search Result of $search";
            $advertisements = Advertise::where('resolution', 'like', "%$search%")->latest()->paginate();
        } else {
            $pageTitle = "All Advertisements";
            $advertisements = Advertise::latest()->paginate();
        }
        $empty_message = "No Advertisements found";
        return view('admin.ads.advertisements', compact('pageTitle', 'advertisements', 'search', 'empty_message'));
    }

    public function advertisementStore(Request $request)
    {
        


        $request->validate([
            'type' => 'required|in:1,2',
            'size' => 'required|in:728x90,300x250,300x600,970x250,330x165,1440x80,356x221,442x165,1440x250,224x295,160x230,710x185,356x250',
            'redirect_url' => 'required_if:type,1|url',
            'adimage' => 'required_if:type,1|image|mimes:jpg,jpeg,png,PNG,gif',
            'script' => 'required_if:type,2',
        ]);
        


        $advr = new Advertise();
        $advr->type = $request->type;
        $advr->script = $request->script ?? null;
        $advr->redirect_url = $request->redirect_url;
        $advr->resolution = $request->size;
        $advr->is_slider = $request->is_slider;
        if ($request->adimage) {
            list($width, $height) = getimagesize($request->adimage);
            $size = $width . 'x' . $height;
            if ($request->size != $size) {
                $notify[] = ['error', 'Sorry image size has to be ' . $request->size];
                return back()->withNotify($notify);
            }
            $advr->ad_image = uploadImage($request->adimage, 'assets/images/advertisement/');
        }
        $advr->status = $request->status ? 1 : 0;
        $advr->save();
        $notify[] = ['success', 'Advertisement added successfully'];
        return back()->withNotify($notify);
    }

    public function advertisementUpdate(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:1,2',
            'size' => 'required|in:728x90,300x250,300x600,970x250,330x165,1440x80,356x221,442x165,1440x250,224x295,160x230,710x185,356x250',
            'redirect_url' => 'required_if:type,1|url',
            'adimage' => 'image|mimes:jpg,jpeg,png,PNG',
            'script' => 'required_if:type,2',
        ]);

        $advr = Advertise::findOrFail($id);
        $advr->type = $request->type;
        $advr->script = $request->script ?? null;
        $advr->redirect_url = $request->redirect_url;
        $advr->resolution = $request->size;
        $advr->is_slider = $request->is_slider;
        if ($request->adimage) {
            $old = $advr->ad_image ?? null;
            list($width, $height) = getimagesize($request->adimage);
            $size = $width . 'x' . $height;
            if ($request->size != $size) {
                $notify[] = ['error', 'Sorry image size has to be ' . $request->size];
                return back()->withNotify($notify);
            }
            $advr->ad_image = uploadImage($request->adimage, 'assets/images/advertisement/', null, $old);
        }
        $advr->status = $request->status ? 1 : 0;
        $advr->save();
        $notify[] = ['success', 'Advertisement Updated successfully'];
        return back()->withNotify($notify);
    }

    public function advertisementRemove($id)
    {
        Advertise::findOrFail($id)->delete();
        $notify[] = ['success', 'Advertisement removed successfully'];
        return back()->withNotify($notify);
    }

}