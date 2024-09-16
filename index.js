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

//ANIMAÇÃO

document.addEventListener("DOMContentLoaded", function() {
  const hiddenElements = document.querySelectorAll('.hidden');

  const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              entry.target.classList.add('show');
              observer.unobserve(entry.target); // Evitar animação repetida
          }
      });
  }, {
      threshold: 0.15
  });

  hiddenElements.forEach(el => observer.observe(el));
});
