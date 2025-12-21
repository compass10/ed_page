<?php
$pageTitle = 'ED커뮤니티';
include 'header.php';

$result = null;
if(isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bid='link' ORDER BY bpw+0 DESC, bno DESC";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="link_form.php?mode=write" class="btn primary">+ 새 커뮤니티</a>
</div>

<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="100">썸네일</th>
        <th>제목</th>
        <th>주소</th>
        <th width="60">가중치</th>
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
        <td>
          <?php if($row['bimg']): ?>
          <img src="<?=$_url?>thumb/link/<?=$row['bimg']?>" style="width: 80px; height: 52px; object-fit: cover;">
          <?php else: ?>
          -
          <?php endif; ?>
        </td>
        <td><a href="link_form.php?mode=modify&bno=<?=$row['bno']?>"><?=$row['btitle']?></a></td>
        <td><?=$row['blink'] ? '<a href="'.$row['blink'].'" target="_blank">'.$row['blink'].'</a>' : '-'?></td>
        <td><?=$row['bpw'] ? $row['bpw'] : '-'?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="link_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 커뮤니티가 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
