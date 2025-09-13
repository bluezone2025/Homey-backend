<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class RoleController extends Controller
{

    use MDT_Method_Action , MDT_Query;

    public function __construct()
    {
        $this->middleware('haveRole:role.index')->only('index');
        $this->middleware('haveRole:role.create')->only(['create' , 'store']);
        $this->middleware('haveRole:role.update')->only('update');
        $this->middleware('haveRole:role.destroy')->only('destroy');
        $this->middleware('haveRole:role.trash')->only('trash');
        $this->middleware('haveRole:role.restore')->only('restore');
        $this->middleware('haveRole:role.finalDelete')->only('finalDelete');
    }



    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';


        return  $this->MDT_Query_method(// Start Query
            Role::class ,
            'admin/pages/roles/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'    => ['is_trash' => $is_trash,],
            ]

        ); // end query

    }


    public function create()
    {

        return view('admin.pages.roles.create');

    }


    public function store(RoleRequest $request)
    {

        Role::create($this->columnsDB($request));

        return back()->with('success' ,__('form.response.create role'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(RoleRequest $request, $id)
    {

        $role = Role::withTrashed()
            ->where('id' , $id)
            ->firstOrFail();

        $role->update($this->columnsDB($request));

        return response(['status' => 'success' , 'message' =>__('form.response.update role')]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(Role::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Role::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Role::class , $id);
    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request){

        return [
            'name'        => $request->name,
            'description' => $request->description,
        ];
    }
}
