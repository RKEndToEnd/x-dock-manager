<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\ModelHasRole;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index',['depots' =>Depot::all()]);
    }

    //Get all users
    public function getUsersList(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('depot');
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('depot', function (User $user) {
                    return $user->depot->name;
                })
                ->addColumn('actions', function ($row){
                    return '<div class="btn-group">
                                            <button class="btn btn-sm btn-outline-warning" data-id="'.$row['id'].'" id="editUserBtn"><i class="fas fa-user-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger" data-id="'.$row['id'].'" id="deleteUserBtn"><i class="fas fa-trash"></i></button>
                                        </div>';
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
    }
    //Add user - temporary
    public function addUser(Request $request){
        $validator = \Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $query = $user->save();
        }
    }
    //Get user details
    public function getUserDetails(Request $request){
        $user_id = $request->user_id;
        $userDetails = User::find($user_id);
        return response()->json(['details'=>$userDetails]);
    }
    //Update user details
    public function updateUserDetails(Request $request) {
        $user_id = $request->cid;

        $validator = \Validator::make($request->all(),[
            'name'=>'required|string|max:50',
            'surname'=>'required|string|max:50',
            'email'=>'required|email|unique:users',
            /*'depot_id'=>'required',*/
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->depot_id = $request->depot;
            $query = $user->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Dane Użytkownika zostały zaktualizowane']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
//Delete user
    public function deleteUser(Request $request){
        $user_id = $request->user_id;
        $query = User::find($user_id)->delete();
        if ($query){
            return response()->json(['code'=>1,'msg'=>'Użytkownik został usunity z bazy danych']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Wystąpił nieoczekiwany błąd']);
        }
    }
//Roles view
    public function roles()
    {
        return view('users.roles');
    }
//Get roles list
    public function getRoles()
    {
        $roles = Role::all();
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<button class="btn btn-sm btn-outline-danger" data-id="'. $row['id'].'" id="deleteStatusBtn"><i class="fas fa-trash"></i></button>
                        ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
//Create new role
    public function createRole(Request $request)
    {
        /*$role_id = $request->cid_create_role;*/
        $validator = \Validator::make($request->all(),[
            'name'=>'required|string|unique:roles|max:50',
            'guard_name'=>'required|string|max:50',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $role = new Role($request->all());
            $role->name = $request->name;
            $role->guard_name = $request->guard_name;
            $query = $role->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Rola została dodana do bazy danych']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
//Roles view
    public function assignedRoles()
    {
        return view('users.rolesAssign',/*['model_has_roles' => ModelHasRole::all()],*/['roles'=>Roles::all()],['users'=>User::all()]);
    }
//Get roles list
    public function getAsRoles(Request $request)
    {
        if ($request->ajax()) {
            $asRoles = ModelHasRole::with('ruser','rrole');
            return DataTables::of($asRoles)
                ->addIndexColumn()
                ->addColumn('user', function (ModelHasRole $userName){
                    return $userName->ruser->name;
                })
                ->addCOlumn('role', function(ModelHasRole $roleName){
                    return $roleName->rrole->name;
                })
                ->addColumn('actions', function ($row){
                    return '<div class="btn-group">
                                            <button class="btn btn-sm btn-outline-warning" data-id="'.$row['id'].'" id="editRoleBtn"><i class="fas fa-user-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger" data-id="'.$row['id'].'" id="deleteRoleBtn"><i class="fas fa-trash"></i></button>
                                        </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
//Create new role
    public function assignRole(Request $request)
    {
        /*$role_id = $request->cid_create_role;*/
        $validator = \Validator::make($request->all(),[
            'model_id'=>'required|unique:model_has_roles|max:50',
            'role_id'=>'required|max:50',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else {
            $assigned = new ModelHasRole($request->all());
            $assigned->model_id = $request->model_id;
            $assigned->model_type = "App\Models\User";
            $assigned->role_id = $request->role_id;
            $query = $assigned->save();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Uprawnienia zostały nadane']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Wystąpił nieoczekiwany błąd']);
            }
        }
    }
}
