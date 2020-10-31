<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{

    protected $request;
    protected $role;
    protected $paginacao = 10;

    public function __construct(Request $request, Role $role)
    {
        $this->request = $request;      
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'roles';
        // $roles = $this->role->where('name', "<>", "Admin")->orderBy('name')->paginate($this->paginacao);
        $roles = $this->role->orderBy('name')->paginate($this->paginacao);
        return view('sys.role.index', compact('roles','active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'roles';
        return view('sys.role.cad-edit', compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $name = $request['name'];
        if( $name != "Admin" && $name != "admin")
        {
            $data = $this->request->all();

            $insert = Role::create($data);

            if($insert)
                return redirect()->route('sys.roles.index')->with('status','Cadastro Realizado com Sucesso');
            else
                return redirect()->back()
                        ->withErrors(['errors' => 'Falha ao salvar o cadastro'])
                        ->withInput();
        }

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active = 'roles';
        $name = Role::find($id)->name;
        if( $name == "Admin" || $name == "admin")
        {
            return redirect()->route('sys.roles.index');
        }
        $role = Role::find($id);
        $rolePermissions = $role->permissions;

        $permissions = Permission::orderBy('name')->get();

        return view('sys.role.show', compact('active','role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $name = Role::find($id)->name;
        if( $name == "Admin" || $name == "admin")
        {
            return redirect()->back();
        }

        $active = 'roles';
        $role = Role::find($id);
        return view('sys.role.cad-edit', compact('active','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $name = $request['name'];
        if( $name != "Admin" && $name != "admin")
        {
            $data = $this->request->all();

            $role = Role::find($id);

            $update = $role->update($data);

            if($update)
                return redirect()->route('sys.roles.index')->with('status','Cadastro Atualizado com Sucesso');
            else
                return redirect()->back()
                        ->withErrors(['errors' => 'Falha ao salvar o cadastro'])
                        ->withInput();
        }

        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $name = Role::find($id)->name;
        if( $name == "Admin" || $name == "admin")
        {
            return redirect()->back();
        }

        $role = Role::find($id);
        $delete = $role->delete();

        if($delete){
            return '1';
        }else{
            return 'Falha ao excluir registro, erro inesperado';
        }
    }

    public function search(Request $request)
    {
        $active = 'roles';

        //Recebe a palavra de pesquisa do formulário
        $filter = $request->only(['filter']);

        $roles = $this->role->search($request->filter);        

        return view('sys.role.index', compact('active','filter','roles'));
    }


    public function permissionsStore(Request $request, $id)
    {
        $role = Role::find($id);
        $data = $request->all();
        $permission = Permission::find($data['permission_id']);
        $role->permissionAdd($permission);

        return redirect()->back();
    }

    public function permissionsDestroy($id, $permission_id)
    {
        $role = Role::find($id);
        $permission = Permission::find($permission_id);
        $role->permissionRemove($permission);
        return redirect()->back();
    }
}
