@extends('layouts\navbar')
@section('content')
      <!-- Container Fluid-->
      <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <div class="card ">
        <div class="card-body">
            <div class="form-row ">
                <div class="col-3">
                    <label for="">Data início</label>
                    <input  name="dataInicial"  onchange="{if($('#dataFinal').val()) buscaChart()}" id="dataInicial" type="date">
                </div>
                    <div class="col">
                    <label for="">Data Final</label>
                <input onchange="buscaChart()" name="dataFinal" id="dataFinal" type="date">
            </div>
            </div>
       
        <div   style="margin:2%" class="row ">
            <div  class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0-header-title mb-3">Gráfico</h4>
                    <div class="inbox-wild">
                        <div id="divChart" class="inbom-item">
                          
                        </div>
                    </div>
                </div>
            </div>     
      </div>
        </div>
        </div>
     
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script> 
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
      <script>
          const hoje = new Date();
          $('#dataInicial').attr('max',hoje)
          buscaChart();
          var datas = [];
          var dias =[];
          var existeChart = 0;
     
        function buscaChart(){

           // reseta gráfico em caso de ja existir 
           datas = [];
           dias =[];
           existeChart = 0;
            $('#divChart').html('<canvas id="myChart" width="1000" height="400"></canvas>');


            //busca informações para preencher o gráfico
            $.ajax({
                url: "{{Route('graficoShow')}}",
                dataType:'json',
                type:'get',
                data:{
                    'dataInicial':$('#dataInicial').val(),
                    'dataFinal':$('#dataFinal').val()
                }
           })
           .done(function( data ) {
               dias = data.dias;
               data = data.fundos;

               for(let i=0;i<data.length;i++){
                   
                   datas.push(
                        {
                        label: data[i].name,
                        data: data[i].dias,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                            
                        ],
                        borderWidth: 1
                        }
                    )
               }
             
               //preenche gráfico
               const ctx = document.getElementById('myChart').getContext('2d');
               
                const myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dias,
                        datasets: datas
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                   
                                     callback: function(value, index, values) {
                                        return 'R$' + value;
                                    }
                            }
                                }
                        }
                    }
                });
             
           }
          );
        }
          
       
        </script>
@stop