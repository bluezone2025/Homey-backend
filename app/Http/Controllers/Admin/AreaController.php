<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaRequest;
use App\Models\Area;
use App\Models\Country;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    protected $lang;

    public function __construct()
    {
        $this->lang = app()->getLocale();

        $this->middleware('haveRole:area.index')->only('index');
        $this->middleware('haveRole:area.create')->only(['create' , 'store']);
        $this->middleware('haveRole:area.update')->only('update');
        $this->middleware('haveRole:area.destroy')->only('destroy');
        $this->middleware('haveRole:area.restore')->only('restore');
        $this->middleware('haveRole:area.finalDelete')->only('finalDelete');

    }


    public function index()
    {

        $is_trash  = \request()->segment(2) === 'trash';

        $countries = Country::get(['id' , "name_$this->lang"])
            ->pluck("name_$this->lang" , 'id')->all();

        return  $this->MDT_Query_method(// Start Query
            Area::class ,
            'admin/pages/areas/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'    => ['is_trash' => $is_trash , 'countries' => $countries],
            ]

        ); // end query
    }


    public function create()
    {

        $countries  = Country::latest('id')->get(['id' , "name_$this->lang"]);

        return  view('admin.pages.areas.create')->with([

            'countries' => $countries,
            'lang' => $this->lang
        ]);
    }


    public function store(AreaRequest $request)
    {
        Area::create([
            'name_ar'        => $request->name_ar,
            'name_en'        => $request->name_en,
            'slug'           => strlen($request->slug) ? $request->slug : \Str::slug($request->name_ar),
            'shipping_price' => $request->shipping_price,
            'shipping_time' => $request->shipping_time,
//          'cache'          => $request->cache,
            'country_id'     => $request->country_id,
        ]);



        return  back()->with('success' ,__('form.response.create area'));
    }


    public function update(AreaRequest $request, $id)
    {

        //dd($request->all());
        $area = Area::withTrashed()
            ->where('id' , $id)
            ->update([
                'name_ar'        => $request->name_ar,
                'name_en'        => $request->name_en,
                //'slug'           => $request->slug,
                'shipping_price' => $request->shipping_price,
                'shipping_time' => $request->shipping_time,
    //            'cache'          => $request->cache,
                'country_id'     => $request->country_id,
            ]);

        return response(['status' => 'success' , 'message' => __('form.response.update area')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->MDT_delete(Area::class , $id);
    }


    public function restore($id)
    {

        return $this->MDT_restore(Area::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Area::class , $id);
    }
}
