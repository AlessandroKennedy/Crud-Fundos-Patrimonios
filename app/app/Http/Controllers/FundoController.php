<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fundo;

class FundoController extends Controller
{
    //
    public function fundosCadastroShow(){
        $user = Auth::user();
        return view('fundoCadastro',['page'=>'fundos','user'=>$user]);
    }
    
    public function fundosCadastroStore(Request $request){

        $request->validate([
            'name'=>'required'
        ],['required'=>'por favor informe o nome do Fundo!']);

        $fundo = new  Fundo();
        $fundo->name = $request->name;
        $fundo->save();
        return redirect('fundos/listar');
    }

    public function fundosEditShow(Request $request){
        $user = Auth::user();
        $fundo = Fundo::find($request->fundo);
        return view('fundoEdit',['page'=>'fundos','user'=>$user,'fundo'=>$fundo]);
    }

    public function fundosEditStore(Request $request){
        $request->validate([
            'name'=>'required'
        ],['required'=>'por favor informe o nome do Fundo!']);
        $fundo = Fundo::find($request->fundoId);
        $fundo->name = $request->name;
        $fundo->save();
        return redirect('fundos/listar');
    }

    public function fundosDeleteStore(Request $request){
        $fundo = Fundo::find($request->fundo);
        $patrimonios = $fundo->patrimonios;
        foreach($patrimonios as $patrimonio){
            $patrimonio->delete();
        }
        $fundo->delete();
        return redirect('fundos/listar');
    }

    public function fundosList(Request $request){
        $fundos = Fundo::get();
        $user = Auth::user();
        return view('fundoList',['page'=>'fundos','user'=>$user,'fundos'=>$fundos]);
    }


}
