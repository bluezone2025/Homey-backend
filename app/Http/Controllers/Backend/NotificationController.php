<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Notification::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    $action = '

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                         <a  href="' . route('notifications.destroy', $row->id) . '" class="btn btn-danger">' . \Lang::get('site.delete') . '</a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.notifications.index');
    }
    public function create()
    {
        return view('dashboard.notifications.create');
    }
    public function show($id)
    {
        $item = Notification::where('id', $id)->first();

        if ($item) {
            $item->delete();

            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', ' تم حذف الاشعار');
            }
        }

        //        return Response::json($user);
        return redirect()->route('notifications.index');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'title_ar'   => ['required' , 'string'  , 'max:50'],
            'title_en'   => ['required' , 'string'  , 'max:50'],
            'body_ar'   => ['required' , 'string'  , 'max:500'],
            'body_en'   => ['required' , 'string'  , 'max:500'],
            'img'       => ['nullable' , 'image' ,  'max:10000'],
        ]);


        $messeges = [
        ];
        $validator = Validator::make($request->all(), [
        ], $messeges);


        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back()->withInput();
        }


        self::save_notf(null,true ,'Info',null ,2,$request);


        if (session()->has("success")) {
            Alert::success('Success ', 'Success Message');
        }

        return redirect()->route('notifications.index');
    }

    public function destroy($id)
    {
        $item = Notification::where('id', $id)->first();

        if ($item) {
            $item->delete();

            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', ' تم حذف الموعد');
            }
        }

        //        return Response::json($user);
        return redirect()->route('notifications.index');
    }
}
