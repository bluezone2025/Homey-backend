<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryTime;
use App\Models\DeliveryTimeNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DeliveryTimesController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DeliveryTime::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    $action = '
                    <a class="btn btn-success"  href="' . route('delivery_times.edit', $row->id) . '" >' . \Lang::get('site.edit') . ' </a>

                      <meta name="csrf-token" content="{{ csrf_token() }}">
                         <a  href="' . route('delivery_times.destroy', $row->id) . '" class="btn btn-danger">' . \Lang::get('site.delete') . '</a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $note = DeliveryTimeNote::orderBy('id',  'DESC')->first();

        return view('dashboard.delivery_times.index',compact('note'));
    }
    public function create()
    {
        return view('dashboard.delivery_times.create');
    }
    public function show($id)
    {
        $delivery_time = DeliveryTime::where('id', $id)->first();

        if ($delivery_time) {
            $delivery_time->delete();

            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', ' تم حذف الموعد');
            }
        }

        //        return Response::json($user);
        return redirect()->route('delivery_times.index');
    }


    public function store(Request $request)
    {
        $messeges = [
            'begin_time.required' => "بداية التاريخ مطلوبة",
            'end_time.required' => "نهاية التاريخ مطلوبة",
        ];
        $validator = Validator::make($request->all(), [
        ], $messeges);


        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back()->withInput();
        }


        $delivery_time = DeliveryTime::create([
            'begin_time' => $request['begin_time'],
            'end_time' => $request['end_time'],
        ]);

        if (session()->has("success")) {
            Alert::success('Success ', 'Success Message');
        }

        return redirect()->route('delivery_times.index');
    }
    public function edit($id)
    {
        $delivery_time = DeliveryTime::findOrFail($id);
        return view('/dashboard/delivery_times/edit', compact(

            'delivery_time'

        ));
    }

    public function updateDeliveryTime(Request $request, $id)
    {
        $messeges = [
            'begin_time.required' => "بداية التاريخ مطلوبة",
            'end_time.required' => "نهاية التاريخ مطلوبة",
        ];
        $validator = Validator::make($request->all(), [
        ], $messeges);


        if ($validator->fails()) {
            Alert::error('error', $validator->errors()->first());
            return back();
        }

        $delivery_time = DeliveryTime::findOrFail($id);
        if (!$delivery_time) {
            Alert::error('error', 'هذا الموعد غير مسجل بالنظام');
            return back();
        }
        $delivery_time = $delivery_time->update([
            'begin_time' => $request['begin_time'],
            'end_time' => $request['end_time'],
        ]);

        //TODO :: -----------------------------//

        //        dd($new_sizes);
        //        dd($removed_sizes);

        //        dd($vv);
        session()->flash('success', "success");
        if (session()->has("success")) {
            Alert::success('Success ', 'Success Message');
        }

        return redirect()->route('delivery_times.index', $id);
    }

    public function editNote($id)
    {
        $delivery_time = DeliveryTimeNote::findOrFail($id);
        return view('/dashboard/delivery_times/edit_note', compact(

            'delivery_time'

        ));
    }

    public function updateNote(Request $request, $id)
    {
        $delivery_time = DeliveryTimeNote::findOrFail($id);
        if (!$delivery_time) {
            Alert::error('error', 'هذا الموعد غير مسجل بالنظام');
            return back();
        }
        $delivery_time = $delivery_time->update([
            'note' => $request['note'] ?: null,

        ]);

        //TODO :: -----------------------------//

        //        dd($new_sizes);
        //        dd($removed_sizes);

        //        dd($vv);
        session()->flash('success', "success");
        if (session()->has("success")) {
            Alert::success('Success ', 'Success Message');
        }

        return redirect()->route('delivery_times.index', $id);
    }

    public function destroy($id)
    {
        $delivery_time = DeliveryTime::where('id', $id)->first();

        if ($delivery_time) {
            $delivery_time->delete();

            session()->flash('success', "success");
            if (session()->has("success")) {
                Alert::success('نجح', ' تم حذف الموعد');
            }
        }

        //        return Response::json($user);
        return redirect()->route('delivery_times.index');
    }
}
