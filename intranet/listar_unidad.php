<?php require_once('../Connections/seipsa.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

        switch ($theType) {
            case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;    
            case "long":
            case "int":
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
            case "double":
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
            case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
            case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
        }
        return $theValue;
    }
}

mysql_select_db($database_seipsa, $seipsa);
$query_list_unidad = "SELECT * FROM unidades ORDER BY id_unidad ASC";
$list_unidad = mysql_query($query_list_unidad, $seipsa) or die(mysql_error());
$row_list_unidad = mysql_fetch_assoc($list_unidad);
$totalRows_list_unidad = mysql_num_rows($list_unidad);
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado de UNIDADES | SEIPSA S.A.C.</title>            
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Unidad</td>
                                <td>Lugar</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do { ?>
                            <tr>
                                <td><?php echo $row_list_unidad['id_unidad']; ?></td>
                                <td><a href="edi_unidad.php?id_unidad=<?php echo $row_list_unidad['id_unidad']; ?>"><?php echo $row_list_unidad['nombre_unidad']; ?></a></td>
                                <td><?php echo $row_list_unidad['lugar']; ?></td>
                            </tr>
                            <?php } while ($row_list_unidad = mysql_fetch_assoc($list_unidad)); ?>
                        </tbody>
                    </table>
                </div> <!-- /.container -->
            </div> <!-- /.row -->
        </div> <!-- /.col-md-12 -->

        <?php include("assets/footer.php"); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
<?php
mysql_free_result($list_unidad);
?>
