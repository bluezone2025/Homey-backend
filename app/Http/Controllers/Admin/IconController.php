<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IconRequest;
use App\Http\Requests\Admin\InfoRequest;
use App\Models\Icon;
use App\Models\Info;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;
use Illuminate\Http\Request;

class IconController extends Controller
{
    use MDT_UploadImag, MDT_Query, MDT_Method_Action;

    public function __construct()
    {
        $this->middleware('haveRole:icon.index')->only('index');
        $this->middleware('haveRole:icon.create')->only(['create' , 'store']);
        $this->middleware('haveRole:icon.update')->only('update');
        $this->middleware('haveRole:icon.destroy')->only('destroy');

    }


    public function index()
    {

        return  $this->MDT_Query_method(// Start Query
            Icon::class ,
            'admin/pages/icons/index',
            false, // Soft Delete
        ); // end query
    }


    public function create()
    {

        return  view('admin.pages.icons.create');
    }


    public function store(IconRequest $request)
    {

        Icon::create($this->columnsDB($request));

        return  back()->with('success' , __('form.response.create icon'));
    }


    public function update(IconRequest $request, $id)
    {

        $icon = Icon::findOrFail($id);

        $icon->update($this->columnsDB($request , $icon));

        return response([
            'status' => 'success' ,
            'message' => __('form.response.update icon'),
            'url' => ['img' => asset("assets/images/icons/$icon->img")]
        ]);
    }


    public function destroy($id){

        $icons = Icon::whereIn('id' , \request('tdSelected' , [$id]))->get();

        $this->MDT_deleteMultiImage($icons->map->img->all(), 'assets/images/icons');

        $this->MDT_delete(Icon::class , $id);

        return response([
            'status' => 'success' ,
            'message' => __('form.response.delete icon'),
        ]);
    }

    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request , $icon=null){

        $img = $this->MDT_saveImage($request->img , time().random_int(1000 , 100000) , 'assets/images/icons');

        if ($request->img && $icon) {

            if ($icon->img  !== "default.png") {

                $this->MDT_deleteImage($icon->img , 'assets/images/icons');
            }
        }


        return [
            'title' => $request->title,
            'link' => $request->link,
            'type' => $request->type,
            "img" => $img ?? $icon->img,
        ];
    }
}
