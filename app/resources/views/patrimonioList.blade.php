

@extends('layouts\navbar')
@section('content')
   <style>
       .col-grid{
        border-width:2px
       }
       .col-grid-head{
        background-color: rgb(100, 100, 100);
        color:floralwhite;
        border-width:2px
       }
   </style>
      <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Patrimônios</h1>
        </div>
        <div style="text-align: center" class="row mb-3">
 
         
            <div class="container">
                <div class="row">
                  <div class="col col-grid-head" >
                    Data
                  </div>
                  <div class="col-sm col-grid-head">
                    Fundo
                  </div>
                  <div class="col-sm col-grid-head">
                    Valor
                  </div>
                  <div class="col-sm col-grid-head">
                    Ação
                  </div>
                </div>
                @foreach ($patrimonios as $patrimonio)
                <div class="row" style="background-color: rgb(216, 216, 216)">
                    <div class="col col-grid">
                        {{explode(' ',$patrimonio->date)[0]}}
                    </div>
                    <div class="col-sm col-grid">
                        {{$patrimonio->fundo->name}}
                    </div>
                    <div class="col-sm col-grid">
                        R${{str_replace('.',',',$patrimonio->value)}}
                    </div>
                    <div class="col-sm col-grid">
                        <a href="{{Route('patrimoniosEditShow',['patrimonio'=>$patrimonio])}}"><i style="margin-right: 10px;margin-left: 10px" class="fas fa-edit"></i></a> <a href="{{Route('patrimoniosDeleteStore',['patrimonio'=>$patrimonio])}}"><i class="fas fa-trash-alt"></i></a>
                    </div>
                  </div>
                @endforeach
                @if(count($patrimonios)<=0)
                <h4>Nenhum Patrimônio Cadastrado...</h4>
                @endif

              </div>
      </div>
   
@stop