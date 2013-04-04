<? 
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 게시판설정의 여유필드 2번에서 coment 를 입력시 작동하며 필요시 변경할것 
 if ($board[bo_2] =="coment"){ 
//원글 작성자가 코멘트 입력이나 수정시 패스 
  if ($wr[mb_id] ==$member[mb_id]){ 
  // return 0; 
  } 
  else{ 
if ($is_member){ 
  $smember_id = $member[mb_id]; 
} 
else{ 
//손님에게 코멘트 허용시 관리자 또는 테스트용 의 아이디를 입력할것(쪽지보기에서 유령? 때문에 ㅠㅠ) 
  $smember_id = "admin"; 
    //$smember_id = $_SERVER[REMOTE_ADDR]; 
} 
//원글의 제목과 쪽지내용의 항목을 만들고 링크를 완성 
      $wr_subject = get_text(stripslashes($wr[wr_subject])); 
      $wr_content = get_text(stripslashes("------ {$lang[267]}------\n\n$wr[wr_subject]\n\n\n----- {$lang[268]} -----\n\n$wr_content")); 
      $warr = array( "c"=>"[{$lang[269]}]", "cu"=>"[{$lang[01]}270]" ); 
      $str = $warr[$w]; 
      $subject = "{$str} {$lang[271]}"; 
      $link_url = "$g4[url]/$g4[bbs]/board.php?bo_table=$bo_table&wr_id=$wr_id&$qstr#c_{$comment_id}"; 
 //쪽지번호만들기 
      $tmp_row = sql_fetch(" select max(me_id) as max_me_id from $g4[memo_table] "); 
      $me_id = $tmp_row[max_me_id] + 1; 
 //쪽지 날리기 
      $sql = " insert into $g4[memo_table] 
          set me_id ='$me_id', 
  me_recv_mb_id = '$wr[mb_id]', 
              me_send_mb_id = '$smember_id', 
              me_send_datetime = '$g4[time_ymdhis]', 
              me_memo = '$subject\n\n$wr_content\n\n{$lang[272]}:\n\n$link_url\n\n' "; 
      sql_query($sql); 
  //쪽지도착 알람넣기 
      $sql = " update $g4[member_table] 
            set mb_memo_call = '$smember_id' 
                where mb_id = '$wr[mb_id]' "; 
        sql_query($sql); 

  } //쪽지 날리기 끝 
 } //게시판 설정 끝 
?>