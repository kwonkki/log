<?
include_once("./_common.php");
include_once("$g4[path]/lib/mailer.lib.php");

/*
// 081022 : CSRF 에서 토큰 비교는 의미 없음
// 세션에 저장된 토큰과 폼값으로 넘어온 토큰을 비교하여 틀리면 에러
if ($_POST["token"] && get_session("ss_token") == $_POST["token"]) 
{
    // 이전 폼 전송 바로전에 만들어진 쿠키가 없다면 에러
    //if (!get_cookie($_POST["token"])) alert_close("쿠키 에러");

    // 맞으면 세션과 쿠키를 지워 다시 입력폼을 통해서 들어오도록 한다.
    set_session("ss_token", "");
    set_cookie($_POST["token"], 0, 0);
} 
else 
{
    alert_close("토큰 에러");
    exit;
}
*/

// 리퍼러 체크
//referer_check();

if (!($w == "" || $w == "u")) 
    alert("w {$lang[355]}");

if ($w == "u" && $is_admin == "super") {
    if (file_exists("$g4[path]/DEMO")) 
        alert("{$lang[439]}");
}

// 자동등록방지 검사
//include_once ("./norobot_check.inc.php");

$key = get_session("captcha_keystring");
if (!($key && $key == $_POST[wr_key])) {
    session_unregister("captcha_keystring");
    alert("{$lang[388]}");
}

$mb_id = trim(strip_tags(mysql_escape_string($_POST[mb_id])));
$mb_password = trim(mysql_escape_string($_POST[mb_password]));
$mb_name = trim(strip_tags(mysql_escape_string($_POST[mb_name])));
$mb_nick = trim(strip_tags(mysql_escape_string($_POST[mb_nick])));
$mb_email = trim(strip_tags(mysql_escape_string($_POST[mb_email])));

if ($w == '' || $w == 'u') 
{
    if (!$mb_id) alert('{$lang[440]}');
    if ($w == '' && !$mb_password) alert('{$lang[441]}');
    if (!$mb_name) alert('{$lang[442]}');
    if (!$mb_nick) alert('{$lang[443]}');
    if (!$mb_email) alert('{$lang[444]}');

    if (preg_match("/[\,]?{$mb_id}/i", $config[cf_prohibit_id]))
        alert("\'$mb_id\' {$lang[445]}");

    if (preg_match("/[\,]?{$mb_nick}/i", $config[cf_prohibit_id]))
        alert("\'$mb_nick\' {$lang[446]}");

    // 이름은 한글만 가능
    /*
    if (!check_string($mb_name, _G4_HANGUL_)) 
        alert('{$lang[447]}');
    */

    // 별명은 한글, 영문, 숫자만 가능
    if (!check_string($mb_nick, _G4_HANGUL_ + _G4_ALPHABETIC_ + _G4_NUMERIC_))
        alert('{$lang[448]}');

    if ($w=='')
    {
        if (strtolower($mb_id) == strtolower($mb_recommend)) alert('{$lang[449]}');

        $sql = " select count(*) as cnt from $g4[member_table] where mb_nick = '$mb_nick' ";
        $row = sql_fetch($sql);
        if ($row[cnt])
            alert("\'$mb_nick\' {$lang[450]}");

        $sql = " select count(*) as cnt from $g4[member_table] where mb_email = '$mb_email' ";
        $row = sql_fetch($sql);
        if ($row[cnt])
            alert("\'$mb_email\' {$lang[451]}");

        // 주민번호 확인 체크시 가입하고 바로 뒤로가기 하면 동일 주민번호로 다시 가입되는 버그 때문에 (letsgolee 님 09.06.16)
        if ($config[cf_use_jumin]) {
            $row = sql_fetch(" select mb_name from $g4[member_table] where mb_jumin = '$mb_jumin' ");
            if ($row[mb_name]) {
                if ($row[mb_name] == $mb_name)
                    alert("이미 가입되어 있습니다.");
                else
                    alert("다른 이름으로 같은 주민등록번호가 이미 가입되어 있습니다.\\n\\n관리자에게 문의해 주십시오.");
            }
        }
    }
    else
    {
        // 자바스크립트로 정보변경이 가능한 버그 수정
        // 별명수정일이 지나지 않았다면
        if ($member[mb_nick_date] > date("Y-m-d", $g4[server_time] - ($config[cf_nick_modify] * 86400)))
            $mb_nick = $member[mb_nick];
        // 회원정보의 메일을 이전 메일로 옮기고 아래에서 비교함
        $old_email = $member[mb_email];

        $sql = " select count(*) as cnt from $g4[member_table] where mb_nick = '$mb_nick' and mb_id <> '$mb_id' ";
        $row = sql_fetch($sql);
        if ($row[cnt])
            alert("\'$mb_nick\' {$lang[450]}");

        $sql = " select count(*) as cnt from $g4[member_table] where mb_email = '$mb_email' and mb_id <> '$mb_id' ";
        $row = sql_fetch($sql);
        if ($row[cnt])
            alert("\'$mb_email\' {$lang[451]}");
    }
}

