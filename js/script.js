const titleArea = document.querySelectorAll('.title_area');
const footer = document.querySelector('#footer');
const menuBtn = document.querySelector('#header .menu')
const sideMenu = document.querySelector('.side_menu');
const sideClose = document.querySelector('.side_menu .top_area .right')
const header = document.querySelector('#header');
titleArea.forEach(item => {
  item.addEventListener('click', ()=> {
    console.log('ddd')
    console.log(footer.classList.contains('show_content'))
    if(footer.classList.contains('show_content')){
      footer.classList.remove('show_content'); 
    }else{
      footer.classList.add('show_content');
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
