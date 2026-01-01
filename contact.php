<?php
$pageTitle = 'Contact Us';
$isSubPage = true;
$pageCss = 'contact';

// DB 연결 (운영서버 lib.php 사용)
include_once('./web/lib.php');

// 페이지네이션 설정
$nCount = 10; // 페이지당 표시 개수
$pg = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
if($pg < 1) $pg = 1;

// 전체 개수 조회
$total_sql = "SELECT COUNT(*) as cnt FROM $inquiry_table WHERE isw != '90'";
$total_result = mysql_fetch_array(mysql_query($total_sql));
$nTotalCount = $total_result['cnt'];
$nTotalPage = ceil($nTotalCount / $nCount);

// 현재 페이지 데이터 조회
$nFrom = ($pg - 1) * $nCount;
$inquiry_sql = "SELECT * FROM $inquiry_table WHERE isw != '90' ORDER BY ino DESC LIMIT $nFrom, $nCount";
$inquiry_result = mysql_query($inquiry_sql);
?>
<?php include 'includes/header.php'; ?>

  <main>
    <div class="page_title">
      <span class="num">02</span>
      <span class="title">Contact Us</span>
    </div>
    <section class="section page_content">
      <!-- 탭 1: 상담문의 -->
      <div class="tab_content active" data-tab="1">
        <h2 class="sec_title">
          <span class="avenir">LET's</span>
          <span class="instru">TALK</span>
        </h2>
        <div class="tab_btns">
          <button class="tab_btn active" data-tab="1">상담문의</button>
          <button class="tab_btn" data-tab="2">위치안내</button>
        </div>
        <div class="contact_wrap">
          <div class="contact_left">
            <p class="left_text_ko">나에게 맞는 학습 방법과 합격 전략이 궁금하다면,<br/>상담 예약을 통해 직접 이야기를 나눠보세요.<br/>편입 준비, 혼자 고민하지 마세요. 이드 학원이 함께 답을 찾아드립니다.<br/>- 지금 바로 상담을 문의해보세요.</p>
            <p class="left_text_en">Curious about the right study plan and admission strategy for you?<br class="pc_only"/>Book a consultation and speak directly with our experts.<br/>Don't struggle alone with transfer preparation.<br/>Ed will help you find the right answers<br/>— contact us today.</p>
            <div class="left_bottom">
              <svg width="50" height="54" viewBox="0 0 50 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.363 53.3421L21.8873 31.979L3.60419 43.1848L0 36.8938L18.8729 26.7366L0 16.4482L3.60419 10.1573L21.8873 21.363L21.363 0H28.5714L28.0472 21.363L46.3958 10.1573L50 16.4482L31.1927 26.7366L50 36.8938L46.3958 43.1848L28.0472 31.979L28.5714 53.3421H21.363Z" fill="black"/>
              </svg>
              <svg width="50" height="54" viewBox="0 0 50 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.363 53.3421L21.8873 31.979L3.60419 43.1848L0 36.8938L18.8729 26.7366L0 16.4482L3.60419 10.1573L21.8873 21.363L21.363 0H28.5714L28.0472 21.363L46.3958 10.1573L50 16.4482L31.1927 26.7366L50 36.8938L46.3958 43.1848L28.0472 31.979L28.5714 53.3421H21.363Z" fill="black"/>
              </svg>
              <p class="bottom_text">A message away<br/>from your next chapter.</p>
              <p class="bottom_text">Tell us your goal<br/>we'll help you get there.</p>
            </div>
          </div>
          <div class="contact_right">
            <div class="right_tabs">
              <button class="right_tab active" data-right-tab="contact">Contact</button>
              <button class="right_tab" data-right-tab="board">Board</button>
            </div>
            <div class="right_content active" data-right-tab="contact">
              <form class="contact_form" id="contactForm" action="contact_submit.php" method="post" enctype="multipart/form-data">
                <div class="form_row">
                  <label class="form_label">이름</label>
                  <input type="text" class="form_input" name="name" placeholder="이름 입력">
                </div>
                <div class="form_row">
                  <label class="form_label">이메일</label>
                  <input type="text" class="form_input" name="email" placeholder="이메일 입력">
                </div>
                <div class="form_row">
                  <label class="form_label">전적대학교 및 학과</label>
                  <input type="text" class="form_input" name="university" placeholder="전적대학교 및 학과 입력">
                </div>
                <div class="form_row">
                  <label class="form_label">전형</label>
                  <div class="checkbox_group">
                    <label class="checkbox_item">
                      <input type="checkbox" name="type[]" value="일반">
                      <span class="checkbox_label">일반</span>
                    </label>
                    <label class="checkbox_item">
                      <input type="checkbox" name="type[]" value="학사">
                      <span class="checkbox_label">학사</span>
                    </label>
                  </div>
                </div>
                <div class="form_row">
                  <label class="form_label">공인영어</label>
                  <div class="checkbox_group">
                    <label class="checkbox_item">
                      <input type="checkbox" name="english[]" value="TOEIC">
                      <span class="checkbox_label">TOEIC</span>
                    </label>
                    <label class="checkbox_item">
                      <input type="checkbox" name="english[]" value="Tofle">
                      <span class="checkbox_label">Tofle</span>
                    </label>
                    <label class="checkbox_item teps">
                      <input type="checkbox" name="english[]" value="Teps">
                      <span class="checkbox_label">Teps</span>
                    </label>
                    <div class="score_input">
                      <span class="score_label">점수:</span>
                      <input type="text" name="score" placeholder="점수 입력">
                    </div>
                  </div>
                </div>
                <div class="form_row">
                  <label class="form_label">제목</label>
                  <input type="text" class="form_input" name="title" placeholder="제목 입력">
                </div>
                <div class="form_row message_row">
                  <label class="form_label">메세지</label>
                  <textarea class="form_textarea" name="message" placeholder="메세지 입력"></textarea>
                </div>
                <div class="form_row file_row">
                  <label class="form_label" for="file1">첨부파일 1</label>
                  <input type="file" class="form_file" name="file1" id="file1">
                </div>
                <div class="form_row file_row">
                  <label class="form_label" for="file2">첨부파일 2</label>
                  <input type="file" class="form_file" name="file2" id="file2">
                </div>
                <div class="form_row file_row">
                  <label class="form_label" for="file3">첨부파일 3</label>
                  <input type="file" class="form_file" name="file3" id="file3">
                </div>
                <div class="form_row">
                  <label class="form_label">암호</label>
                  <input type="password" class="form_input" name="password" placeholder="암호 입력">
                </div>
                <div class="form_row privacy_row">
                  <label class="form_label">개인정보의 수집·이용 동의</label>
                  <div class="privacy_wrap">
                    <div class="checkbox_group privacy_agree">
                      <label class="checkbox_item">
                        <input type="radio" name="privacy" value="동의함">
                        <span class="checkbox_label">동의함</span>
                      </label>
                      <label class="checkbox_item">
                        <input type="radio" name="privacy" value="동의안함">
                        <span class="checkbox_label">동의 안함</span>
                      </label>
                    </div>
                    <div class="privacy_detail">
                      <label class="checkbox_item privacy_sub">
                        <input type="checkbox" name="privacy_detail[]" value="purpose">
                        <span class="checkbox_label">
                          <span class="privacy_title">개인정보의 수집·이용 목적</span>
                          <span class="privacy_content">서비스 제공 및 계약의 이행, 구매 및 대금결제, 물품배송 또는 청구지 발송, 회원관리 등을 위한 목적</span>
                        </span>
                      </label>
                      <label class="checkbox_item privacy_sub">
                        <input type="checkbox" name="privacy_detail[]" value="items">
                        <span class="checkbox_label">
                          <span class="privacy_title">수집하려는 개인정보의 항목</span>
                          <span class="privacy_content">이름, 이메일 등</span>
                        </span>
                      </label>
                      <label class="checkbox_item privacy_sub">
                        <input type="checkbox" name="privacy_detail[]" value="period">
                        <span class="checkbox_label">
                          <span class="privacy_title">개인정보의 보유 및 이용 기간</span>
                          <span class="privacy_content">회사는 개인정보 수집 및 이용목적이 달성된 후에는 예외없이 해당정보를 파기합니다.</span>
                        </span>
                      </label>
                    </div>
                  </div>
                </div>
                <button type="submit" class="submit_btn">SUBMIT</button>
              </form>
            </div>
            <div class="right_content" data-right-tab="board">
              <div class="board_list">
                <div class="board_header">
                  <span class="col_no">No.</span>
                  <span class="col_title">제목</span>
                  <span class="col_author">작성자</span>
                  <span class="col_date">작성일</span>
                  <span class="col_status">상태</span>
                </div>
                <ul class="board_body">
                  <?php
                  if(mysql_num_rows($inquiry_result) > 0) {
                    $num = $nTotalCount - $nFrom; // 전체 기준 번호
                    while($inquiry = mysql_fetch_array($inquiry_result)) {
                      // 이름 마스킹 (홍길동 -> 홍**)
                      $name = mb_substr($inquiry['iname'], 0, 1, 'UTF-8') . '**';
                      // 날짜 포맷
                      $date = date('Y.m.d.', strtotime($inquiry['reg_date']));
                      // 상태 클래스 및 텍스트
                      $status_class = '';
                      $status_text = '';
                      switch($inquiry['isw']) {
                        case '5': $status_class = 'waiting'; $status_text = '답변대기'; break;
                        case '7': $status_class = 'waiting'; $status_text = '상담보류'; break;
                        case '10': $status_class = 'complete'; $status_text = '답변완료'; break;
                      }
                  ?>
                  <li class="board_item" data-ino="<?=$inquiry['ino']?>">
                    <span class="col_no"><?=$num?></span>
                    <span class="col_title"><?=htmlspecialchars($inquiry['isubject'])?></span>
                    <span class="col_author"><?=$name?></span>
                    <span class="col_date"><?=$date?></span>
                    <span class="col_status <?=$status_class?>"><?=$status_text?></span>
                  </li>
                  <?php
                      // 답변완료인 경우 RE 행 추가
                      if($inquiry['isw'] == '10') {
                  ?>
                  <li class="board_item reply" data-ino="<?=$inquiry['ino']?>">
                    <span class="col_no"></span>
                    <span class="col_title">[re] <?=htmlspecialchars($inquiry['isubject'])?></span>
                    <span class="col_author">관리자</span>
                    <span class="col_date"><?=$date?></span>
                    <span class="col_status"></span>
                  </li>
                  <?php
                      }
                  ?>
                  <li class="board_password_form" data-ino="<?=$inquiry['ino']?>">
                    <div class="password_form_inner">
                      <span class="password_label">비밀번호</span>
                      <input type="password" class="password_input" placeholder="비밀번호 입력">
                      <button type="button" class="password_submit">확인</button>
                    </div>
                    <div class="password_error">비밀번호가 일치하지 않습니다.</div>
                  </li>
                  <?php
                      $num--;
                    }
                  } else {
                  ?>
                  <li class="board_item">
                    <span class="col_no">-</span>
                    <span class="col_title">등록된 문의가 없습니다.</span>
                    <span class="col_author">-</span>
                    <span class="col_date">-</span>
                    <span class="col_status">-</span>
                  </li>
                  <?php } ?>
                </ul>
                <?php if($nTotalPage > 1) { ?>
                <div class="pagination">
                  <?php
                  // 이전 버튼
                  if($pg > 1) {
                    echo '<a href="?pg='.($pg-1).'#board" class="page_btn prev">←</a>';
                  } else {
                    echo '<span class="page_btn prev" disabled>←</span>';
                  }

                  // 페이지 번호 (5개 단위, 현재 페이지 중심)
                  $startPage = max(1, $pg - 2);
                  $endPage = min($startPage + 4, $nTotalPage);
                  // 끝에서 5개 미만이면 시작점 조정
                  if($endPage - $startPage < 4) {
                    $startPage = max(1, $endPage - 4);
                  }

                  echo '<div class="page_nums">';
                  for($i = $startPage; $i <= $endPage; $i++) {
                    if($i == $pg) {
                      echo '<span class="page_num active">'.$i.'</span>';
                    } else {
                      echo '<a href="?pg='.$i.'#board" class="page_num">'.$i.'</a>';
                    }
                  }
                  echo '</div>';

                  // 다음 버튼
                  if($pg < $nTotalPage) {
                    echo '<a href="?pg='.($pg+1).'#board" class="page_btn next">→</a>';
                  } else {
                    echo '<span class="page_btn next" disabled>→</span>';
                  }
                  ?>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 탭 2: 위치안내 -->
      <div class="tab_content" data-tab="2">
        <h2 class="sec_title">
          <span class="instru">Here</span>
          <span class="avenir">we are</span>
        </h2>
        <div class="tab_btns">
          <button class="tab_btn" data-tab="1">상담문의</button>
          <button class="tab_btn active" data-tab="2">위치안내</button>
        </div>
        <div class="location_mobile_desc mobile_only">
          <p class="left_text_ko">미대편입 이드는 서울 건대본점과 홍대점, 두 캠퍼스로 운영되며 지하철과 버스 접근이 편리한 서울 중심권에 위치해 있습니다. 오늘의 연습이 내일의 합격으로 이어지는 곳, 그곳이 이드입니다.</p>
          <p class="left_text_en">Ed academy for art & design transfer operates two campuses in Seoul — Konkuk main and Hongdae — both conveniently located in the heart of the city with easy access to subway and bus lines. A place where today's practice becomes tomorrow's success — that place is Ed.</p>
        </div>
        <div class="location_wrap">
          <div class="location_left">
            <p class="left_text_ko">미대편입 이드는 서울 건대본점과 홍대점, 두 캠퍼스로 운영되며<br/>지하철과 버스 접근이 편리한 서울 중심권에 위치해 있습니다.<br/>오늘의 연습이 내일의 합격으로 이어지는 곳, 그곳이 이드입니다.</p>
            <p class="left_text_en">Ed academy for art & design transfer operates two campuses in Seoul<br class="pc_only"/>— Konkuk main and Hongdae — both conveniently located in<br/>the heart of the city with easy access to subway and bus lines.<br/>A place where today's practice becomes tomorrow's success —<br/>that place is Ed.</p>
            <div class="left_bottom">
              <svg width="50" height="54" viewBox="0 0 50 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.363 53.3421L21.8873 31.979L3.60419 43.1848L0 36.8938L18.8729 26.7366L0 16.4482L3.60419 10.1573L21.8873 21.363L21.363 0H28.5714L28.0472 21.363L46.3958 10.1573L50 16.4482L31.1927 26.7366L50 36.8938L46.3958 43.1848L28.0472 31.979L28.5714 53.3421H21.363Z" fill="black"/>
              </svg>
              <svg width="50" height="54" viewBox="0 0 50 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.363 53.3421L21.8873 31.979L3.60419 43.1848L0 36.8938L18.8729 26.7366L0 16.4482L3.60419 10.1573L21.8873 21.363L21.363 0H28.5714L28.0472 21.363L46.3958 10.1573L50 16.4482L31.1927 26.7366L50 36.8938L46.3958 43.1848L28.0472 31.979L28.5714 53.3421H21.363Z" fill="black"/>
              </svg>
              <p class="bottom_text">A message away<br/>from your next chapter.</p>
              <p class="bottom_text">Tell us your goal<br/>we'll help you get there.</p>
            </div>
          </div>
          <div class="location_right">
            <div class="location_box">
              <div class="location_top">
                <span class="location_name">건대이드<br/>본원</span>
                <span class="location_phone">+82 02<br/>464 9197</span>
                <a href="https://naver.me/52R2482v" target="_blank" class="location_addr">4F, Gunja Building, 512 Cheonho-daero,<br/>Gwangjin-gu, Seoul</a>
              </div>
              <div class="location_map" id="map_konkuk"></div>
              <div class="location_address">
                <span class="address_text">서울시 광진구 천호대로 512 군자빌딩 4층</span>
              </div>
            </div>
            <div class="location_box">
              <div class="location_top">
                <span class="location_name">홍대이드</span>
                <span class="location_phone">+82 02<br/>336 9543</span>
                <a href="https://naver.me/5M5lXBV7" target="_blank" class="location_addr">2F, Eunhye Building, 107-1 Wausan-ro,<br/>Mapo-gu, Seoul</a>
              </div>
              <div class="location_map" id="map_hongdae"></div>
              <div class="location_address">
                <span class="address_text">서울시 마포구 와우산로 107-1 은혜빌딩2층</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
<script src="js/contact.js"></script>

<!-- 네이버 지도 API -->
<script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpKeyId=5plzhiw4g6"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // 위치안내 탭이 활성화될 때 지도 초기화
  let mapsInitialized = false;

  function initMaps() {
    if (mapsInitialized) return;

    // 건대이드 본원 좌표 (서울특별시 광진구 천호대로 512)
    const konkukPosition = new naver.maps.LatLng(37.5583894, 127.0753041);

    // 홍대이드 좌표 (서울특별시 마포구 와우산로 107-1)
    const hongdaePosition = new naver.maps.LatLng(37.5534556, 126.9254033);

    // 건대 지도
    const mapKonkuk = new naver.maps.Map('map_konkuk', {
      center: konkukPosition,
      zoom: 17,
      zoomControl: true,
      zoomControlOptions: {
        position: naver.maps.Position.TOP_RIGHT
      }
    });

    // 건대 마커
    new naver.maps.Marker({
      position: konkukPosition,
      map: mapKonkuk,
      title: '건대이드 본원'
    });

    // 홍대 지도
    const mapHongdae = new naver.maps.Map('map_hongdae', {
      center: hongdaePosition,
      zoom: 17,
      zoomControl: true,
      zoomControlOptions: {
        position: naver.maps.Position.TOP_RIGHT
      }
    });

    // 홍대 마커
    new naver.maps.Marker({
      position: hongdaePosition,
      map: mapHongdae,
      title: '홍대이드'
    });

    mapsInitialized = true;
  }

  // 탭 전환 감지 - 위치안내 탭(data-tab="2") 클릭 시 지도 초기화
  const tabBtns = document.querySelectorAll('.tab_btn[data-tab="2"]');
  tabBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      setTimeout(initMaps, 100);
    });
  });

  // URL 해시로 바로 위치안내 탭으로 접근한 경우
  if (window.location.hash === '#location') {
    setTimeout(initMaps, 100);
  }

  // 페이지 로드 시 위치안내 탭이 이미 활성화되어 있는 경우
  const activeTab = document.querySelector('.tab_content[data-tab="2"].active');
  if (activeTab) {
    setTimeout(initMaps, 100);
  }
});
</script>
