<?php
$pageTitle = '메인 유튜브 관리';
include 'header.php';

$bid = 'youtube';

$result = null;
if(isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bid='$bid' ORDER BY bpw DESC, bno DESC";
  $result = @mysql_query($sql);
}
?>

<div class="page_actions">
  <a href="youtube_form.php?mode=write" class="btn primary">+ 새 유튜브 영상</a>
</div>

<p style="color: #888; font-size: 13px; margin-bottom: 15px;">* 메인 페이지 하단 유튜브 섹션에 노출됩니다. (최대 7개 권장)</p>

<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="120">썸네일</th>
        <th>제목</th>
        <th width="200">유튜브 URL</th>
        <th width="60">가중치</th>
        <th width="80">노출</th>
        <th width="100">등록일</th>
        <th width="80">관리</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($result && @mysql_num_rows($result) > 0) {
        $num = 1;
        while($row = @mysql_fetch_array($result)) {
      ?>
      <tr>
        <td><?=$num++?></td>
        <td>
          <?php if($row['bimg']): ?>
          <img src="<?=$_url?>thumb/youtube/<?=$row['bimg']?>" style="width: 100px; height: 56px; object-fit: cover; border-radius: 4px;">
          <?php else: ?>
          <span style="color: #ccc;">-</span>
          <?php endif; ?>
        </td>
        <td><a href="youtube_form.php?mode=modify&bno=<?=$row['bno']?>"><?=$row['btitle'] ? $row['btitle'] : '(제목없음)'?></a></td>
        <td>
          <?php if($row['blink']): ?>
          <a href="https://www.youtube.com/watch?v=<?=$row['blink']?>" target="_blank" style="color: #666; font-size: 12px;">
            <?=$row['blink']?>
          </a>
          <?php else: ?>
          <span style="color: #ccc;">-</span>
          <?php endif; ?>
        </td>
        <td><?=$row['bpw'] ? $row['bpw'] : '-'?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="youtube_form.php?mode=modify&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 유튜브 영상이 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
