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
    segurosList.scrollBy({ left: 1, behavior: 'smooth' }); // Rolagem contínua suave

    // Verifica se chegou ao final
    if (segurosList.scrollLeft >= (segurosList.scrollWidth - segurosList.clientWidth)) {
      segurosList.scrollLeft = 0; // Volta imediatamente para o início
    }
  }

  requestAnimationFrame(scrollList); // Continua o loop de rolagem
}

// Inicia o loop
requestAnimationFrame(scrollList);
