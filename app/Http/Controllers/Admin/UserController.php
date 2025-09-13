<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest ;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class UserController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    public function __construct()
    {

        $this->middleware('haveRole:user.index')->only('index');
        $this->middleware('haveRole:user.create')->only(['create' , 'store']);
//        $this->middleware('haveRole:user.update')->only('update');
        $this->middleware('haveRole:user.destroy')->only('destroy');
        $this->middleware('haveRole:user.restore')->only('restore');
        $this->middleware('haveRole:user.finalDelete')->only('finalDelete');

    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';

        $roles = Role::get(['id' , "name"])
            ->pluck("name" , 'id')->all();

        return  $this->MDT_Query_method(// Start Query
            User::class ,
            'admin/pages/users/index',
            $is_trash, // Soft Delete
            [ // Other Options
                'with'      => ['is_trash' => $is_trash , 'roles' => $roles],
            ]

        ); // end query

    }


    public function orders($id)
    {

        return $this->MDT_Query_method(// Start Query
            Order::class,
            'admin/pages/orders/index',
            false, // Soft Delete
            [
                'condition' => ['where', 'user_id', '=', $id]
            ]
        ); // end query

    }
    public function create()
    {

        $roles = Role::get(['id' , "name"]);

        return view('admin.pages.users.create')->with([

            'roles' => $roles,

        ]);

    }


    public function store(UserRequest $request)
    {

        User::create($this->columnsDB($request));

        return back()->with('success' ,  __('form.response.create user'));

    }


//    public function update(UserRequest $request, $id)
//    {
//
//
//        $user = User::withTrashed()
//            ->where('id' , $id)
//            ->firstOrFail();
//
//        $user->update($this->columnsDB($request));
//
//        return response(['status' => 'success' , 'message' =>  __('form.response.create user')]);
//    }


    public function destroy($id)
    {
        return $this->MDT_delete(User::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(User::class , $id);
    }

    public function finalDelete($id)
    {
      Order::where('user_id',$id)->delete();
        return $this->MDT_finalDelete(User::class , $id);
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
            $password    => bcrypt($request->password),
        ];
    }

}
