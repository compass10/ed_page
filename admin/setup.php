<?php
$pageTitle = 'SEO 설정';

// header 포함 전에 DB 연결 및 저장 처리
@include_once $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';

$save_message = '';
$save_type = '';

// 저장 처리
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  // 먼저 기존 데이터 확인
  $check_result = @mysql_query("SELECT * FROM seo_setup LIMIT 1");
  $existing = @mysql_fetch_array($check_result);

  // 기본 메타 정보
  $site_name = mysql_real_escape_string($_POST['site_name']);
  $meta_title = mysql_real_escape_string($_POST['meta_title']);
  $meta_description = mysql_real_escape_string($_POST['meta_description']);
  $meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);

  // Open Graph
  $og_title = mysql_real_escape_string($_POST['og_title']);
  $og_description = mysql_real_escape_string($_POST['og_description']);

  // OG 이미지 업로드 처리
  $og_image = isset($existing['og_image']) ? $existing['og_image'] : '';
  if(isset($_FILES['og_image']) && $_FILES['og_image']['size'] > 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/seo/';
    if(!is_dir($uploadDir)) {
      @mkdir($uploadDir, 0755, true);
    }
    $ext = strtolower(pathinfo($_FILES['og_image']['name'], PATHINFO_EXTENSION));
    $allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    if(in_array($ext, $allowedExt)) {
      if($og_image && file_exists($uploadDir . $og_image)) {
        @unlink($uploadDir . $og_image);
      }
      $newFilename = 'og_image_' . time() . '.' . $ext;
      if(move_uploaded_file($_FILES['og_image']['tmp_name'], $uploadDir . $newFilename)) {
        $og_image = $newFilename;
      }
    }
  }

  // 추가 SEO 항목
  $canonical_url = mysql_real_escape_string($_POST['canonical_url']);
  $naver_verification = mysql_real_escape_string($_POST['naver_verification']);
  $google_verification = mysql_real_escape_string($_POST['google_verification']);

  // 연락처 정보
  $site_tel = mysql_real_escape_string($_POST['site_tel']);
  $site_email = mysql_real_escape_string($_POST['site_email']);
  $site_addr = mysql_real_escape_string($_POST['site_addr']);

  // 파비콘 업로드 처리
  $favicon = isset($existing['favicon']) ? $existing['favicon'] : '';
  if(isset($_FILES['favicon']) && $_FILES['favicon']['size'] > 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/seo/';
    if(!is_dir($uploadDir)) {
      @mkdir($uploadDir, 0755, true);
    }
    $ext = strtolower(pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION));
    $allowedExt = array('ico', 'png', 'svg');
    if(in_array($ext, $allowedExt)) {
      if($favicon && file_exists($uploadDir . $favicon)) {
        @unlink($uploadDir . $favicon);
      }
      $newFilename = 'favicon_' . time() . '.' . $ext;
      if(move_uploaded_file($_FILES['favicon']['tmp_name'], $uploadDir . $newFilename)) {
        $favicon = $newFilename;
      }
    }
  }

  // robots.txt 저장
  $robots_txt = isset($_POST['robots_txt']) ? $_POST['robots_txt'] : '';
  $robotsPath = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';
  @file_put_contents($robotsPath, $robots_txt);

  // 테이블 존재 여부 확인
  $table_check = @mysql_query("SHOW TABLES LIKE 'seo_setup'");
  if(@mysql_num_rows($table_check) == 0) {
    $save_message = 'seo_setup 테이블이 없습니다. 먼저 db_update.php에서 테이블을 생성해주세요.';
    $save_type = 'error';
  } else {
    if($existing) {
      $sql = "UPDATE seo_setup SET
        site_name='$site_name',
        meta_title='$meta_title',
        meta_description='$meta_description',
        meta_keywords='$meta_keywords',
        og_title='$og_title',
        og_description='$og_description',
        og_image='$og_image',
        canonical_url='$canonical_url',
        naver_verification='$naver_verification',
        google_verification='$google_verification',
        site_tel='$site_tel',
        site_email='$site_email',
        site_addr='$site_addr',
        favicon='$favicon'
        WHERE id=1";
    } else {
      $sql = "INSERT INTO seo_setup (site_name, meta_title, meta_description, meta_keywords, og_title, og_description, og_image, canonical_url, naver_verification, google_verification, site_tel, site_email, site_addr, favicon)
        VALUES ('$site_name', '$meta_title', '$meta_description', '$meta_keywords', '$og_title', '$og_description', '$og_image', '$canonical_url', '$naver_verification', '$google_verification', '$site_tel', '$site_email', '$site_addr', '$favicon')";
    }

    if(@mysql_query($sql)) {
      $save_message = '저장되었습니다.';
      $save_type = 'success';
    } else {
      $save_message = '저장 실패: ' . mysql_error();
      $save_type = 'error';
    }
  }
}

