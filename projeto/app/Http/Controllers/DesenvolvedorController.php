<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desenvolvedor;

class DesenvolvedorController extends Controller
{
    public function buscarTodosRegistros()
    {
       $devSelect =  Desenvolvedor::select('id','nome','sexo','idade','hobby','data_nascimento')->get();
       
       if ($devSelect->first()) {
            return response()->json(['status'=>1,'result'=>$devSelect, 'mensagem'=>'Sucesso']);
        }
        
    } 

    public function buscarQueryString($campo,$valor)
    {
        $devSelectQuery =  Desenvolvedor::select('id','nome','sexo','idade','hobby','data_nascimento')
        ->where($campo,'like',"%$valor%")->get();
 
        if ($devSelectQuery->first()) {    
             return response()->json(['status'=>1,'result'=>$devSelectQuery, 'mensagem'=>'Sucesso']);
         }else{
            return response()->json(['mensagem' => 'Não encontrado']);
        }
    }

    public function buscarId($valor)
    {
        
        $devSelectId =  Desenvolvedor::select('id','nome','sexo','idade','hobby','data_nascimento')
            ->where('id','=',$valor)->get();
 
        if ($devSelectId->first() && is_numeric($valor)) {    
             return response()->json(['status'=>1,'result'=>$devSelectId, 'mensagem'=>'Sucesso'],200);
         }else{
             return response()->json(['mensagem' => 'Não encontrado']);
        }
    }


    public function cadastrarDesenvolvedor(Request $request)
    {
        $dadosJson = $request->all();
        $nome           = $dadosJson['nome'];
        $sexo           = $dadosJson['sexo'];
        $idade          = $dadosJson['idade'];
        $hobby          = $dadosJson['hobby'];
        $dataNascimento = date('Y-m-d', strtotime($dadosJson['dataNascimento']));
        
        $resultJson = array('nome' => $nome,'sexo' => $sexo,
                             'idade' => $idade,'hobby'=>$hobby,'data_nascimento'=>$dataNascimento);
        $resultado = Desenvolvedor::create($resultJson);
            
        return response()->json(['status'=>1,'mensagem' => 'Sucesso!']);
    }

    public function buscarDesenvolvedor(Request $request)
    {
        $dadosJson = $request->all();
        $filtro           = $dadosJson['filtro'];
        $valor            = $dadosJson['valorFiltro'];
        
        $devSelect =  Desenvolvedor::select('id','nome','sexo','idade','hobby','data_nascimento')
        ->where("$filtro",'=',"$valor")->get();
 
        if ($devSelect->first()) {    
             return response()->json(['status'=>1,'result'=>$devSelect, 'mensagem'=>'Sucesso na consulta!']);
         }else{
             return response()->json(['result'=>$devSelect, 'mensagem' => 'Erro na consulta.']);
        }
    }

    public function alterarDesenvolvedor(Request $request)
    {
        $desenvolvedor = Desenvolvedor::find($request->id);
        $desenvolvedor->nome            = $request->nome;
        $desenvolvedor->sexo            = $request->sexo;
        $desenvolvedor->idade           = $request->idade;
        $desenvolvedor->hobby           = $request->hobby;
        $desenvolvedor->data_nascimento = date('Y-m-d', strtotime($request->dataNascimento));
        
        $resultado = $desenvolvedor->save();

        if($resultado){
            return response()->json(['status'=>1, 'mensagem' => 'Atualizado com sucesso.']);
        }else{
            return response()->json(['mensagem' => 'Falha na tentativa de atualizar os dados.']);
        }
    }

    public function deletarDesenvolvedor($id)
    {
        $desenvolvedor = Desenvolvedor::find($id);
        $resultado = $desenvolvedor->delete();
        
        if($resultado){
            return response()->json(['status'=>1, 'mensagem' => 'Deletado com sucesso!']);
        }else{
            return response()->json(['mensagem' => 'Deletado com sucesso!']);
        }
        
    }
}
