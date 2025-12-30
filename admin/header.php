<?php
// DB 연결 (운영서버 lib.php 사용)
// /web/new/admin/ 에서 /web/lib.php 로 접근
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

// 로그인 체크
if(!isset($_SESSION['logged_no']) || !$_SESSION['logged_no']) {
  header("Location: login.php?error=session");
  exit;
}

// 관리자 권한 체크 (DB 연결 시)
$member = array();
if(function_exists('mysql_query') && isset($member_table)) {
  $member = @mysql_fetch_array(@mysql_query("SELECT * FROM $member_table WHERE user_no='{$_SESSION['logged_no']}'"));
  if(!$member || $member['user_level'] != '1') {
    header("Location: login.php?error=invalid");
    exit;
  }
}

// 현재 페이지 확인
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// 메뉴 활성화 체크
$active_setup = in_array($current_page, array('setup', 'mainbanner_list', 'mainbanner_form')) ? 'active' : '';
$active_youtube = in_array($current_page, array('youtube_list', 'youtube_form')) ? 'active' : '';
$active_passlist = in_array($current_page, array('passlist_list', 'passlist_form')) ? 'active' : '';
$active_portfolio = in_array($current_page, array('portfolio_list', 'portfolio_form')) ? 'active' : '';
$active_portslide = in_array($current_page, array('portslide_list', 'portslide_form')) ? 'active' : '';
$active_mainnews = in_array($current_page, array('mainnews_list', 'mainnews_form')) ? 'active' : '';
$active_andmore = in_array($current_page, array('andmore_list', 'andmore_form')) ? 'active' : '';
$active_inquiry = in_array($current_page, array('inquiry_list', 'inquiry_form')) ? 'active' : '';
// Backup 메뉴
$active_page = in_array($current_page, array('page_list', 'page_form')) ? 'active' : '';
$active_contents = in_array($current_page, array('notice_list', 'notice_form', 'tutor_list', 'tutor_form', 'link_list', 'link_form', 'pass_list', 'pass_form', 'review_list', 'review_form', 'guide_list', 'guide_form', 'practice_list', 'practice_form', 'faq_list', 'faq_form')) ? 'active' : '';
$active_gallery = in_array($current_page, array('gallery_list', 'gallery_form')) ? 'active' : '';
$active_video = in_array($current_page, array('video_list', 'video_form')) ? 'active' : '';
$active_backup = ($active_page || $active_contents || $active_gallery || $active_video) ? 'active' : '';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ED Admin - <?=isset($pageTitle) ? $pageTitle : 'Management'?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pretendard:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.typekit.net/nkq2hxd.css">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
  <div class="admin_wrap">
    <!-- 사이드바 -->
    <aside class="sidebar">
      <div class="sidebar_logo">
        <a href="index.php">
          <h1>ED</h1>
          <span>Admin</span>
        </a>
      </div>

      <nav class="sidebar_nav">
        <!-- 대시보드 -->
        <div class="nav_section">
          <ul class="nav_list">
            <li class="<?=$current_page == 'index' ? 'active' : ''?>">
              <a href="index.php">대시보드</a>
            </li>
          </ul>
        </div>

        <!-- Settings -->
        <div class="nav_section">
          <p class="nav_label">Settings</p>
          <ul class="nav_list">
            <li class="has_sub <?=$active_setup?>">
              <a href="setup.php">사이트설정</a>
              <ul class="nav_sub">
                <li><a href="setup.php">사이트정보</a></li>
                <li><a href="mainbanner_list.php">메인배너관리</a></li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- Contents -->
        <div class="nav_section">
          <p class="nav_label">Contents</p>
          <ul class="nav_list">
            <li class="<?=$active_youtube?>">
              <a href="youtube_list.php">00 Youtube</a>
            </li>
            <li class="<?=$active_passlist?>">
              <a href="passlist_list.php">03 Success Stories</a>
            </li>
            <li class="<?=$active_portfolio?>">
              <a href="portfolio_list.php">04 Our Students</a>
            </li>
            <li class="<?=$active_portslide?>">
              <a href="portslide_list.php">05 Portfolio</a>
            </li>
            <li class="<?=$active_mainnews?>">
              <a href="mainnews_list.php">06 News</a>
            </li>
            <li class="<?=$active_andmore?>">
              <a href="andmore_list.php">07 And More</a>
            </li>
          </ul>
        </div>

        <!-- Managing -->
        <div class="nav_section">
          <p class="nav_label">Managing</p>
          <ul class="nav_list">
            <li class="<?=$active_inquiry?>">
              <a href="inquiry_list.php">상담문의관리</a>
              <?php
              if(isset($inquiry_table)) {
                $inquiry_result = @mysql_query("SELECT ino FROM $inquiry_table WHERE isw='5'");
                $inquiry_cnt = $inquiry_result ? @mysql_num_rows($inquiry_result) : 0;
                if($inquiry_cnt > 0):
              ?>
              <span class="badge"><?=$inquiry_cnt?></span>
              <?php endif; } ?>
            </li>
          </ul>
        </div>

        <!-- Backup -->
        <div class="nav_section">
          <p class="nav_label">Backup</p>
          <ul class="nav_list">
            <li class="has_sub <?=$active_page?>">
              <a href="page_list.php">메뉴설정</a>
              <ul class="nav_sub">
                <li><a href="page_list.php">전체 목록</a></li>
                <li><a href="page_list.php?menucode=1">학원소개</a></li>
                <li><a href="page_list.php?menucode=2">시각디자인</a></li>
                <li><a href="page_list.php?menucode=3">공업디자인</a></li>
                <li><a href="page_list.php?menucode=4">입시정보</a></li>
                <li><a href="page_list.php?menucode=5">합격자</a></li>
                <li><a href="page_list.php?menucode=6">커뮤니티</a></li>
              </ul>
            </li>
            <li class="has_sub <?=$active_contents?>">
              <a href="notice_list.php">컨텐츠관리</a>
              <ul class="nav_sub">
                <li><a href="notice_list.php">공지사항</a></li>
                <li><a href="tutor_list.php">이드강사진</a></li>
                <li><a href="link_list.php">ED커뮤니티</a></li>
                <li><a href="pass_list.php">연도별합격자</a></li>
                <li><a href="review_list.php">합격수기</a></li>
                <li><a href="guide_list.php">편입모집요강</a></li>
                <li><a href="practice_list.php">대학별실기</a></li>
                <li><a href="faq_list.php">자주묻는질문</a></li>
              </ul>
            </li>
            <li class="has_sub <?=$active_gallery?>">
              <a href="gallery_list.php?type=1">갤러리관리</a>
              <ul class="nav_sub">
                <li><a href="gallery_list.php?type=1">일러스트</a></li>
                <li><a href="gallery_list.php?type=2">제품렌더링</a></li>
                <li><a href="gallery_list.php?type=3">금속렌더링</a></li>
                <li><a href="gallery_list.php?type=4">도자렌더링</a></li>
                <li><a href="gallery_list.php?type=5">색채정밀</a></li>
                <li><a href="gallery_list.php?type=6">연필정밀</a></li>
                <li><a href="gallery_list.php?type=7">선생님작품</a></li>
              </ul>
            </li>
            <li class="has_sub <?=$active_video?>">
              <a href="video_list.php?type=1">영상관리</a>
              <ul class="nav_sub">
                <li><a href="video_list.php?type=1">학원소개영상</a></li>
                <li><a href="video_list.php?type=2">시각디자인영상</a></li>
                <li><a href="video_list.php?type=3">공업디자인영상</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>

      <div class="sidebar_footer">
        <a href="../index.php" target="_blank" class="site_link">사이트 바로가기</a>
        <a href="logout.php" class="logout_link">로그아웃</a>
      </div>
    </aside>

    <!-- 메인 컨텐츠 -->
    <main class="main_content">
      <header class="content_header">
        <h2><?=isset($pageTitle) ? $pageTitle : 'Dashboard'?></h2>
        <div class="user_info">
          <span><?=isset($member['user_name']) ? $member['user_name'] : $_SESSION['logged_name']?>님</span>
        </div>
      </header>

      <div class="content_body">
