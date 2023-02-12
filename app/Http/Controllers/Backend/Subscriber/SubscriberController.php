<?php

namespace App\Http\Controllers\Backend\Subscriber;

use App\Http\Controllers\Controller;
use App\Model\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function showSubscribers()
    {
        $subsribers = Subscriber::all();
        return view('admin.subscribers.index')->with(compact('subsribers'));
    }
    public function storeSubscribersEmail(Request $request)
    {
        $this->validate($request,[
            'phone' => 'required|regex:/(01)[0-9]{9}/|min:11|unique:subscribers',
        ]);

        $phone=new Subscriber();

        $phone->phone = $request->phone;

        
        $phone->save();

       return response()->json("You are Subscribed");
        }
}
