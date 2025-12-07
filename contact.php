<?php
$pageTitle = 'Contact Us';
$isSubPage = true;
$pageCss = 'contact';
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
            <p class="left_text_en">Curious about the right study plan and admission strategy for you?<br/>Book a consultation and speak directly with our experts.<br/>Don't struggle alone with transfer preparation.<br/>Ed will help you find the right answers<br/>— contact us today.</p>
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
              <form class="contact_form">
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
                  <!-- 샘플 데이터 - 실제로는 서버에서 불러옴 -->
                  <li class="board_item">
                    <span class="col_no">70</span>
                    <span class="col_title">올해 편입 실기 관련 문의드립니다.</span>
                    <span class="col_author">김**</span>
                    <span class="col_date">2025.10.21.</span>
                    <span class="col_status complete">답변완료</span>
                  </li>
                  <li class="board_item reply">
                    <span class="col_no"></span>
                    <span class="col_title">[re] 올해 편입 실기 관련 문의드립니다.</span>
                    <span class="col_author">관리자</span>
                    <span class="col_date">2025.10.22.</span>
                    <span class="col_status"></span>
                  </li>
                  <li class="board_item">
                    <span class="col_no">69</span>
                    <span class="col_title">수강 등록 절차 문의</span>
                    <span class="col_author">이**</span>
                    <span class="col_date">2025.10.18.</span>
                    <span class="col_status waiting">답변대기</span>
                  </li>
                  <li class="board_item">
                    <span class="col_no">68</span>
                    <span class="col_title">학사편입 준비 기간 관련 상담 요청</span>
                    <span class="col_author">박**</span>
                    <span class="col_date">2025.10.15.</span>
                    <span class="col_status complete">답변완료</span>
                  </li>
                  <li class="board_item reply">
                    <span class="col_no"></span>
                    <span class="col_title">[re] 학사편입 준비 기간 관련 상담 요청</span>
                    <span class="col_author">관리자</span>
                    <span class="col_date">2025.10.16.</span>
                    <span class="col_status"></span>
                  </li>
                </ul>
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
        <div class="location_wrap">
          <div class="location_left">
            <p class="left_text_ko">미대편입 이드는 서울 건대본점과 홍대점, 두 캠퍼스로 운영되며<br/>지하철과 버스 접근이 편리한 서울 중심권에 위치해 있습니다.<br/>오늘의 연습이 내일의 합격으로 이어지는 곳, 그곳이 이드입니다.</p>
            <p class="left_text_en">Ed academy for art & design transfer operates two campuses in Seoul<br/>— Konkuk main and Hongdae — both conveniently located in<br/>the heart of the city with easy access to subway and bus lines.<br/>A place where today's practice becomes tomorrow's success —<br/>that place is Ed.</p>
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
                <span class="location_addr">4F, Gunja Building, 512 Cheonho-daero,<br/>Gwangjin-gu, Seoul</span>
              </div>
              <div class="location_map">
                <!-- 지도 연동 예정 -->
              </div>
              <div class="location_address">
                <span class="address_text">서울시 광진구 천호대로 512 군자빌딩 4층</span>
              </div>
            </div>
            <div class="location_box">
              <div class="location_top">
                <span class="location_name">홍대이드</span>
                <span class="location_phone">+82 02<br/>336 9543</span>
                <span class="location_addr">2F, Eunhye Building, 107-1 Wausan-ro,<br/>Mapo-gu, Seoul</span>
              </div>
              <div class="location_map">
                <!-- 지도 연동 예정 -->
              </div>
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
