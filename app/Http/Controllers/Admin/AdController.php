<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ad;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;
use Illuminate\Validation\ValidationException;

class AdController extends Controller
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

        return  $this->MDT_Query_method(// Start Query
            Ad::class ,
            'admin/pages/ads/index',
            false, // Soft Delete
            [ // Other Options
                'where'    => ['where', 'is_slider' , '=', 0],
            ]
        ); // end query
    }


    public function create()
    {

        return  view('admin.pages.ads.create');
    }


    public function store(AdRequest $request)
    {

        Ad::create($this->columnsDB($request));

        return  back()->with('success' , __('form.response.create ad'));
    }


    public function update(AdRequest $request, $id)
    {

        $columns = $this->columnsDB($request);

        Ad::where('id' , $id)
            ->update($columns);

        return response([
            'status' => 'success' ,
            'message' =>  __('form.response.update ad'),
            'url' => ['img' => asset("assets/images/ads/".$columns['img'])]
        ]);
    }


    public function destroy($id){

        $ads = Ad::whereIn('id' , \request('tdSelected' , [$id]))->get();

        $this->MDT_deleteMultiImage($ads->map->img->all(), 'assets/images/ads');

        $this->MDT_delete(Ad::class , $id);

        return response([
            'status' => 'success',
            'message' => __('form.response.delete ad'),
        ]);
    }


    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request){

        $img = $this->MDT_saveImage($request->img , time().random_int(1000 , 100000) , 'assets/images/ads');

        $in_app = $request->in_app == 1 ? 1 :0;

        if ($in_app) {

            $product = Product::find($request->link);
            $category = Category::find($request->link);

            if (!$product && !$category) {
                  throw ValidationException::withMessages(['link' => 'This value is incorrect']);

            }
        }

        return [
            'link' => $request->link,
            "img" => $request->img ? $img : \DB::raw('img'),
            'in_app' => $in_app,
            'position' => $request->position,
        ];
    }
}
