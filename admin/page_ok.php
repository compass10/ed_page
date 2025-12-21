<?php
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$mode = $_REQUEST['mode'];
$page_no = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : '';
$menucode = isset($_REQUEST['menucode']) ? $_REQUEST['menucode'] : '';

$list_url = 'page_list.php' . ($menucode ? '?menucode=' . $menucode : '');

if($mode == 'write' || $mode == '') {
  $page_parent = mysql_real_escape_string($_POST['page_parent']);
  $page_code = mysql_real_escape_string($_POST['page_code']);
  $page_title = mysql_real_escape_string($_POST['page_title']);
  $page_content = mysql_real_escape_string($_POST['page_content']);
  $page_rank = isset($_POST['page_rank']) ? (int)$_POST['page_rank'] : 0;

  $sql = "INSERT INTO $page_table (page_parent, page_code, page_title, page_content, page_rank, page_view)
    VALUES ('$page_parent', '$page_code', '$page_title', '$page_content', '$page_rank', 0)";
  mysql_query($sql);

} else if($mode == 'modify') {
  $page_parent = mysql_real_escape_string($_POST['page_parent']);
  $page_code = mysql_real_escape_string($_POST['page_code']);
  $page_title = mysql_real_escape_string($_POST['page_title']);
  $page_content = mysql_real_escape_string($_POST['page_content']);
  $page_rank = isset($_POST['page_rank']) ? (int)$_POST['page_rank'] : 0;

  $sql = "UPDATE $page_table SET
    page_parent='$page_parent',
    page_code='$page_code',
    page_title='$page_title',
    page_content='$page_content',
    page_rank='$page_rank'
    WHERE page_no='$page_no'";
  mysql_query($sql);

} else if($mode == 'delete') {
  mysql_query("DELETE FROM $page_table WHERE page_no='$page_no'");
  echo "<script>alert('삭제되었습니다.'); location.href='$list_url';</script>";
  exit;
}

echo "<script>alert('저장되었습니다.'); location.href='$list_url';</script>";
@mysql_close($connect);
?>
