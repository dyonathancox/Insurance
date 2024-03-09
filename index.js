function menuShow() {
    let menuMobile = document.querySelector('.mobile-menu');
    if(menuMobile.classList.contains('open')){
        menuMobile.classList.remove('open')
        document.querySelector('.icon').src = "assets/menu.png";
    }else{
        menuMobile.classList.add('open');
        document.querySelector('.icon').src = "assets/close.png";
    }
}

const segurosList = document.getElementById('seguros-list');
let isHovered = false;

segurosList.addEventListener('mouseenter', () => {
  isHovered = true;
});

segurosList.addEventListener('mouseleave', () => {
  isHovered = false;
});

function scrollList() {
  if (!isHovered) {
    segurosList.scrollLeft += 600; // Incremento da rolagem (ajuste conforme necessário)
    if (segurosList.scrollLeft >= (segurosList.scrollWidth - segurosList.clientWidth)) {
      segurosList.scrollTo({ left: 0, behavior: 'smooth' }); // Volta para o início de forma suave
    }
  }
}

setInterval(scrollList, 28); // Intervalo de rolagem (ajuste conforme necessário)
