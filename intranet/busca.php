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

$colname_resulta_busca = "-1";
if (isset($_POST['ape_pat'])) {
  $colname_resulta_busca = $_POST['ape_pat'];
}
mysql_select_db($database_seipsa, $seipsa);
$query_resulta_busca = sprintf("SELECT * FROM personal WHERE ape_pat LIKE %s", GetSQLValueString("%" . $colname_resulta_busca . "%", "text"));
$resulta_busca = mysql_query($query_resulta_busca, $seipsa) or die(mysql_error());
$row_resulta_busca = mysql_fetch_assoc($resulta_busca);
$totalRows_resulta_busca = mysql_num_rows($resulta_busca);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>buscar</title>
</head>

<body>
<table width="70%" border="1">
  <tr>
    <td>DNI</td>
    <td>Apellidos y nombres</td>
    <td>Nº Carnet</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="edit_basic.php?id_per=<?php echo $row_resulta_busca['id_per']; ?>"><?php echo $row_resulta_busca['dni']; ?></a></td>
      <td><a href="edit_basic.php?id_per=<?php echo $row_resulta_busca['id_per']; ?>"><?php echo $row_resulta_busca['ape_pat']; ?> <?php echo $row_resulta_busca['ape_mat']; ?>, <?php echo $row_resulta_busca['nombres']; ?></a></td>
      <td><?php echo $row_resulta_busca['carnet_sucamec']; ?></td>
    </tr>
    <?php } while ($row_resulta_busca = mysql_fetch_assoc($resulta_busca)); ?>
</table>

</body>
</html>
<?php
mysql_free_result($resulta_busca);
?>
