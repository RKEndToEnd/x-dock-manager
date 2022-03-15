<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\ModelHasRole;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
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
        return view('users.index',[
            'depots' =>Depot::all(),
            'users' => User::all()
        ]);
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
                    if(Auth::user()->hasrole('super-admin')) {
                        return '<div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editUserBtn" title="Edycja danych uśytkownia"><i class="fas fa-user-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteUserBtn" title="Usuwanie użytkownika"><i class="fas fa-trash"></i></button>
                                </div>';
                    }
                    if(Auth::user()->hasrole('admin')) {
                        return '<div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" data-id="' . $row['id'] . '" id="editUserBtn" title="Edycja danych uśytkownia"><i class="fas fa-user-edit"></i></button>
                                    <button class="btn btn-sm btn-outline-danger" data-id="' . $row['id'] . '" id="deleteUserBtn" title="Usuwanie użytkownika" disabled><i class="fas fa-trash"></i></button>

                                </div>';
                    }
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
    }
    //Add user
    public function addUser(Request $request){
        $validator = \Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'depot_id' => 'required|exists:App\Models\Depot,id',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'name.required' => 'Wpisz imię.',
            'name.max' => 'Imię nie może być dłuższe niż 255 znaków.',
            'surname.required' => 'Wpisz nazwisko.',
            'surname.max' => 'Nazwisko nie może być dłuższe niż 255 znaków.',
            'email.required' => 'Wpisz adres email.',
            'email.email' => 'Niewłaściwy format adresu email.',
            'email.max' => 'Adres email nie może być dłuiższy niż 255 znaków.',
            'email.unique' => 'Adres email istnieje w systemie. Skorzystaj z innego adresu email.',
            'depot_id.required' => 'Wybierz depot z listy.',
            'depot_id.exists' => 'Depot nie istnieje.',
            'password.required' => 'Wpisz hasło. Hasło musi zawierać min. 8 znaków.',
            'password.min' => 'Hasło musi zawierać min. 8 znaków.'
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->depot_id = $request->depot_id;
            $user->password = Hash::make($request->password);
            $user->assignRole('observer');
            $query = $user->save();
            if ($query){
                return response()->json(['code'=>1,'msg'=>'Nowy użytkownik został dodany']);
            }else{
                return response()->json(['code'=>0,'msg'=>'Wystąpił nieoczekiwany błąd']);
            }
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
        ],[
            'name.required' => 'Wpisz imię.',
            'name.max' => 'Imię nie może być dłuższe niż 255 znaków.',
            'surname.required' => 'Wpisz nazwisko.',
            'surname.max' => 'Nazwisko nie może być dłuższe niż 255 znaków.',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->surname = $request->surname;
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
        ],[
            'name.required' => 'Wpisz nazwę roli.',
            'name.unique' => 'Rola istnieje. Wybierz inną nazwę.',
            'guard_name.required' => 'Guard name jest wymagane. Domyślnie wpisz: web.'
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
                    return [$userName->ruser->name,
                        $userName->ruser->surname];
                })
                ->addColumn('role', function(ModelHasRole $roleName){
                    return $roleName->rrole->name;
                })
                ->addColumn('actions', function ($row){
                    if(Auth::user()->hasrole('super-admin')) {
                        return '<div class="btn-group">
                                    <button class="btn btn-sm btn-outline-warning" data-id="' . $row['model_id'] . '" id="editAssignedRoleBtn"><i class="fas fa-user-edit"></i></button>
                                </div>';
                    }
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
//Assign role to user
    public function assignRole(Request $request)
    {
        /*$role_id = $request->cid_create_role;*/
        $validator = \Validator::make($request->all(),[
            'model_id'=>'required|max:255',
            'role_id'=>'required|max:50',
        ],[
            'model_id.required' => 'Wybierz nazwę uzytkownika z listy.',
            'model_id.max' => 'Nazwa użytkownika nie może być dłuższa niż 255 znaków',
            'role_id.required' => 'Wybierz poziom uprawnień z listy.',
            'role_id.max' => 'Nazwa popziomu uprawnień nie może być dłuższa niż 50 znaków.',
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
//Get user details
    public function getUserRole(Request $request)
    {
        $model_id = $request->model_id;
        $modelDetails = ModelHasRole::find($model_id);
        return response()->json(['details' => $modelDetails]);
    }
}
