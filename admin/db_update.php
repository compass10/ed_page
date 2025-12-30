<?php
header('Content-Type: text/html; charset=utf-8');
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php");
  exit;
}

$messages = array();

// bext1 컬럼 추가 (Who We Are 노출용)
if(isset($_POST['add_bext1'])) {
  $check = @mysql_query("SHOW COLUMNS FROM $board_table LIKE 'bext1'");
  if(@mysql_num_rows($check) > 0) {
    $messages[] = array('type' => 'info', 'msg' => 'bext1 컬럼이 이미 존재합니다.');
  } else {
    $result = @mysql_query("ALTER TABLE $board_table ADD COLUMN bext1 VARCHAR(1) DEFAULT 'N'");
    if($result) {
      $messages[] = array('type' => 'success', 'msg' => 'bext1 컬럼이 추가되었습니다.');
    } else {
      $messages[] = array('type' => 'error', 'msg' => 'bext1 컬럼 추가 실패: ' . mysql_error());
    }
  }
}

// blink 컬럼 추가 (And More 링크용)
if(isset($_POST['add_blink'])) {
  $check = @mysql_query("SHOW COLUMNS FROM $board_table LIKE 'blink'");
  if(@mysql_num_rows($check) > 0) {
    $messages[] = array('type' => 'info', 'msg' => 'blink 컬럼이 이미 존재합니다.');
  } else {
    $result = @mysql_query("ALTER TABLE $board_table ADD COLUMN blink VARCHAR(500) DEFAULT ''");
    if($result) {
      $messages[] = array('type' => 'success', 'msg' => 'blink 컬럼이 추가되었습니다.');
    } else {
      $messages[] = array('type' => 'error', 'msg' => 'blink 컬럼 추가 실패: ' . mysql_error());
    }
  }
}

// 현재 컬럼 상태 확인
$columns = array();
$col_result = @mysql_query("SHOW COLUMNS FROM $board_table");
if($col_result) {
  while($col = @mysql_fetch_array($col_result)) {
    $columns[] = $col['Field'];
  }
}

$has_bext1 = in_array('bext1', $columns);
$has_blink = in_array('blink', $columns);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB 업데이트</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Pretendard', sans-serif; background: #f5f5f5; padding: 40px; }
    .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h1 { font-size: 24px; margin-bottom: 20px; color: #333; }
    .msg { padding: 12px 16px; border-radius: 6px; margin-bottom: 15px; }
    .msg.success { background: #d4edda; color: #155724; }
    .msg.error { background: #f8d7da; color: #721c24; }
    .msg.info { background: #d1ecf1; color: #0c5460; }
    .section { border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
    .section h3 { font-size: 16px; margin-bottom: 10px; }
    .section p { font-size: 14px; color: #666; margin-bottom: 15px; }
    .status { display: inline-block; padding: 4px 10px; border-radius: 4px; font-size: 12px; font-weight: 500; }
    .status.done { background: #d4edda; color: #155724; }
    .status.pending { background: #fff3cd; color: #856404; }
    .btn { display: inline-block; padding: 10px 20px; background: #333; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; }
    .btn:hover { background: #555; }
    .btn:disabled { background: #ccc; cursor: not-allowed; }
    .back { display: inline-block; margin-top: 20px; color: #666; text-decoration: none; }
    .back:hover { color: #333; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #eee; font-size: 13px; }
    th { background: #f9f9f9; font-weight: 500; }
  </style>
</head>
<body>
  <div class="container">
    <h1>DB 테이블 업데이트</h1>

    <?php foreach($messages as $m): ?>
    <div class="msg <?=$m['type']?>"><?=$m['msg']?></div>
    <?php endforeach; ?>

    <div class="section">
      <h3>1. bext1 컬럼 (Who We Are 노출)</h3>
      <p>뉴스 게시물의 Who We Are 페이지 노출 여부를 저장하는 컬럼입니다.</p>
      <span class="status <?=$has_bext1 ? 'done' : 'pending'?>">
        <?=$has_bext1 ? '추가됨' : '미추가'?>
      </span>
      <?php if(!$has_bext1): ?>
      <form method="post" style="display: inline; margin-left: 10px;">
        <button type="submit" name="add_bext1" class="btn">컬럼 추가</button>
      </form>
      <?php endif; ?>
    </div>

    <div class="section">
      <h3>2. blink 컬럼 (And More 링크)</h3>
      <p>And More 섹션의 링크 URL을 저장하는 컬럼입니다.</p>
      <span class="status <?=$has_blink ? 'done' : 'pending'?>">
        <?=$has_blink ? '추가됨' : '미추가'?>
      </span>
      <?php if(!$has_blink): ?>
      <form method="post" style="display: inline; margin-left: 10px;">
        <button type="submit" name="add_blink" class="btn">컬럼 추가</button>
      </form>
      <?php endif; ?>
    </div>

    <h3 style="margin-top: 30px; margin-bottom: 10px;">현재 테이블 컬럼 목록</h3>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>컬럼명</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($columns as $i => $col): ?>
        <tr>
          <td><?=$i+1?></td>
          <td><?=$col?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a href="index.php" class="back">&larr; 대시보드로 돌아가기</a>
  </div>
</body>
</html>
