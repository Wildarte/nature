let previousScroll = 0;
$(window).scroll(function(event) {
    const scroll = $(this).scrollTop();
    if(scroll > previousScroll && scroll > 80) {
        $('nav .desktop').addClass('compact')
    } else {
        $('nav .desktop').removeClass('compact')
    }
    previousScroll = scroll;
});



document.addEventListener('DOMContentLoaded', function() {
    const menuToggler = document.querySelectorAll('.menu-toggler').forEach(toggler => {
        toggler.addEventListener('click', toggleMenu);
    });


    if($('#products').length > 0) {
        $(document).on('scroll', function() {
            $('#products').stickr({
                offsetTop: $('nav').height() - 55,
                offsetBottom: -357,
                duration: 0
            });
        });
    }

})

$('#latest-posts .tab h4').on('click', function() {
    filterPosts(this)
})
$('.strip .close').on('click', function() {
    $('.strip').slideUp(50);

    $('body').removeClass('topbar-open');
})



function toggleMenu() {
    const html = document.querySelector('html');
    const mobileMenu = document.querySelector('nav .mobile');
    const menuSidebar = document.querySelector('nav .mobile .sidebar');

    if(mobileMenu.classList.contains('opened')) {
        mobileMenu.classList.remove('opened');
        html.classList.remove('noscroll');

        setTimeout(() => {
            menuSidebar.classList.add('closed');
        }, 150);


    } else {
        menuSidebar.classList.remove('closed');

        setTimeout(() => {
            mobileMenu.classList.add('opened');
            html.classList.add('noscroll');
        }, 10);
    }
}

function refreshCarousel(carousel, options) {
    $(carousel).trigger('destroy.owl.carousel');
    $(carousel).find('.owl-stage-outer').children().unwrap();
    $(carousel).removeClass("owl-center owl-loaded owl-text-select-on");
    $(carousel).owlCarousel(options);
}

function filterPosts(el) {
    const categoria = $(el).attr('data-categoria');
    $('#latest-posts .tab h4').removeClass('active');
    $(el).addClass('active');

    $('#latest-posts .content .latest-posts-item').css('opacity', '0');

    setTimeout(() => {
        $('#latest-posts .content .latest-posts-item').removeClass('last-item')
        $('#latest-posts .content .latest-posts-item').addClass('hidden');
        $('#latest-posts .content .latest-posts-item').css('opacity', '1');

        $(`[data-categoria=${categoria}]`).last().addClass('last-item');
        $(`[data-categoria=${categoria}]`).removeClass('hidden');
    }, 150); // duração do transition no css
}




$('.search-form input').on('input', function() {
    if($(this).val().length > 0) $('.search-form').addClass('not-empty')
    else $('.search-form').removeClass('not-empty')
});
