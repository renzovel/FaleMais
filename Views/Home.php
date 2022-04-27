
<?php
    //consultamos nossa propria API
    $req=file_get_contents(localURL."/Api/Discagem");
    //recebemos os Discagem
    $discagem=json_decode($req);

    //consultamos os planos
    $req=file_get_contents(localURL."/Api/Planos");
    //recebemos os planos
    $planos=json_decode($req);

?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        .btn-large{
            width: 100%;
        }
        .load-destino, .load-require, #tcarculos{
            display: none;
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
            <form action="#" method="get">
                <div class="row">
                    <div class="col s2">
                    </div>
                    <div class="col s8">
                    <blockquote>
                        Calcule o valor da sua chamada para os planos "Fale Mais" com esta nova ferramenta Telzi.
                    </blockquote>
                    <hr>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <select id="origem" name="origem">
                                <option value="">--Selecione a origem--</option>
                                <?php foreach ($discagem->data as $row) { 
                                ?>
                                <option value="<?=$row->iddiscagem?>"><?=$row->ddd?> &nbsp;&nbsp; (<?=$row->regiao?>-<?=$row->uf?>)</option>
                                <?php }?>
                            </select>
                            <label>DDD de origem:</label>
                        </div> 
                        <div class="input-field col s12 m6">
                            <select id="destino" name="destino" disabled>
                                <option value="">--Selecione o destino--</option>
                            </select>
                            <label>DDD de destino:</label>
                            <div class="progress load-destino">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="minutos" type="number" name="minutos" required>
                            <label for="minutos">Minutos da ligacao:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select id="plano" name="plano">
                                <option value="">--Selecione a plano Fale Mais--</option>
                                <?php foreach ($planos->data as $row) { 
                                ?>
                                <option value="<?=$row->idplanos?>"><?=$row->name?></option>
                                <?php }?>
                            </select>
                            <label>Planos Fale Mais:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">                            
                            <button id="submit" class="btn btn-large waves-effect waves-light" type="submit">
                                Calcular Valor
                                <i class="material-icons right">send</i>
                            </button>
                            <div class="progress load-require">
                                <div class="indeterminate"></div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col s2">                    
                    </div>
                </div>
                <div class="row">
                    <table id="tcarculos" class="responsive-table">
                        <thead>
                            <tr>
                                <th>
                                    Origem
                                </th>
                                <th>
                                    Destino
                                </th>
                                <th>
                                    Valor/Min
                                </th>
                                <th>
                                    Tempo
                                </th>
                                <th>
                                    Plano "Fale Mais"
                                </th>                                
                                <th>
                                    Com "Fale Mais"
                                </th>
                                <th>
                                    Sem "Fale Mais"
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
    

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        //carrega o form style da materialize
        $('select').formSelect();

        $('form').on('submit',function(e){
            e.preventDefault();
            $(".load-require").show();
            $("#tcarculos").hide();
            $("#submit").attr('disabled', true);
            var urlget='&idorigem='+$("#origem").val();
            urlget+='&iddestino='+$("#destino").val();
            urlget+='&minutos='+$("#minutos").val(); 
            urlget+='&idplano='+$("#plano").val();           
            $.get("<?=publicURL."/Api/Tarifas/Calcular/"?>"+urlget, function(response, status){
                if(status=='success'){ 
                    const data=JSON.parse(response).data[0];
                    console.log(data);
                    $(".load-require").hide();
                    $("#submit").attr('disabled', false);
                    $("#tcarculos>tbody").html(`
                        <tr>
                            <td>
                                ${data.origem}
                            </td>
                            <td>
                                ${data.destino}
                            </td>
                            <td>
                               $ ${data.valorminuto}
                            </td>
                            <td>
                                ${$("#minutos").val()}
                            </td>
                            <td>
                                ${data.name}
                            </td>
                            <td>
                              $ ${data.comfalemais}
                            </td>
                            <td>
                               $ ${data.semfalemais}
                            </td>
                        </tr>
                    `);
                    $("#tcarculos").show();
                }
            });
        });

        $('#origem').on("change", function(){
            var origem=$(this).val();
            if(origem!=""){
                $('.load-destino').show();
                $.get("<?=publicURL."/Api/Discagem/Destino/"?>"+origem, function(response, status){
                    if(status=='success'){ 
                        var options='<option value="">--Selecione o destino--</option>';
                        $.each(JSON.parse(response).data, function(index, value){
                            options+=`<option value="${value.iddiscagem}">${value.ddd}  &nbsp;&nbsp; (${value.regiao}-${value.uf})</option>`;                            
                        });
                        $("#destino").html(options);        
                        $('.load-destino').hide();              
                        $("#destino").removeAttr('disabled');
                        $('select').formSelect();
                    }else{
                        console.log(status);
                    }
                });
            }else{
                $("#destino").val('').change();
                $("#destino").attr('disabled', true);
                $('select').formSelect();
            }
            
        });
    });
</script>
</body>
</html>




