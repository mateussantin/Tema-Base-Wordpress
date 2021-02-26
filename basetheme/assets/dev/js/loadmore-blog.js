$(document).ready(function(){
    // LOAD MORE BLOG
    //--------------------------------------
    $(".load-more-btn").on("click",function(){
        load_posts_blog();
    });

    var ppp = 9; //quantidade de posts que carrega
    var pageNumber = 1;

    function load_posts_blog(){
        pageNumber++;
        var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_blog_ajax';
        var button = $('.load-more-btn');
        var navContainer = $('.list-blog');
        var urlAjax = window.location.origin + '/wp-admin/admin-ajax.php';

        $.ajax({
            type: "POST",
            dataType: "html",
            url: urlAjax,
            data: str,
            beforeSend: function () {
				button.text('Aguarde...');
			},
            success: function(data){
                var $data = $(data);
                if($data.length){
                    navContainer.append($data);
                    button.attr("disabled",false);
                    button.text('Carregar Mais');
                } else{
                    navContainer.append('<div class="msg-box is-info">Não há mais postagens para carregar!</div>');
                    button.remove();
                }
            },
            error : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
        return false;
    }
});
