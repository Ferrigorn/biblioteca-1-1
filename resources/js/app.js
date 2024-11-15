import './bootstrap';

// resources/js/app.js

// Importaciones de Slick Carousel
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import $ from 'jquery';
import 'slick-carousel';


import '../css/app.css';

// Configuració de Slick Carousel
$(function() {
    $('.slick-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        centerMode: true,
        centerPadding: '0px',
        prevArrow: $('.slick-prev'), // Selector de la fletxa "previous"
        nextArrow: $('.slick-next'), // Selector de la fletxa "next"
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false
                }
            }
        ]
    });
});
