  <footer id="footer">
    <div class="floating_btn">
      <p>COntact</p>
      <p class="flex_row">
        <span>
          US
        </span>
        <span class="arrow">→→</span>
      </p>
    </div>
    <div class="footer_inner">
      <ul class="footer_info_list">
        <li class="by_ed">
          <div class="cont">
            <div class="title_area">
              <span>
                CREATIVE JOURNEY, BY ED
              </span>
              <span>
                +
              </span>
            </div>
            <div class="cont_area">
              <div class="company">
                미대편입이드 With Us
              </div>
              <div class="doing">
                시각 | 영상 | 산업 | 공예
              </div>
              <div class="director">
                ED Illustration Design academy director JAEGYU PARK
              </div>
              <div class="copy">
                COPYRIGHT 2025 ED ILLUST ACADEMY. ALL RIGHTS RESERVED.
              </div>
            </div>
          </div>
        </li>
        <li class="contact">
          <div class="cont">
            <div class="title_area">
              <span>
                Contact Info
              </span>
              <span>
                +
              </span>
            </div>
            <div class="cont_area">
              <div class="time">
                <div class="work">
                  <b>운영 시간</b> 09:00 AM - 10:00 PM
                </div>
                <div class="night">
                  <b>저녁 시간</b> 05:00 PM - 06:00 PM
                </div>
              </div>
              <div class="call_mail">
                <div class="call">
                  <b>T</b> +82 10 6225 9197
                </div>
                <div class="mail">
                  <b>E</b> sanha10172@gmail.com
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="location">
          <div class="cont">
            <div class="title_area">
              <span>
                Location info
              </span>
              <span>
                +
              </span>
            </div>
            <div class="cont_area">
              <div class="left_cont">
                <div class="aca_name">
                  건대이드 본원
                </div>
                <div class="tel">
                  +82 02 464 9197
                </div>
                <div class="adr">
                  서울시 광진구 천호대로 512 군자빌딩 4층
                </div>
                <div class="adr_en">
                  4F, Gunja Building, 512 Cheonho-daero, <br/>
                  Gwangjin-gu, Seoul
                </div>
              </div>
              <div class="right_cont">
                <div class="aca_name">
                  홍대이드
                </div>
                <div class="tel">
                  +82 02 336 9543
                </div>
                <div class="adr">
                  서울시 마포구 와우산로 107-1 은혜빌딩2층
                </div>
                <div class="adr_en">
                  2F, Eunhye Building, 107-1 Wausan-ro, <br/>
                  Mapo-gu, Seoul
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="follow">
          <div class="cont">
            <div class="title_area">
              <span>FOLLOW US</span>
              <span>+</span>
            </div>
            <div class="cont_area">
              <ul class="sns_list">
                <li class="youtube">
                  <a href="https://www.youtube.com/@user-drawing" target="_blank">Youtube →</a>
                </li>
                <li class="insta">
                  <a href="https://www.instagram.com/archive_ed_illust" target="_blank">
                    Instagram →
                  </a>
                </li>
                <li class="blog_01">
                  <a href="https://blog.naver.com/sunsook1006" target="_blank">
                    Blog #1 →
                  </a>
                </li>
                <li class="blog_02">
                  <a href="https://blog.naver.com/sunsook1006" target="_blank">
                    Blog #2→
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </footer>

  <script>
    (function (d) {
      var config = {
        kitId: 'ebu3zus',
        scriptTimeout: 3000,
        async: true,
      },
        h = d.documentElement,
        t = setTimeout(function () {
          h.className =
            h.className.replace(/\bwf-loading\b/g, '') + ' wf-inactive';
        }, config.scriptTimeout),
        tk = d.createElement('script'),
        f = false,
        s = d.getElementsByTagName('script')[0],
        a;
      h.className += ' wf-loading';
      tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
      tk.async = true;
      tk.onload = tk.onreadystatechange = function () {
        a = this.readyState;
        if (f || (a && a != 'complete' && a != 'loaded')) return;
        f = true;
        clearTimeout(t);
        try {
          Typekit.load(config);
        } catch (e) { }
      };
      s.parentNode.insertBefore(tk, s);
    })(document);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
  <script src="js/animations.js"></script>
  <script src="js/script.js"></script>
  <?php if (!isset($isSubPage) || !$isSubPage): ?>
  <script src="./js/main.js"></script>
  <?php endif; ?>
</body>

</html>
