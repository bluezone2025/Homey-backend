<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\BoxCategory;
use App\Models\BoxOrder;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use App\MyDataTable\MDT_UploadImag;
use App\MyDataTable\MDT_UploadImag2;
use Illuminate\Http\Request;
use DB;

class BoxesController extends Controller
{
    use MDT_Query, MDT_Method_Action, MDT_UploadImag2;


    protected $lang;
    protected $slug;
    protected $boxUpdate_id;

    public function __construct()
    {

        $this->middleware('haveRole:box.index')->only('index');
        $this->middleware('haveRole:box.create')->only(['create', 'store']);
        $this->middleware('haveRole:box.update')->only('update');
        $this->middleware('haveRole:box.destroy')->only('destroy');
        $this->middleware('haveRole:box.restore')->only('restore');
        $this->middleware('haveRole:box.finalDelete')->only('finalDelete');

        $this->lang = app()->getLocale();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $is_trash  = \request()->segment(2) === 'trash';

        return  $this->MDT_Query_method(// Start Query
            Box::class ,
            'admin/pages/boxes/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'condition' => ['where' , 'box_category_id' , '!=' , null],
                'with'      => ['is_trash' => $is_trash],
                'with_RS'      => ['boxCategory']
            ]

        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $box_categories = BoxCategory::get(['id' , "title_$this->lang"])
            ->pluck("title_$this->lang" , 'id')->all();
        return view('admin.pages.boxes.create', compact('box_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //dd($request->all());
        DB::beginTransaction();
        try{
            $box = Box::create($this->columnsDB($request));

            //start save images gallery
            if (is_array($request->images)) {

                $images = $this->MDT_saveMultiImage($request->images, uniqid() . time(), ['box_id', $box->id]);

                $box->images()->insert($images);
            }

            //end save attributes
            if($request->send_notifi_pro){
                // New Notification Here
                //self::save_notf(null,true ,'Box',$box->id ,1,$box);
            }
            DB::commit();
            return back()->with('success', __('form.response.create product'));

        }catch (\Exception $e){

            DB::rollback();
            // return $e;
            return back()->with('error', 'something went wrong');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $this->boxUpdate_id = $id;

        $box = Box::findOrFail($id);

        $box_categories = BoxCategory::get(['id' , "title_$this->lang"])
            ->pluck("title_$this->lang" , 'id')->all();

        return view('admin.pages.boxes.update')->with(['box'=>$box,'box_categories'=>$box_categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $box = Box::findOrFail($id); // check and get product
        $box->update($this->columnsDB($request, $box->default_image));


        $oldImages = is_array($request->oldImages) ? $request->oldImages : [];

        $oldImages = $box->images()->whereNotIn('id', $oldImages);
        $oldImages->delete();

        if (is_array($request->images)) {

            $this->MDT_deleteMultiImage($oldImages);

            $images = $this->MDT_saveMultiImage($request->images, uniqid() . time(), ['box_id', $box->id]);

            $box->images()->insert($images);
        }

        return back()->with('success', __('form.response.update product'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {

        // delete the box order
        $box_orders = BoxOrder::where('box_id',$id)->get();
        if ($box_orders){
            foreach ($box_orders as $box_order){
                $box_order->delete();
            }
        }
        return $this->MDT_delete(Box::class, $id);
    }

    public function restore($id)
    {

        $box_orders = BoxOrder::onlyTrashed()->where('box_id',$id)->get();
        if ($box_orders){
            foreach ($box_orders as $box_order){
                $box_order->restore();
            }
        }

        return $this->MDT_restore(Box::class, $id);
    }

    public function finalDelete($id)
    {
        $box_orders = BoxOrder::where('box_id',$id)->get();
        if ($box_orders){
            foreach ($box_orders as $box_order){
                $box_order->forceDelete();
            }
        }

        return $this->MDT_finalDelete(Box::class, $id);
    }

    public function columnsDB($request, $oldImag = null)
    {
        //dd($request->all());
        $img = $request->file('default_image') ? $this->MDT_saveImage($request->default_image, uniqid().time()) : $oldImag;
        $price  =  (float) $request->price;
        return [
            'default_image'                 => $img,
            'title_ar'             => $request->title_ar,
            'title_en'             => $request->title_en,
            'box_category_id'             => $request->box_category_id,
            'description_ar'      => $request->description_ar,
            'description_en'      => $request->description_en,
            'price'            => $price,
            'quantity'            => $request->quantity,
            "required_order"    => $request->required_order == "on"? 1:0,
            "order_min_price"    => $request->required_order == "on" && $request->order_min_price > 0? $request->order_min_price : 0,
        ];
    }
}
