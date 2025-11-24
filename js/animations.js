/**
 * Animations - 다양한 애니메이션 유틸리티 모음
 */

/**
 * InView - 요소가 화면에 보일 때 콜백 실행
 *
 * 사용법:
 * inView('.selector', (el) => {
 *   // 요소가 보일 때 실행할 코드
 * }, { once: true });
 */
function inView(selector, callback, options = {}) {
  const defaults = {
    once: true,
    threshold: 0.1,
    rootMargin: '0px'
  };

  const settings = { ...defaults, ...options };
  const elements = document.querySelectorAll(selector);

  if (elements.length === 0) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        callback(entry.target);

        if (settings.once) {
          observer.unobserve(entry.target);
        }
      }
    });
  }, {
    threshold: settings.threshold,
    rootMargin: settings.rootMargin
  });

  elements.forEach(el => observer.observe(el));

  return observer;
}

/**
 * CountUp - 숫자 카운트 애니메이션
 *
 * 사용법:
 * <div data-count="100" data-duration="2000">
 *   <span>0</span>
 * </div>
 *
 * countUp('.counter'); // 화면에 보일 때 자동 실행
 * countUp('.counter', { duration: 1500 }); // 기본 duration 설정
 */
function countUp(selector, options = {}) {
  const defaults = {
    duration: 2000,       // 기본 애니메이션 시간 (ms)
    once: true,           // 한번만 실행
    threshold: 0.3,       // 요소가 30% 보일 때 시작
    easing: 'easeOutQuad' // 이징 함수
  };

  const settings = { ...defaults, ...options };

  // 이징 함수들
  const easings = {
    linear: t => t,
    easeOutQuad: t => t * (2 - t),
    easeOutCubic: t => (--t) * t * t + 1,
    easeInOutQuad: t => t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t
  };

  const animate = (el) => {
    const target = parseInt(el.dataset.count, 10) || 0;
    const duration = parseInt(el.dataset.duration, 10) || settings.duration;
    const span = el.querySelector('span');

    if (!span) return;

    const start = performance.now();
    const easing = easings[settings.easing] || easings.easeOutQuad;

    const update = (currentTime) => {
      const elapsed = currentTime - start;
      const progress = Math.min(elapsed / duration, 1);
      const easedProgress = easing(progress);
      const current = Math.floor(easedProgress * target);

      span.textContent = current.toLocaleString();

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        span.textContent = target.toLocaleString();
      }
    };

    requestAnimationFrame(update);
  };

  inView(selector, animate, {
    once: settings.once,
    threshold: settings.threshold
  });
}
