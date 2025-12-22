<?php
$pageTitle = 'Who We Are';
$isSubPage = true;
$pageCss = 'whoweare';

// DB 연결
include_once('./web/lib.php');

// 메인 뉴스 데이터 조회 (최대 4개)
$news_sql = "SELECT * FROM $board_table
             WHERE bid='mainnews'
             AND is_hidden='N'
             ORDER BY bpw ASC, bno DESC
             LIMIT 0, 4";
$news_result = @mysql_query($news_sql);
?>
<?php include 'includes/header.php'; ?>

  <main>
    <div class="page_title">
      <span class="num">01</span>
      <span class="title">Who We Are</span>
    </div>
    <section class="section page_content">
      <!-- 탭 1: 이드 소개 -->
      <div class="tab_content active" data-tab="1">
        <h2 class="sec_title">
          <span class="avenir">Where</span>
          <span class="instru">Creativity</span>
        </h2>
        <h2 class="sec_title">
          <span class="avenir">Meets</span>
          <span class="instru">Strategy.</span>
        </h2>
        <div class="tab_btns">
          <button class="tab_btn active" data-tab="1">이드 소개</button>
          <button class="tab_btn" data-tab="2">이드 공간 안내</button>
          <button class="tab_btn" data-tab="3">이드 커리큘럼 안내</button>
        </div>
        <div class="tab_detail">
          <div class="left_col">
            <h3 class="title">We're ED!</h3>
            <p class="content">
              우리 학원은 단순히 그림을 잘 그리게 만드는 곳이 아니라, 학생 한 사람의 가능성을 발견하고 끝까지 성장시키는 공간입니다.<br/><br/>
              처음에는 상담을 통해 목표 전공과 대학을 설정하고, 개인의 배경과 준비 기간을 진단하여 가장 효율적인 학습 경로를 만듭니다. 기초 드로잉과 색채, 조형 훈련으로 기본기를 다지는 동시에, 개성과 재능을 살려 나만의 작품 세계를 구축하도록 지도합니다.<br/><br/>
              완성된 포트폴리오는 단순한 평가 자료가 아닌, 학생의 비전과 정체성을 담은 결과물이 됩니다. 또한 실제 시험과 동일한 환경에서 모의 실기를 경험하고, 대학별 면접 대비 훈련을 통해 자신 있게 표현할 수 있도록 준비합니다.<br/><br/>
              특강기간에는 자유롭게 이용할 수 있는 학원 공간과 세심한 피드백 속에서 학생들은 몰입하며 성장할 수 있고, 우리는 그 길 끝까지 함께하는 든든한 동반자가 됩니다.
            </p>
          </div>
          <div class="right_col">
            <div class="item">
              <div class="item_title">상주 전문 강사진</div>
              <div class="item_content">
                <p class="sub_title">늘 곁에서 지켜보는 멘토</p>
                <p class="desc">
                  이드 학원은 언제나 학원에 상주하는 경험 많고 실력 있는 강사진이 함께합니다.<br/>
                  학생들은 필요한 순간마다 즉각적인 피드백과 지도를 받을 수 있어,<br/>
                  혼자 고민하는 시간을 줄이고 빠르게 성장할 수 있습니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">높은 미대 편입 합격률</div>
              <div class="item_content">
                <p class="sub_title">숫자로 증명되는 자신감</p>
                <p class="desc">
                  매년 수많은 합격 사례로 증명된 압도적인 합격률은<br/>
                  이드 학원의 가장 큰 자부심입니다. 단순한 합격을 넘어, 학생들이 원하는 대학과<br/>
                  학과에 진학할 수 있도록 끝까지 책임집니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">맞춤형 시간표</div>
              <div class="item_content">
                <p class="sub_title">나만의 속도를 존중하는 1:1 학습 설계</p>
                <p class="desc">
                  학생마다 목표와 학습 스타일은 다릅니다. 이드 학원은 획일적인 수업이 아닌,<br/>
                  개개인의 상황에 맞춘 맞춤형 시간표를 제공합니다. 이를 통해 학생들은 자신만의<br/>
                  학습 리듬을 유지하며 효율적인 성장을 이끌어냅니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">지정좌석제</div>
              <div class="item_content">
                <p class="sub_title">오직 나만의 자리, 언제나 내 공간</p>
                <p class="desc">
                  이드 학원은 학생 개개인에게 고유의 좌석을 제공합니다.<br/>
                  자신의 책상에서 안정감을 느끼며 자습할 수 있어, 꾸준함과 몰입도를 높입니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">두 가지 실기 준비 원칙</div>
              <div class="item_content">
                <p class="sub_title">두 가지 무기를 동시에 준비하는 전략적 훈련</p>
                <p class="desc">
                  이드 학원은 학생 1인당 두 가지 실기를 반드시 준비하는 것을 원칙으로 합니다.<br/>
                  다양한 실기 능력을 함께 개발하여 시험에서의 선택 폭을 넓히고,<br/>
                  변화하는 전형에도 유연하게 대응할 수 있도록 합니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">정규 수업</div>
              <div class="item_content">
                <p class="sub_title">하루를 꽉 채우는 집중의 힘</p>
                <p class="desc">
                  단순히 오전반, 오후반으로 나뉘는 짧은 수업이 아닙니다.<br/>
                  하루 전체를 미술에 온전히 집중할 수 있도록 설계된 정규 수업은<br/>
                  깊이 있는 실력 향상과 입시 준비를 위한 최적의 환경을 만들어 줍니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">특강기간 동안 개방 공간</div>
              <div class="item_content">
                <p class="sub_title">닫히지 않는 배움의 문</p>
                <p class="desc">
                  특강 기간에는 학원 공간이 학생들에게 자유롭게 열립니다.<br/>
                  원하는 시간에 와서 집중하고, 자유롭게 작업할 수 있는 환경은<br/>
                  스스로의 페이스를 지키며 성장하고자 하는 학생들에게 큰 자산이 됩니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">포스터 실기 전형 석권</div>
              <div class="item_content">
                <p class="sub_title">포스터 실기의 왕좌를 차지하다</p>
                <p class="desc">
                  이드 학원은 포스터 실기 전형에서 독보적인 성과를 자랑합니다.<br/>
                  체계적인 훈련과 탄탄한 노하우를 바탕으로, 포스터 전형을<br/>
                  준비하는 학생들에게 가장 확실한 선택이 됩니다.
                </p>
              </div>
            </div>
            <div class="item">
              <div class="item_title">CIP 전형 압도적 합격률</div>
              <div class="item_content">
                <p class="sub_title">CIP, 누구도 따라올 수 없는 성과</p>
                <p class="desc">
                  CIP 전형에서 이드 학원은 매년 압도적인 합격률을 기록합니다.<br/>
                  다년간의 데이터 분석과 전형별 맞춤 전략은<br/>
                  CIP 합격을 목표로 하는 학생들에게 최고의 선택지가 됩니다.
                </p>
              </div>
            </div>
          </div>
          <!-- 모바일 아코디언 -->
          <div class="right_col_mobile">
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">상주 전문 강사진</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">늘 곁에서 지켜보는 멘토</p>
                <p class="desc">이드 학원은 언제나 학원에 상주하는 경험 많고 실력 있는 강사진이 함께합니다. 학생들은 필요한 순간마다 즉각적인 피드백과 지도를 받을 수 있어, 혼자 고민하는 시간을 줄이고 빠르게 성장할 수 있습니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">높은 미대 편입 합격률</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">숫자로 증명되는 자신감</p>
                <p class="desc">매년 수많은 합격 사례로 증명된 압도적인 합격률은 이드 학원의 가장 큰 자부심입니다. 단순한 합격을 넘어, 학생들이 원하는 대학과 학과에 진학할 수 있도록 끝까지 책임집니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">맞춤형 시간표</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">나만의 속도를 존중하는 1:1 학습 설계</p>
                <p class="desc">학생마다 목표와 학습 스타일은 다릅니다. 이드 학원은 획일적인 수업이 아닌, 개개인의 상황에 맞춘 맞춤형 시간표를 제공합니다. 이를 통해 학생들은 자신만의 학습 리듬을 유지하며 효율적인 성장을 이끌어냅니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">지정좌석제</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">오직 나만의 자리, 언제나 내 공간</p>
                <p class="desc">이드 학원은 학생 개개인에게 고유의 좌석을 제공합니다. 자신의 책상에서 안정감을 느끼며 자습할 수 있어, 꾸준함과 몰입도를 높입니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">두 가지 실기 준비 원칙</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">두 가지 무기를 동시에 준비하는 전략적 훈련</p>
                <p class="desc">이드 학원은 학생 1인당 두 가지 실기를 반드시 준비하는 것을 원칙으로 합니다. 다양한 실기 능력을 함께 개발하여 시험에서의 선택 폭을 넓히고, 변화하는 전형에도 유연하게 대응할 수 있도록 합니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">정규 수업</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">하루를 꽉 채우는 집중의 힘</p>
                <p class="desc">단순히 오전반, 오후반으로 나뉘는 짧은 수업이 아닙니다. 하루 전체를 미술에 온전히 집중할 수 있도록 설계된 정규 수업은 깊이 있는 실력 향상과 입시 준비를 위한 최적의 환경을 만들어 줍니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">특강기간 동안 개방 공간</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">닫히지 않는 배움의 문</p>
                <p class="desc">특강 기간에는 학원 공간이 학생들에게 자유롭게 열립니다. 원하는 시간에 와서 집중하고, 자유롭게 작업할 수 있는 환경은 스스로의 페이스를 지키며 성장하고자 하는 학생들에게 큰 자산이 됩니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">포스터 실기 전형 석권</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">포스터 실기의 왕좌를 차지하다</p>
                <p class="desc">이드 학원은 포스터 실기 전형에서 독보적인 성과를 자랑합니다. 체계적인 훈련과 탄탄한 노하우를 바탕으로, 포스터 전형을 준비하는 학생들에게 가장 확실한 선택이 됩니다.</p>
              </div>
            </div>
            <div class="accordion_item">
              <div class="accordion_header">
                <span class="accordion_title">CIP 전형 압도적 합격률</span>
                <button class="accordion_btn" aria-expanded="false"><span class="icon"></span></button>
              </div>
              <div class="accordion_content">
                <p class="sub_title">CIP, 누구도 따라올 수 없는 성과</p>
                <p class="desc">CIP 전형에서 이드 학원은 매년 압도적인 합격률을 기록합니다. 다년간의 데이터 분석과 전형별 맞춤 전략은 CIP 합격을 목표로 하는 학생들에게 최고의 선택지가 됩니다.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 탭 2: 이드 공간 안내 -->
      <div class="tab_content" data-tab="2">
        <h2 class="sec_title">
          <span class="avenir">ED's</span>
          <span class="instru">calm</span>
          <span class="avenir">and</span>
        </h2>
        <h2 class="sec_title">
          <span class="instru">creative</span>
          <span class="avenir">space.</span>
        </h2>
        <div class="tab_btns">
          <button class="tab_btn" data-tab="1">이드 소개</button>
          <button class="tab_btn active" data-tab="2">이드 공간 안내</button>
          <button class="tab_btn" data-tab="3">이드 커리큘럼 안내</button>
        </div>
        <div class="space_intro">
          <div class="intro_item left">
            <h3 class="intro_title">미대편입이드는, 학생들이 찾는 공간에서 가르칩니다.</h3>
            <p class="intro_content">
              미대편입이드는 삭막한 학원의 공간이 아닌 학원학생들이 스트레스를 받지 않고 휴식할수 있는 공간으로<br/>
              가족과 같은 분위기 속에서 강의합니다. 입시는 장기전이기 때문에 수강환경이 매우 중요합니다.
            </p>
          </div>
          <div class="intro_item right">
            <h3 class="intro_title">이드 전용 공간 - 다양한 강의실</h3>
            <p class="intro_content">
              이드는 다양한 강의실을 통해 학생 맞춤형 공간을 제공하고자 합니다.<br/>
              실기 강의실 3개,워크샵룸 , 포트폴리오 공간, 상담실로 구성 되어 있으며 학생의 실기, 전형에 맞춰 강의실을 유동적으로 이용할수 있습니다.
            </p>
          </div>
        </div>

        <div class="space_list">
          <div class="space_row">
            <div class="space_info">
              <div class="space_top">
                <span class="space_label">SPACE</span>
                <span class="space_num">01</span>
              </div>
              <div class="space_bottom">
                <h4 class="space_title">실기전용 강의실</h4>
                <p class="space_desc">
                  실기에 맞는 최적의 조명과 함께 미술 실기 전용 공간으로 학생들이 실기에 집중할수 있는 공간입니다.<br/>
                  이곳은 단순한 강의실을 넘어, 잠재된 예술적 영감을 발견하고 실질적인 실력 향상을 이루어내는것을 목표로 합니다.
                </p>
              </div>
            </div>
            <div class="space_images">
              <div class="img_wrap"><img src="asset/images/whoweare/Space01_01.png" alt="실기전용 강의실"></div>
              <div class="img_wrap"><img src="asset/images/whoweare/Space01_02.png" alt="실기전용 강의실"></div>
            </div>
          </div>

          <div class="space_row">
            <div class="space_info">
              <div class="space_top">
                <span class="space_label">SPACE</span>
                <span class="space_num">02</span>
              </div>
              <div class="space_bottom">
                <h4 class="space_title">학생의 편의 고려</h4>
                <p class="space_desc">
                  학생들의 편의를 고려하여 실기 전형에 따라 건식재료 강의실과 습식 재료 강의실을 분리하였습니다.<br/>
                  습식 재료 실기 전형 학생들을 위해 개수대를 설치하였습니다.
                </p>
              </div>
            </div>
            <div class="space_images">
              <div class="img_wrap square"><img src="asset/images/whoweare/Space02_01.png" alt="학생의 편의 고려"></div>
              <div class="img_wrap square"><img src="asset/images/whoweare/Space02_02.png" alt="학생의 편의 고려"></div>
            </div>
          </div>

          <div class="space_row">
            <div class="space_info">
              <div class="space_top">
                <span class="space_label">SPACE</span>
                <span class="space_num">03</span>
              </div>
              <div class="space_bottom">
                <h4 class="space_title">포트폴리오 강의실</h4>
                <p class="space_desc">
                  포트폴리오 강의실은 실기하는 공간에서 함께하는 것이 아닌  독립공간에서 디자인 제작의 효율을 위해 분리하였습니다.
                  노트북 사용을 위해 각 자리에 콘센트를 배치하여 원활한 실기를 돕고자 하였습니다.
                </p>
              </div>
            </div>
            <div class="space_images">
              <div class="img_wrap"><img src="asset/images/whoweare/Space03_01.png" alt="포트폴리오 강의실"></div>
              <div class="img_wrap"><img src="asset/images/whoweare/Space03_02.png" alt="포트폴리오 강의실"></div>
              <div class="img_wrap square"><img src="asset/images/whoweare/Space03_03.png" alt="포트폴리오 강의실"></div>
            </div>
          </div>

          <div class="space_row">
            <div class="space_info">
              <div class="space_top">
                <span class="space_label">SPACE</span>
                <span class="space_num">04</span>
              </div>
              <div class="space_bottom">
                <h4 class="space_title">워크샵 강의실</h4>
                <p class="space_desc">
                  워크샵 강의실은 판서강의를 위한 공간으로 구성하였습니다.<br/>
                  판서강의에 집중할수 있도록 분리하였습니다
                </p>
              </div>
            </div>
            <div class="space_images">
              <div class="img_wrap"><img src="asset/images/whoweare/Space04_01.png" alt="워크샵 강의실"></div>
              <div class="img_wrap square"><img src="asset/images/whoweare/Space04_02.png" alt="워크샵 강의실"></div>
            </div>
          </div>

          <div class="space_row">
            <div class="space_info">
              <div class="space_top">
                <span class="space_label">SPACE</span>
                <span class="space_num">05</span>
              </div>
              <div class="space_bottom">
                <h4 class="space_title">원장실 / 상담실</h4>
                <p class="space_desc">
                  학생들의 실기, 전형 대학 진학에 대한 뿐만 아니라 학생 진로를 위한<br/>
                  상담을 진행할수 있는 프라이빗한 공간으로 구성되어있습니다
                </p>
              </div>
            </div>
            <div class="space_images">
              <div class="img_wrap"><img src="asset/images/whoweare/Space05_01.png" alt="원장실 / 상담실"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- 탭 3: 이드 커리큘럼 안내 -->
      <div class="tab_content" data-tab="3">
        <h2 class="sec_title">
          <span class="avenir">From</span>
          <span class="instru">Basics</span>
          <span class="avenir">to</span>
          <br class="mob_only"/>
          <span class="instru">Success,</span>
        </h2>
        <h2 class="sec_title">
          <span class="instru">Step</span>
          <span class="avenir">by</span>
          <span class="instru">Step.</span>
        </h2>
        <div class="tab_btns">
          <button class="tab_btn" data-tab="1">이드 소개</button>
          <button class="tab_btn" data-tab="2">이드 공간 안내</button>
          <button class="tab_btn active" data-tab="3">이드 커리큘럼 안내</button>
        </div>
        <div class="curriculum_intro">
          <div class="curriculum_item left">
            <h3 class="curriculum_top">ED is DIFFERERNT!</h3>
            <p class="curriculum_mid">
              주요대학만 준비합니다.<br/>
              미대편입이드는, 주요대학외에 준비하지 않습니다.
            </p>
            <p class="curriculum_bot">
              "지방대,대학원,순수회화. 이드의 합격자에는 없습니다."<br/>
              이드의 입시 전략은 디자인 계열의 서울, 수도권 대학만 지도합니다.<br/>
              대량 합격자 양산을 위한 지방대 지원과 누구나 합격할수 있는 대학원 진학 명단은 적어도 이드의 합격자 명단엔 없습니다.
            </p>
            <img src="asset/images/whoweare/tab_03_top.gif" alt="ED is Different" class="curriculum_gif">
          </div>
          <div class="curriculum_item right">
            <h3 class="curriculum_title">이드만의 1:1 티칭</h3>
            <p class="curriculum_content">
              미대 편입은 학생 개개인의 맞춤형 목표가 매우 중요합니다.<br/>
              이드는 학생 한명 한명 개개인에 맞는 커리큘럼과 일정을 통해 편입을 준비합니다.
            </p>
            <div class="curriculum_news">
              <?php
              $news_count = 0;
              if($news_result && mysql_num_rows($news_result) > 0) {
                while($news = mysql_fetch_array($news_result)) {
                  $thumb_img = $news['bimg'] ? $_url . 'thumb/mainnews/' . $news['bimg'] : 'asset/images/whoweare/News_0'.($news_count+1).'.png';
              ?>
              <div class="news_item">
                <a href="news_detail.php?bno=<?=$news['bno']?>">
                  <img src="<?=$thumb_img?>" alt="<?=htmlspecialchars($news['btitle'])?>">
                </a>
              </div>
              <?php
                  $news_count++;
                }
              }
              // DB에 데이터가 없거나 4개 미만일 경우 기본 이미지로 채움
              for($i = $news_count; $i < 4; $i++) {
              ?>
              <div class="news_item"><img src="asset/images/whoweare/News_0<?=($i+1)?>.png" alt="뉴스"></div>
              <?php } ?>
            </div>
          </div>
        </div>
        <h3 class="core_value_title">ED's CORE VALUE</h3>
        <div class="core_value_list">
          <div class="core_value_col">
            <div class="core_value_item">
              <div class="item_header">
                <span class="item_num">01</span>
                <span class="item_title">정보력</span>
                <span class="item_toggle"></span>
              </div>
              <div class="item_body">
                <p>급변하는 편입 상황에 발 빠르게 대응합니다.<br/>전임원장이 혼자 연구하는것이 아닌 강사들과 함께 연구해나가 결과로 입증합니다.</p>
              </div>
            </div>
            <div class="core_value_item">
              <div class="item_header">
                <span class="item_num">04</span>
                <span class="item_title">1인 2실기 커리 큘럼</span>
                <span class="item_toggle"></span>
              </div>
              <div class="item_body">
                <p>편입 시험은 여러대학을 많이 볼수록 합격의 기회는 높아집니다.<br/>실기 종류의 다양한 준비를 통해 해결할수 있습니다.<br/>일러스트,포스터+연필정밀묘사 렌더링+연필정밀묘사, 일러스트/포스터+ci 로고, 각 대학의 다양한 편입실기시험---이드의 1인 2실기로 해결</p>
              </div>
            </div>
          </div>
          <div class="core_value_col">
            <div class="core_value_item">
              <div class="item_header">
                <span class="item_num">02</span>
                <span class="item_title">철저한 수업과 향상</span>
                <span class="item_toggle"></span>
              </div>
              <div class="item_body">
                <p>철저한 정규시간과, 철저한 정원으로 최적의 수업환경을 조성합니다.</p>
              </div>
            </div>
            <div class="core_value_item">
              <div class="item_header">
                <span class="item_num">05</span>
                <span class="item_title">개인별 커리큘럼</span>
                <span class="item_toggle"></span>
              </div>
              <div class="item_body">
                <p>편입시험은 여러대학을 많이 볼수록 스케줄 관리가 매우 중요해집니다.<br/>획일화된 스케줄 관리가 아닌, 실기에 맞는 일정과, 본인이 부족한 실기를 반영하여 학생별로 다른 시간표를 계획해 줍니다.</p>
              </div>
            </div>
          </div>
          <div class="core_value_col">
            <div class="core_value_item">
              <div class="item_header">
                <span class="item_num">03</span>
                <span class="item_title">편입전문학원</span>
                <span class="item_toggle"></span>
              </div>
              <div class="item_body">
                <p>미대 편입 이드는 학점 은행제나, 공모전, 대학원 까지 여러 분야를 분산시켜 다루는 것이 아닌, '미대 편입' 만 전문적으로 집중하여 가르칩니다.</p>
              </div>
            </div>
            <div class="core_value_item">
              <div class="item_header">
                <span class="item_num">06</span>
                <span class="item_title">실전 합격 데이터 기반 피드백</span>
                <span class="item_toggle"></span>
              </div>
              <div class="item_body">
                <p>실제 합격 데이터를 만든 강사진이 직접 지도합니다.<br/>최신 경향을 반영한 실기 전략과 현장형 피드백, 그 둘의 균형이 이드의 경쟁력입니다.<br/>이드는 감각이 아닌 '체계'로 결과를 만듭니다</p>
              </div>
            </div>
          </div>
        </div>
        <h3 class="transfer_title">미대 편입 방법</h3>
        <div class="transfer_list">
          <div class="transfer_step">
            <div class="step_header">
              <span class="step_num">STEP 01</span>
              <span class="step_title">편입 전형 선택</span>
            </div>
            <div class="step_body">
              <p>편입을 고려하고 계신다면, 먼저 본인에게 가장 적합한 전형(일반편입/학사편입)을 신중하게 선택해 주세요.<br class="show"/> 현재 대학에 재학 중이시라면 일반편입이 적절하며, 이미 졸업했거나 자퇴하신 경우라면 학점은행제를 활용하는 학사편입이 더 유리할 수 있습니다.</p>
              <div class="step_tags">
                <span class="tag">일반편입</span>
                <span class="tag">학사편입</span>
              </div>
            </div>
          </div>
          <div class="transfer_step">
            <div class="step_header">
              <span class="step_num">STEP 02</span>
              <span class="step_title">실기 전형 선택</span>
            </div>
            <div class="step_body">
              <p>편입 준비 방향을 잡는 것이 중요합니다.<br class="show"/> 실기, 포트폴리오, 영어 중 어떤 과정을 중심으로 준비하실지 선택해 주세요.<br class="show"/> 어느 것이 정답이라고 할 수는 없습니다.<br class="show"/> 고객님의 목표와 계획을 가장 잘 실현할 수 있는 방향이 무엇인지 함께 고민해 보는 것이 중요합니다.</p>
              <div class="step_tags">
                <span class="tag">공인영어</span>
                <span class="tag">전공실기</span>
                <span class="tag">면접 포트폴리오</span>
              </div>
            </div>
          </div>
          <div class="transfer_step">
            <div class="step_header">
              <span class="step_num">STEP 03</span>
              <span class="step_title">편입 전략 설계</span>
            </div>
            <div class="step_body">
              <p>혹시 성적이 낮거나 영어 점수가 없으신 경우라면, 우선적으로 실기 유형을 준비하시는 것이 상대적으로 유리할 수 있습니다. 입시 미술 경험이 없더라도 충분히 가능하니 너무 걱정하지 마세요. 편입 실기는 생각보다 어렵지 않습니다. 영어는 선택적으로 준비할 수 있는 과목입니다. 미대 편입은 실기 중심으로 진행되기 때문에 영어 점수가 없어도 합격에는 지장이 없습니다. 다만 일부 학교에서는 영어가 반영되거나 실기와 함께 준비하면 유리한 경우도 있으므로, 본인에게 필요한 과정을 상담을 통해 정확히 확인하고 계획을 세우시기를 권장드립니다.</p>
              <div class="step_tags">
                <span class="tag">목표대학 전공 설정</span>
                <span class="tag">개인별 전형 설정</span>
                <span class="tag">개인별 맞춤학습</span>
              </div>
            </div>
          </div>
        </div>
        <div class="info_section">
          <div class="info_col left">
            <h3 class="info_title">수강 시간 및 등록 안내</h3>
            <div class="info_boxes">
              <div class="info_box">
                <span class="box_top">월~금 정규수업</span>
                <span class="box_bottom">오후 6시 ~ 오후 10시</span>
              </div>
              <div class="info_box_outline">
                <p>학생 개별 스케줄과 전형 유형에 따라 맞춤형 실기 수업이 진행<br/>됩니다. 또한, 전체 학생을 대상으로 하는 공통 커리큘럼 수업도 함께 운영되어<br/>각자의 진도와 목표에 맞는 균형 잡힌 학습이 가능합니다.<br/>개인별 진도 관리와 전형별 실기 준비가 동시에 이루어지는 시스템입니다.</p>
              </div>
            </div>
          </div>
          <div class="info_col right">
            <h3 class="info_title">수강 시간 및 등록 안내</h3>
            <div class="info_boxes">
              <div class="info_box">
                <span class="box_top">학원비 (1개월 기준)</span>
                <span class="box_bottom"><del>820,000원</del> 680,000원</span>
              </div>
              <div class="info_box_outline">
                <p>선착순 할인 예약 등록 가격입니다.<br/>선착순 마감 후에는 가격이 순차적으로 인상되며,<br/>할인가로 등록하신 분들은 1년간 동일한 가격이 유지됩니다.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php include 'includes/footer.php'; ?>
<script src="js/whoweare.js"></script>
