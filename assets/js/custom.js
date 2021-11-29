//append ajax
var page = 2;
function more_post(type, val = ""){
    var data = {
        'action': 'load_posts_by_ajax',
        'page': page,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    };

    $('#text-button-load').hide();
    $('.c-loader').show();

    $.post(blog.ajaxurl, data, function(response) {
        if($.trim(response) != '') {
            $('#latest-posts .content').append(response);
            page++;
        } else {
            $('.loadmore').hide();
        }
        $('#text-button-load').show();
        $('.c-loader').hide();
    });


    page2 = page + 1
    var data2 = {
        'action': 'load_posts_by_ajax',
        'page': page2,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    }
    $.post(blog.ajaxurl, data2, function(response) {
        if($.trim(response) == '') {
            $('.loadmore').hide();
        }
    });
}

function more_post2(type, val = "", msg_btn = ""){
    var data = {
        'action': 'load_posts_by_ajax',
        'page': page,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    };
    
    $('#text-button-load').hide();
    $('.c-loader').show();

    $.post(blog.ajaxurl, data, function(response) {
        if($.trim(response) != '') {
            $('#latest-posts .content').append(response);
            page++;
        } else {
            $('.loadmore').text(msg_btn);
            $('.loadmore').removeClass("see-more");
            $('.loadmore').addClass("latest-posts-notpost");
        }
        $('#text-button-load').show();
        $('.c-loader').hide();
    });

    //busca novamente por posts, para adiantar se deve ocultar ou trocar texto do botao de carregamento de posts
    page2 = page + 1
    var data2 = {
        'action': 'load_posts_by_ajax',
        'page': page2,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    }
    $.post(blog.ajaxurl, data2, function(response) {
        if($.trim(response) == '') {
            $('.loadmore').text(msg_btn);
            $('.loadmore').removeClass("see-more");
            $('.loadmore').addClass("latest-posts-notpost");
        }
    });
    
}




//function for get posts for mobile
var pageMobile = 0;
function more_post_mobile(type, val = "", catPage){
    console.log("valor da variavel pageMobile: "+pageMobile);
    var data = {
        'action': 'load_posts_by_ajax',
        'page': catPage,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    };

    $('#text-button-load').hide();
    $('.c-loader').show();

    $.post(blog.ajaxurl, data, function(response) {
        if($.trim(response) != '') {
            $('#latest-posts .content').append(response);
            pageMobile++;
        } else {
            //$('.loadmore').hide();
        }
        $('#text-button-load').show();
        $('.c-loader').hide();
    });

/*
    pageMobile2 = pageMobile + 1
    var data2 = {
        'action': 'load_posts_by_ajax',
        'page': pageMobile2,
        'security': blog.security,
        'type' : type,
        'category' : val,
        'search' : val
    }
    $.post(blog.ajaxurl, data2, function(response) {
        if($.trim(response) == '') {
            //s$('.loadmore').hide();
        }
    });
    */
}

/*
if( $(window).width() < 980){
    console.log("menor");
    document.querySelector("#latest-posts .content").innerHTML = "";
    more_post_mobile('category', 'carta-ao-homem');
    filterPosts('#latest-posts .tab h4[data-categoria="carta-ao-homem"]', 'more_post_mobile("category", "carta-ao-homem")');
}else{
    console.log("maior");
}
*/

