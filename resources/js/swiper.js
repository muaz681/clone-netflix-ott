// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/css';
import Swiper from './swiper.min.js'

const swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    grabCursor: 'true',
    centeredSlides: 'true',
    slidesPerView: 'auto',
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    pagination: {
        el: '.swiper-pagination',
    },
});