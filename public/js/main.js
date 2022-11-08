$(function() {

    // f_test_alert();
    f_nondata_tablebody();

    // function f_test_alert() {
    //     alert('HELLO!!!');
    // }

    function f_nondata_tablebody() {
        if($('.nondata_tbody').length == true && $('.nondata_tbody').find('tr').length == false) {
            $('.nondata_tbody').append('<tr><td class="align-middle bg-white" colspan="5" style="font-size: 15px;"><div class="h2 my-5 text-dark"><b>データがありません。</b></div></td></tr>');
        }
    }


});