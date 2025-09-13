<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;


class NotificationController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    public function __construct()
    {

        $this->middleware('haveRole:notification.index')->only('index');
        $this->middleware('haveRole:notification.create')->only(['create' , 'store']);
        $this->middleware('haveRole:notification.update')->only('update');
        $this->middleware('haveRole:notification.destroy')->only('destroy');
        $this->middleware('haveRole:notification.restore')->only('restore');
        $this->middleware('haveRole:notification.finalDelete')->only('finalDelete');

    }



    public function index()
    {
        $uniqueNotifications = \DB::table('notifications')
            ->select(
                'data',
                \DB::raw('MAX(created_at) as created_at') // Use MAX() to get the latest created_at for each group
            )
            ->groupBy('data')
            ->orderBy('created_at', 'desc') // Order by the aggregated created_at
            ->get(1000);
        //dd($uniqueNotifications);
        //$uniqueNotifications = $this->paginate($allNotifications, 10); // Paginate the results manually

        return view('admin.pages.notifications.index', compact('uniqueNotifications'));


        /*return  $this->MDT_Query_method(// Start Query
            Notification::class ,
            'admin/pages/notifications/index',
            false
        ); // end query

        */

    }


    public function create()
    {

        return view('admin.pages.notifications.create');

    }


    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
        
            'title_ar'   => ['required' , 'string'  , 'max:50'],
            'title_en'   => ['required' , 'string'  , 'max:50'],
            'details_ar'   => ['required' , 'string'  , 'max:500'],
            'details_en'   => ['required' , 'string'  , 'max:500'],
            'type'   => ['required' , 'in:category_id,product_id,student_id,brand_id,out_source,general'],
            'reference_id'   => ['nullable'],
            'image'       => ['nullable' , 'image' ,  'max:10000'],
            ]);

        // New Notification Here
//dd('s');
        //self::save_notf(null,true ,'Info',null ,2,$request);
        // send notifications for all users as Listeners
         if ($request->hasFile('image')){
             $imgName = time().'.'.$request->file('image')->getClientOriginalExtension();
             $request->file('image')->move(public_path('assets/images/notifications') , $imgName);
             $image = asset('assets/images/notifications/' . $imgName);
         }else{
              $image = null;
         }

         if ($request->type == "out_source"){
             $ref  = $request->get('out_source_link');
         }elseif ($request->type == "general"){
             $ref = null;
         }else{
             $ref = $request->get('reference_id');
         }

         $notification = [
             'title_ar'     => $request->get('title_ar'),
             'title_en'     => $request->get('title_en'),
             'details_ar'   => $request->get('details_ar'),
             'details_en'   => $request->get('details_en'),
             'type'         => $request->get('type'),
             'reference_id' => $ref,
             'image'        => $image
         ];
         //dd($notification);
         // call event here
        event(new NewNotification($notification));
        session()->flash('success',__('form.response.create notification'));

        return back()->with('success' , __('form.response.create notification'));

    }

  
    public function show()
    {

        return  $this->MDT_Query_method(// Start Query
            Notification::class ,
            'admin/pages/notifications/pending',
            false, // Soft Delete
            [ // Other Options
                'condition' => ['where' , 'is_active' , '=' , 0],
                'with'      => ['is_trash' => false ],

            ]

        ); // end query

    }


    public function destroy($id)
    {
        return $this->MDT_delete(Notification::class , $id);
    }

 



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request,$user_id){

        $imgName = null;

        $img = $request->file('img');
        if ($img) {
            $imgName = time().$img->getClientOriginalExtension();
            $img->move(public_path('assets/images/notifications') , $imgName);
        }
        return [
            'type'                => 'Info',
            'title_ar'            => $request->title_ar,
            'title_en'           => $request->title_en,
            'body_ar'           => $request->note_en,
            'body_en'            => $request->note_ar,
            'img'       => $imgName ,

        ];
    }
}
