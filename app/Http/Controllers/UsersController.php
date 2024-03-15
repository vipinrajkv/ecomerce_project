<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use DB;
use Spatie\Permission\Models\Role;

/** Models */
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $user;
    private $role;

    public function __construct(
        User $user,
        Role $role,
    ) {
        $this->user = $user ;
        $this->role = $role ;
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAllUsers()
    {
       $usersLists =  $this->user->getUsersList();

       return view('admin.users.users_list', compact('usersLists'));
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUser(int $id)
    {
        $page = 'edit';
        $userDetails = $this->user->getUser($id);
        $roles =  $this->role->get()->toArray(); 

        return view('admin.users.manage_users', compact('userDetails','roles','page'));
    }

    

    /**
     * Show the form for creating Sub Category.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request)
    {   
        $validator = validator::make($request->all(), [
            'user_name' => 'required',
            'role' => 'required',
        ]);
        $roleId = $request->input('role');
        // $role = $this->role->where('id',$roleId)->first();
        $role = Role::find($roleId);
        // dd($role);
        $id = $request->has('id') ? $request->id : '';
        $userData =  [
            'name' => $request->input('user_name'),
            'role' => $role->name,
        ];

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if (!empty($id)) {
                DB::beginTransaction();
                try {
                    
                    $user = $this->user->where('id', $id)->first();
                    if ($user) {
                    $name = $userData['name'];
                    $roleName = $userData['role'];
                    $user->name = $name;
                    //  $user->assignRole($role);
                    if ($role) {
                        $user->syncRoles([$role->id]); // Replace existing roles with the new one
                    }
                     $user->save();
                    } else {
                        throw new \Exception('User not found');
                    }
                    DB::commit();
                    return redirect()->route('users.list')->with('success', 'User updated successfully'); 
                } catch (\Exception $e) {
        
                    return redirect()->back()->with('error', $e->getMessage());
                }
                return redirect()->route('users.list')->with('Failed', 'Data inserted/Updated Failed'); 
            } else {
                return redirect()->back()->with('Failed', 'Data inserted/Updated Failed');
            }
        }
    }
}

