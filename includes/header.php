<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($pageTitle) ? $pageTitle . ' | ED' : 'ED'; ?></title>
  <link rel="icon" type="image/png" href="ed_favicon.png" />
  <link rel="stylesheet" href="https://use.typekit.net/ebu3zus.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <?php if (isset($isSubPage) && $isSubPage): ?>
  <link rel="stylesheet" href="css/sub.css" />
  <?php endif; ?>
  <?php if (isset($pageCss) && $pageCss): ?>
  <link rel="stylesheet" href="css/<?php echo $pageCss; ?>.css" />
  <?php endif; ?>
  <?php if (!isset($isSubPage) || !$isSubPage): ?>
  <link rel="stylesheet" href="css/main.css" />
  <?php endif; ?>
</head>

<body<?php
  $classes = array();
  if (isset($darkTheme) && $darkTheme) $classes[] = 'dark-theme';
  if (isset($bodyClass) && $bodyClass) $classes[] = $bodyClass;
  if (!empty($classes)) echo ' class="' . implode(' ', $classes) . '"';
?>>
  <!-- 로딩 스피너 -->
  <div id="pageLoader" class="page_loader">
    <div class="loader_inner">
      <div class="spinner"></div>
    </div>
  </div>

  <header id="header" class="down">
    <div class="header_inner">
      <div class="logo_area">
        <a href="index.php">
          <img src="./asset/images/svg/logo.svg" alt="ed_logo" />
        </a>
      </div>
      <div class="menu">
        <img src="./asset/images/svg/hamburger.svg" alt="menu_icon" />
      </div>
    </div>
  </header>

  <div class="side_menu">
    <div class="top_area">
      <div class="left">
        <span class="menu_text">MENU</span>
        <a href="index.php"><img class="menu_logo" src="./asset/images/svg/logo.svg" alt="ed_logo" /></a>
      </div>
      <div class="right">
        <svg viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0.540551 5.65713L6.19741 0.000273908L40.6233 34.4262L34.9664 40.083L0.540551 5.65713Z" fill="black"/>
          <path d="M5.65688 40.0831L2.73422e-05 34.4262L34.4259 0.000371933L40.0828 5.65723L5.65688 40.0831Z" fill="black"/>
        </svg>
      </div>
    </div>
    <ul class="menu_list">
      <li>
        <a href="whoweare.php">
          <div class="title">
            <span class="num">01</span>
            Who We Are
          </div>
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black"/>
          </svg>
        </a>
      </li>
      <li>
        <a href="contact.php">
          <div class="title">
            <span class="num">02</span>
            Contact Us
          </div>
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black"/>
          </svg>
        </a>
      </li>
      <li>
        <a href="success.php">
          <div class="title">
            <span class="num">03</span>
            Success stories
          </div>
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black"/>
          </svg>
        </a>
      </li>
      <li>
        <a href="students.php">
          <div class="title">
            <span class="num">04</span>
            Our Students
          </div>
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black"/>
          </svg>
        </a>
      </li>
      <li>
        <a href="portfolio.php">
          <div class="title">
            <span class="num">05</span>
            Portfolio
          </div>
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black"/>
          </svg>
        </a>
      </li>
      <li>
        <a href="news.php">
          <div class="title">
            <span class="num">06</span>
            News
          </div>
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black"/>
          </svg>
        </a>
      </li>
    </ul>
    <div class="bottom_links">
      <div class="left_btn">
        FOllow us :)
      </div>
      <div class="right_btns">
        <a target="_blank" href="https://www.youtube.com/@edillust_academy">
          YoutubE
        </a>
        <a target="_blank" href="https://www.instagram.com/archive_ed_illust?utm_source=ig_web_button_share_s">
          Instagram
        </a>
        <!--<a target="_blank" href="https://blog.naver.com/sunsook1006">Blog #1</a>
        <a target="_blank" href="https://blog.naver.com/hedboss">Blog #2</a>-->
      </div>
    </div>
  </div>
