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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO unidades (id_unidad, activo, nombre_unidad, representante, lugar, telefonos, fecha_inicio, fecha_fin, fec_registro, auto_log) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                         GetSQLValueString($_POST['id_unidad'], "int"),
                         GetSQLValueString(isset($_POST['activo']) ? "true" : "", "defined","1","0"),
                         GetSQLValueString($_POST['nombre_unidad'], "text"),
                         GetSQLValueString($_POST['representante'], "text"),
                         GetSQLValueString($_POST['lugar'], "text"),
                         GetSQLValueString($_POST['telefonos'], "text"),
                         GetSQLValueString($_POST['fecha_inicio'], "date"),
                         GetSQLValueString($_POST['fecha_fin'], "date"),
                         GetSQLValueString($_POST['fec_registro'], "date"),
                         GetSQLValueString($_POST['auto_log'], "text"));

    mysql_select_db($database_seipsa, $seipsa);
    $Result1 = mysql_query($insertSQL, $seipsa) or die(mysql_error());

    $insertGoTo = "listar_unidad.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro de UNIDAD NUEVA | SEIPSA S.A.C.</title>            
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
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table align="center">
                <tr valign="baseline">
                    <td nowrap align="right">Activo:</td>
                    <td><input type="checkbox" name="activo" value="" ></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Nombre_unidad:</td>
                    <td><input type="text" name="nombre_unidad" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Representante:</td>
                    <td><input type="text" name="representante" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Lugar:</td>
                    <td><input type="text" name="lugar" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Telefonos:</td>
                    <td><input type="text" name="telefonos" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Fecha_inicio:</td>
                    <td><input type="text" name="fecha_inicio" value="<?php 
date_default_timezone_set('America/Lima');
echo date("Y-m-d H:i:s"); ?>" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Fecha_fin:</td>
                    <td><input type="text" name="fecha_fin" value="<?php 
date_default_timezone_set('America/Lima');
echo date("Y-m-d H:i:s"); ?>" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">&nbsp;</td>
                    <td><input type="submit" value="Insertar datos"></td>
                </tr>
            </table>
            <input type="hidden" name="id_unidad" value="">
            <input type="hidden" name="fec_registro" value="<?php 
date_default_timezone_set('America/Lima');
echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="auto_log" value="">
            <input type="hidden" name="MM_insert" value="form1">
        </form>
        <p>&nbsp;</p>
        <?php include("assets/footer.php"); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>