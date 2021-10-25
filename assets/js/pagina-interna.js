const postCarouselOpt = {
    items: 1,
    centered: true,
    margin: 20,
    nav: false,

    responsive: {
        876: {
            items: 2,
        }
    }
}


$(window).on('resize', function() {
    if($(window).width() >= 992){
        $('.related-posts-container').owlCarousel('destroy');
    } else{
        $('.related-posts-container').owlCarousel(postCarouselOpt);
    }
})
