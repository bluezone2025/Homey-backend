<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest ;
use App\Models\Role;
use App\Models\Admin;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class AdminController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    public function __construct()
    {
        $this->middleware('haveRole:admin.index')->only('index');
        $this->middleware('haveRole:admin.create')->only(['create' , 'store']);
        $this->middleware('haveRole:admin.update')->only('update');
        $this->middleware('haveRole:admin.destroy')->only('destroy');
        $this->middleware('haveRole:admin.restore')->only('restore');
        $this->middleware('haveRole:admin.finalDelete')->only('finalDelete');
    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';

        $roles = Role::get(['id' , "name"])
            ->pluck("name" , 'id')->all();

        return  $this->MDT_Query_method(// Start Query
            Admin::class ,
            'admin/pages/admins/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'      => ['is_trash' => $is_trash , 'roles' => $roles],
            ]

        ); // end query

    }


    public function create()
    {

        $roles = Role::get(['id' , "name"]);

        return view('admin.pages.admins.create')->with([

            'roles' => $roles,

        ]);

    }


    public function store(AdminRequest $request)
    {

        Role::findOrFail($request->role_id);

        Admin::create($this->columnsDB($request));


        return back()->with('success' , __('form.response.create admin'));

    }


    public function update(AdminRequest $request, $id)
    {

        Role::findOrFail($request->role_id);

        $user = Admin::withTrashed()
            ->where('id' , $id)
            ->firstOrFail();

        $user->update($this->columnsDB($request));

        return response(['status' => 'success' , 'message' => __('form.response.update admin')]);
    }

    public function destroy($id)
    {
        return $this->MDT_delete(Admin::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Admin::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Admin::class , $id);
    }






      ///////////////////////////////////////////////////////
     ////                                               ////
    //// ..........  Methods Clean Code .............. ////
   ////                                               ////
  ///////////////////////////////////////////////////////


    public function columnsDB($request){

        $password = $request->password ? 'password' : '';

        return [
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'role_id'     => $request->role_id,
             $password    => bcrypt($request->password),
        ];
    }

}
