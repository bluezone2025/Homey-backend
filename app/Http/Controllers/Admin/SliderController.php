<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Product;
use App\Models\Slider;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;

class SliderController extends Controller
{
    use MDT_UploadImag , MDT_Query, MDT_Method_Action;

    public function __construct()
    {
        $this->middleware('haveRole:slider.index')->only('index');
        $this->middleware('haveRole:slider.create')->only(['create' , 'store']);
        $this->middleware('haveRole:slider.update')->only('update');
        $this->middleware('haveRole:slider.destroy')->only('destroy');
    }


    public function index()
    {

        $sliders = Slider::orderBy('id','desc')->paginate(10);

        return view('admin.pages.sliders.index', compact('sliders'));/*

        return  $this->MDT_Query_method(// Start Query
            Slider::class ,
            'admin/pages/sliders/index',
            false, // Soft Delete
            [ // Other Options
                'where'    => ['where', 'is_slider' , '=', 1],
            ]
        ); // end query*/
    }


    public function create()
    {

        return  view('admin.pages.sliders.create');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);


        return  view('admin.pages.sliders.edit',compact('slider'));
    }


    public function store(SliderRequest $request)
    {

        //dd($request->all());
        Slider::create($this->columnsDB($request));

        return  back()->with('success' , __('form.response.create slider'));
    }


    public function update(SliderRequest $request, $id)
    {


        $slider = Slider::findOrFail($id);

        $slider->update($this->columnsDB($request , $slider));

        return  back()->with('success' , __('form.response.update slider'));

    }


    public function destroy($id){

        $slider = Slider::find($id);
        $slider->delete();
        return  back()->with('success' , __('form.response.delete slider'));

        /*$sliders = Slider::whereIn('id' , \request('tdSelected' , [$id]))->get();

        $this->MDT_deleteMultiImage($sliders->map->img->all(), 'assets/images/sliders');

        return $this->MDT_delete(Slider::class , $id);*/


    }

    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request , $slider=null){

        $img = $this->MDT_saveImage($request->img , time().random_int(1000 , 100000) , 'assets/images/sliders');

        if ($request->img && $slider) {

            $this->MDT_deleteImage($slider->img , 'assets/images/sliders');
        }


        $in_app = $request->in_app == 1 ? 1 :0;

        if ($in_app) {

            $product = Product::find($request->link);

            if (!$product && !$category) {
                  throw ValidationException::withMessages(['link' => 'This value is incorrect']);

            }
        
        }

        return [
            'slider_reference' => $request->slider_reference,
            'slider_for' => $request->slider_for,
            "img" => $img ?? $slider->img,
            /*'in_app' => $in_app,*/
        ];
    }
}
