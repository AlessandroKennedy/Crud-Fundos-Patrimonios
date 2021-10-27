<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fundo;
use App\Models\Patrimonio;
class PatrimonioController extends Controller
{
    //

    public function patrimoniosCadastroShow(){
        $user = Auth::user();
        $fundos = Fundo::get();
        return view('patrimonioCadastro',['page'=>'patrimonios','user'=>$user,'fundos'=>$fundos]);
    }


    public function patrimoniosCadastroStore(Request $request){
        $request->validate([
            'date'=>'required',
            'value'=>'required',
            'fundoId'=>'required'
        ],['required'=>'por favor preencha todos os campos!']);
        $patrimonio = new  Patrimonio();
        $patrimonio->date = $request->date;
        $patrimonio->fundo_Id = $request->fundoId;
        //formata para salvar no banco
        $request->value  = str_replace('.','',$request->value);
        $request->value  = str_replace(',','.',$request->value);
        $patrimonio->value = $request->value;
        $patrimonio->save();
        return redirect('patrimonios/listar');
    }

    public function patrimoniosEditShow(Request $request){
        $user = Auth::user();
        $patrimonio = Patrimonio::find($request->patrimonio);
        $fundos = Fundo::get();
        return view('patrimonioEdit',['page'=>'patrimonios','user'=>$user,'patrimonio'=>$patrimonio,'fundos'=>$fundos]);
    }

    public function patrimoniosEditStore(Request $request){
        $request->validate([
            'date'=>'required',
            'value'=>'required',
            'fundoId'=>'required'
        ],['required'=>'por favor preencha todos os campos!']);
        $patrimonio = Patrimonio::find($request->patrimonioId);       
        $patrimonio->date = $request->date;
        $patrimonio->fundo_Id = $request->fundoId;
        //formata para salvar no banco
        $request->value  = str_replace('.','',$request->value);
        $request->value  = str_replace(',','.',$request->value);
        $patrimonio->value = $request->value;
      
        $patrimonio->save();
        return redirect('patrimonios/listar');
    }

    public function patrimoniosDeleteStore(Request $request){
        $patrimonio = Patrimonio::find($request->patrimonio);
        $patrimonio->delete();
        return redirect('patrimonios/listar');
    }

    public function patrimoniosList(){
        $patrimonios = Patrimonio::get();
        
        $user = Auth::user();
        return view('patrimonioList',['page'=>'patrimonios','user'=>$user,'patrimonios'=>$patrimonios]);
    }
    
}
