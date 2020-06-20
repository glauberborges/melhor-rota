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
<div id="app-loading" class="app-loading justify-content-center align-items-center d-none">
    <div class="logo-loading">
        <!--?xml version="1.0" encoding="utf-8"?-->
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
              <style type="text/css">
                  .st0{fill:#FFFFFF;}
              </style>
            <g>
                <path id="path38_1_" class="st0" d="M36.11,70.06c1.62,1.61,3.62,2.89,5.93,3.79c2.29,0.89,4.9,1.34,7.75,1.34
                  c2.85,0,5.45-0.45,7.75-1.34c2.31-0.9,4.31-2.17,5.94-3.79c1.63-1.61,2.9-3.55,3.76-5.76c0.86-2.19,1.29-4.61,1.29-7.17V31.49
                  H57.95v25.64c0,1.4-0.19,2.66-0.57,3.77c-0.37,1.07-0.91,1.98-1.59,2.72c-0.69,0.74-1.51,1.3-2.51,1.7c-2.02,0.83-4.95,0.83-6.97,0
                  c-1-0.41-1.81-0.97-2.49-1.71c-0.68-0.75-1.21-1.67-1.59-2.74c-0.39-1.11-0.58-2.37-0.58-3.77V31.49H31.07v25.64
                  c0,2.57,0.43,4.98,1.29,7.17C33.23,66.51,34.49,68.45,36.11,70.06"></path>
                <path id="path42_1_" class="st0" d="M49.8,88.74c-21.27,0-38.57-17.22-38.57-38.38c0-21.17,17.3-38.38,38.57-38.38
                  S88.37,29.2,88.37,50.36C88.37,71.52,71.07,88.74,49.8,88.74 M49.8,1.69c-26.97,0-48.9,21.83-48.9,48.67
                  c0,26.84,21.94,48.67,48.9,48.67c26.96,0,48.9-21.83,48.9-48.67C98.7,23.52,76.77,1.69,49.8,1.69"></path>
            </g>
              </svg>

    </div>
</div>

<div class="bg-half">
    <div class="container-fluid bg-half">
        <div class="row">
            <div class="col">
                <div class="box-text">
                    <h1>Encontre o melhor caminho para sua entrega</h1>
                    <h4>Envie um arquivo CSV com todos os endereços para calcular o trajeto.</h4>
                    <a download="modelo.csv" class="btn btn-outline-light" href="{{asset('docs/modelo2.csv')}}" role="button"> Baixar Modelo </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="box-upload">
    @if ($errors->any())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif


    <form action="{{route('process.csv')}}" enctype="multipart/form-data" method="POST">
        <div class='box-container'>
            <div class="dropzone">
                {{ csrf_field() }}
                <label for="files" class="dropzone-container">
                    <div class="file-icon">+</div>
                    <div class="dropzone-title">
                        Clique aqui para enviar seu <span class='browse'>CSV</span>
                    </div>
                </label>
                <input id="files" name="file" type="file" class="file-input" />
            </div>
            <br>

            <label for="basic-url">Insira o endereço do centro de distribuição</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="adress_cd" id="basic-url" aria-describedby="basic-addon3" value="Avenida Dr. Gastão Vidigal, 1132,Vila Leopoldina,05314-010">
            </div>

            <br>
            <button type="submit" class="btn btn-outline-primary btn-block">Processar CSV</button>
        </div>
    </form>
</div>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