// header 포함
include 'header.php';

// 데이터 다시 불러오기
$setup = array();
$result = @mysql_query("SELECT * FROM seo_setup LIMIT 1");
if($result) {
  $setup = @mysql_fetch_array($result);
}

// robots.txt 내용 읽기
$robotsPath = $_SERVER['DOCUMENT_ROOT'] . '/robots.txt';
$robots_txt = '';
if(file_exists($robotsPath)) {
  $robots_txt = @file_get_contents($robotsPath);
}
if(empty($robots_txt)) {
  $robots_txt = "User-agent: *
Allow: /

Sitemap: https://www.ed-academy.com/sitemap.xml";
}
?>

<?php if($save_message): ?>
<div class="alert <?=$save_type?>"><?=$save_message?></div>
<?php endif; ?>

<div class="form_section">
  <form method="post" enctype="multipart/form-data">

    <!-- 기본 메타 정보 -->
    <div class="form_title">기본 메타 정보</div>

    <div class="form_group">
      <label>사이트명 <span class="desc">브라우저 탭, 검색 결과에 표시</span></label>
      <input type="text" name="site_name" value="<?=isset($setup['site_name']) ? htmlspecialchars($setup['site_name']) : ''?>" placeholder="ED 편입미술학원">
    </div>

    <div class="form_group">
      <label>메타 타이틀 <span class="desc">&lt;title&gt; 태그, 60자 이내 권장</span></label>
      <input type="text" name="meta_title" value="<?=isset($setup['meta_title']) ? htmlspecialchars($setup['meta_title']) : ''?>" placeholder="ED 편입미술학원 - 시각/공업디자인 편입 전문" maxlength="60">
      <div class="char_count"><span id="titleCount">0</span>/60</div>
    </div>

    <div class="form_group">
      <label>메타 설명 <span class="desc">&lt;meta description&gt;, 160자 이내 권장</span></label>
      <textarea name="meta_description" rows="3" placeholder="서울 강남 위치, 시각디자인/공업디자인 편입 전문 미술학원. 체계적인 커리큘럼과 높은 합격률로 편입 성공을 도와드립니다." maxlength="160"><?=isset($setup['meta_description']) ? htmlspecialchars($setup['meta_description']) : ''?></textarea>
      <div class="char_count"><span id="descCount">0</span>/160</div>
    </div>

    <div class="form_group">
      <label>메타 키워드 <span class="desc">쉼표로 구분</span></label>
      <input type="text" name="meta_keywords" value="<?=isset($setup['meta_keywords']) ? htmlspecialchars($setup['meta_keywords']) : ''?>" placeholder="편입미술, 시각디자인편입, 공업디자인편입, 미대편입, 편입학원">
    </div>

    <!-- Open Graph -->
    <div class="form_title">Open Graph (SNS 공유용)</div>

    <div class="form_group">
      <label>OG 타이틀 <span class="desc">SNS 공유 시 제목 (비워두면 메타 타이틀 사용)</span></label>
      <input type="text" name="og_title" value="<?=isset($setup['og_title']) ? htmlspecialchars($setup['og_title']) : ''?>" placeholder="카카오톡/페이스북 공유 시 표시될 제목">
    </div>

    <div class="form_group">
      <label>OG 설명 <span class="desc">SNS 공유 시 설명문 (비워두면 메타 설명 사용)</span></label>
      <textarea name="og_description" rows="2" placeholder="SNS 공유 시 표시될 설명문"><?=isset($setup['og_description']) ? htmlspecialchars($setup['og_description']) : ''?></textarea>
    </div>

    <div class="form_group">
      <label>OG 이미지 <span class="desc">1200x630px 권장, SNS 공유 시 표시될 대표 이미지</span></label>
      <?php if(isset($setup['og_image']) && $setup['og_image']): ?>
      <div class="current_file">
        <img src="/upload/seo/<?=htmlspecialchars($setup['og_image'])?>" alt="OG Image" style="max-width:300px; max-height:150px;">
        <span><?=htmlspecialchars($setup['og_image'])?></span>
      </div>
      <?php endif; ?>
      <input type="file" name="og_image" accept="image/*">
    </div>

    <!-- 추가 SEO 항목 -->
    <div class="form_title">추가 SEO 항목</div>

    <div class="form_group">
      <label>대표 URL (Canonical) <span class="desc">검색엔진에 알릴 대표 주소</span></label>
      <input type="url" name="canonical_url" value="<?=isset($setup['canonical_url']) ? htmlspecialchars($setup['canonical_url']) : ''?>" placeholder="https://www.ed-academy.com">
    </div>

    <div class="form_group">
      <label>파비콘 <span class="desc">브라우저 탭 아이콘 (ico, png, svg)</span></label>
      <?php if(isset($setup['favicon']) && $setup['favicon']): ?>
      <div class="current_file">
        <img src="/upload/seo/<?=htmlspecialchars($setup['favicon'])?>" alt="Favicon" style="max-width:32px; max-height:32px;">
        <span><?=htmlspecialchars($setup['favicon'])?></span>
      </div>
      <?php endif; ?>
      <input type="file" name="favicon" accept=".ico,.png,.svg">
    </div>

    <div class="form_row">
      <div class="form_group">
        <label>네이버 사이트 인증 <span class="desc">웹마스터 도구 인증 코드</span></label>
        <input type="text" name="naver_verification" value="<?=isset($setup['naver_verification']) ? htmlspecialchars($setup['naver_verification']) : ''?>" placeholder="인증 코드만 입력">
      </div>
      <div class="form_group">
        <label>구글 사이트 인증 <span class="desc">Search Console 인증 코드</span></label>
        <input type="text" name="google_verification" value="<?=isset($setup['google_verification']) ? htmlspecialchars($setup['google_verification']) : ''?>" placeholder="인증 코드만 입력">
      </div>
    </div>

    <!-- 연락처 정보 -->
    <div class="form_title">연락처 정보 <span class="desc">Schema.org 구조화 데이터용</span></div>

    <div class="form_row">
      <div class="form_group">
        <label>대표전화</label>
        <input type="text" name="site_tel" value="<?=isset($setup['site_tel']) ? htmlspecialchars($setup['site_tel']) : ''?>" placeholder="02-1234-5678">
      </div>
      <div class="form_group">
        <label>대표이메일</label>
        <input type="email" name="site_email" value="<?=isset($setup['site_email']) ? htmlspecialchars($setup['site_email']) : ''?>" placeholder="info@ed-academy.com">
      </div>
    </div>

    <div class="form_group">
      <label>주소</label>
      <input type="text" name="site_addr" value="<?=isset($setup['site_addr']) ? htmlspecialchars($setup['site_addr']) : ''?>" placeholder="서울특별시 강남구 ...">
    </div>

    <!-- robots.txt -->
    <div class="form_title">robots.txt 설정</div>

    <div class="form_group">
      <label>robots.txt 내용 <span class="desc">검색엔진 크롤링 규칙 설정</span></label>
      <textarea name="robots_txt" rows="8" style="font-family: monospace;"><?=htmlspecialchars($robots_txt)?></textarea>
    </div>

    <div class="form_actions">
      <button type="submit" class="btn primary">저장</button>
      <a href="db_update.php" class="btn" style="background:#666;">DB 컬럼 관리</a>
    </div>
  </form>
