<?php
$is_member = true;

$tel = implode("-",$_POST['tel']);
$wr_subject	= $_POST['wr_subject'] = $_POST['name']."님(".$tel.")이 예약하셨습니다.";
$wr_1		= $_POST['birthday']; // 생년월일
$wr_2		= $tel;
$wr_3		= $_POST['input_date'];
$wr_4		= $_POST['su_day'];
$wr_5		= $_POST['room'];
$wr_6		= $_POST['people_cnt'];
$wr_7		= $_POST['arrive'];
$wr_8		= $_POST['vehicle'];
$wr_9		= $_POST['etc'];
$wr_10		= $_POST[''];

$wr_name	= $_POST['name'];

$wr_content = $_POST['wr_content'] = <<<HTML
예약자명 : {$name}
전화번호 : {$tel}
생년월일 : {$birthday}
입실일 : {$input_date} : {$su_day}
예약객실 : {$room}
인원수 : {$people_cnt}
도착시간 : {$arrive}
교통편 : {$vehicle}
기타사항 : {$etc}
HTML;


?>
