<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo isset($pageTitle) ? $pageTitle . ' | ED' : 'ED'; ?></title>

  <!-- Meta Description -->
  <meta name="description" content="2025 미대편입이드 합격자 133명! 서울과기대, 국민대 100% 점유! 홍대 31명, 단국대 5명 모집 4명 합격,서울여대 6명 합격, 성신여대 2명 모집 2명 합격, 동덕여대 5명 모집 5명 합격, 건대 24명 합격, 서경대 5명 모집 6명 합격" />

  <!-- Open Graph -->
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' | ED' : 'ED'; ?>" />
  <meta property="og:description" content="2025 미대편입이드 합격자 133명! 서울과기대, 국민대 100% 점유! 홍대 31명, 단국대 5명 모집 4명 합격,서울여대 6명 합격, 성신여대 2명 모집 2명 합격, 동덕여대 5명 모집 5명 합격, 건대 24명 합격, 서경대 5명 모집 6명 합격" />
  <meta property="og:image" content="/asset/images/common/ed_og_img.png" />
  <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />

  <link rel="icon" type="image/png" href="ed_favicon.png" />
  <link rel="stylesheet" href="https://use.typekit.net/ebu3zus.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <!-- 로더 이미지 프리로드 -->
  <link rel="preload" href="asset/images/spiner/img_01.gif" as="image">
  <link rel="preload" href="asset/images/spiner/img_02.gif" as="image">
  <link rel="preload" href="asset/images/spiner/img_03.gif" as="image">
  <link rel="preload" href="asset/images/spiner/chat_b_01.svg" as="image">
  <link rel="preload" href="asset/images/spiner/chat_b_02.svg" as="image">
  <link rel="preload" href="asset/images/spiner/chat_b_03.svg" as="image">
  <?php if (isset($preloadImages) && !empty($preloadImages)): ?>
    <?php foreach($preloadImages as $imgSrc): ?>
    <link rel="preload" href="<?php echo $imgSrc; ?>" as="image">
    <?php endforeach; ?>
  <?php endif; ?>
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
if (isset($darkTheme) && $darkTheme)
  $classes[] = 'dark-theme';
if (isset($bodyClass) && $bodyClass)
  $classes[] = $bodyClass;
if (!empty($classes))
  echo ' class="' . implode(' ', $classes) . '"';
