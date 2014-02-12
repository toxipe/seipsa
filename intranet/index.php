<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title>Acceso intranet - SEIPSA S.A.C.</title>
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/style_control.css">  
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body>
        <div class="jumbotron">
            <div class="container">
                <h1>Bienvenido,</h1> <h2>ingrese sus credenciales</h2>
                <p>
                    <form class="form-inline" role="form" name="login" method="POST" action="main.php">
                        <div class="form-group">
                            <label class="sr-only" for="user_name">Usuario</label>
                            <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Usuario">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="user_pass">Contraseña</label>
                            <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="Contraseña">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Recordarme
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg">Entrar</button>
                </form>  <!-- ./form --></p>
        </div> <!-- container for jumbotron -->
    </div> <!-- .jumbotron -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
