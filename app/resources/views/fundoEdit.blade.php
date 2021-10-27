@extends('layouts\navbar')
@section('content')
   
      <div class="container-fluid" id="container-wrapper">
        @if(count($errors)>0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
         
            <li>{{$error}}</li>  
      
          @endforeach
        </div>  
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Edição de Fundo</h1>
        </div>
        <div class="row mb-3">
 
            <div style="margin: 2%" class="form-perfil">
                <form method="POST"  action="{{route('fundosEditStore')}}">      
                    @csrf   
                    <div class="row">
                        <label for="name"><b>Nome do Fundo</b> </label> 
                        <div class="col-6">
                            <input type="hidden" class="form-control" id="fundoId" value="{{$fundo->id}}" name="fundoId" >
                            <input type="text" class="form-control" id="name" value="{{$fundo->name}}" name="name" >
                           
                        </div>   
                        <button class="btn btn-primary row-3" type="submit"> Salvar</button>
                    </div>
                  
                  
                  </form>
            </div>
      </div>
   
@stop