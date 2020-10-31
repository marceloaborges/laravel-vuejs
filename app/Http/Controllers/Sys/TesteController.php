<?php

namespace App\Http\Controllers\Sys;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teste;
use Auth;
use Gate;

class TesteController extends Controller
{

    protected $request;
    protected $teste;
    protected $paginacao = 5;


    public function __construct(Request $request, Teste $teste)
    {
        $this->request = $request;
        $this->teste = $teste;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'testes';

        if( Gate::denies('visualizar_testes') )
        {
            return redirect()->back();
            //return redirect()->route('sys.403');                       
        }
        $testes = $this->teste->orderBy('name')->paginate($this->paginacao);
        return view('sys.teste.index', compact('active','testes'));        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'testes';
        return view('sys.teste.cad-edit', compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $this->request->all();

        $data = array_merge($dataForm, ['user_add' => auth()->user()->id, 'user_id' => Auth::user()->id] );

        $insert = Teste::create($data);

        if($insert)
            return redirect()->route('sys.testes.index')->with('status','Cadastro Realizado com Sucesso');
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
        $active = 'testes';
        $teste = $this->teste->with('user')->find($id);
        //$this->authorize('show-teste', $teste);
        if( Gate::denies('show-teste', $teste) )
        {
            return redirect()->back();
        }
        return view('sys.teste.show', compact('active','teste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active = 'testes';
        $teste = Teste::find($id);
        if( Gate::allows('editar_testes', $teste) )
        {
            return view('sys.teste.cad-edit', compact('active','teste'));            
        }
        return redirect()->route('sys.403');       
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
        $dataForm = $this->request->all();        

        $data = array_merge($dataForm, ['user_upd' => auth()->user()->id] );

        $teste = Teste::find($id);

        if( Gate::denies('editar_testes', $teste) )
        {
            return redirect()->back();
        }

        $update = $teste->update($data);

        if($update)
            return redirect()->route('sys.testes.index')->with('status','Cadastro Atualizado com Sucesso');
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
        $teste = Teste::find($id); 

        $delete = $teste->delete();

        if($delete){
            return '1';
        }else{
            return 'Falha ao excluir registro, erro inesperado';
        }
        
    }

   /* public function rolesPermissions()
    {
        $user = Auth::user()->name;
        echo '<b>Usuário : </b> '."$user <br/>";

        
        foreach( Auth::user()->roles as $role)
        {
            echo "<br> <b>Papeis : </b>";
            echo " $role->name, ";

            echo " <br> <b>Funções : </b>";

            $permissions = $role->permissions;
            foreach($permissions as $permission)
            {
                echo "$permission->name, ";
            }
        }

    }*/
}
