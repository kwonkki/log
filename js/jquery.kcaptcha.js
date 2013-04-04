$(function() {
    $('#kcaptcha_image').bind('click', function() {
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $('#kcaptcha_image').attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
            }
        });
    })
    .css('cursor', 'pointer')
    .attr('title', '')
    .attr('width', '120')
    .attr('height', '60')
    .trigger('click');
});

// 출력된 캡챠이미지의 키값과 입력한 키값이 같은지 비교한다.
function check_kcaptcha(input_key)
{
    if (typeof(input_key) != 'undefined') {
        var captcha_result = false;
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_result.php',
            data: {
                'captcha_key': input_key.value 
            },
            cache: false,
            async: false,
            success: function(text) {
                captcha_result = text;
            }
        });

        if (!captcha_result) {
            alert('');
            input_key.select();
            return false;
        }
    }
    return true;
}