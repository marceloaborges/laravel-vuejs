<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $request;
    protected $user;
    protected $paginacao = 10;

    public function __construct(Request $request, User $user)
    {
        $this->request = $request;      
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'users';
        $users = User::paginate($this->paginacao);
        //$users = $this->user->where('id', Auth::user()->id)->paginate($this->paginacao);
        return view('sys.user.index', compact('active','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'users';
        return view('sys.user.cad-edit', compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $dataForm = $this->request->all();
        $passwordCrypt = Hash::make($request->password);
        
        $data = array_merge($dataForm, ['user_add' => auth()->user()->id, 'password' => $passwordCrypt] );

        $insert = User::create($data);

        if($insert)
            return redirect()->route('sys.users.show', $insert->id)->with('status','Cadastro Realizado com Sucesso');
        else
            return redirect()->back()
                    ->withErrors(['errors' => 'Falha ao salvar o cadastro'])
                    ->withInput();        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active = 'users';
        $user = User::find($id);
        $roles = Role::where('name', "<>", "Admin")->orderBy('name')->paginate($this->paginacao);
        return view('sys.user.show', compact('active','user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active = 'users';
        $user = User::find($id);
        return view('sys.user.cad-edit', compact('active','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $dataForm = $this->request->all();
        $passwordCrypt = Hash::make($request->password);

        if( !isset($dataForm['active']) )
            $user = array_merge($dataForm, ['user_upd' => auth()->user()->id, 'password' => $passwordCrypt, 'active' => 0] );
        else
            $user = array_merge($dataForm, ['user_upd' => auth()->user()->id, 'password' => $passwordCrypt] );

        $users = User::find($id);
        $update = $users->update($user);

        if($update)
            return redirect()->route('sys.users.index')->with('status','Cadastro Realizado com Sucesso');
        else
            return redirect()->back()
                    ->withErrors(['errors' => 'Falha ao salvar o cadastro'])
                    ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Recupera o item pelo id
        $user = User::find($id);

        $user_dlt = auth()->user()->id;
        $user->user_dlt = $user_dlt;
        $user->save();

        $delete = $user->delete();

        if($delete){
            return '1';
        }else{
            return 'Falha ao excluir registro, erro inesperado';
        }
    }

    public function search(Request $request)
    {
        $active = 'users';

        //Recebe a palavra de pesquisa do formulário
        $filter = $request->only(['filter']);

        $users = $this->user->search($request->filter);        

        return view('sys.user.index', compact('active','filter','users'));
    }

    public function rolesStore(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();
        $role = Role::find($data['role_id']);
        $user->roleAdd($role);

        return redirect()->back();
    }

    public function rolesDestroy($id, $role_id)
    {
        $user = User::find($id);
        $role = Role::find($role_id);
        $user->roleRemove($role);
        return redirect()->back();
    }
    
}
