<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fundo;
use App\Models\Patrimonio;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboardShow(){
        $user = Auth::user();
        return view('dashboard',['page'=>'dashboard','user'=>$user]);
    }

    public function graficoShow(Request $request){
        
        
        $fundos = Fundo::get();
        $i=0;

        if($request->dataInicial != null && $request->dataFinal != null){ // se não tiver data selecionada mostra dos últimos 7 dias
            $diferenca = (strtotime($request->dataFinal) - strtotime($request->dataInicial));
            $quantidadeDias = intval(floor($diferenca / (60 * 60 * 24))) +1;
        }else{
            $quantidadeDias = 7;
        }
        
        foreach($fundos as $fundo){

            $data[$i]['name'] = $fundo->name;
            
           
            for($j=0;$j<$quantidadeDias;$j++){
                if($request->dataInicial != null && $request->dataFinal != null){
                    $diaInicial = new Carbon($request->dataFinal,'America/Sao_Paulo');
                }else{
                    $diaInicial = Carbon::today()->setTimezone('America/Sao_Paulo');
                }
                          
                
                $semana[$j] = $diaInicial->subDays($j)->format('Y-m-d');
                $patrimonios[$j]  = DB::table('fundos')
                ->join('patrimonios', 'patrimonios.fundo_id', '=', 'fundos.id')
                ->select(DB::raw('SUM(patrimonios.value) as totalPatrimonio'))->where('patrimonios.date','=',$semana[$j])->where('fundos.name',$fundo->name)->groupby('patrimonios.date')->get();
                $soma = 0;
                foreach($patrimonios[$j] as $aux){
                    $soma += $aux->totalPatrimonio;
                }
                $semanaFormatada[$j] = $diaInicial->setTimezone('America/Sao_Paulo')->format('d-m-Y');
                $data[$i]['dias'][$j] = $soma;
               
            }
            $data[$i]['dias'] = array_reverse($data[$i]['dias']);
            $i++;
        }

       
        
        $json['fundos'] =  $data;
        $json['dias'] = array_reverse($semanaFormatada);
        return $json;
    }
}
