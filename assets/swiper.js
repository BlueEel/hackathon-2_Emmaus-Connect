import Swiper from 'swiper/bundle';
import 'swiper/css/bundle'
import './styles/swiper.scss'

window.Swiper = Swiper;

const swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 15,
    freeMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
