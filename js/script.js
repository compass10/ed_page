const titleArea = document.querySelectorAll('.title_area');
const footer = document.querySelector('#footer');
const menuBtn = document.querySelector('#header .menu')
const sideMenu = document.querySelector('.side_menu');
const sideClose = document.querySelector('.side_menu .top_area .right')
const header = document.querySelector('#header');

// 모바일 체크 함수
function isMobile() {
  return window.innerWidth <= 1024;
}

titleArea.forEach(item => {
  item.addEventListener('click', ()=> {
    if (isMobile()) {
      // 모바일: 개별 아코디언 토글
      const parentLi = item.closest('li');
      const footerInfoList = document.querySelector('.footer_info_list');

      if (parentLi) {
        // by_ed 클릭 시 다른 메뉴들도 보이게
        if (parentLi.classList.contains('by_ed')) {
          footer.classList.toggle('menu_open');
        }
        parentLi.classList.toggle('accordion_open');
      }
    } else {
      // PC: 전체 푸터 토글
      if(footer.classList.contains('show_content')){
        footer.classList.remove('show_content');
      }else{
        footer.classList.add('show_content');
      }
    }
  })
})

menuBtn.addEventListener('click', ()=> {
  sideMenu.classList.add('open');
})
sideClose.addEventListener('click', ()=> {
  sideMenu.classList.remove('open');
})

window.addEventListener('wheel', (e)=> {

  if(e.deltaY > 0){
    header.classList.remove('down');
  }else{
    header.classList.add('down');

  }


})
