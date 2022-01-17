<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Monolog\Handler\CouchDBHandler;
use Ramsey\Collection\Queue;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


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
    public function getUsersList(){
        $users = User::all();
        return DataTables::of($users)
                            ->addIndexColumn()
                            ->addColumn('actions', function ($row){
                                return '<div class="btn-group">
                                            <button class="btn btn-sm btn-outline-warning" data-id="'.$row['id'].'" id="editUserBtn"><i class="fas fa-user-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-danger" data-id="'.$row['id'].'" id="deleteUserBtn"><i class="fas fa-trash"></i></button>
                                        </div>';
                            })
                            ->rawColumns(['actions'])
                            ->make(true);
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
            'depot_id'=>'required',
        ]);
        if (!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->depot_id = $request->depot_id;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
