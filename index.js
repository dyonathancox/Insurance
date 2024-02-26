document.addEventListener("DOMContentLoaded", function() {
    const scrollLeftBtn = document.querySelector(".scroll-left");
    const scrollRightBtn = document.querySelector(".scroll-right");
    const segurosList = document.querySelector(".seguros ul");

    scrollLeftBtn.addEventListener("click", function() {
        segurosList.scrollLeft -= 600;
    });

    scrollRightBtn.addEventListener("click", function() {
        segurosList.scrollLeft += 600;
    });
});
