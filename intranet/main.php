<?php
/*header('Location: park/index.php');*/
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Intranet - SEIPSA S.A.C.</title>            
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/style_control.css">  
        <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    </head>
    <body>       
        <?php include("assets/menu_top.php"); ?>
        <!-- Button trigger modal -->
        <!--
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
Launch demo modal
</button>
-->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Importante</h4>
                    </div>
                    <div class="modal-body">
                        <p class="bg-danger">
                            Listado de carnets, licencias, etc. por vencer...</p>
                        <ul>
                            <li>Texto 1</li>
                            <li>Texto 1</li>
                            <li>Texto 1</li>
                            <li>Texto 1</li>
                            <li>Texto 1</li>
                            <li>Texto 1</li>
                        </ul>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> <!-- .modal -->
        <div class="container" id="main">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Intranet <small>Panel de administración</small></h1>
                </div>

                <div class="list-group"> <!-- list-group -->
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading"><i class="fa fa-files-o"></i> Web</h4>
                        <p class="list-group-item-text"> Modificar, editar contenido estático del portal.</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading"><i class="fa fa-users"></i> Personal</h4>
                        <p class="list-group-item-text">Registro, modificación de datos del personal.</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading"><i class="fa fa-map-marker"></i> Unidades</h4>
                        <p class="list-group-item-text"> Registro de unidades nuevas y control de vigentes.</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading"><i class="fa fa-stack-overflow"></i> Almacén</h4>
                        <p class="list-group-item-text"> Control de Almacén.</p>
                    </a>
                </div> <!-- .list-group -->
                <div class="alert alert-danger"><i class="fa fa-cog fa-spin fa-2x"></i> Sitio en construcción...</div>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width: 42%">
                        <span class="sr-only">42% Complete</span>
                    </div>
                </div> <!-- .progress-bar -->
            </div> <!-- . col-md-12 -->
        </div>   <!-- .main container  -->
        <?php include("assets/footer.php"); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
        <!--
<script type="text/javascript">
$(window).load(function(){
$('#myModal').modal('show');
});
</script> modal autoshow script
-->
    </body>
</html>