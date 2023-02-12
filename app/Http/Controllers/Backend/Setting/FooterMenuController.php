<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Model\Footermenu;
use App\Model\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FooterMenuController extends Controller
{
    public function delete_submenu( $id)
    {
        $data = Submenu::find($id);
        $data->delete();

        return response()->json('Successfully Deleted!!!',200);
    }


    public function view_sub_menu(){
        $data = Submenu::all();
        return view('admin.footer_menu.sub_menu',['data'=>$data]);
    }

    public function sub_menu(){

        $data = DB::table('footermenus')->where('menu_status', 'Active')->get();
        return view('admin.footer_menu.add_submenu',['data'=>$data]);
    }

   public function save_sub_menu(Request $req){
        $validated = $req->validate([
            'menu_id' => 'required',
            'sub_menu' => 'required|unique:submenus,sub_menu',
            'sub_menu_details' => 'required',
            'sub_status' => 'required',
        ]);
        $data = new Submenu();
        $data->menu =  $req->menu_id;
        $data->sub_menu = $req->sub_menu;
        $data->slug = Str::slug($req->sub_menu);
        $data->sub_menu_details = $req->sub_menu_details;
        $data->sub_status = $req->sub_status;
        $data->save();
        return response()->json([
            'success' => 'Ajax request submitted successfully',
            'data' => $data
           ]);
    }

    public function edit_sub_menu($id){
        $data = Submenu::find($id);
        return response()->json($data, 200);
    }

    public function update_sub_menu(Request $req, $id){

        $data = Submenu::find($id);

        $validated = $req->validate([
            'menu_id' => 'required',
            'sub_menu' => 'required|unique:submenus,sub_menu,'.$data->id,
            'sub_menu_details' => 'required',
            'sub_status' => 'required'
        ]);
        $data->menu = $req->menu_id;
        $data->sub_menu = $req->sub_menu;
        $data->slug = Str::slug($req->sub_menu);
        $data->sub_menu_details = $req->sub_menu_details;
        $data->sub_status = $req->sub_status;
        $data->update();
        return response()->json(['data' => $data,'success' => 'Data successfully updated']);
    }


    public function footer_menu_details($slug){
        $data = Submenu::where('slug',$slug)->firstOrFail();
        return view('admin.footer_menu.footer_menu',['data'=>$data]);
    }

}
