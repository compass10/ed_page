<?php
$pageTitle = '자주묻는질문';
include 'header.php';

$result = null;
if(isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bid='faq' ORDER BY is_notice DESC, bno DESC";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="faq_form.php?mode=write" class="btn primary">+ 새 질문</a>
</div>

<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th>제목</th>
        <th width="60">상위</th>
        <th width="80">노출</th>
        <th width="100">등록일</th>
        <th width="80">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($result && @mysql_num_rows($result) > 0) {
        while($row = @mysql_fetch_array($result)) {
      ?>
      <tr>
        <td><?=$row['bno']?></td>
        <td><a href="faq_form.php?mode=modify&bno=<?=$row['bno']?>"><?=$row['btitle']?></a></td>
        <td><?=$row['is_notice'] == 'Y' ? '<span class="status new">Y</span>' : '-'?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="faq_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="6" class="empty">등록된 질문이 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