</div>

<script>
// 글자 수 카운터
document.querySelector('input[name="meta_title"]').addEventListener('input', function() {
  document.getElementById('titleCount').textContent = this.value.length;
});
document.querySelector('textarea[name="meta_description"]').addEventListener('input', function() {
  document.getElementById('descCount').textContent = this.value.length;
});

// 초기 카운트
document.getElementById('titleCount').textContent = document.querySelector('input[name="meta_title"]').value.length;
document.getElementById('descCount').textContent = document.querySelector('textarea[name="meta_description"]').value.length;
</script>

<style>
.alert {
  padding: 15px 20px;
  border-radius: 6px;
  margin-bottom: 20px;
  font-size: 14px;
}
.alert.success {
  background: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}
.alert.error {
  background: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}
.form_title {
  font-size: 18px;
  font-weight: 700;
  color: #333;
  margin: 30px 0 15px;
  padding-bottom: 10px;
  border-bottom: 2px solid #333;
}
.form_title:first-child {
  margin-top: 0;
}
.form_title .desc {
  font-size: 12px;
  font-weight: 400;
  color: #888;
  margin-left: 8px;
}
.form_group label .desc {
  font-size: 11px;
  color: #888;
  margin-left: 6px;
}
.char_count {
  font-size: 12px;
  color: #888;
  text-align: right;
  margin-top: 4px;
}
.current_file {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 8px;
  padding: 8px;
  background: #f5f5f5;
  border-radius: 4px;
}
.current_file span {
  font-size: 12px;
  color: #666;
}
</style>

<?php include 'footer.php'; ?>
