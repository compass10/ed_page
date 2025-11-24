/**
 * InView - 요소가 화면에 보일 때 콜백 실행
 *
 * 사용법:
 * inView('.selector', (el) => {
 *   // 요소가 보일 때 실행할 코드
 * }, { once: true }); // once: true면 한번만, false면 보일 때마다 실행
 */

function inView(selector, callback, options = {}) {
  const defaults = {
    once: true,           // true: 한번만 실행, false: 보일 때마다 실행
    threshold: 0.1,       // 요소가 얼마나 보여야 실행할지 (0~1)
    rootMargin: '0px'     // 뷰포트 마진
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
