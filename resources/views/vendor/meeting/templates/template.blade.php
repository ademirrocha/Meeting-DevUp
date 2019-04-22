<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <title>Meeting</title>

    <link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/adminlte.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/custom.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/layout.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/components.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/meeting/styles/bootstrap.min.css')}}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('node_modules/sweetalert2/dist/sweetalert2.min.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    

   


      @yield('css')
    
    <!-- <link rel="stylesheet" type="text/css" href="../resources/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../resources/css/algaworks.min.css" /> -->


    
</head>

<body onload="c();">
    @auth
    <?php 
        $organizacaoUser = App\Models\Organizacao::find(auth()->user()->organizacao_id); 
        $cargoUser = App\Models\Cargo::find(auth()->user()->cargo_id);
        
    ?>
    @endauth
    


    <header class="aw-topbar">
        <div class="logo">
            <h1><a href="{{ route('home') }}">Meeting</a></h1>
        </div>
        @auth

            

            <a href="#" class="aw-toggle  js-toggle js-sidebar-toggle">
            <i class="fa  fa-bars"></i>
            </a>

                
                

                <div class="sair">
                    <a class="aw-sair" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em class="fa  fa-sign-out"></em>Sair</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                



            <span class="center organizacao col-sm-12">
                Organizacao: {{$organizacaoUser->fantasia}} 
                 | Cargo: {{$cargoUser->cargo}}

                 

            </span>

                
            <span class="dados-user ">
                Bem Vindo! {{Auth::user()->nome}}

                @if(Auth::user()->imagem == null)
                    <div class="circle">
                        <img src="{{ asset('storage/users/perfil.png') }}" class="imagem-usuario">
                    </div>
                @else
                    <div class="circle">
                        <img src="{{ asset('storage/users/'.auth()->user()->imagem) }}" class="imagem-usuario">
                    </div>
                @endif
            
            </span>



        @endauth
    </header>

   
        @extends('vendor/meeting/templates/menu')
    


        


    <section class="aw-content  js-content">



       
        @yield('content')





    </section>

    <footer class="aw-layout-footer">
        <div class="container-fluid">
            <span class="aw-footer-disclaimer"> @ {{date('Y')}} Meeting. Todos os direitos reservados.</span>
        </div>
    </footer>
    


    <script  src="{{asset('vendor/meeting/javascripts/jquery.min.js')}}"></script>
    <script  src="{{asset('vendor/meeting/javascripts/app.js')}}"></script>
    <script  src="{{asset('vendor/meeting/javascripts/scripts-meeting.js')}}"></script>
    
    <script  src="{{asset('vendor/meeting/javascripts/bootstrap.mim.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    
</body>
</html>
             
  