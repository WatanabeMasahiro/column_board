$(function() {

    f_navBar();
    f_search_form_submit();
    f_tablehead_desc_anchor();
    f_formGet_descAnchor();
    f_postDetail_anchor();
    f_nondata_tablebody();
    f_topReturnBtn();
    f_faEye_toggleSlash();
    f_faEye_toggleSlash_addConfirm();
    f_commentBtn_confirm();
    f_withdrawalBtn_confirm();
    f_deleteBtn_confirm();
    f_deleteBtn_confirm2();
    f_user_login_form()
    f_user_register_form();
    f_flashingWarning();


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


    function f_search_form_submit() {
        $('.search_btn').on('click', function() {
            $('.form_get').submit(function() {
                var search_text_val = $('.search_text').val();
                var trim_parm = $.trim(search_text_val);
                $('.search_text').val(trim_parm);
            })
        })
    }


    function f_tablehead_desc_anchor() {
        /**
         * Get the URL parameter value
         *
         * @param  name {string} パラメータのキー文字列
         * @return  url {url} 対象のURL文字列（任意）
         */
        function getParam(name) {
            var url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        if (getParam('date_desc1') == "true" || getParam('date_desc2') == "true") {
            $('.good_desc_anchor').css('background-color', '#e0d8d8');
            $('.good_desc_anchor').find('a').css('color', '#aaaaaa');
        }
        if (getParam('good_desc1') == "true" || getParam('good_desc2') == "true") {
            $('.date_desc_anchor').css('background-color', '#e0d8d8');
            $('.date_desc_anchor').find('a').css('color', '#aaaaaa');
            $('.good_desc_anchor').css('background-color', '');
            $('.good_desc_anchor').find('a').removeAttr('style');
        }
    }


    function f_formGet_descAnchor() {
        $('.date_desc_anchor').on('click', function() {
            $('.date_desc_input').val('');
            $('.good_desc_input').val('');
            $(this).find('.date_desc_input').val('true');
            $('.form_get').submit();
        })
        $('.good_desc_anchor').on('click', function() {
            $('.date_desc_input').val('');
            $('.good_desc_input').val('');
            $(this).find('.good_desc_input').val('true');
            $('.form_get').submit();
        })
    }


    function f_postDetail_anchor() {
        $('.recordData_content').on('click', function() {
            var article_id = $(this).find('.article_id').text();
            $(this).find('.input_post').attr('value', article_id);
            $(this).find('.form_post').submit();
        })
    }


    function f_nondata_tablebody() {
        if($('.if_nondata_tbody').length == true && $('.if_nondata_tbody').find('tr').length == false) {
            $('.if_nondata_tbody').append('<tr><td class="text-center" style="padding-top: 10.5px;">記事がありません</td></tr>');
        }
        if($('.if_nondata_tbody').find('td').text() == '記事がありません') {
            $('.if_nondata_tbody').closest('table').removeClass('table-hover').css('max-width', '500px').css('margin', '0 auto 16px');
            $('.if_nondata_tbody').closest('table').find('thead').remove();
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


    function f_faEye_toggleSlash() {
        $('#btn-toggle-password').on('click', function() {
            $('.toggle-password').toggleClass("fa-eye-slash").toggleClass("fa-eye");
            if($('.toggle-password').hasClass('fa-eye-slash') == true) {
                $('input[name="password"]').attr('type', 'password');
            }
            if($('.toggle-password').hasClass('fa-eye') == true) {
                $('input[name="password"]').attr('type', 'text');
            }
        });
    }

    function f_faEye_toggleSlash_addConfirm() {
        $('#btn-toggle-pw').on('click', function() {
            $('.toggle-pw').toggleClass("fa-eye-slash").toggleClass("fa-eye");
            if($('.toggle-pw').hasClass('fa-eye-slash') == true) {
                $('input[name="password"]').attr('type', 'password');
            }
            if($('.toggle-pw').hasClass('fa-eye') == true) {
                $('input[name="password"]').attr('type', 'text');
            }
        });

        $('#btn-toggle-pwConfirm').on('click', function() {
            $('.toggle-pwConfirm').toggleClass("fa-eye-slash").toggleClass("fa-eye");
            if($('.toggle-pwConfirm').hasClass('fa-eye-slash') == true) {
                $('input[name="password_confirmation"]').attr('type', 'password');
            }
            if($('.toggle-pwConfirm').hasClass('fa-eye') == true) {
                $('input[name="password_confirmation"]').attr('type', 'text');
            }
        });
    }


    function f_commentBtn_confirm() {
        $('.comment-btn').on('click', function() {
            if (!confirm('コメントを投稿します。\n宜しいですか??')) {
                return false;
            }
        })
    }


    function f_withdrawalBtn_confirm() {
        $('.withdrawalBtn').on('click', ()=> {
            if (!confirm('退会すると、登録している\nすべてのデータが削除されます。')) {
                return false;
            }
            if (!confirm("退会しますか??" )) {
                return false;
            }
        });
    }


    function f_deleteBtn_confirm() {
        $('button[name="delete"]').on('click', ()=> {
            if (!confirm("データを削除しますか??" )) {
                return false;
            }
        });
    }

    function f_deleteBtn_confirm2() {
        if (location.pathname == "/delete_confirm") {
            $('button[name="deleteBtn"]').on('click', function() {
                if (!confirm("データを削除しますか??" )) {
                    return false;
                }
            });
        }
    }


    function f_user_login_form() {
        if (location.pathname == "/login") {
            $('.user_login_btn').on('click', function(e) {
                if( $('input[name="email"]').val()          == false || 
                    $('input[name="password"]').val()       == false
                    ) {
                    e.preventDefault();
                    alert('未入力の項目を入力してください。');
                }
            })
        }
    }


    function f_user_register_form() {
        if (location.pathname == "/register") {
            $('.user_register_btn').on('click', function(e) {
                if( $('input[name="name"]').val()                       == false || 
                        $('input[name="email"]').val()                  == false || 
                        $('input[name="password"]').val()               == false || 
                        $('input[name="password_confirmation"]').val()  == false 
                    ) {
                    e.preventDefault();
                    alert('未入力の項目を入力してください。');
                }
            })
        }
    }


    function f_flashingWarning() {
        var n = 5;
        var intarval;
        intarval = setInterval(function(){
            $('.flashingWarning').fadeOut(1200).fadeIn(1800);
            n--;
            if (n == 0) {
                clearInterval(intarval);
            }
        }, 500)
        setTimeout(function(){
            $('.flashingWarning').animate({opacity:0, height: 0}, 1000);
        }, 10000)
    }


});