$mb_dir = "$g4[path]/data/member/".substr($mb_id,0,2);

// 아이콘 삭제
if ($del_mb_icon)
    @unlink("$mb_dir/$mb_id.gif");

$msg = "";

// 아이콘 업로드
$mb_icon = "";
if (is_uploaded_file($_FILES[mb_icon][tmp_name])) 
{
    if (preg_match("/(\.gif)$/i", $_FILES[mb_icon][name])) 
    {
        // 아이콘 용량이 설정값보다 이하만 업로드 가능
        if ($_FILES[mb_icon][size] <= $config[cf_member_icon_size]) 
        {
            @mkdir($mb_dir, 0707);
            @chmod($mb_dir, 0707);
            $dest_path = "$mb_dir/$mb_id.gif";
            move_uploaded_file($_FILES[mb_icon][tmp_name], $dest_path);
            chmod($dest_path, 0606);
            if (file_exists($dest_path)) 
            {
                //=================================================================\
                // 090714
                // gif 파일에 악성코드를 심어 업로드 하는 경우를 방지
                // 에러메세지는 출력하지 않는다.
                //-----------------------------------------------------------------
                $size = getimagesize($dest_path);
                if ($size[2] != 1) // gif 파일이 아니면 올라간 이미지를 삭제한다.
                    @unlink($dest_path);
                else
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config[cf_member_icon_width] || $size[1] > $config[cf_member_icon_height])
                    @unlink($dest_path);
                //=================================================================\
            }
        }
    }
    else
        $msg .= $_FILES[mb_icon][name] . "{$lang[452]}";
}


// 관리자님 회원정보
$admin = get_admin('super');


