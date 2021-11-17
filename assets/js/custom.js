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
        }
    });
    
}
