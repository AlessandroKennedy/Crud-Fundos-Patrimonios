
@extends('layouts\navbar')
@section('content')
   
      <div class="container-fluid" id="container-wrapper">
        @if(count($errors)>0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>  
            @break
          @endforeach
        </div>  
        @endif
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Cadastro de Patrimônio</h1>
        </div>
        <div class="row mb-3">
 
            <div style="margin: 2%" class="col-3 form-perfil">
                <form method="POST"  action="{{route('patrimoniosCadastroStore')}}">      
                    @csrf   
                    <div class="row mb-3">
                        <label for="name"><b>Data</b> </label> 
                        <div class="col">
                            <input type="date" class="form-control" id="date" name="date" >         
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="name"><b>Fundo</b> </label> 
                        <div class="col-8">
                            @if(count($fundos) > 0)
                            <select class="form-select" name="fundoId"  id="fundoId" aria-label="Default select example">
                                <option> </option>
                                @foreach ($fundos as $fundo)    
                                    <option value="{{$fundo->id}}">{{$fundo->name}}</option>
                                @endforeach
                              </select> 
                              @else
                              <div class="alert alert-danger">
                                <span>Você não tem nenhum Fundo adicionado.</span>
                                <p>Adicione um fundo na página de cadastro de Fundo.</p>
                              </div>   
                              @endif
                        </div>    
                    </div>
                <div class="row mb-4">
                    <label for="name"><b>Valor</b> </label> 
                    <div class="col">
                        <div class="input-group mb-3">    
                            <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                            </div>
                            <input type="text" class="form-control" id="value" name="value">
                        </div>
                    </div>

                </div>   
                    <button class="btn btn-primary row" type="submit"> Salvar</button>
                  </form>
            </div>
      </div>
 
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>  
  <script>
       $(document).ready(function(){
            $('#value').mask('#.##0,00', {reverse: true});
        });
    
   </script>   
@stop
