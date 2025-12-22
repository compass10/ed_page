<?php
// lib.php에서 세션 시작 (세션 경로 설정 포함)
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 이미 로그인 상태면 관리 페이지로 이동
if(isset($_SESSION['logged_no']) && $_SESSION['logged_no']) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ED Admin Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pretendard:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.typekit.net/nkq2hxd.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Pretendard', sans-serif;
      background: #000;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login_container {
      width: 100%;
      max-width: 400px;
      padding: 60px 40px;
      background: #fff;
    }

    .login_logo {
      text-align: center;
      margin-bottom: 48px;
    }

    .login_logo h1 {
      font-family: avenir-next-lt-pro-condensed, sans-serif;
      font-weight: 700;
      font-size: 48px;
      letter-spacing: -0.03em;
      text-transform: uppercase;
    }

    .login_logo p {
      font-size: 14px;
      color: #666;
      margin-top: 8px;
    }

    .login_form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .form_group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form_group label {
      font-weight: 700;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: -0.03em;
    }

    .form_group input {
      width: 100%;
      padding: 14px 16px;
      border: 1px solid #000;
      font-family: 'Pretendard', sans-serif;
      font-size: 14px;
      outline: none;
      transition: background 0.2s;
    }

    .form_group input:focus {
      background: #f8f8f8;
    }

    .login_btn {
      width: 100%;
      padding: 16px;
      background: #000;
      color: #fff;
      border: none;
      font-family: 'Pretendard', sans-serif;
      font-weight: 700;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: -0.03em;
      cursor: pointer;
      margin-top: 16px;
      transition: background 0.2s;
    }

    .login_btn:hover {
      background: #333;
    }

    .error_msg {
      color: #e74c3c;
      font-size: 13px;
      text-align: center;
      margin-bottom: 16px;
    }
  </style>
</head>
<body>
  <div class="login_container">
    <div class="login_logo">
      <h1>ED Admin</h1>
      <p>Management System</p>
    </div>

    <?php if(isset($_GET['error'])): ?>
    <p class="error_msg">
      <?php
        switch($_GET['error']) {
          case 'empty': echo '아이디와 비밀번호를 입력해주세요.'; break;
          case 'invalid': echo '아이디 또는 비밀번호가 올바르지 않습니다.'; break;
          case 'session': echo '세션이 만료되었습니다. 다시 로그인해주세요.'; break;
          case 'db': echo 'DB 연결 실패 (lib.php 경로 확인)'; break;
          case 'query': echo 'DB 쿼리 실패'; break;
          default: echo '로그인에 실패했습니다.';
        }
      ?>
    </p>
    <?php endif; ?>

    <form class="login_form" method="post" action="login_ok.php">
      <div class="form_group">
        <label for="user_id">Username</label>
        <input type="text" id="user_id" name="user_id" placeholder="아이디" required>
      </div>
      <div class="form_group">
        <label for="user_pw">Password</label>
        <input type="password" id="user_pw" name="user_pw" placeholder="비밀번호" required>
      </div>
      <button type="submit" class="login_btn">Login</button>
    </form>
  </div>
</body>
</html>
