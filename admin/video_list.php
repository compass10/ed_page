<?php
$pageTitle = '영상관리';
include 'header.php';

$video_types = array(
  '1' => '학원소개',
  '2' => '시각디자인',
  '3' => '공업디자인'
);

$type = isset($_GET['type']) ? $_GET['type'] : '1';
$bid = 'video' . $type;
$type_title = isset($video_types[$type]) ? $video_types[$type] : '학원소개';

$result = null;
if(isset($board_table)) {
  $sql = "SELECT * FROM $board_table WHERE bid='$bid' ORDER BY is_notice DESC, bpw DESC, bno DESC";
  $result = @mysql_query($sql);
}
?>

<div class="filter_tabs">
  <?php foreach($video_types as $key => $name): ?>
  <a href="video_list.php?type=<?=$key?>" class="filter_tab <?=$type == $key ? 'active' : ''?>"><?=$name?></a>
  <?php endforeach; ?>
</div>

<div class="page_actions">
  <a href="video_form.php?mode=write&type=<?=$type?>" class="btn primary">+ 새 <?=$type_title?> 영상</a>
</div>

<div class="table_section full">
  <table class="data_table">
    <thead>
      <tr>
        <th width="60">번호</th>
        <th width="100">썸네일</th>
        <th>제목</th>
        <th width="60">상위</th>
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
          <img src="<?=$_url?>thumb/gallery/<?=$row['bimg']?>" style="width: 80px; height: 52px; object-fit: cover;">
          <?php else: ?>
          -
          <?php endif; ?>
        </td>
        <td><a href="video_form.php?mode=modify&type=<?=$type?>&bno=<?=$row['bno']?>"><?=$row['btitle']?></a></td>
        <td><?=$row['is_notice'] == 'Y' ? '<span class="status new">Y</span>' : '-'?></td>
        <td><?=$row['bpw'] ? $row['bpw'] : '-'?></td>
        <td><?=$row['is_hidden'] == 'N' ? '<span class="status done">노출</span>' : '<span class="status">숨김</span>'?></td>
        <td><?=date('Y-m-d', strtotime($row['bregdate']))?></td>
        <td><a href="video_form.php?mode=modify&type=<?=$type?>&bno=<?=$row['bno']?>" class="btn" style="padding: 6px 12px; font-size: 11px;">수정</a></td>
      </tr>
      <?php
        }
      } else {
      ?>
      <tr>
        <td colspan="8" class="empty">등록된 <?=$type_title?> 영상이 없습니다.</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>
