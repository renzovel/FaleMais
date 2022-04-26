<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
    <title>Telzi (Planos)</title>
    <style type="text/css">
        .nav-wrapper{
            display: flex !important;
            flex-wrap: nowrap !important;
        }
        .nav-wrapper > div{
           width: 33.33333333% !important;
        }
        .nav-wrapper > div > h3{
            line-height:inherit; 
            padding:0px; 
            margin:0px;
        }
        @media only screen and (max-width: 992px){
            nav .brand-logo{
                left: auto; 
                -webkit-transform: translateX(0);
                transform: translateX(0);
            }
            .hide-on-med-and-down{
                display: block !important;
            }
        }        
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <div>
                    <a href="#!" class="brand-logo"><img src="https://ui-avatars.com/api/?background=0D8ABD&color=fff&name=Telzi" alt="Telzi"></a>
                </div>            
                <div style="text-align: center;">
                    <h3>Telzi</h3>  
                </div>
                <div>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="#"><i class="material-icons">home</i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col s2">
                </div>
                <div class="col s8">
                <blockquote>
                    Calcule o valor da sua chamada para os planos "Fale Mais" com esta nova ferramenta Telzi.
                </blockquote>
                <hr>
                <div class="row">
                    <div class="input-field col s6">
                        <select>
                        <option value="">--Selecione a origem--</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        </select>
                        <label>DDD de origem:</label>
                    </div> 
                    <div class="input-field col s6">
                        <select>
                        <option value="">--Selecione o destino--</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        </select>
                        <label>DDD de destino:</label>
                    </div>
                </div>
                </div>
                <div class="col s2">                    
                </div>
            </div>
        </div>
    </section>
    

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        $('select').formSelect();
    });
</script>
</body>
</html>




