

@extends('layouts\navbar')
@section('content')
   
      <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Fundos</h1>
        </div>
        <div style="text-align: center" class="row mb-3">
 
            <div style="padding: 2%">
                @foreach ($fundos as $fundo)
                <ul class="list-group">
                    <li class="list-group-item">{{$fundo->name}} <a href="{{Route('fundosEditShow',['fundo'=>$fundo])}}">
                        <i style="margin-right: 10px;margin-left: 10px" class="fas fa-edit">
                    </i></a> 
                    <a onclick="{if(window.confirm('Tem certeza que deseja excluir este fundo? \n Se existir patrimonios pertencentes a este fundo, eles serão excluidos')) window.location.href='{{{Route('fundosDeleteStore',['fundo'=>$fundo])}}}'}" ><i class="fas fa-trash-alt"></i></a>  </li>
                </ul>
                @endforeach
                @if(count($fundos)<=0)
                <h4>Nenhum Fundo Cadastrado...</h4>
                @endif
            </div> 
      </div>
   
@stop