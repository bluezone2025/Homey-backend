<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $records = Role::paginate(20);
        return view('dashboard.roles.index', compact('records'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //dd($request->all());
        /*try{*/
            $this->validate($request, [
                'name' => 'required|string|unique:roles,name',
                'permissions_list' => 'required',
            ]);

            $record = Role::create([
                'name'=>$request->get('name'),
            ]);
            $record->attachPermissions((array)$request->permissions_list);

            return redirect()->route('admin.roles')->with(['success' =>  trans('admin.form.create_done')]);

        /*} catch (\Exception $ex) {
            return redirect()->route('admin.roles')->with(['error' =>  trans('admin.form.some_error')]);
        }*/



    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $model = Role::findOrFail($id);
        $permissions = $model->permissions()->pluck( 'permissions.name')->toArray();
        return view('dashboard.roles.edit', compact('model', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
//            $records->update($request->all());
//            $records->permissions()->sync((array) $request->input('permissions_list'));
////        $records->permissions()->sync($request->permissions_list);
        //try{
                $records = Role::findOrFail($id);
                $this->validate($request, [
                    'name' => 'required|string',
                    'permissions_list' => 'required',
                ]);

                $records->update([
                    'name'=>$request->get('name'),
                ]);

                $records->syncPermissions((array)$request->permissions_list);

        return redirect()->route('admin.roles')->with(['success' =>  trans('admin.form.update_done')]);

        /*} catch (\Exception $ex) {
            return redirect()->route('admin.roles')->with(['error' =>  trans('admin.form.some_error')]);
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        /*try {*/
            //get specific categories and its translations
            $record = Role::whereId($id);

            if (!$record)
                return redirect()->route('admin.roles')->with(['error' => trans('admin.permissions.not_found')]);

            $record->delete();
            return redirect()->route('admin.roles')->with(['success' =>  trans('admin.form.delete_done')]);

        /*} catch (\Exception $ex) {
            return redirect()->route('admin.roles')->with(['error' =>  trans('admin.form.some_error')]);
        }*/
    }
}
