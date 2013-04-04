<?
$sub_menu = "200100";
include_once("./_common.php");



$mb_id = mysql_real_escape_string(trim($_POST['mb_id']));

$sql_common = " mb_name         = '$_POST[mb_name]',
                mb_nick         = '$_POST[mb_nick]',
                mb_email        = '$_POST[mb_email]',
                mb_homepage     = '$_POST[mb_homepage]',
                mb_tel          = '$_POST[mb_tel]',
                mb_hp           = '$_POST[mb_hp]',
                mb_zip1         = '$_POST[mb_zip1]',
                mb_zip2         = '$_POST[mb_zip2]',
                mb_addr1        = '$_POST[mb_addr1]',
                mb_addr2        = '$_POST[mb_addr2]',
                mb_birth        = '$_POST[mb_birth]',
                mb_sex          = '$_POST[mb_sex]',
                mb_signature    = '$_POST[mb_signature]',
                mb_leave_date   = '$_POST[mb_leave_date]',
                mb_intercept_date='$_POST[mb_intercept_date]',
                mb_memo         = '$_POST[mb_memo]',
                mb_mailling     = '$_POST[mb_mailling]',
                mb_sms          = '$_POST[mb_sms]',
                mb_open         = '$_POST[mb_open]',
                mb_profile      = '$_POST[mb_profile]',
                mb_level        = '$_POST[mb_level]',
                mb_1            = '$_POST[mb_1]',
                mb_2            = '$_POST[mb_2]',
                mb_3            = '$_POST[mb_3]',
                mb_4            = '$_POST[mb_4]',
                mb_5            = '$_POST[mb_5]',
                mb_6            = '$_POST[mb_6]',
                mb_7            = '$_POST[mb_7]',
                mb_8            = '$_POST[mb_8]',
                mb_9            = '$_POST[mb_9]',
                mb_10           = '$_POST[mb_10]' ";

if ($w == "")
{
    $mb = get_member($mb_id);
    if ($mb[mb_id]){
        echo "member id already existing"; 
        exit;
    }
        
/*
    if ($mb[mb_nick] == $mb_nick){
        echo "nick name already existing"; 
        exit;
    }
        

    if ($mb[mb_email] == $mb_email){
        echo "email already existing"; 
        exit;
    }
*/        
        
    
	
    sql_query(" insert into $g4[member_table] set mb_id = '$mb_id', mb_password = '".sql_password($mb_password)."', mb_datetime = '$g4[time_ymdhis]', mb_ip = '$_SERVER[REMOTE_ADDR]', mb_email_certify = '$g4[time_ymdhis]', $sql_common  ");
    
    echo "member data has been inserted";
}
else if ($w == "u")
{
	$test2 = $_POST['mb_id'];
    $mb = get_member($mb_id);
    
    if (!$mb[mb_id]){
        echo " no member id existing.";
        exit;
    }

    if ($is_admin != "super" && $mb[mb_level] >= $member[mb_level]){
        echo "you cant change the higher level";
        exit;
    }

    if ($_POST[mb_id] == $member[mb_id] && $_POST[mb_level] != $mb[mb_level]){
        echo "$mb[mb_id] : you cant change the loggined administrator info'.";
        exit;
    }

    $mb_dir = substr($mb_id,0,2);

    // 회원 아이콘 삭제
    if ($del_mb_icon)
        @unlink("$g4[path]/data/member/$mb_dir/$mb_id.gif");

    // 아이콘 업로드
    if (is_uploaded_file($_FILES[mb_icon][tmp_name])) {
        if (!preg_match("/(\.gif)$/i", $_FILES[mb_icon][name])) {
            echo "$_FILES[mb_icon][name] . '은(는) gif 파일이 아닙니다.'";
        }

        if (preg_match("/(\.gif)$/i", $_FILES[mb_icon][name])) {
            @mkdir("$g4[path]/data/member/$mb_dir", 0707);
            @chmod("$g4[path]/data/member/$mb_dir", 0707);

            $dest_path = "$g4[path]/data/member/$mb_dir/$mb_id.gif";

            move_uploaded_file($_FILES[mb_icon][tmp_name], $dest_path);
            chmod($dest_path, 0606);

            if (file_exists($dest_path)) {
                $size = getimagesize($dest_path);
                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                if ($size[0] > $config[cf_member_icon_width] || $size[1] > $config[cf_member_icon_height]) {
                    @unlink($dest_path);
                }
            }
        }
    }

    if ($mb_password)
        $sql_password = " , mb_password = '".sql_password($mb_password)."' ";
    else
        $sql_password = "";

    if ($passive_certify)
        $sql_certify = " , mb_email_certify = '$g4[time_ymdhis]' ";
    else
        $sql_certify = "";

    $sql = " update $g4[member_table]
                set $sql_common
                    $sql_password
                    $sql_certify
              where mb_id = '$mb_id' ";
    sql_query($sql);
    
    echo "member data has been updated";
}
else
    echo "wrong parameter";

?>