if ($w == "") 
{
    $mb = get_member($mb_id);
    if ($mb[mb_id]) 
        alert("{$lang[453]}");

    $sql = " insert into $g4[member_table]
                set mb_id = '$mb_id',
                    mb_password = '".sql_password($mb_password)."',
                    mb_name = '$mb_name',
                    mb_jumin = '$mb_jumin',
                    mb_sex = '$mb_sex',
                    mb_birth = '$mb_birth',
                    mb_nick = '$mb_nick',
                    mb_nick_date = '$g4[time_ymd]',
                    mb_password_q = '$mb_password_q',
                    mb_password_a = '$mb_password_a',
                    mb_email = '$mb_email',
                    mb_homepage = '$mb_homepage',
                    mb_tel = '$mb_tel',
                    mb_hp = '$mb_hp',
                    mb_zip1 = '$mb_zip1',
                    mb_zip2 = '$mb_zip2',
                    mb_addr1 = '$mb_addr1',
                    mb_addr2 = '$mb_addr2',
                    mb_signature = '$mb_signature',
                    mb_profile = '$mb_profile',
                    mb_today_login = '$g4[time_ymdhis]',
                    mb_datetime = '$g4[time_ymdhis]',
                    mb_ip = '$_SERVER[REMOTE_ADDR]',
                    mb_level = '$config[cf_register_level]',
                    mb_recommend = '$mb_recommend',
                    mb_login_ip = '$_SERVER[REMOTE_ADDR]',
                    mb_mailling = '$mb_mailling',
                    mb_sms = '$mb_sms',
                    mb_open = '$mb_open',
                    mb_open_date = '$g4[time_ymd]',
                    mb_1 = '$mb_1',
                    mb_2 = '$mb_2',
                    mb_3 = '$mb_3',
                    mb_4 = '$mb_4',
                    mb_5 = '$mb_5',
                    mb_6 = '$mb_6',
                    mb_7 = '$mb_7',
                    mb_8 = '$mb_8',
                    mb_9 = '$mb_9',
                    mb_10 = '$mb_10' ";
    // 이메일 인증을 사용하지 않는다면 이메일 인증시간을 바로 넣는다
    if (!$config[cf_use_email_certify])
        $sql .= " , mb_email_certify = '$g4[time_ymdhis]' ";
    sql_query($sql);

    // 회원가입 포인트 부여
    insert_point($mb_id, $config[cf_register_point], "{$lang[454]}", '@member', $mb_id, '{$lang[455]}');

    // 추천인에게 포인트 부여
    if ($config[cf_use_recommend] && $mb_recommend)
        insert_point($mb_recommend, $config[cf_recommend_point], "{$mb_id}{$lang[456]}", '@member', $mb_recommend, "{$mb_id} {$lang[55]}");

    // 회원님께 메일 발송
    if ($config[cf_email_mb_member]) 
    {
        $subject = "{$lang[457]}";

        $mb_md5 = md5($mb_id.$mb_email.$g4[time_ymdhis]);
        $certify_href = "$g4[url]/$g4[bbs]/email_certify.php?mb_id=$mb_id&mb_md5=$mb_md5";
        
        ob_start();
        include_once ("./register_form_update_mail1.php");
        $content = ob_get_contents();
        ob_end_clean();
        
        mailer($admin[mb_nick], $admin[mb_email], $mb_email, $subject, $content, 1);
    }

    // 최고관리자님께 메일 발송
    if ($config[cf_email_mb_super_admin]) 
    {
        $subject = $mb_nick . " {$lang[458]}";
        
        ob_start();
        include_once ("./register_form_update_mail2.php");
        $content = ob_get_contents();
        ob_end_clean();

        mailer($mb_nick, $mb_email, $admin[mb_email], $subject, $content, 1);
    }

    // 메일인증 사용하지 않는 경우에만 로그인
    if (!$config[cf_use_email_certify]) 
        set_session("ss_mb_id", $mb_id);

    set_session("ss_mb_reg", $mb_id);
} 
else if ($w == "u") 
{
    if (!trim($_SESSION["ss_mb_id"]))
        alert("{$lang[459]}");

    if ($_SESSION["ss_mb_id"] != $_POST[mb_id])
        alert("{$lang[460]}");

    $sql_password = "";
    if ($mb_password)
        $sql_password = " , mb_password = '".sql_password($mb_password)."' ";

    $sql_icon = "";
    if ($mb_icon)
        $sql_icon = " , mb_icon = '$mb_icon' ";

    $sql_nick_date = "";
    if ($mb_nick_default != $mb_nick)
        $sql_nick_date =  " , mb_nick_date = '$g4[time_ymd]' ";

    $sql_open_date = "";
    if ($mb_open_default != $mb_open)
        $sql_open_date =  " , mb_open_date = '$g4[time_ymd]' ";

    $sql_sex = "";
    if (isset($mb_sex))
        $sql_sex = " , mb_sex = '$mb_sex' ";

    // 이전 메일주소와 수정한 메일주소가 틀리다면 인증을 다시 해야하므로 값을 삭제
    $sql_email_certify = "";
    if ($old_email != $mb_email && $config[cf_use_email_certify])
        $sql_email_certify = " , mb_email_certify = '' ";

                // set mb_name         = '$mb_name', 제거
    $sql = " update $g4[member_table]
                set mb_nick         = '$mb_nick',
                    mb_password_q   = '$mb_password_q',
                    mb_password_a   = '$mb_password_a',
                    mb_mailling     = '$mb_mailling',
                    mb_sms          = '$mb_sms',
                    mb_open         = '$mb_open',
                    mb_email        = '$mb_email',
                    mb_homepage     = '$mb_homepage',
                    mb_tel          = '$mb_tel',
                    mb_hp           = '$mb_hp',
                    mb_zip1         = '$mb_zip1',
                    mb_zip2         = '$mb_zip2',
                    mb_addr1        = '$mb_addr1',
                    mb_addr2        = '$mb_addr2',
                    mb_signature    = '$mb_signature',
                    mb_profile      = '$mb_profile',
                    mb_1            = '$mb_1',
                    mb_2            = '$mb_2',
                    mb_3            = '$mb_3',
                    mb_4            = '$mb_4',
                    mb_5            = '$mb_5',
                    mb_6            = '$mb_6',
                    mb_7            = '$mb_7',
                    mb_8            = '$mb_8',
                    mb_9            = '$mb_9',
                    mb_10           = '$mb_10'
                    $sql_password 
                    $sql_icon 
                    $sql_nick_date
                    $sql_open_date
                    $sql_sex
                    $sql_email_certify
              where mb_id = '$_POST[mb_id]' ";
    sql_query($sql);

    // 인증메일 발송
    if ($old_email != $mb_email && $config[cf_use_email_certify])
    {
        $subject = "{$lang[461]}";

        $mb_md5 = md5($mb_id.$mb_email.$member[mb_datetime]);
        $certify_href = "$g4[url]/$g4[bbs]/email_certify.php?mb_id=$mb_id&mb_md5=$mb_md5";
        
        ob_start();
        include_once ("./register_form_update_mail3.php");
        $content = ob_get_contents();
        ob_end_clean();
        
        mailer($admin[mb_nick], $admin[mb_email], $mb_email, $subject, $content, 1);
    }
}