?>>
  <?php if (isset($showLoader) && $showLoader): ?>
  <!-- 로딩 스피너 -->
  <div id="pageLoader" class="page_loader"<?php if (isset($loaderDuration)) echo ' data-duration="' . $loaderDuration . '"'; ?><?php if (isset($loaderWaitForImages) && $loaderWaitForImages) echo ' data-wait-for-images="true"'; ?>>
      <div class="img_list">
        <img class="person" src="asset/images/spiner/img_01.gif" alt="loader_img_01" loading="eager" fetchpriority="high">
        <img class="chat_bubble" src="asset/images/spiner/chat_b_01.svg" alt="loader_chat_01" loading="eager" fetchpriority="high">
        <img class="person" src="asset/images/spiner/img_02.gif" alt="loader_img_02" loading="eager" fetchpriority="high">
        <img class="chat_bubble" src="asset/images/spiner/chat_b_02.svg" alt="loader_chat_02" loading="eager" fetchpriority="high">
        <img class="person" src="asset/images/spiner/img_03.gif" alt="loader_img_03" loading="eager" fetchpriority="high">
        <img class="chat_bubble" src="asset/images/spiner/chat_b_03.svg" alt="loader_chat_03" loading="eager" fetchpriority="high">
      </div>
      <div class="loader_inner">
        <div class="loader_title_mobile">
          <svg width="258" height="181" viewBox="0 0 258 181" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M36.33 45.5C33.6 49.28 29.47 52.22 22.61 52.22C11.06 52.22 3.35998 41.44 3.35998 26.11C3.35998 10.57 11.13 1.06096e-05 22.61 1.06096e-05C29.19 1.06096e-05 33.6 2.66001 36.26 6.23001L30.24 14.35C28.56 12.11 26.6 10.71 23.45 10.71C17.57 10.71 14.49 17.43 14.49 26.11C14.49 34.65 17.57 41.51 23.52 41.51C26.53 41.51 28.77 39.76 30.1 37.73L36.33 45.5ZM71.6603 50.89H59.8303L53.1803 31.15H49.8903V50.89H39.1103V1.33001H55.0003C64.5903 1.33001 70.1903 6.37001 70.1903 16.24C70.1903 23.59 66.4103 27.65 63.1903 28.77L71.6603 50.89ZM59.1303 16.87C59.1303 11.83 55.9803 10.71 53.3903 10.71H49.8903V23.24H53.1803C56.3303 23.24 59.1303 21.35 59.1303 16.87ZM99.6614 50.89H74.8814V1.33001H98.8214V11.2H85.5914V20.93H97.7714V30.17H85.5914V40.88H99.6614V50.89ZM137.828 50.89H126.138L124.108 41.86H112.978L110.948 50.89H99.7483L111.788 1.33001H125.858L137.828 50.89ZM122.708 33.18L118.718 12.11H118.438L114.238 33.18H122.708ZM163.546 10.85H154.446V50.89H143.456V10.85H134.356V1.33001H163.546V10.85ZM177.058 50.89H165.788V1.33001H177.058V50.89ZM217.666 1.33001L205.486 50.89H191.276L179.306 1.33001H191.976L198.696 37.59H198.836L205.486 1.33001H217.666ZM244.679 50.89H219.899V1.33001H243.839V11.2H230.609V20.93H242.789V30.17H230.609V40.88H244.679V50.89ZM27.93 100.28C27.93 110.64 23.52 117.01 13.58 117.01C6.71998 117.01 1.46998 112.67 -1.95615e-05 106.3L9.09998 102.24C9.65998 104.48 10.92 106.44 13.02 106.44C16.1 106.44 16.8 103.78 16.8 99.3V66.33H27.93V100.28ZM70.5119 90.97C70.5119 106.72 63.2319 117.22 51.4719 117.22C39.7119 117.22 32.4319 106.72 32.4319 90.97C32.4319 75.29 39.5719 65 51.4719 65C63.2319 65 70.5119 75.29 70.5119 90.97ZM59.0319 90.97C59.0319 82.36 56.5119 75.85 51.4719 75.85C46.3619 75.85 43.9119 82.36 43.9119 90.97C43.9119 99.58 46.3619 106.23 51.4719 106.23C56.5119 106.23 59.0319 99.58 59.0319 90.97ZM107.913 97.55C107.913 108.47 103.083 117.22 90.9732 117.22C78.8632 117.22 74.3832 108.54 74.3832 97.55V66.33H85.6532V96.57C85.6532 102.17 86.7732 106.44 91.1832 106.44C95.5932 106.44 96.7132 102.17 96.7132 96.57V66.33H107.913V97.55ZM146.347 115.89H134.517L127.867 96.15H124.577V115.89H113.797V66.33H129.687C139.277 66.33 144.877 71.37 144.877 81.24C144.877 88.59 141.097 92.65 137.877 93.77L146.347 115.89ZM133.817 81.87C133.817 76.83 130.667 75.71 128.077 75.71H124.577V88.24H127.867C131.017 88.24 133.817 86.35 133.817 81.87ZM182.958 115.89H170.988L159.508 85.72H159.298L159.578 115.89H149.568V66.33H161.888L173.298 96.92H173.508L173.298 66.33H182.958V115.89ZM214.426 115.89H189.646V66.33H213.586V76.2H200.356V85.93H212.536V95.17H200.356V105.88H214.426V115.89ZM249.793 66.33L237.193 98.04V115.89H226.203V98.04L213.673 66.33H225.783L231.733 86.84H231.873L237.893 66.33H249.793ZM257.077 104.2L251.407 124.15H243.287L247.487 104.2H257.077ZM36.54 166.75C36.54 177.32 28.91 180.89 21.84 180.89H5.38998V131.33H20.23C26.39 131.33 34.86 133.36 34.86 144.07C34.86 149.88 32.13 153.31 28.7 154.92V155.06C32.48 156.04 36.54 159.82 36.54 166.75ZM24.99 145.89C24.99 142.04 22.47 140.64 19.6 140.64H15.82V151.35H19.67C22.4 151.35 24.99 149.81 24.99 145.89ZM25.9 165.7C25.9 161.29 22.75 159.54 19.88 159.54H15.82V171.58H20.02C23.31 171.58 25.9 169.62 25.9 165.7ZM71.826 131.33L59.226 163.04V180.89H48.236V163.04L35.706 131.33H47.816L53.766 151.84H53.906L59.926 131.33H71.826ZM108.294 180.89H83.5138V131.33H107.454V141.2H94.2238V150.93H106.404V160.17H94.2238V170.88H108.294V180.89ZM147.301 156.25C147.301 171.23 140.861 180.89 126.721 180.89H112.791V131.33H126.721C140.931 131.33 147.301 140.99 147.301 156.25ZM136.031 156.25C136.031 146.31 132.251 141.13 126.861 141.13H124.131V171.09H126.861C132.251 171.09 136.031 165.84 136.031 156.25Z" fill="black"/>
          </svg>
        </div>
        <div class="loader_top">
          <img class="loader_top_pc" src="asset/images/spiner/loader_top_pc.svg" alt="Industrial Design, Motion Design, Visual Design, Craft Design">
          <img class="loader_top_mob" src="asset/images/spiner/loader_top_mob.svg" alt="Industrial Design, Motion Design, Visual Design, Craft Design">
        </div>
        <div class="loader_spinner">
          <svg width="120" height="128" viewBox="0 0 120 128" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M51.2713 128L52.5295 76.7371L8.65007 103.627L0 88.5307L45.2949 64.1572L0 39.4693L8.65007 24.3735L52.5295 51.2629L51.2713 0H68.5714L67.3132 51.2629L111.35 24.3735L120 39.4693L74.8624 64.1572L120 88.5307L111.35 103.627L67.3132 76.7371L68.5714 128H51.2713Z"
              fill="black" />
          </svg>
        </div>
        <div class="loader_marquee">
          <div class="marquee_track">
            <svg width="1903" height="169" viewBox="0 0 1903 169" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M94.2002 130C86.4002 140.8 74.6002 149.2 55.0002 149.2C22.0002 149.2 0.000195682 118.4 0.000195682 74.6C0.000195682 30.2 22.2002 1.28746e-05 55.0002 1.28746e-05C73.8002 1.28746e-05 86.4002 7.60002 94.0002 17.8L76.8002 41C72.0002 34.6 66.4002 30.6 57.4002 30.6C40.6002 30.6 31.8002 49.8 31.8002 74.6C31.8002 99 40.6002 118.6 57.6002 118.6C66.2002 118.6 72.6002 113.6 76.4002 107.8L94.2002 130ZM195.144 145.4H161.344L142.344 89H132.944V145.4H102.144V3.80002H147.544C174.944 3.80002 190.944 18.2 190.944 46.4C190.944 67.4 180.144 79 170.944 82.2L195.144 145.4ZM159.344 48.2C159.344 33.8 150.344 30.6 142.944 30.6H132.944V66.4H142.344C151.344 66.4 159.344 61 159.344 48.2ZM275.147 145.4H204.347V3.80002H272.747V32H234.947V59.8H269.747V86.2H234.947V116.8H275.147V145.4ZM384.196 145.4H350.796L344.996 119.6H313.196L307.396 145.4H275.396L309.796 3.80002H349.996L384.196 145.4ZM340.996 94.8L329.596 34.6H328.796L316.796 94.8H340.996ZM457.674 31H431.674V145.4H400.274V31H374.274V3.80002H457.674V31ZM496.281 145.4H464.081V3.80002H496.281V145.4ZM612.303 3.80002L577.503 145.4H536.903L502.703 3.80002H538.903L558.103 107.4H558.503L577.503 3.80002H612.303ZM689.483 145.4H618.683V3.80002H687.083V32H649.283V59.8H684.083V86.2H649.283V116.8H689.483V145.4ZM798.427 100.8C798.427 130.4 785.827 148.6 757.427 148.6C737.827 148.6 722.827 136.2 718.627 118L744.627 106.4C746.227 112.8 749.827 118.4 755.827 118.4C764.627 118.4 766.627 110.8 766.627 98V3.80002H798.427V100.8ZM920.089 74.2C920.089 119.2 899.289 149.2 865.689 149.2C832.089 149.2 811.289 119.2 811.289 74.2C811.289 29.4 831.689 1.28746e-05 865.689 1.28746e-05C899.289 1.28746e-05 920.089 29.4 920.089 74.2ZM887.289 74.2C887.289 49.6 880.089 31 865.689 31C851.089 31 844.089 49.6 844.089 74.2C844.089 98.8 851.089 117.8 865.689 117.8C880.089 117.8 887.289 98.8 887.289 74.2ZM1026.95 93C1026.95 124.2 1013.15 149.2 978.55 149.2C943.95 149.2 931.15 124.4 931.15 93V3.80002H963.35V90.2C963.35 106.2 966.55 118.4 979.15 118.4C991.75 118.4 994.95 106.2 994.95 90.2V3.80002H1026.95V93ZM1136.76 145.4H1102.96L1083.96 89H1074.56V145.4H1043.76V3.80002H1089.16C1116.56 3.80002 1132.56 18.2 1132.56 46.4C1132.56 67.4 1121.76 79 1112.56 82.2L1136.76 145.4ZM1100.96 48.2C1100.96 33.8 1091.96 30.6 1084.56 30.6H1074.56V66.4H1083.96C1092.96 66.4 1100.96 61 1100.96 48.2ZM1241.36 145.4H1207.16L1174.36 59.2H1173.76L1174.56 145.4H1145.96V3.80002H1181.16L1213.76 91.2H1214.36L1213.76 3.80002H1241.36V145.4ZM1331.27 145.4H1260.47V3.80002H1328.87V32H1291.07V59.8H1325.87V86.2H1291.07V116.8H1331.27V145.4ZM1432.32 3.80002L1396.32 94.4V145.4H1364.92V94.4L1329.12 3.80002H1363.72L1380.72 62.4H1381.12L1398.32 3.80002H1432.32ZM1453.13 112L1436.93 169H1413.73L1425.73 112H1453.13ZM1585.82 105C1585.82 135.2 1564.02 145.4 1543.82 145.4H1496.82V3.80002H1539.22C1556.82 3.80002 1581.02 9.60002 1581.02 40.2C1581.02 56.8 1573.22 66.6 1563.42 71.2V71.6C1574.22 74.4 1585.82 85.2 1585.82 105ZM1552.82 45.4C1552.82 34.4 1545.62 30.4 1537.42 30.4H1526.62V61H1537.62C1545.42 61 1552.82 56.6 1552.82 45.4ZM1555.42 102C1555.42 89.4 1546.42 84.4 1538.22 84.4H1526.62V118.8H1538.62C1548.02 118.8 1555.42 113.2 1555.42 102ZM1686.64 3.80002L1650.64 94.4V145.4H1619.24V94.4L1583.44 3.80002H1618.04L1635.04 62.4H1635.44L1652.64 3.80002H1686.64ZM1790.83 145.4H1720.03V3.80002H1788.43V32H1750.63V59.8H1785.43V86.2H1750.63V116.8H1790.83V145.4ZM1902.28 75C1902.28 117.8 1883.88 145.4 1843.48 145.4H1803.68V3.80002H1843.48C1884.08 3.80002 1902.28 31.4 1902.28 75ZM1870.08 75C1870.08 46.6 1859.28 31.8 1843.88 31.8H1836.08V117.4H1843.88C1859.28 117.4 1870.08 102.4 1870.08 75Z" fill="black"/>
            </svg>
            <svg width="1903" height="169" viewBox="0 0 1903 169" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M94.2002 130C86.4002 140.8 74.6002 149.2 55.0002 149.2C22.0002 149.2 0.000195682 118.4 0.000195682 74.6C0.000195682 30.2 22.2002 1.28746e-05 55.0002 1.28746e-05C73.8002 1.28746e-05 86.4002 7.60002 94.0002 17.8L76.8002 41C72.0002 34.6 66.4002 30.6 57.4002 30.6C40.6002 30.6 31.8002 49.8 31.8002 74.6C31.8002 99 40.6002 118.6 57.6002 118.6C66.2002 118.6 72.6002 113.6 76.4002 107.8L94.2002 130ZM195.144 145.4H161.344L142.344 89H132.944V145.4H102.144V3.80002H147.544C174.944 3.80002 190.944 18.2 190.944 46.4C190.944 67.4 180.144 79 170.944 82.2L195.144 145.4ZM159.344 48.2C159.344 33.8 150.344 30.6 142.944 30.6H132.944V66.4H142.344C151.344 66.4 159.344 61 159.344 48.2ZM275.147 145.4H204.347V3.80002H272.747V32H234.947V59.8H269.747V86.2H234.947V116.8H275.147V145.4ZM384.196 145.4H350.796L344.996 119.6H313.196L307.396 145.4H275.396L309.796 3.80002H349.996L384.196 145.4ZM340.996 94.8L329.596 34.6H328.796L316.796 94.8H340.996ZM457.674 31H431.674V145.4H400.274V31H374.274V3.80002H457.674V31ZM496.281 145.4H464.081V3.80002H496.281V145.4ZM612.303 3.80002L577.503 145.4H536.903L502.703 3.80002H538.903L558.103 107.4H558.503L577.503 3.80002H612.303ZM689.483 145.4H618.683V3.80002H687.083V32H649.283V59.8H684.083V86.2H649.283V116.8H689.483V145.4ZM798.427 100.8C798.427 130.4 785.827 148.6 757.427 148.6C737.827 148.6 722.827 136.2 718.627 118L744.627 106.4C746.227 112.8 749.827 118.4 755.827 118.4C764.627 118.4 766.627 110.8 766.627 98V3.80002H798.427V100.8ZM920.089 74.2C920.089 119.2 899.289 149.2 865.689 149.2C832.089 149.2 811.289 119.2 811.289 74.2C811.289 29.4 831.689 1.28746e-05 865.689 1.28746e-05C899.289 1.28746e-05 920.089 29.4 920.089 74.2ZM887.289 74.2C887.289 49.6 880.089 31 865.689 31C851.089 31 844.089 49.6 844.089 74.2C844.089 98.8 851.089 117.8 865.689 117.8C880.089 117.8 887.289 98.8 887.289 74.2ZM1026.95 93C1026.95 124.2 1013.15 149.2 978.55 149.2C943.95 149.2 931.15 124.4 931.15 93V3.80002H963.35V90.2C963.35 106.2 966.55 118.4 979.15 118.4C991.75 118.4 994.95 106.2 994.95 90.2V3.80002H1026.95V93ZM1136.76 145.4H1102.96L1083.96 89H1074.56V145.4H1043.76V3.80002H1089.16C1116.56 3.80002 1132.56 18.2 1132.56 46.4C1132.56 67.4 1121.76 79 1112.56 82.2L1136.76 145.4ZM1100.96 48.2C1100.96 33.8 1091.96 30.6 1084.56 30.6H1074.56V66.4H1083.96C1092.96 66.4 1100.96 61 1100.96 48.2ZM1241.36 145.4H1207.16L1174.36 59.2H1173.76L1174.56 145.4H1145.96V3.80002H1181.16L1213.76 91.2H1214.36L1213.76 3.80002H1241.36V145.4ZM1331.27 145.4H1260.47V3.80002H1328.87V32H1291.07V59.8H1325.87V86.2H1291.07V116.8H1331.27V145.4ZM1432.32 3.80002L1396.32 94.4V145.4H1364.92V94.4L1329.12 3.80002H1363.72L1380.72 62.4H1381.12L1398.32 3.80002H1432.32ZM1453.13 112L1436.93 169H1413.73L1425.73 112H1453.13ZM1585.82 105C1585.82 135.2 1564.02 145.4 1543.82 145.4H1496.82V3.80002H1539.22C1556.82 3.80002 1581.02 9.60002 1581.02 40.2C1581.02 56.8 1573.22 66.6 1563.42 71.2V71.6C1574.22 74.4 1585.82 85.2 1585.82 105ZM1552.82 45.4C1552.82 34.4 1545.62 30.4 1537.42 30.4H1526.62V61H1537.62C1545.42 61 1552.82 56.6 1552.82 45.4ZM1555.42 102C1555.42 89.4 1546.42 84.4 1538.22 84.4H1526.62V118.8H1538.62C1548.02 118.8 1555.42 113.2 1555.42 102ZM1686.64 3.80002L1650.64 94.4V145.4H1619.24V94.4L1583.44 3.80002H1618.04L1635.04 62.4H1635.44L1652.64 3.80002H1686.64ZM1790.83 145.4H1720.03V3.80002H1788.43V32H1750.63V59.8H1785.43V86.2H1750.63V116.8H1790.83V145.4ZM1902.28 75C1902.28 117.8 1883.88 145.4 1843.48 145.4H1803.68V3.80002H1843.48C1884.08 3.80002 1902.28 31.4 1902.28 75ZM1870.08 75C1870.08 46.6 1859.28 31.8 1843.88 31.8H1836.08V117.4H1843.88C1859.28 117.4 1870.08 102.4 1870.08 75Z" fill="black"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

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
          <path d="M0.540551 5.65713L6.19741 0.000273908L40.6233 34.4262L34.9664 40.083L0.540551 5.65713Z"
            fill="black" />
          <path d="M5.65688 40.0831L2.73422e-05 34.4262L34.4259 0.000371933L40.0828 5.65723L5.65688 40.0831Z"
            fill="black" />
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
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black" />
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
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black" />
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
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black" />
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
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black" />
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
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black" />
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
            <path d="M12.16 0V8.88H21.04V12.16H12.16V21.04H8.88V12.16H0V8.88H8.88V0H12.16Z" fill="black" />
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