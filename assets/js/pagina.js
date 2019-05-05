//Instancia de la clase Swiper y configuración respectiva
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3, //Slides por vista total = 3
    spaceBetween: 30, 
    slidesPerGroup: 3,
    loop: true,
    loopFillGroupWithBlank: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

});

//Manejo de eventos de swiper 

//Cuando hago click 
swiper.on('click', function () {
    console.log('Estoy haciendo Click');
});
//Cuando hago swipe sobre un slide del carrusen  
swiper.on('slideChange', function () {
    console.log('estoy haciendo slide');
});
