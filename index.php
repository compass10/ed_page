<?php
$pageTitle = '메인';

// DB 연결
include_once('./web/lib.php');

// 메인 뉴스 데이터 조회 (순서대로, 10개)
$news_sql = "SELECT * FROM $board_table
             WHERE bid='mainnews'
             AND is_hidden='N'
             ORDER BY bpw ASC, bno DESC
             LIMIT 0, 10";
$news_result = mysql_query($news_sql);

// 포트폴리오 슬라이드 조회 (순서대로)
$portslide_sql = "SELECT * FROM $board_table WHERE bid='portslide' AND is_hidden='N' ORDER BY bpw ASC, bno DESC";
$portslide_result = mysql_query($portslide_sql);

// 슬라이드 데이터 배열 생성
$port_slides = array();
while($row = mysql_fetch_array($portslide_result)) {
    $port_slides[] = array(
        'img' => $row['bimg'] ? $_url . 'thumb/portslide/' . $row['bimg'] : '',
        'text' => $row['btitle']
    );
}
?>
<?php include 'includes/header.php'; ?>

  <main>
    <section id="topSection" class="section01 section">
      <div class="top_elements">
        <div class="top_marquee">
          <span> CREATIVE JOURNEY, BY ED </span>
          <span> CREATIVE JOURNEY, BY ED </span>
          <span> CREATIVE JOURNEY, BY ED </span>
        </div>
        <div class="top_comps">
          <span> VISUAL DESIGN </span>
          <span> MOTION DESIGN </span>
          <span> INDUSTRIAL DESIGN </span>
          <span> CRAFT DESIGN </span>
        </div>
      </div>

      <div class="main_visual">
        <div class="flex_box">
          <div class="left_text visual_text">
            Build your dream, <br />
            step by step with ED.
          </div>
          <div class="main_img">
            <video src="./asset/video/main/main.mp4" muted autoplay playsinline loop></video>
          </div>
          <div class="right_text visual_text">
            Your vision <br />
            begins here.
          </div>
        </div>
      </div>
    </section>
    <section id="textEd" class="seciton02 section">
      <div class="text_flex">
        <div class="left_text">
          Dream it. <br />
          Draw it. <br />
          Do it with ED.
        </div>
        <div class="center_text">
          <span class="star"><svg width="56" height="60" viewBox="0 0 56 60" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M23.877 59.6191L24.4629 35.7422L4.02832 48.2666L0 41.2354L21.0938 29.8828L0 18.3838L4.02832 11.3525L24.4629 23.877L23.877 0H31.9336L31.3477 23.877L51.8555 11.3525L55.8838 18.3838L34.8633 29.8828L55.8838 41.2354L51.8555 48.2666L31.3477 35.7422L31.9336 59.6191H23.877Z"
                fill="black" />
            </svg>
          </span>

          <div class="under_text">
            <p>
              이드의 합격은 단순한 결과가 아닙니다. <br />
              한 사람의 꿈이 완성된 이야기입니다.
            </p>
            <p class="right_text">
              At ED, every acceptance is more than an outcome <br />
              — it's a story of one's dream coming true.
            </p>
          </div>
        </div>
      </div>
      <div class="bottom_gif">
        <div class="man">
          <img src="./asset/images/main/main_text_img.gif" alt="남자 물감" />
        </div>
        <div class="title_img">
          <img class="chat_b pc" src="./asset/images/main/svg/chat_bubble_01.svg" alt="chat_bubble_01" /> 
          <img class="chat_b mobile" src="./asset/images/main/svg/chat_bubble_01_mob.svg" alt="chat_bubble_01" /> 
        </div>
      </div>
    </section>
    <section id="news" class="section section03">
      <div class="section_wrap">
        <div class="sec_header">
          <h2 class="header_tit">
            <span>LATEST <em>NEWS</em></span>
            <span>OF</span> <span>ED</span>
          </h2>
        </div>
               <div class="slide_page_nation">
          <div class="btn_prev pn_btn">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="20" cy="20" r="19.5" transform="rotate(180 20 20)" stroke="black" />
              <path d="M23 12L15 20L23 28" stroke="black" stroke-width="3" />
            </svg>
          </div>
          <div class="btn_next pn_btn">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="20" cy="20" r="19.5" stroke="black" />
              <path d="M17 28L25 20L17 12" stroke="black" stroke-width="3" />
            </svg>
          </div>
        </div>
        <div class="news_area news_swiper">
          <ul class="news_list swiper-wrapper">
            <?php
            if($news_result && mysql_num_rows($news_result) > 0) {
              while($news = mysql_fetch_array($news_result)) {
                $thumb_img = $news['bimg'] ? $_url . 'thumb/mainnews/' . $news['bimg'] : "./asset/images/main/02_01.png";
            ?>
            <li class="swiper-slide">
              <a href="news_detail.php?bno=<?=$news['bno']?>">
                <img src="<?=$thumb_img?>" alt="<?=htmlspecialchars($news['btitle'])?>" />
              </a>
            </li>
            <?php
              }
            } else {
              // 데이터 없을 때 기본 이미지
            ?>
            <li class="swiper-slide">
              <a href="#">
                <img src="./asset/images/main/02_01.png" alt="뉴스 준비중" />
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
 
      </div>
      <div class="bottom_img">
        <img src="./asset/images/main/sec03_bottom_img.gif" alt="책보는gif" />
      </div>
      <div class="bottom_banner">
        <p>
          Make your dream University your reality. You dream it, we help you
          draw the path.
        </p>
      </div>
    </section>
    <section id="success" class="section section04">
      <div class="title_area">
        <h2>
          <img src="./asset/images/main/svg/sec04_title.svg" alt="title_img" />
        </h2>

        <div class="title_img">
          <img class="chat_b pc" src="./asset/images/main/svg/chat_bubble_02.svg" alt="여기 진짜 붙는 애들이 다 모여있어요" />
          <img class="chat_b mobile" src="./asset/images/main/svg/chat_bubble_02_mob.svg" alt="여기 진짜 붙는 애들이 다 모여있어요" />
          <img class="man" src="./asset/images/main/sec04_title_img.gif" alt="노트북 보는 남자 이미지" />
        </div>
      </div>
      <div class="content">
        <div class="content_header">
          <div class="left_img">
            <img class="chat_b pc" src="./asset/images/main/svg/chat_bubble_03.svg" alt="2025년도 주요 대학 합격생 명단" />
            <img class="chat_b mobile" src="./asset/images/main/svg/chat_bubble_03_mob.svg" alt="2025년도 주요 대학 합격생 명단" />
          </div>
          <div class="center_gif">
            <img src="./asset/images/main/sec04_cont_img.gif" alt="인사gif" />
          </div>
          <div class="right_img">
            <img class="chat_b pc" src="./asset/images/main/svg/chat_bubble_04.svg" alt="1998년부터 이어진 합격 데이터 보기" />
            <img class="chat_b mobile" src="./asset/images/main/svg/chat_bubble_04_mob.svg" alt="1998년부터 이어진 합격 데이터 보기" />
            <a href="https://www.edillust.co.kr/success.php"></a>
          </div>
          <div class="bottom_center_gif">
            <img src="./asset/images/main/sec03_bottom_img.gif" alt="책보는gif">
          </div>
        </div>
        <div class="content_body pc_only">
          <!-- 첫 번째 테이블: 국민대~서경대 -->
          <table class="passed_table table_01">
            <tbody>
              <!-- 국민대학교 -->
              <tr>
                <th>국민대학교</th>
                <th>학사 1명 모집</th>
                <th>1명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>김0영</td>
                <td>영상디자인 학사</td>
              </tr>

              <!-- 서울과학기술대학교 -->
              <tr>
                <th>서울과학기술대학교</th>
                <th>일반 2명 모집</th>
                <th>2명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>김0윤</td>
                <td>시각디자인전공</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>유0량</td>
                <td>산업디자인전공</td>
              </tr>

              <!-- 단국대학교 -->
              <tr>
                <th>단국대학교</th>
                <th>일반 5명 모집</th>
                <th>4명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>5명 모집 4명 합격</td>
                <td>장0연<br />이0빈<br />이0원<br />박0현</td>
                <td>
                  커뮤니케이션디자인과<br />커뮤니케이션디자인과<br />커뮤니케이션디자인과<br />커뮤니케이션디자인과
                </td>
              </tr>

              <!-- 성신여자대학교 -->
              <tr>
                <th>성신여자대학교</th>
                <th></th>
                <th>4명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>문0아</td>
                <td>공예 일반</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>윤0<br />예비1<br />예비2</td>
                <td>공예 학사<br />공예 학사<br />공예 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>2명 모집 2명 합격</td>
                <td>최0인<br />이0현</td>
                <td>산업디자인 학사<br />산업디자인 학사</td>
              </tr>

              <!-- 서울여자대학교 -->
              <tr>
                <th>서울여자대학교</th>
                <th></th>
                <th>6명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>우0화</td>
                <td>시각디자인 일반</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 4명 합격</td>
                <td>박0빈<br />최0인<br />이0빈<br />이0현</td>
                <td>
                  시각디자인 학사<br />시각디자인 학사<br />시각디자인 학사<br />시각디자인
                  학사
                </td>
              </tr>
              <tr class="detail_txt">
                <td>2명 모집 1명 합격</td>
                <td>장0기</td>
                <td>산업디자인 일반</td>
              </tr>

              <!-- 동덕여자대학교 -->
              <tr>
                <th>동덕여자대학교</th>
                <th></th>
                <th>5명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>2명 모집 1명 합격</td>
                <td>문0우<br />예비1<br />예비4<br />예비6</td>
                <td>
                  시각실내디자인 일반<br />시각실내디자인 일반<br />시각실내디자인
                  일반<br />시각실내디자인 일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>김0정</td>
                <td>시각실내디자인 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>2명 모집 3명 합격</td>
                <td>최0진<br />우0화<br />백0우</td>
                <td>
                  미디어디자인 일반<br />미디어디자인 일반<br />미디어디자인
                  일반
                </td>
              </tr>

              <!-- 중앙대학교 -->
              <tr>
                <th>중앙대학교</th>
                <th></th>
                <th>3명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>19명 모집 3명 합격</td>
                <td>김0윤<br />이0윤<br />차0서</td>
                <td>
                  예술공학부 일반<br />예술공학부 일반<br />예술공학부 일반
                </td>
              </tr>

              <!-- 서경대학교 -->
              <tr>
                <th>서경대학교</th>
                <th></th>
                <th>6명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>4명 모집 5명 합격</td>
                <td>
                  김0윤<br />차0서<br />백0우<br />손0연<br />현0희<br />예비1<br />예비2<br />예비3<br />예비4<br />예비5<br />예비6<br />예비7
                </td>
                <td>
                  비쥬얼디자인 일반<br />비쥬얼디자인 일반<br />비쥬얼디자인
                  일반<br />비쥬얼디자인 일반<br />비쥬얼디자인 일반<br />비쥬얼디자인
                  일반<br />비쥬얼디자인 일반<br />비쥬얼디자인 일반<br />비쥬얼디자인
                  일반<br />비쥬얼디자인 일반<br />비쥬얼디자인 일반<br />비쥬얼디자인
                  일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>정0빈<br />예비1<br />예비3</td>
                <td>
                  비주얼디자인 학사<br />비주얼디자인 학사<br />비주얼디자인
                  학사
                </td>
              </tr>
            </tbody>
          </table>

          <!-- 두 번째 테이블: 홍익대~상명대 -->
          <table class="passed_table table_02">
            <tbody>
              <!-- 홍익대학교 -->
              <tr>
                <th>홍익대학교</th>
                <th></th>
                <th>31명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>19명 모집 16명 합격</td>
                <td>
                  방0은<br />나0영<br />이0경<br />이0윤<br />서0정<br />이0원<br />이0진<br />유0찬<br />기0은<br />배0리<br />황0영<br />임0지<br />최0정<br />박0명<br />한0원<br />신0희
                </td>
                <td>
                  디자인컨버전스 일반<br />디자인컨버전스 일반<br />디자인컨버전스
                  일반<br />디자인컨버전스 일반<br />디자인컨버전스 일반<br />디자인컨버전스
                  일반<br />디자인컨버전스 일반<br />디자인컨버전스 일반<br />디자인컨버전스
                  일반<br />디자인컨버전스 일반<br />디자인컨버전스 일반<br />디자인컨버전스
                  일반<br />디자인컨버전스 일반<br />디자인컨버전스 일반<br />디자인컨버전스
                  일반<br />디자인컨버전스 일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>5명 모집 4명 합격</td>
                <td>구0원<br />최0진<br />조0진<br />이0우</td>
                <td>
                  디자인컨버전스 학사<br />디자인컨버전스 학사<br />디자인컨버전스
                  학사<br />디자인컨버전스 학사
                </td>
              </tr>
              <tr class="detail_txt">
                <td>연계</td>
                <td>손0현<br />정0린<br />이0언</td>
                <td>
                  디자인컨버전스 연계<br />디자인컨버전스 연계<br />디자인컨버전스
                  연계
                </td>
              </tr>
              <tr class="detail_txt">
                <td>4명 모집 3명 합격</td>
                <td>차0서<br />이0선<br />신0환</td>
                <td>
                  영상, 애니 일반<br />영상, 애니 일반<br />영상, 애니 일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>3명 모집 1명 합격</td>
                <td>이0현</td>
                <td>영상, 애니 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 2명 합격</td>
                <td>남0운<br />이0빈</td>
                <td>게임그래픽 학사<br />게임그래픽 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>연계</td>
                <td>조0찬<br />유0욱</td>
                <td>게임그래픽 연계<br />게임그래픽 연계</td>
              </tr>

              <!-- 건국대학교 -->
              <tr>
                <th>건국대학교</th>
                <th></th>
                <th>24명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>5명 모집 7명 합격</td>
                <td>
                  김0윤<br />임0운<br />신0<br />백0우<br />이0서<br />유0찬<br />현0희
                </td>
                <td>
                  시각영상디자인 일반<br />시각영상디자인 일반<br />시각영상디자인
                  일반<br />시각영상디자인 일반<br />시각영상디자인 일반<br />시각영상디자인
                  일반<br />시각영상디자인 일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>2명 모집 1명 합격</td>
                <td>박0빈</td>
                <td>시각영상디자인 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>7명 모집 7명 합격</td>
                <td>
                  서0현<br />김0은<br />우0화<br />조0솔<br />김0진<br />이0현<br />장0수
                </td>
                <td>
                  미디어컨텐츠디자인 일반<br />미디어컨텐츠디자인 일반<br />미디어컨텐츠디자인
                  일반<br />미디어컨텐츠디자인 일반<br />미디어컨텐츠디자인
                  일반<br />미디어컨텐츠디자인 일반<br />미디어컨텐츠디자인
                  일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 2명 합격</td>
                <td>이0현<br />양0은</td>
                <td>미디어컨텐츠디자인 학사<br />미디어컨텐츠디자인 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>조0민</td>
                <td>산업디자인 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>4명 모집 6명 합격</td>
                <td>
                  문0아<br />김0서<br />조0인<br />유0욱<br />이0언<br />김0은
                </td>
                <td>
                  산업디자인 연계<br />산업디자인 연계<br />산업디자인 연계<br />산업디자인
                  연계<br />산업디자인 연계<br />산업디자인 연계
                </td>
              </tr>

              <!-- 상명대학교 -->
              <tr>
                <th>상명대학교</th>
                <th></th>
                <th>11명 합격</th>
                <th class="add_toggle">
                  <svg width="34" height="34" viewBox="4 4 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 4.75A.75.75 0 0 1 15.5 4h.4a.5.5 0 0 1 .5.5V14h9.25a.75.75 0 0 1 0 1.5H16.4v9.25a.5.5 0 0 1-.5.5h-.4a.75.75 0 0 1-.75-.75V15.5H5.5a.75.75 0 0 1 0-1.5h9.25V5.5A.5.5 0 0 1 15.5 5h-.4a.75.75 0 0 1-.75-.75Z"/>
                  </svg>
                </th>
              </tr>
              <tr class="detail_txt">
                <td>3명 모집 2명 합격</td>
                <td>고0현<br />이0언</td>
                <td>무대디자인 일반<br />무대디자인 일반</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 2명 합격</td>
                <td>이0빈<br />박0민</td>
                <td>무대디자인 학사<br />무대디자인 학사</td>
              </tr>
              <tr class="detail_txt">
                <td>3명 모집 2명 합격</td>
                <td>장0연<br />신0<br />예비3</td>
                <td>
                  커뮤니케이션디자인 일반<br />커뮤니케이션디자인 일반<br />커뮤니케이션디자인
                  일반
                </td>
              </tr>
              <tr class="detail_txt">
                <td>2명 모집 3명 합격</td>
                <td>박0빈<br />최0진<br />양0희<br />예비6<br />예비8</td>
                <td>
                  커뮤니케이션디자인 학사<br />커뮤니케이션디자인 학사<br />커뮤니케이션디자인
                  학사<br />커뮤니케이션디자인 학사<br />커뮤니케이션디자인
                  학사
                </td>
              </tr>
              <tr class="detail_txt">
                <td>3명 모집 1명 합격</td>
                <td>최0진</td>
                <td>텍스타일디자인 일반</td>
              </tr>
              <tr class="detail_txt">
                <td>1명 모집 1명 합격</td>
                <td>이0림</td>
                <td>인더스트리얼디자인 학사</td>
              </tr>
            </tbody>
          </table>
          <div class="absol_img01 absol_img">
            <img src="./asset/images/main/sec04_absol_img_01.gif" alt="gif 이미지" />
          </div>
          <div class="absol_img02 absol_img">
            <img src="./asset/images/main/sec04_absol_img_02.gif" alt="gif 이미지" />
          </div>
          <div class="absol_img03 absol_img">
            <img src="./asset/images/main/sec04_absol_img_03.gif" alt="gif 이미지" />
          </div>
        </div>
        <div class="content_body mob_only">
          <!-- 국민대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">국민대학교</div>
              <div class="univ_summary">학사 1명 모집 1명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">김0영</span>
                  <span class="major">영상디자인 학사</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 서울과학기술대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">서울과학기술대학교</div>
              <div class="univ_summary">일반 2명 모집 2명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">김0윤</span>
                  <span class="major">시각디자인전공</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">유0량</span>
                  <span class="major">산업디자인전공</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 단국대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">단국대학교</div>
              <div class="univ_summary">일반 5명 모집 4명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">장0연</span>
                  <span class="major">커뮤니케이션디자인과</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">이0빈</span>
                  <span class="major">커뮤니케이션디자인과</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">이0원</span>
                  <span class="major">커뮤니케이션디자인과</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">박0현</span>
                  <span class="major">커뮤니케이션디자인과</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 성신여자대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">성신여자대학교</div>
              <div class="univ_summary">4명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">문0아</span>
                  <span class="major">공예 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">윤0</span>
                  <span class="major">공예 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">예비1</span>
                  <span class="major">공예 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">예비2</span>
                  <span class="major">공예 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 2명 합격</span>
                  <span class="name">최0인</span>
                  <span class="major">산업디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 2명 합격</span>
                  <span class="name">이0현</span>
                  <span class="major">산업디자인 학사</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 서울여자대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">서울여자대학교</div>
              <div class="univ_summary">6명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">우0화</span>
                  <span class="major">시각디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 4명 합격</span>
                  <span class="name">박0빈</span>
                  <span class="major">시각디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 4명 합격</span>
                  <span class="name">최0인</span>
                  <span class="major">시각디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 4명 합격</span>
                  <span class="name">이0빈</span>
                  <span class="major">시각디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 4명 합격</span>
                  <span class="name">이0현</span>
                  <span class="major">시각디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 1명 합격</span>
                  <span class="name">장0기</span>
                  <span class="major">산업디자인 일반</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 동덕여자대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">동덕여자대학교</div>
              <div class="univ_summary">5명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">2명 모집 1명 합격</span>
                  <span class="name">문0우</span>
                  <span class="major">시각실내디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 1명 합격</span>
                  <span class="name">예비1</span>
                  <span class="major">시각실내디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 1명 합격</span>
                  <span class="name">예비4</span>
                  <span class="major">시각실내디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 1명 합격</span>
                  <span class="name">예비6</span>
                  <span class="major">시각실내디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">김0정</span>
                  <span class="major">시각실내디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">최0진</span>
                  <span class="major">미디어디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">우0화</span>
                  <span class="major">미디어디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">백0우</span>
                  <span class="major">미디어디자인 일반</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 중앙대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">중앙대학교</div>
              <div class="univ_summary">3명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">19명 모집 3명 합격</span>
                  <span class="name">김0윤</span>
                  <span class="major">예술공학부 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 3명 합격</span>
                  <span class="name">이0윤</span>
                  <span class="major">예술공학부 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 3명 합격</span>
                  <span class="name">차0서</span>
                  <span class="major">예술공학부 일반</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 서경대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">서경대학교</div>
              <div class="univ_summary">6명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">김0윤</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">차0서</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">백0우</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">손0연</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">현0희</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비1</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비2</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비3</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비4</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비5</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비6</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 5명 합격</span>
                  <span class="name">예비7</span>
                  <span class="major">비쥬얼디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">정0빈</span>
                  <span class="major">비주얼디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">예비1</span>
                  <span class="major">비주얼디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">예비3</span>
                  <span class="major">비주얼디자인 학사</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 홍익대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">홍익대학교</div>
              <div class="univ_summary">31명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">방0은</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">나0영</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">이0경</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">이0윤</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">서0정</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">이0원</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">이0진</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">유0찬</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">기0은</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">배0리</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">황0영</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">임0지</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">최0정</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">박0명</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">한0원</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">19명 모집 16명 합격</span>
                  <span class="name">신0희</span>
                  <span class="major">디자인컨버전스 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">구0원</span>
                  <span class="major">디자인컨버전스 학사</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">최0진</span>
                  <span class="major">디자인컨버전스 학사</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">조0진</span>
                  <span class="major">디자인컨버전스 학사</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 4명 합격</span>
                  <span class="name">이0우</span>
                  <span class="major">디자인컨버전스 학사</span>
                </li>
                <li>
                  <span class="recruit">연계</span>
                  <span class="name">손0현</span>
                  <span class="major">디자인컨버전스 연계</span>
                </li>
                <li>
                  <span class="recruit">연계</span>
                  <span class="name">정0린</span>
                  <span class="major">디자인컨버전스 연계</span>
                </li>
                <li>
                  <span class="recruit">연계</span>
                  <span class="name">이0언</span>
                  <span class="major">디자인컨버전스 연계</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 3명 합격</span>
                  <span class="name">차0서</span>
                  <span class="major">영상, 애니 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 3명 합격</span>
                  <span class="name">이0선</span>
                  <span class="major">영상, 애니 일반</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 3명 합격</span>
                  <span class="name">신0환</span>
                  <span class="major">영상, 애니 일반</span>
                </li>
                <li>
                  <span class="recruit">3명 모집 1명 합격</span>
                  <span class="name">이0현</span>
                  <span class="major">영상, 애니 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 2명 합격</span>
                  <span class="name">남0운</span>
                  <span class="major">게임그래픽 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 2명 합격</span>
                  <span class="name">이0빈</span>
                  <span class="major">게임그래픽 학사</span>
                </li>
                <li>
                  <span class="recruit">연계</span>
                  <span class="name">조0찬</span>
                  <span class="major">게임그래픽 연계</span>
                </li>
                <li>
                  <span class="recruit">연계</span>
                  <span class="name">유0욱</span>
                  <span class="major">게임그래픽 연계</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 건국대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">건국대학교</div>
              <div class="univ_summary">24명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">김0윤</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">임0운</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">신0</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">백0우</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">이0서</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">유0찬</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">5명 모집 7명 합격</span>
                  <span class="name">현0희</span>
                  <span class="major">시각영상디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 1명 합격</span>
                  <span class="name">박0빈</span>
                  <span class="major">시각영상디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">서0현</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">김0은</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">우0화</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">조0솔</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">김0진</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">이0현</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">7명 모집 7명 합격</span>
                  <span class="name">장0수</span>
                  <span class="major">미디어컨텐츠디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 2명 합격</span>
                  <span class="name">이0현</span>
                  <span class="major">미디어컨텐츠디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 2명 합격</span>
                  <span class="name">양0은</span>
                  <span class="major">미디어컨텐츠디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">조0민</span>
                  <span class="major">산업디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 6명 합격</span>
                  <span class="name">문0아</span>
                  <span class="major">산업디자인 연계</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 6명 합격</span>
                  <span class="name">김0서</span>
                  <span class="major">산업디자인 연계</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 6명 합격</span>
                  <span class="name">조0인</span>
                  <span class="major">산업디자인 연계</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 6명 합격</span>
                  <span class="name">유0욱</span>
                  <span class="major">산업디자인 연계</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 6명 합격</span>
                  <span class="name">이0언</span>
                  <span class="major">산업디자인 연계</span>
                </li>
                <li>
                  <span class="recruit">4명 모집 6명 합격</span>
                  <span class="name">김0은</span>
                  <span class="major">산업디자인 연계</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- 상명대학교 -->
          <div class="accordion_item">
            <div class="accordion_header">
              <div class="univ_name">상명대학교</div>
              <div class="univ_summary">11명 합격</div>
              <button class="accordion_btn" aria-expanded="false">
                <span class="icon"></span>
              </button>
            </div>
            <div class="accordion_content">
              <ul class="pass_list">
                <li>
                  <span class="recruit">3명 모집 2명 합격</span>
                  <span class="name">고0현</span>
                  <span class="major">무대디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">3명 모집 2명 합격</span>
                  <span class="name">이0언</span>
                  <span class="major">무대디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 2명 합격</span>
                  <span class="name">이0빈</span>
                  <span class="major">무대디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 2명 합격</span>
                  <span class="name">박0민</span>
                  <span class="major">무대디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">3명 모집 2명 합격</span>
                  <span class="name">장0연</span>
                  <span class="major">커뮤니케이션디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">3명 모집 2명 합격</span>
                  <span class="name">신0</span>
                  <span class="major">커뮤니케이션디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">3명 모집 2명 합격</span>
                  <span class="name">예비3</span>
                  <span class="major">커뮤니케이션디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">박0빈</span>
                  <span class="major">커뮤니케이션디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">최0진</span>
                  <span class="major">커뮤니케이션디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">양0희</span>
                  <span class="major">커뮤니케이션디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">예비6</span>
                  <span class="major">커뮤니케이션디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">2명 모집 3명 합격</span>
                  <span class="name">예비8</span>
                  <span class="major">커뮤니케이션디자인 학사</span>
                </li>
                <li>
                  <span class="recruit">3명 모집 1명 합격</span>
                  <span class="name">최0진</span>
                  <span class="major">텍스타일디자인 일반</span>
                </li>
                <li>
                  <span class="recruit">1명 모집 1명 합격</span>
                  <span class="name">이0림</span>
                  <span class="major">인더스트리얼디자인 학사</span>
                </li>
              </ul>
            </div>
          </div>

      </div>
    </section>
    <section id="andMore" class="section section05">
      <div class="section_header">
        <div class="left">@ 2025</div>
        <div class="right">and <em>More</em></div>
      </div>
      <div class="pass_list pc_only">
        <ul class="img_list">
          <li><img src="./asset/images/main/sec_05_left_img_01.jpeg" alt=""></li>
          <li><img src="./asset/images/main/sec_05_left_img_02.png" alt=""></li>
          <li><img src="./asset/images/main/sec_05_left_img_03.jpeg" alt=""></li>
          <li><img src="./asset/images/main/sec_05_left_img_04.png" alt=""></li>
          <li><img src="./asset/images/main/sec_05_left_img_05.png" alt=""></li>
        </ul>
        <ul class="article_list">
          <li>
            <a href="https://www.edillust.co.kr/success_detail.php?bno=790">
              <div class="title_area">
                <p>2025 합격자 바로가기</p>
                <div class="btn">
                  <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z"
                      fill="black" />
                  </svg>
                </div>
              </div>
              <div class="hiding_text">
                2025년 압도적 점유율 1위대학 30개 대학! 서울 최상위권대학은
                100% 점유!
              </div>
            </a>
          </li>
          <li>
            <a href="https://www.edillust.co.kr/success_detail.php?bno=789">
              <div class="title_area">
                <p>2024 합격자 바로가기</p>
                <div class="btn">
                  <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z"
                      fill="black" />
                  </svg>
                </div>
              </div>
              <div class="hiding_text">
                2024학년도 이드 합격자 101명! 이드의 합격자는 in서울과 수도권
                중심 대학만을 지원합니다
              </div>
            </a>
          </li>
          <li>
            <a href="https://www.edillust.co.kr/success_detail.php?bno=701">
              <div class="title_area">
                <p>2023 합격자 바로가기</p>
                <div class="btn">
                  <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z"
                      fill="black" />
                  </svg>
                </div>
              </div>
              <div class="hiding_text">
                2023년도 이드합격자 서울,수도권대학 총 98명 합격의 쾌거!
              </div>
            </a>
          </li>
          <li>
            <a href="https://www.edillust.co.kr/success_detail.php?bno=700">
              <div class="title_area">
                <p>2022 합격자 바로가기</p>
                <div class="btn">
                  <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z"
                      fill="black" />
                  </svg>
                </div>
              </div>
              <div class="hiding_text">
                총 합격자 수 89명! 포트폴리오 전형 29명 합격
              </div>
            </a>
          </li>
          <li>
            <a href="https://www.edillust.co.kr/success_detail.php?bno=699">
              <div class="title_area">
                <p>2021 합격자 바로가기</p>
                <div class="btn">
                  <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z"
                      fill="black" />
                  </svg>
                </div>
              </div>
              <div class="hiding_text">
                2021년도 총 50명 합격! 홍익대학교 17명, 건국대 12명, 경희대
                1명, 성신여대 1명, 서울여대 1명 동덕여대 1명!
              </div>
            </a>
          </li>
        </ul>
      </div>
      <!-- 모바일 전용 pass_list -->
      <div class="pass_list_mobile mobile_only">
        <ul class="article_list">
          <li data-link="https://www.edillust.co.kr/success_detail.php?bno=790">
            <div class="title_area">
              <p>2025 합격자 바로가기</p>
              <div class="btn">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z" fill="black" />
                </svg>
              </div>
            </div>
            <div class="hiding_text">
              <p>2025년 압도적 점유율 1위대학 30개 대학! 서울 최상위권대학은 100% 점유!</p>
              <img src="./asset/images/main/sec_05_left_img_01.jpeg" alt="2025 합격자">
            </div>
          </li>
          <li data-link="https://www.edillust.co.kr/success_detail.php?bno=789">
            <div class="title_area">
              <p>2024 합격자 바로가기</p>
              <div class="btn">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z" fill="black" />
                </svg>
              </div>
            </div>
            <div class="hiding_text">
              <p>2024학년도 이드 합격자 101명! 이드의 합격자는 in서울과 수도권 중심 대학만을 지원합니다</p>
              <img src="./asset/images/main/sec_05_left_img_02.png" alt="2024 합격자">
            </div>
          </li>
          <li data-link="https://www.edillust.co.kr/success_detail.php?bno=701">
            <div class="title_area">
              <p>2023 합격자 바로가기</p>
              <div class="btn">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z" fill="black" />
                </svg>
              </div>
            </div>
            <div class="hiding_text">
              <p>2023년도 이드합격자 서울,수도권대학 총 98명 합격의 쾌거!</p>
              <img src="./asset/images/main/sec_05_left_img_03.jpeg" alt="2023 합격자">
            </div>
          </li>
          <li data-link="https://www.edillust.co.kr/success_detail.php?bno=700">
            <div class="title_area">
              <p>2022 합격자 바로가기</p>
              <div class="btn">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z" fill="black" />
                </svg>
              </div>
            </div>
            <div class="hiding_text">
              <p>총 합격자 수 89명! 포트폴리오 전형 29명 합격</p>
              <img src="./asset/images/main/sec_05_left_img_04.png" alt="2022 합격자">
            </div>
          </li>
          <li data-link="https://www.edillust.co.kr/success_detail.php?bno=699">
            <div class="title_area">
              <p>2021 합격자 바로가기</p>
              <div class="btn">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M14.5703 27.6953L11.4062 24.5703L19.8438 16.1328H0V11.5234H19.8438L11.4062 3.125L14.5703 0L28.4375 13.8281L14.5703 27.6953Z" fill="black" />
                </svg>
              </div>
            </div>
            <div class="hiding_text">
              <p>2021년도 총 50명 합격! 홍익대학교 17명, 건국대 12명, 경희대 1명, 성신여대 1명, 서울여대 1명 동덕여대 1명!</p>
              <img src="./asset/images/main/sec_05_left_img_05.png" alt="2021 합격자">
            </div>
          </li>
        </ul>
      </div>
    </section>
    <section id="opportunity" class="section section06">
      <div class="top_area">
        <div class="top_star">
          <svg width="71" height="150" viewBox="0 0 71 150" fill="none" xmlns="http://www.w3.org/2000/svg" class="pc_only">
            <path
              d="M30.3223 81.5645L31.2012 58.8594L11.8652 71.0176L6.88477 62.375L27.0996 51.8281L6.88477 41.1348L11.8652 32.4922L31.2012 44.6504L30.3223 21.9453H40.2832L39.4043 44.6504L58.7402 32.4922L63.7207 41.1348L43.6523 51.8281L63.7207 62.375L58.7402 71.0176L39.4043 58.8594L40.2832 81.5645H30.3223Z"
              fill="black" />
          </svg>
          <svg
          width="18"
          height="18"
          viewBox="6.88 21.94 56.84 59.62"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
          class="mob_only"
        >
          <path
            d="M30.3223 81.5645L31.2012 58.8594L11.8652 71.0176L6.88477 62.375L27.0996 51.8281L6.88477 41.1348L11.8652 32.4922L31.2012 44.6504L30.3223 21.9453H40.2832L39.4043 44.6504L58.7402 32.4922L63.7207 41.1348L43.6523 51.8281L63.7207 62.375L58.7402 71.0176L39.4043 58.8594L40.2832 81.5645H30.3223Z"
            fill="black"
          />
        </svg>
        </div>
        <div class="top_text">
          <ul class="top_img_list">
            <li>
              <img class="chat_b mobile" src="./asset/images/main/svg/sec_06_chat_bubble_03_mob.svg" alt="sec_06_gif">
              <img src="./asset/images/main/sec_06_top_img_01.gif" alt="sec_06_gif"> 
            </li>
            <li>
              <img src="./asset/images/main/sec_06_top_img_02.gif" alt="sec_06_gif">

            </li>
            <li>
              <img src="./asset/images/main/sec_06_top_img_03.gif" alt="sec_06_gif">

            </li>
            <li>
              <img src="./asset/images/main/sec_06_top_img_04.gif" alt="sec_06_gif">

            </li>
            <li>
              <img class="chat_b pc" src="./asset/images/main/svg/sec_06_chat_bubble_01.svg" alt="sec_06_gif">
              <img class="chat_b mobile" src="./asset/images/main/svg/sec_06_chat_bubble_01_mob.svg" alt="sec_06_gif">
            </li>
            <li>
              <img src="./asset/images/main/sec_06_top_img_05.gif" alt="sec_06_gif">

            </li>
            <li>
              <img src="./asset/images/main/sec_06_top_img_06.gif" alt="sec_06_gif">
            </li>
          </ul>
          <p class="kr">
            EDILLUST - 진심이 만든 결과.<br />
            주요 대학 모집인원 80명 중 90%이상 합격,<br class="mob_only" /> 결과가 쌓이면, 브랜드가 됩니다.
          </p>
          <p class="en">
            Edillust — Results built on sincerity.<br />
            When over 90% of 80 top university applicants succeed,<br />
            those results become a brand.
          </p>
        </div>
        <div class="bottom_text">
          <p>
            <span>Where&nbsp;</span>
            <img src="./asset/images/main/sec_06_effort.png" alt="effort_img">
            <span>&nbsp;EFFORT</span>
          </p>
          <p>
            <img src="./asset/images/main/sec_06_opportunity.png" alt="opportunity_img" class="mob_only">
            <span>meets&nbsp;</span>
            <img src="./asset/images/main/sec_06_opportunity.png" alt="opportunity_img" class="pc_only">
            <br class="mob_only"/>
            <span class="mob_transf">&nbsp;opportunity.</span>
          </p>
        </div>
      </div>
      <div class="bottom_area">
        <ul class="bottom_img_list">
          <li>
            <img src="./asset/images/main/sec_06_bottom_img_01.gif" alt="bottom_area_img">
            <img class="chat_b mobile" src="./asset/images/main/svg/sec_06_chat_bubble_02_mob.svg" alt="bottom_area_img">
          </li>
          <li>
            <img src="./asset/images/main/svg/sec_06_chat_bubble_02.svg" alt="bottom_area_img">
          </li>
          <li>
            <img src="./asset/images/main/sec_06_bottom_img_02.gif" alt="bottom_area_img">
          </li>
          <li>
            <img src="./asset/images/main/sec_06_bottom_img_03.gif" alt="bottom_area_img">
          </li>
          <li>
            <img src="./asset/images/main/svg/sec_06_chat_bubble_03.svg" alt="bottom_area_img">
          </li>
        </ul>
        <div class="grid_line">
          <div class="first_row grid_row">
            <div class="hiding_text">
                          <div class="counting" data-count="800">
              <span>0</span>+ <br/>
              <p>현재까지 이드 합격생</p>
            </div>
            <div class="counting" data-count="130">
              <span>0</span>+ <br/>
              <p>2025 이드 합격생</p>
            </div>
            </div>
            <div class="floating">
              Turning <br/>
              your <span class="instru">potential</span> <br/>
              into <span class="instru">possibility</span><br/>
            </div>
          </div>
          <div class="second_row grid_row">
            <div class="hiding_text">
              <div class="counting" data-count="1200">
              <span>0</span>+ <br/>
              <p>현재 이드에 쌓인 그림</p>
            </div>
            <div class="counting" data-count="500">
              <span>0</span>+ <br/>
              <p>이번주 학생들이 마신 커피</p>
            </div>
            </div>
            <div class="floating">
with ED.
            </div>
          </div>
        </div>
        <div class="floating_wrap mob_only">
          <div class="floating">
            Turning <br/>
            your <span class="instru">potential</span> <br/>
            into <span class="instru">possibility</span><br/>
          </div>
          <div class="floating">
with ED.
          </div>
        </div>
      </div>
    </section>
    <section id="portfolio" class="section section07">
      <div class="section_header">
        <div class="title pc_only">
                  Portfolio<br/>
        of
        </div>
        <div class="box pc_only">
                  <div class="star">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.4258 19.873H7.71484L8.00781 12.5977L1.85547 16.5039L0 13.2812L6.49414 9.96094L0 6.5918L1.85547 3.36914L8.00781 7.27539L7.71484 0H11.4258L11.084 7.27539L17.2363 3.36914L19.1406 6.5918L12.6465 9.96094L19.1406 13.2812L17.2363 16.5039L11.084 12.5977L11.4258 19.873Z" fill="white"/>
</svg>

        </div>
        <div class="text_01">
          Build your dream, <br/>
step by step with ED.
        </div>
        <div class="text_02">
          We guide you to where you belong.<br/>
Because your dream deserves a real chance.
        </div>
        </div>
        <div class="img_01 pc_only">
          <img src="./asset/images/main/sec_07_header_img_01.gif" alt="sec_07_header_img_01">
        </div>
        <div class="right_text pc_only">
          ED
        </div>

        <div class="box mob_only">
          <div class="box_left">
            <div class="title">
              Portfolio<br/>
            of
            </div>
            <div class="text_01">
              Build your dream, <br/>
    step by step with ED.
            </div>
            <div class="img_01">
              <img src="./asset/images/main/sec_07_header_img_01.gif" alt="sec_07_header_img_01">
            </div>
          </div>
          <div class="box_right">
            <span class="star">
              <svg width="56" height="60" viewBox="0 0 56 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.877 59.6191L24.4629 35.7422L4.02832 48.2666L0 41.2354L21.0938 29.8828L0 18.3838L4.02832 11.3525L24.4629 23.877L23.877 0H31.9336L31.3477 23.877L51.8555 11.3525L55.8838 18.3838L34.8633 29.8828L55.8838 41.2354L51.8555 48.2666L31.3477 35.7422L31.9336 59.6191H23.877Z" fill="white"></path>
              </svg>
            </span>
            <div class="right_text">
              ED
            </div>
          </div>
        </div>

      </div>
      <div class="video_area">
        <video src="./asset/video/main/main_port.mp4" muted autoplay playsinline loop></video>

      </div>
      <div class="port_box">

        <div class="port_slide">

          <ul class="port_list swiper-wrapper">
            <?php if(!empty($port_slides)): ?>
              <?php foreach($port_slides as $slide): ?>
            <li class="swiper-slide">
              <img src="<?=$slide['img']?>" alt="portfolio_img">
              <div class="right_text">
                <?=nl2br(htmlspecialchars($slide['text']))?>
              </div>
            </li>
              <?php endforeach; ?>
            <?php else: ?>
            <li class="swiper-slide">
              <img src="./asset/images/main/sec_07_port_img_01.gif" alt="portfolio_img">
              <div class="right_text">
                <span class="cate">BRAND DEsign</span><br/>
                <span class="when">BATHE CAMPAIGN, 2025</span>
              </div>
            </li>
            <li class="swiper-slide">
              <img src="./asset/images/main/sec_07_port_img_02.png" alt="portfolio_img">
              <div class="right_text">
                <span class="cate">BRAND DEsign</span><br/>
                <span class="when">BATHE CAMPAIGN, 2025</span>
              </div>
            </li>
            <li class="swiper-slide">
              <img src="./asset/images/main/sec_07_port_img_03.png" alt="portfolio_img">
              <div class="right_text">
                <span class="cate">BRAND DEsign</span><br/>
                <span class="when">BATHE CAMPAIGN, 2025</span>
              </div>
            </li>
            <?php endif; ?>
          </ul>

        </div>
                <div class="port_next_btn">
          <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17 28L25 20L17 12" stroke="white" stroke-width="3"/>
<circle cx="20" cy="20" r="19.5" stroke="white"/>
</svg>

        </div>
      </div>
      <div class="bottom_bar">
        <a href="portfolio.php">CHeck out more portfolio of ED!</a>
      </div>
    </section>
    <section id="ourStory" class="section section09">
      <h2 class="sec_title">
        <span class="avenir">CHECK OUT</span>
        <span class="vivaldi">Our Story</span>
      </h2>

      <!-- PC용 -->
      <div class="sliding_cont pc_only">
        <div class="slide_front">
          <span>
            {
          </span>
              <div class="between_cont">
                From Ambition<br/>
to admission
              </div>
          <span>
            }
          </span>
        </div>
        <div class="slide_back">
          <div class="left_slide back_cont">
            on
          </div>
          <div class="right_slide back_cont">
            Youtube
          </div>
        </div>
      </div>

      <!-- 모바일용 -->
      <div class="sliding_cont_mobile mobile_only">
        <p class="mobile_title">check out</p>
        <div class="mobile_middle">
          <span class="bracket">{</span>
            <div class="flex_container">
              
              <span class="vivaldi_text our">Our</span>
              <div class="mobile_between">
                From Ambition<br/>to admission
              </div>
              <span class="vivaldi_text story">Story</span>
            </div>
          <span class="bracket">}</span>
        </div>
        <p class="mobile_youtube">on youtube</p>
      </div>

      <div class="youtube_grid">
        <?php
        // 유튜브 영상 불러오기 (최대 7개)
        $youtube_sql = "SELECT * FROM $board_table WHERE bid='youtube' AND is_hidden='N' ORDER BY bpw DESC, bno DESC LIMIT 7";
        $youtube_result = @mysql_query($youtube_sql);
        $youtube_count = 0;

        if($youtube_result && @mysql_num_rows($youtube_result) > 0) {
          while($yt = @mysql_fetch_array($youtube_result)) {
            $youtube_count++;
            $yt_url = $yt['blink'] ? 'https://www.youtube.com/watch?v=' . $yt['blink'] : '#';
            $yt_thumb = $yt['bimg'] ? $_url . 'thumb/youtube/' . $yt['bimg'] : 'asset/images/main/youtube_thumb_0' . $youtube_count . '.png';
            $yt_title = $yt['btitle'] ? htmlspecialchars($yt['btitle']) : 'Youtube thumbnail ' . $youtube_count;
        ?>
        <a href="<?=$yt_url?>" class="youtube_item" target="_blank">
          <img src="<?=$yt_thumb?>" alt="<?=$yt_title?>">
        </a>
        <?php
          }
        }

        // 7개 미만일 경우 빈 슬롯 채우기 (기본 이미지)
        for($i = $youtube_count + 1; $i <= 7; $i++) {
        ?>
        <a href="#" class="youtube_item">
          <img src="asset/images/main/youtube_thumb_0<?=$i?>.png" alt="Youtube thumbnail <?=$i?>">
        </a>
        <?php } ?>

        <!-- 8번째: 유튜브 채널 링크 (고정) -->
        <a href="https://www.youtube.com/@edillust_academy" class="youtube_item text_box" target="_blank">
          <div class="text_top">
            More Videos<br>
            on Youtube.<br>
            <span class="bold">Click Here!</span>
          </div>
          <div class="text_bottom">
            <span class="stars">* * *</span>
            <span class="arrow">→</span>
          </div>
        </a>
      </div>

    </section>
  </main>

  <!-- 모바일 #andMore 아코디언 토글 -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mobileItems = document.querySelectorAll('.pass_list_mobile .article_list li');

      mobileItems.forEach(function(item) {
        item.addEventListener('click', function() {
          // 현재 아이템이 이미 active면 닫기
          if (this.classList.contains('active')) {
            this.classList.remove('active');
          } else {
            // 다른 모든 아이템 닫기
            mobileItems.forEach(function(otherItem) {
              otherItem.classList.remove('active');
            });
            // 클릭한 아이템 열기
            this.classList.add('active');
          }
        });
      });
    });
  </script>

<?php include 'includes/footer.php'; ?>
