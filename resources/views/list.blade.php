<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="stylesheet" href="{{asset('bootstrap/estilo.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>

<div class="bg-half">
    <div class="container-fluid bg-half">
        <div class="row">
            <div class="col">
                <div class="box-text">
                    <h1>Dados Importado com sucesso!</h1>
                    <h4>Veja os dados que foram importado e as melhores rotas abaixo.</h4>
                    <a class="btn btn-outline-light" href="{{url('/')}}"> Voltar </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid" style="margin-top: -100px; background: #ffffff">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin: 15px 0px;" id="table">
                    <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Nascimento</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">CEP</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data_csv as $row)
                        <tr>
                            <th>{{$row[0]}}</th>
                            <th>{{$row[1]}}</th>
                            <th>{{$row[2]}}</th>
                            <th>{{$row[3]}}</th>
                            <th>{{$row[4]}}</th>
                            <th>{{$row[5]}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-outline-primary btn-block" onclick="download_table_as_csv('table');">Exporta dados para CSV</button>
        </div>
    </div>
</div>

<div class="container-fluid" style="margin-top: 5px">
    <div class="row">
        <div class="col">
            <div class="text-center">
                <h2>Veja o trajeto</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <p><b>Partida:</b> {{$delivery_routes->routes[0]->legs[0]->start_address}}</p>
                <p><b>Destino:</b> {{$delivery_routes->routes[0]->legs[0]->end_address}}</p>
                <p>
                    <b>Distância total:</b> {{$delivery_routes->routes[0]->legs[0]->distance->text}}
                    <b>Duração total:</b> {{$delivery_routes->routes[0]->legs[0]->duration->text}}
                </p>
                <table class="table table-bordered" style="margin: 15px 0px;">
                    <thead>
                    <tr>
                        <th scope="col">Distância</th>
                        <th scope="col">Duração</th>
                        <th scope="col">Instrução</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delivery_routes->routes[0]->legs[0]->via_waypoint as $via_waypoint)

                        @foreach($delivery_routes->routes[0]->legs[0]->steps as $key => $steps)
                            <tr class="{{ ($via_waypoint->step_index == $key) ? 'table-success' :  ''  }}" >
                                <th>{{$steps->distance->text}}</th>
                                <th>{{$steps->duration->text}}</th>
                                <th>{{ ($via_waypoint->step_index == $key) ? 'PONTO DE ENTREGA: ' :  ''  }} {!! $steps->html_instructions !!}</th>
                            </tr>
                        @endforeach

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

<script>
        // Quick and simple export target #table_id into a csv
        function download_table_as_csv(table_id) {
            // Select rows from table_id
            var rows = document.querySelectorAll('table#' + table_id + ' tr');
            // Construct csv
            var csv = [];
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll('td, th');
                for (var j = 0; j < cols.length; j++) {
                    // Clean innertext to remove multiple spaces and jumpline (break csv)
                    var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                    // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
                    data = data.replace(/"/g, '""');
                    // Push escaped string
                    row.push('"' + data + '"');
                }
                csv.push(row.join(';'));
            }
            var csv_string = csv.join('\n');
            // Download it
            var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
            var link = document.createElement('a');
            link.style.display = 'none';
            link.setAttribute('target', '_blank');
            link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
</script>

</body>
</html>
