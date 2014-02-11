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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_lista_1 = 25;
$pageNum_lista_1 = 0;
if (isset($_GET['pageNum_lista_1'])) {
  $pageNum_lista_1 = $_GET['pageNum_lista_1'];
}
$startRow_lista_1 = $pageNum_lista_1 * $maxRows_lista_1;

mysql_select_db($database_seipsa, $seipsa);
$query_lista_1 = "SELECT * FROM personal ORDER BY ape_pat ASC";
$query_limit_lista_1 = sprintf("%s LIMIT %d, %d", $query_lista_1, $startRow_lista_1, $maxRows_lista_1);
$lista_1 = mysql_query($query_limit_lista_1, $seipsa) or die(mysql_error());
$row_lista_1 = mysql_fetch_assoc($lista_1);

if (isset($_GET['totalRows_lista_1'])) {
  $totalRows_lista_1 = $_GET['totalRows_lista_1'];
} else {
  $all_lista_1 = mysql_query($query_lista_1);
  $totalRows_lista_1 = mysql_num_rows($all_lista_1);
}
$totalPages_lista_1 = ceil($totalRows_lista_1/$maxRows_lista_1)-1;

$queryString_lista_1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_lista_1") == false && 
        stristr($param, "totalRows_lista_1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_lista_1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_lista_1 = sprintf("&totalRows_lista_1=%d%s", $totalRows_lista_1, $queryString_lista_1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<form action="busca.php" method="post" name="busqueda">
<input name="ape_pat" type="text" value="" size="32" maxlength="32">
<input name="Buscar" type="submit" value="Buscar">
</form>

<table width="70%" border="1">
  <tr>
    <td>DNI</td>
    <td>Apellidos y nombres</td>
    <td>Carnet SUCamec</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="edit_basic.php?id_per=<?php echo $row_lista_1['id_per']; ?>"><?php echo $row_lista_1['dni']; ?></a></td>
      <td><a href="edit_basic.php?id_per=<?php echo $row_lista_1['id_per']; ?>"><?php echo $row_lista_1['ape_pat']; ?> <?php echo $row_lista_1['ape_mat']; ?>, <?php echo $row_lista_1['nombres']; ?></a></td>
      <td><?php echo $row_lista_1['carnet_sucamec']; ?></td>
    </tr>
    <?php } while ($row_lista_1 = mysql_fetch_assoc($lista_1)); ?>
</table>
<p>&nbsp;
Registros <?php echo ($startRow_lista_1 + 1) ?> a <?php echo min($startRow_lista_1 + $maxRows_lista_1, $totalRows_lista_1) ?> de <?php echo $totalRows_lista_1 ?> </p>
<table border="0">
  <tr>
    <td><?php if ($pageNum_lista_1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_lista_1=%d%s", $currentPage, 0, $queryString_lista_1); ?>"><img src="First.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_lista_1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_lista_1=%d%s", $currentPage, max(0, $pageNum_lista_1 - 1), $queryString_lista_1); ?>"><img src="Previous.gif"></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_lista_1 < $totalPages_lista_1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_lista_1=%d%s", $currentPage, min($totalPages_lista_1, $pageNum_lista_1 + 1), $queryString_lista_1); ?>"><img src="Next.gif"></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_lista_1 < $totalPages_lista_1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_lista_1=%d%s", $currentPage, $totalPages_lista_1, $queryString_lista_1); ?>"><img src="Last.gif"></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($lista_1);
?>
