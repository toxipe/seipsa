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
    $insertSQL = sprintf("INSERT INTO personal (id_per, dni, img_dni, venc_dni, estado_seipsa, ruc, apt_reniec, ape_pat, ape_mat, nombres, img_foto, grup_sang, cod_essalud, afp, cod_afp, cod_seipsa, est_sucamec, carnet_sucamec, img_carnet, car_suc_inicio, car_suc_fin, est_civil, email, fec_nac, nac_distrito, nac_provincia, nac_depart, nac_pais, tel_fijo, tel_cel1, tel_cel2, tel_cel3, niv_instruccion, talla, peso, n_calzado, ser_militar, t_servicios, grado, arma, unidad, img_croquis, img_licencia, img_ant_penal, img_ant_pol, img_ant_jud, img_rec_agua, img_rec_luz, log_personal, fecha_reg, auto_log) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                         GetSQLValueString($_POST['id_per'], "int"),
                         GetSQLValueString($_POST['dni'], "text"),
                         GetSQLValueString($_POST['img_dni'], "text"),
                         GetSQLValueString($_POST['venc_dni'], "date"),
                         GetSQLValueString($_POST['estado_seipsa'], "text"),
                         GetSQLValueString($_POST['ruc'], "int"),
                         GetSQLValueString(isset($_POST['apt_reniec']) ? "true" : "", "defined","1","0"),
                         GetSQLValueString($_POST['ape_pat'], "text"),
                         GetSQLValueString($_POST['ape_mat'], "text"),
                         GetSQLValueString($_POST['nombres'], "text"),
                         GetSQLValueString($_POST['img_foto'], "text"),
                         GetSQLValueString($_POST['grup_sang'], "text"),
                         GetSQLValueString($_POST['cod_essalud'], "text"),
                         GetSQLValueString($_POST['afp'], "text"),
                         GetSQLValueString($_POST['cod_afp'], "text"),
                         GetSQLValueString($_POST['cod_seipsa'], "text"),
                         GetSQLValueString($_POST['est_sucamec'], "text"),
                         GetSQLValueString($_POST['carnet_sucamec'], "text"),
                         GetSQLValueString($_POST['img_carnet'], "text"),
                         GetSQLValueString($_POST['car_suc_inicio'], "date"),
                         GetSQLValueString($_POST['car_suc_fin'], "date"),
                         GetSQLValueString($_POST['est_civil'], "text"),
                         GetSQLValueString($_POST['email'], "text"),
                         GetSQLValueString($_POST['fec_nac'], "date"),
                         GetSQLValueString($_POST['nac_distrito'], "text"),
                         GetSQLValueString($_POST['nac_provincia'], "text"),
                         GetSQLValueString($_POST['nac_depart'], "text"),
                         GetSQLValueString($_POST['nac_pais'], "text"),
                         GetSQLValueString($_POST['tel_fijo'], "text"),
                         GetSQLValueString($_POST['tel_cel1'], "text"),
                         GetSQLValueString($_POST['tel_cel2'], "text"),
                         GetSQLValueString($_POST['tel_cel3'], "text"),
                         GetSQLValueString($_POST['niv_instruccion'], "text"),
                         GetSQLValueString($_POST['talla'], "int"),
                         GetSQLValueString($_POST['peso'], "int"),
                         GetSQLValueString($_POST['n_calzado'], "int"),
                         GetSQLValueString(isset($_POST['ser_militar']) ? "true" : "", "defined","1","0"),
                         GetSQLValueString($_POST['t_servicios'], "text"),
                         GetSQLValueString($_POST['grado'], "text"),
                         GetSQLValueString($_POST['arma'], "text"),
                         GetSQLValueString($_POST['unidad'], "text"),
                         GetSQLValueString($_POST['img_croquis'], "text"),
                         GetSQLValueString($_POST['img_licencia'], "text"),
                         GetSQLValueString($_POST['img_ant_penal'], "text"),
                         GetSQLValueString($_POST['img_ant_pol'], "text"),
                         GetSQLValueString($_POST['img_ant_jud'], "text"),
                         GetSQLValueString($_POST['img_rec_agua'], "text"),
                         GetSQLValueString($_POST['img_rec_luz'], "text"),
                         GetSQLValueString($_POST['log_personal'], "text"),
                         GetSQLValueString($_POST['fecha_reg'], "date"),
                         GetSQLValueString($_POST['auto_log'], "text"));

    mysql_select_db($database_seipsa, $seipsa);
    $Result1 = mysql_query($insertSQL, $seipsa) or die(mysql_error());

    $insertGoTo = "listar.php";
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
        <title>Registro de personal nuevo &#124; SEIPSA S.A.C.</title>            
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
                    <td nowrap align="right">Nº de DNI:</td>
                    <td><input type="text" name="dni" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Imagen DNI:</td>
                    <td><input type="text" name="img_dni" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Venc_dni:</td>
                    <td><input type="text" name="venc_dni" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Estado SEIPSA:</td>
                    <td><select name="estado_seipsa">
                        <option value="Activo" <?php if (!(strcmp("Activo", "Activo"))) {echo "SELECTED";} ?>>Activo</option>
                        <option value="Inactivo" <?php if (!(strcmp("Inactivo", "Activo"))) {echo "SELECTED";} ?>>Inactivo</option>
                        </select></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Ruc:</td>
                    <td><input type="text" name="ruc" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Apt_reniec:</td>
                    <td><input type="checkbox" name="apt_reniec" value="" ></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Ape_pat:</td>
                    <td><input type="text" name="ape_pat" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Ape_mat:</td>
                    <td><input type="text" name="ape_mat" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Nombres:</td>
                    <td><input type="text" name="nombres" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_foto:</td>
                    <td><input type="text" name="img_foto" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Grup_sang:</td>
                    <td><input type="text" name="grup_sang" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Cod_essalud:</td>
                    <td><input type="text" name="cod_essalud" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Afp:</td>
                    <td><input type="text" name="afp" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Cod_afp:</td>
                    <td><input type="text" name="cod_afp" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Cod_seipsa:</td>
                    <td><input type="text" name="cod_seipsa" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Est_sucamec:</td>
                    <td><select name="est_sucamec">
                        <option value="V" <?php if (!(strcmp("V", ""))) {echo "SELECTED";} ?>>Vigente</option>
                        <option value="H" <?php if (!(strcmp("H", ""))) {echo "SELECTED";} ?>>Baja</option>
                        </select></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Carnet_sucamec:</td>
                    <td><input type="text" name="carnet_sucamec" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_carnet:</td>
                    <td><input type="text" name="img_carnet" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Car_suc_inicio:</td>
                    <td><input type="text" name="car_suc_inicio" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Car_suc_fin:</td>
                    <td><input type="text" name="car_suc_fin" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Est_civil:</td>
                    <td><select name="est_civil">
                        <option value="Soltero" <?php if (!(strcmp("Soltero", ""))) {echo "SELECTED";} ?>>Soltero</option>
                        <option value="Conviviente" <?php if (!(strcmp("Conviviente", ""))) {echo "SELECTED";} ?>>Conviviente</option>
                        <option value="Casado" <?php if (!(strcmp("Casado", ""))) {echo "SELECTED";} ?>>Casado</option>
                        <option value="Divorciado" <?php if (!(strcmp("Divorciado", ""))) {echo "SELECTED";} ?>>Divorciado</option>
                        <option value="Viudo" <?php if (!(strcmp("Viudo", ""))) {echo "SELECTED";} ?>>Viudo</option>
                        </select></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Email:</td>
                    <td><input type="text" name="email" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Fec_nac:</td>
                    <td><input type="text" name="fec_nac" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Nac_distrito:</td>
                    <td><input type="text" name="nac_distrito" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Nac_provincia:</td>
                    <td><input type="text" name="nac_provincia" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Nac_depart:</td>
                    <td><input type="text" name="nac_depart" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Nac_pais:</td>
                    <td><input type="text" name="nac_pais" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Tel_fijo:</td>
                    <td><input type="text" name="tel_fijo" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Tel_cel1:</td>
                    <td><input type="text" name="tel_cel1" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Tel_cel2:</td>
                    <td><input type="text" name="tel_cel2" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Tel_cel3:</td>
                    <td><input type="text" name="tel_cel3" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Niv_instruccion:</td>
                    <td><select name="niv_instruccion">
                        <option value="Secundaria incompleta" <?php if (!(strcmp("Secundaria incompleta", ""))) {echo "SELECTED";} ?>>Secundaria incompleta</option>
                        <option value="Secundaria completa" <?php if (!(strcmp("Secundaria completa", ""))) {echo "SELECTED";} ?>>Secundaria completa</option>
                        <option value="Superior no universitaria incompleta" <?php if (!(strcmp("Superior no universitaria incompleta", ""))) {echo "SELECTED";} ?>>Superior no universitaria incompleta</option>
                        <option value="Superior no universitaria completa" <?php if (!(strcmp("Superior no universitaria completa", ""))) {echo "SELECTED";} ?>>Superior no universitaria completa</option>
                        <option value="Superior universitaria incompleta" <?php if (!(strcmp("Superior universitaria incompleta", ""))) {echo "SELECTED";} ?>>Superior universitaria incompleta</option>
                        <option value="Superior universitaria completa" <?php if (!(strcmp("Superior universitaria completa", ""))) {echo "SELECTED";} ?>>Superior universitaria completa</option>
                        </select></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Talla:</td>
                    <td><input type="text" name="talla" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Peso:</td>
                    <td><input type="text" name="peso" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">N_calzado:</td>
                    <td><input type="text" name="n_calzado" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Ser_militar:</td>
                    <td><input type="checkbox" name="ser_militar" value="" ></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">T_servicios:</td>
                    <td><input type="text" name="t_servicios" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Grado:</td>
                    <td><input type="text" name="grado" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Arma:</td>
                    <td><input type="text" name="arma" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Unidad:</td>
                    <td><input type="text" name="unidad" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_croquis:</td>
                    <td><input type="text" name="img_croquis" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_licencia:</td>
                    <td><input type="text" name="img_licencia" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_ant_penal:</td>
                    <td><input type="text" name="img_ant_penal" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_ant_pol:</td>
                    <td><input type="text" name="img_ant_pol" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_ant_jud:</td>
                    <td><input type="text" name="img_ant_jud" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_rec_agua:</td>
                    <td><input type="text" name="img_rec_agua" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Img_rec_luz:</td>
                    <td><input type="text" name="img_rec_luz" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Log_personal:</td>
                    <td><input type="text" name="log_personal" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Fecha_reg:</td>
                    <td><input type="text" name="fecha_reg" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">Auto_log:</td>
                    <td><input type="text" name="auto_log" value="" size="32"></td>
                </tr>
                <tr valign="baseline">
                    <td nowrap align="right">&nbsp;</td>
                    <td><input type="submit" value="Insertar registro"></td>
                </tr>
            </table>
            <input type="hidden" name="id_per" value="">
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