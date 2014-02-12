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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE personal SET dni=%s, venc_dni=%s, ruc=%s, apt_reniec=%s, ape_pat=%s, ape_mat=%s, nombres=%s, grup_sang=%s, cod_seipsa=%s, est_sucamec=%s, carnet_sucamec=%s, car_suc_inicio=%s, car_suc_fin=%s, fec_nac=%s, tel_cel1=%s, tel_cel2=%s, tel_cel3=%s, cert_dom=%s, ant_polic=%s, ant_penal=%s, niv_instruccion=%s, ser_militar=%s, auto_log=%s WHERE id_per=%s",
                       GetSQLValueString($_POST['dni'], "text"),
                       GetSQLValueString($_POST['venc_dni'], "date"),

                       GetSQLValueString($_POST['ruc'], "int"),
                       GetSQLValueString(isset($_POST['apt_reniec']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['ape_pat'], "text"),
                       GetSQLValueString($_POST['ape_mat'], "text"),
                       GetSQLValueString($_POST['nombres'], "text"),
                       
                       GetSQLValueString($_POST['grup_sang'], "text"),
                       GetSQLValueString($_POST['cod_seipsa'], "text"),
                       GetSQLValueString($_POST['est_sucamec'], "text"),
                       GetSQLValueString($_POST['carnet_sucamec'], "text"),
                       GetSQLValueString($_POST['car_suc_inicio'], "date"),
                       GetSQLValueString($_POST['car_suc_fin'], "date"),
                       GetSQLValueString($_POST['fec_nac'], "date"),
                       GetSQLValueString($_POST['tel_cel1'], "text"),
                       GetSQLValueString($_POST['tel_cel2'], "text"),
                       GetSQLValueString($_POST['tel_cel3'], "text"),
                       GetSQLValueString($_POST['niv_instruccion'], "text"),
                       GetSQLValueString(isset($_POST['ser_militar']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['auto_log'], "text"));

  mysql_select_db($database_seipsa, $seipsa);
  $Result1 = mysql_query($updateSQL, $seipsa) or die(mysql_error());

  $updateGoTo = "listar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$maxRows_list_to_edit = 1;
$pageNum_list_to_edit = 0;
if (isset($_GET['pageNum_list_to_edit'])) {
  $pageNum_list_to_edit = $_GET['pageNum_list_to_edit'];
}
$startRow_list_to_edit = $pageNum_list_to_edit * $maxRows_list_to_edit;

$colname_list_to_edit = "-1";
if (isset($_GET['id_per'])) {
  $colname_list_to_edit = $_GET['id_per'];
}
mysql_select_db($database_seipsa, $seipsa);
$query_list_to_edit = sprintf("SELECT * FROM personal WHERE id_per = %s", GetSQLValueString($colname_list_to_edit, "int"));
$query_limit_list_to_edit = sprintf("%s LIMIT %d, %d", $query_list_to_edit, $startRow_list_to_edit, $maxRows_list_to_edit);
$list_to_edit = mysql_query($query_limit_list_to_edit, $seipsa) or die(mysql_error());
$row_list_to_edit = mysql_fetch_assoc($list_to_edit);

if (isset($_GET['totalRows_list_to_edit'])) {
  $totalRows_list_to_edit = $_GET['totalRows_list_to_edit'];
} else {
  $all_list_to_edit = mysql_query($query_list_to_edit);
  $totalRows_list_to_edit = mysql_num_rows($all_list_to_edit);
}
$totalPages_list_to_edit = ceil($totalRows_list_to_edit/$maxRows_list_to_edit)-1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php include("assets/buscar_form.php"); ?>

<p align="center"><a href="listar.php"> &larr; Volver </a></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Id_per:</td>
      <td><?php echo $row_list_to_edit['id_per']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Dni:</td>
      <td><input type="text" name="dni" value="<?php echo htmlentities($row_list_to_edit['dni'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Venc_dni:</td>
      <td><input type="text" name="venc_dni" value="<?php echo htmlentities($row_list_to_edit['venc_dni'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>

    <tr valign="baseline">
      <td nowrap align="right">Ruc:</td>
      <td><input type="text" name="ruc" value="<?php echo htmlentities($row_list_to_edit['ruc'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Apt_reniec:</td>
      <td><input type="checkbox" name="apt_reniec" value=""  <?php if (!(strcmp($row_list_to_edit['apt_reniec'],""))) {echo "checked=\"checked\"";} ?>></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ape_pat:</td>
      <td><input type="text" name="ape_pat" value="<?php echo htmlentities($row_list_to_edit['ape_pat'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ape_mat:</td>
      <td><input type="text" name="ape_mat" value="<?php echo htmlentities($row_list_to_edit['ape_mat'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nombres:</td>
      <td><input type="text" name="nombres" value="<?php echo htmlentities($row_list_to_edit['nombres'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Img_foto:</td>
      <td><img src="http://placedog.com/200/200" alt="Foto"><!--<input type="text" name="img_foto" value="<?php echo htmlentities($row_list_to_edit['img_foto'], ENT_COMPAT, 'utf-8'); ?>" size="32">--></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Grup_sang:</td>
      <td><input type="text" name="grup_sang" value="<?php echo htmlentities($row_list_to_edit['grup_sang'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Cod_seipsa:</td>
      <td><input type="text" name="cod_seipsa" value="<?php echo htmlentities($row_list_to_edit['cod_seipsa'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Est_sucamec:</td>
      <td><select name="est_sucamec">
        <option value="V" <?php if (!(strcmp("V", htmlentities($row_list_to_edit['est_sucamec'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Vigente</option>
        <option value="H" <?php if (!(strcmp("H", htmlentities($row_list_to_edit['est_sucamec'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Baja</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Carnet_sucamec:</td>
      <td><input type="text" name="carnet_sucamec" value="<?php echo htmlentities($row_list_to_edit['carnet_sucamec'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Car_suc_inicio:</td>
      <td><input type="text" name="car_suc_inicio" value="<?php echo htmlentities($row_list_to_edit['car_suc_inicio'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Car_suc_fin:</td>
      <td><input type="text" name="car_suc_fin" value="<?php echo htmlentities($row_list_to_edit['car_suc_fin'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Fec_nac:</td>
      <td><input type="text" name="fec_nac" value="<?php echo htmlentities($row_list_to_edit['fec_nac'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tel_cel1:</td>
      <td><input type="text" name="tel_cel1" value="<?php echo htmlentities($row_list_to_edit['tel_cel1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tel_cel2:</td>
      <td><input type="text" name="tel_cel2" value="<?php echo htmlentities($row_list_to_edit['tel_cel2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tel_cel3:</td>
      <td><input type="text" name="tel_cel3" value="<?php echo htmlentities($row_list_to_edit['tel_cel3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Niv_instruccion:</td>
      <td><input type="text" name="niv_instruccion" value="<?php echo htmlentities($row_list_to_edit['niv_instruccion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Ser_militar:</td>
      <td><input type="checkbox" name="ser_militar" value=""  <?php if (!(strcmp(htmlentities($row_list_to_edit['ser_militar'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Actualizar registro"></td>
    </tr>
  </table>
  <input type="hidden" name="auto_log" value="<?php echo htmlentities($row_list_to_edit['auto_log'], ENT_COMPAT, 'utf-8'); ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_per" value="<?php echo $row_list_to_edit['id_per']; ?>">
</form>
</body>
</html>
<?php
mysql_free_result($list_to_edit);
?>
