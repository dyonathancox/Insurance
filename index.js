document.addEventListener("DOMContentLoaded", function() {
    const scrollLeftBtn = document.querySelector(".scroll-left");
    const scrollRightBtn = document.querySelector(".scroll-right");
    const segurosList = document.querySelector(".seguros ul");

    scrollLeftBtn.addEventListener("click", function() {
        segurosList.scrollLeft -= 260;
    });

    scrollRightBtn.addEventListener("click", function() {
        segurosList.scrollLeft += 260;
    });
});

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