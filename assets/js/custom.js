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

    $.post(blog.ajaxurl, data, function(response) {
        if($.trim(response) != '') {
            $('#latest-posts .content').append(response);
            page++;
        } else {
            $('.loadmore').hide();
        }
    });
}