// 사용자 코드 실행
@include_once ("$g4[path]/skin/member/$config[cf_member_skin]/register_update.skin.php");


if ($msg) 
    echo "<script type='text/javascript'>alert('{$msg}');</script>";

/*
// 결과페이지는 https 에서 http 로 변경이 되어야 함
if ($g4[https_url])
    $https_url = "$g4[https_url]/$g4[bbs]";
else
    $https_url = ".";
*/

$https_url = "$g4[url]/$g4[bbs]";

if ($w == "") {
    goto_url("{$https_url}/register_result.php");
} else if ($w == "u") {
    if ($mb_password)
        $tmp_password = $mb_password;
    else
        $tmp_password = get_session("ss_tmp_password");

    if ($old_email != $mb_email && $config[cf_use_email_certify]) {
        set_session("ss_mb_id", "");
        alert("{$lang[462]}", $g4[path]);
    } else {
        echo "
        <html><title>{$lang[463]}</title><meta http-equiv='Content-Type' content='text/html; charset=$g4[charset]'></html><body> 
        <form name='fregisterupdate' method='post' action='{$https_url}/register_form.php'>
        <input type='hidden' name='w' value='u'>
        <input type='hidden' name='mb_id' value='{$mb_id}'>
        <input type='hidden' name='mb_password' value='{$tmp_password}'>
        </form>
        <script type='text/javascript'>
        alert('{$lang[464]}');
        document.fregisterupdate.submit();
        </script>
        </body>
        </html>";
    }
}
?>
