<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** Models */

use Exception;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $roles;

    public function __construct(
        Role $roles,
    ) {
        $this->roles = $roles ;
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllRoles()
    {
       $rolesList =  $this->roles->get()->all();

       return view('admin.roles.roles_list', compact('rolesList'));
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getRole(int $id)
    {
        $page = 'edit';
        $roleDetails = $this->roles->where('id', $id)->first();

        return view('admin.roles.manage_roles', compact('roleDetails','page'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRole()
    {
        $page = 'create';

        return view('admin.roles.manage_roles', compact('page'));
    }



    /**
     * Show the form for creating category.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function addOrEditRole(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        $id = $request->has('id') ? $request->id : '';
        $roleData =  [
            'name' => $request->input('name'),
            'guard_name' => 'web'
        ];

        try {
            $role =  $this->roles->updateOrCreate(['id' => $id], $roleData);

            if ($role) {
                return redirect()->route('roles.list')->with('success', 'Data inserted/Updated Successfully');
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['error'=> $e->getMessage()]);
        }
    }

}
