$(function() {

    f_navBar();
    f_tablehead_desc_anchor();
    f_nondata_tablebody();
    f_topReturnBtn();


    function f_navBar() {
        $('.navbar-collapse').find('a').each(function(){
          var a_Href = $(this).attr('href');
          var url_Path = location.pathname;
          if ( a_Href == url_Path ) {
            $(this).addClass('disabled')
                    .attr('tabindex', '-1')
                    .attr('aria-disabled', 'true');
          }
        });
      }


    function f_tablehead_desc_anchor() {

        var url_get_param = location.search;
        if (url_get_param == "?date_desc=true") {
            $('.good_desc_anchor').css('background-color', '#e0d8d8');
            $('.good_desc_anchor').find('a').css('color', '#aaaaaa');
        }
        if (url_get_param == "?good_desc=true") {
            $('.date_desc_anchor').css('background-color', '#e0d8d8');
            $('.date_desc_anchor').find('a').css('color', '#aaaaaa');
            $('.good_desc_anchor').css('background-color', '');
            $('.good_desc_anchor').find('a').removeAttr('style');
        }

    }


    function f_nondata_tablebody() {
        if($('.nondata_tbody').length == true && $('.nondata_tbody').find('tr').length == false) {
            $('.nondata_tbody').append('<tr><td class="align-middle bg-white" colspan="5" style="font-size: 15px;"><div class="h2 my-5 text-dark"><b>データがありません。</b></div></td></tr>');
        }
    }


    function f_topReturnBtn() {
        const topReturnBtn = $('#topReturnBtn');
        topReturnBtn.hide();

        /* scroll */
        $(window).scroll(function() {
            if($(this).scrollTop() > 50) {
                topReturnBtn.fadeIn();
            } else {
                topReturnBtn.fadeOut();
            }
        })

        /* click */
        topReturnBtn.on('click', function() {
            $('body,html').animate({ scrollTop: 0 }, 100);
            return false;   
        })
    }


});