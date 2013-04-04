<?

$https_url = ".";
if($is_admin)
{
    goto_url("{$https_url}/write.php?bo_table=$bo_table&w=u&wr_id=$wr_id&page=$page" . $qstr);
}else
{
    alert("예약신청되었습니다. 확인후 연락드리겠습니다.","{$https_url}/write.php?bo_table=$bo_table" . $qstr);
}
?>
