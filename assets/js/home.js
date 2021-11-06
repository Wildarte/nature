const homeCarouselOpt = {
    items: 1,
    centered: true,
    margin: 40,
    nav: false,

    responsive: {
        840: {
            margin: 100
        },
        992: {
            navContainer: $('.item-head .navigation'),
            navText: [$('.carousel-pagination .prev'), $('.carousel-pagination .next')],
            margin: 150
        }
    }
}
$('.news-carousel .carousel-wrapper').owlCarousel(homeCarouselOpt);

window.addEventListener('resize', function() {
    refreshCarousel($('.news-carousel .carousel-wrapper'), homeCarouselOpt)
});



