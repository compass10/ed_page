<?php
$pageTitle = '메뉴설정';
include 'header.php';

$menu_names = array(
  '1' => '학원소개',
  '2' => '시각디자인',
  '3' => '공업디자인',
  '4' => '입시정보',
  '5' => '합격자',
  '6' => '커뮤니티'
);

$menucode = isset($_GET['menucode']) ? $_GET['menucode'] : '';
$menu_sql = $menucode ? " WHERE page_parent='$menucode'" : "";
$mtitle = $menucode && isset($menu_names[$menucode]) ? '[' . $menu_names[$menucode] . '] ' : '';

$result = null;
if(isset($page_table)) {
  $sql = "SELECT * FROM $page_table $menu_sql ORDER BY page_code ASC, page_rank DESC";
  $result = @mysql_query($sql);
}
?>

<div class="filter_tabs">
  <a href="page_list.php" class="filter_tab <?=$menucode == '' ? 'active' : ''?>">전체</a>
  <?php foreach($menu_names as $key => $name): ?>
  <a href="page_list.php?menucode=<?=$key?>" class="filter_tab <?=$menucode == $key ? 'active' : ''?>"><?=$name?></a>
  <?php endforeach; ?>
</div>

<div class="page_actions">
  <a href="page_form.php?mode=write<?=$menucode ? '&menucode='.$menucode : ''?>" class="btn primary">+ 새 페이지</a>
</div>

<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="100">메뉴</th>
        <th width="100">코드</th>
        <th>타이틀</th>
        <th width="80">우선순위</th>
        <th width="80">조회수</th>
        <th width="80">보기</th>
        <th width="100">편집유형</th>
        <th width="80">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($result && @mysql_num_rows($result) > 0) {
        while($row = @mysql_fetch_array($result)) {
          $menu_name = isset($menu_names[$row['page_parent']]) ? $menu_names[$row['page_parent']] : '-';
      ?>
      <tr>
        <td><?=$menu_name?></td>
        <td><?=$row['page_code']?></td>
        <td><a href="page_form.php?mode=modify&page_no=<?=$row['page_no']?><?=$menucode ? '&menucode='.$menucode : ''?>"><?=$row['page_title']?></a></td>
        <td><?=$row['page_rank']?></td>
        <td><?=$row['page_view']?></td>
        <td><a href="<?=$_url?>?page=sub&pcode=<?=$row['page_code']?>" target="_blank" class="btn" style="padding: 6px 12px; font-size: 11px;">보기</a></td>
        <td>
          <?php
          if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/web/page_' . $row['page_code'] . '.php')) {
            echo 'page_' . $row['page_code'] . '.php';
          } else {
            echo '에디터';
          }
          ?>
        </td>
        <td><a href="page_form.php?mode=modify&page_no=<?=$row['page_no']?><?=$menucode ? '&menucode='.$menucode : ''?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 페이지가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
