<?
/**
 * Bechu basic skin for gnuboard4
 *
 * copyright (c) 2008 Choi Jae-Young <www.miwit.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// gr_id 입력 안된것 보완 v.1.0.1
if (!$mw_basic[gr_id])
    sql_query("update $mw[basic_config_table] set gr_id = '$gr_id' where bo_table = '$bo_table'", false);

// gr_id 변경 체크 v.1.0.3
if ($mw_basic[gr_id] != $gr_id) {
    $sql = "update $mw[basic_config_table] set gr_id = '$gr_id' where bo_table = '$bo_table'";
    $res = sql_query($sql, false);
}

if (!$mw_basic)
{
    $sql = "insert into $mw[basic_config_table] set gr_id = '$gr_id', bo_table = '$bo_table'";
    $res = sql_query($sql, false);
    if (!$res)
    {
        // 스킨 설정 테이블 자동생성
        $sql = "create table $mw[basic_config_table] (
        gr_id varchar(20) default '' not null,
        bo_table varchar(20) default '' not null,
        cf_type varchar(5) default 'list' not null,
        cf_thumb_width smallint default '80' not null,
        cf_thumb_height smallint default '50' not null,
        cf_attribute varchar(10) default 'basic' not null,
        cf_ccl tinyint default '0' not null,
        cf_hot tinyint default '0' not null,
        cf_hot_basis varchar(10) default 'hit' not null,
        cf_related tinyint default '0' not null,
        cf_link_blank tinyint default '1' not null,
        cf_zzal tinyint default '0' not null,
        cf_zzal_must tinyint default '0' not null,
        cf_source_copy tinyint default '1' not null,
        cf_relation tinyint default '1' not null,
        cf_comment_editor tinyint default '1' not null,
        cf_comment_emoticon tinyint default '0' not null,
        cf_comment_write tinyint default '1' not null,
        cf_singo tinyint default '1' not null,
        cf_singo_id text not null,
        cf_email text not null,
        cf_sms_id varchar(100) not null,
        cf_sms_pw varchar(100) not null,
        cf_hp text not null,
        cf_content_head text not null,
        cf_content_tail text not null,
        primary key (gr_id, bo_table));";
        sql_query($sql, false);

        $sql = "insert into $mw[basic_config_table] set gr_id = '$gr_id', bo_table = '$bo_table'";
        $res = sql_query($sql, false);
    }

    $sql = "select * from $mw[basic_config_table] where bo_table = '$bo_table'";
    $mw_basic = sql_fetch($sql);
}
// 게시판 테이블에 CCL 항목 자동 추가
if (is_null($write[wr_ccl])) {
    $sql = "alter table $write_table add wr_ccl varchar(10) default '' not null";
    sql_query($sql, false);
}

// 게시판 테이블에 신고 항목 자동 추가
if (is_null($write[wr_singo])) {
    $sql = "alter table $write_table add wr_singo tinyint default '0' not null";
    sql_query($sql, false);
}

// 게시판 테이블에 짤방 항목 자동 추가
if (is_null($write[wr_zzal])) {
    $sql = "alter table $write_table add wr_zzal varchar(255) default '짤방' not null";
    sql_query($sql, false);
}

// 게시판 테이블에 관련글 항목 자동 추가
if (is_null($write[wr_related])) {
    $sql = "alter table $write_table add wr_related varchar(255) default '' not null";
    sql_query($sql, false);
}

// 스킨환경정보에 글번호, 조회수등 컴마설정 자동추가 v.1.0.1
if (is_null($mw_basic[cf_comma])) {
    $sql = "alter table $mw[basic_config_table] add cf_comma tinyint default '0' not null";
    sql_query($sql, false);
}

// 코멘트 공지 자동추가 v.1.0.1
if (is_null($mw_basic[cf_comment_notice])) {
    $sql = "alter table $mw[basic_config_table] add cf_comment_notice text default '' not null";
    sql_query($sql, false);
}

// 다운로드 제한(코멘트 강제) 자동추가 v.1.0.1
if (is_null($mw_basic[cf_download_comment])) {
    $sql = "alter table $mw[basic_config_table] add cf_download_comment tinyint default '0' not null";
    sql_query($sql, false);
}

// 업로더 포인트 제공 자동추가 v.1.0.1
if (is_null($mw_basic[cf_uploader_point])) {
    $sql = "alter table $mw[basic_config_table] add cf_uploader_point tinyint default '0' not null";
    $sql .= ", add cf_uploader_day tinyint default '0' not null";
    sql_query($sql, false);
}

// 자동등록방지 코드 이미지 사용 - 그누보드4 최신버전과 이전버전의 호환성 v.1.0.1
if (is_null($mw_basic[cf_norobot_image])) {
    $sql = "alter table $mw[basic_config_table] add cf_norobot_image tinyint default '1' not null";
    sql_query($sql, false);
}

// 코멘트 입력시 비밀글 체크 기본설정기능 자동추가 v.1.0.1
if (is_null($mw_basic[cf_comment_secret])) {
    $sql = "alter table $mw[basic_config_table] add cf_comment_secret tinyint default '0' not null";
    sql_query($sql, false);
}

// 요약형 본문 글자수 설정 자동추가 v.1.0.1
if (is_null($mw_basic[cf_desc_len])) {
    $sql = "alter table $mw[basic_config_table] add cf_desc_len int default '150' not null";
    sql_query($sql, false);
}

// 권한에 따른 쓰기버튼 출력 옵션 v.1.0.2
if (is_null($mw_basic[cf_write_button])) {
    $sql = "alter table $mw[basic_config_table] add cf_write_button tinyint default '1' not null";
    sql_query($sql, false);
}

// 권한별 제목링크 v.1.0.2
if (is_null($mw_basic[cf_subject_link])) {
    $sql = "alter table $mw[basic_config_table] add cf_subject_link tinyint default '0' not null";
    sql_query($sql, false);
}

// 코멘트 금지 기능 v.1.0.2
if (is_null($mw_basic[cf_comment_ban])) {
    $sql = "alter table $mw[basic_config_table] add cf_comment_ban tinyint default '0' not null";
    sql_query($sql, false);
}
if (is_null($write[wr_comment_ban])) {
    $sql = "alter table $write_table add wr_comment_ban char(1) not null";
    sql_query($sql, false);
}

// 링크 게시판 
if (is_null($mw_basic[cf_link_board])) {
    $sql = "alter table $mw[basic_config_table] add cf_link_board tinyint default '0' not null";
    sql_query($sql, false);
}

// 공지사항 이름, 날짜, 조회수 출력 여부 
if (is_null($mw_basic[cf_notice_name])) {
    sql_query("alter table $mw[basic_config_table] add cf_notice_name tinyint default '0' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_notice_date tinyint default '0' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_notice_hit tinyint default '0' not null", false);
}

// 일반게시물 이름, 날짜, 조회수 출력 여부 
if (is_null($mw_basic[cf_notice_name])) {
    sql_query("alter table $mw[basic_config_table] add cf_post_name tinyint default '0' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_post_date tinyint default '0' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_post_hit tinyint default '0' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_post_num tinyint default '0' not null", false);
}

// 코멘트 금지 레벨설정 기능 v.1.0.2
if (is_null($mw_basic[cf_comment_ban_level])) {
    $sql = "alter table $mw[basic_config_table] add cf_comment_ban_level tinyint default '10' not null";
    sql_query($sql, false);
}

// 게시글 히스토리 v.1.0.2
if (is_null($mw_basic[cf_post_history])) {
    $sql = "alter table $mw[basic_config_table] add cf_post_history char(1) not null";
    sql_query($sql, false);

    $sql = "alter table $mw[basic_config_table] add cf_post_history_level tinyint default '10' not null";
    sql_query($sql, false);

    $sql = "alter table $mw[basic_config_table] add cf_delete_log char(1) not null";
    sql_query($sql, false);

    $sql = "create table $mw[post_history_table] (
            ph_id int unsigned auto_increment not null
            ,bo_table varchar(20) not null
            ,wr_id int not null
            ,wr_parent int not null
            ,mb_id varchar(20) not null
            ,ph_name varchar(255)
            ,ph_option set('html1', 'html2', 'secret', 'mail') not null
            ,ph_subject varchar(255) not null
            ,ph_content text not null
            ,ph_ip varchar(20) not null
            ,ph_datetime datetime not null
            ,primary key(ph_id)
            ,index(bo_table, wr_id, mb_id));";
    sql_query($sql);
}

// 다운로드 기록 v.1.0.2
if (is_null($mw_basic[cf_download_log])) {
    $sql = "alter table $mw[basic_config_table] add cf_download_log char(1) not null";
    sql_query($sql, false);

    $sql = "create table $mw[download_log_table] (
            dl_id int auto_increment not null
            ,bo_table varchar(20) not null
            ,wr_id int not null
            ,bf_no int not null
            ,mb_id varchar(20) not null
            ,dl_ip varchar(20) not null
            ,dl_datetime datetime not null
            ,primary key(dl_id)
            ,index(bo_table, wr_id, bf_no, mb_id));";
    sql_query($sql);
}

// 접근권한 v.1.0.2
if (is_null($mw_basic[cf_board_member])) {
    $sql = "alter table $mw[basic_config_table] add cf_board_member char(1) not null";
    sql_query($sql);

    // 게시판 접근권한 테이블 자동생성 v.1.0.2
    $sql = "create table $mw[board_member_table] (
    bo_table varchar(20) not null
    ,mb_id varchar(20) not null
    ,bm_datetime datetime not null
    ,primary key (bo_table));";
    sql_query($sql);
}

// 접근권한 목록 v.1.0.2
if (is_null($mw_basic[cf_board_member_list])) {
    $sql = "alter table $mw[basic_config_table] add cf_board_member_list char(1) not null";
    sql_query($sql, false);
}

// 코멘트 기본 내용 v.1.0.2
if (is_null($mw_basic[cf_comment_default])) {
    $sql = "alter table $mw[basic_config_table] add cf_comment_default text not null";
    sql_query($sql, false);
}

// 접근권한 v.1.0.2
if ($mw_basic[cf_board_member] && !$is_admin) {
    $sql = "select mb_id from $mw[board_member_table] where bo_table = '$bo_table'";
    $qry = sql_query($sql, false);

    $mw_board_member = array();
    while ($row = sql_fetch_array($qry)) {
        array_push($mw_board_member, $row[mb_id]);
    }
    $mw_is_board_member = false;
    if (!in_array($member[mb_id], $mw_board_member)) {
        if (!($mw_basic[cf_board_member_list] && $mw_is_list)) {
            alert("게시판에 접근권한이 없습니다.");
        }
    } else {
        $mw_is_board_member = true;
    }
}

// 게시물 목록 셔플 
if (is_null($mw_basic[cf_list_shuffle])) {
    $sql = "alter table $mw[basic_config_table] add cf_list_shuffle char(1) not null";
    sql_query($sql, false);
}

// 첫번째 첨부 이미지 본문 출력 안함 (썸네일용) 
if (is_null($mw_basic[cf_img_1_noview])) {
    $sql = "alter table $mw[basic_config_table] add cf_img_1_noview char(1) not null";
    sql_query($sql, false);
}

// 첨부파일 상단 
if (is_null($mw_basic[cf_file_head])) {
    $sql = "alter table $mw[basic_config_table] add cf_file_head text not null";
    sql_query($sql, false);
}

// 첨부파일 하단 
if (is_null($mw_basic[cf_file_tail])) {
    $sql = "alter table $mw[basic_config_table] add cf_file_tail text not null";
    sql_query($sql, false);
}

// 한사람당 글 한개만 
if (is_null($mw_basic[cf_only_one])) {
    $sql = "alter table $mw[basic_config_table] add cf_only_one char(1) not null";
    sql_query($sql, false);
}

// 배추컨텐츠샵 솔루션 사용
if (is_null($mw_basic[cf_contents_shop])) {
    $sql = "alter table $mw[basic_config_table] add cf_contents_shop char(1) not null";
    sql_query($sql, false);
}

// 컨텐츠 가격
if (is_null($write[wr_contents_price])) {
    $sql = "alter table $write_table add wr_contents_price int not null";
    sql_query($sql, false);
}

// 컨텐츠 사용 도메인 입력
if (is_null($write[wr_contents_domain])) {
    $sql = "alter table $write_table add wr_contents_domain char(1) not null";
    sql_query($sql, false);
}

// 관리자만 dhtml editor 사용
if (is_null($mw_basic[cf_admin_dhtml])) {
    $sql = "alter table $mw[basic_config_table] add cf_admin_dhtml char(1) not null";
    sql_query($sql, false);
}

// 관리자만 dhtml_comment editor 사용
if (is_null($mw_basic[cf_admin_dhtml_comment])) {
    $sql = "alter table $mw[basic_config_table] add cf_admin_dhtml_comment char(1) not null";
    sql_query($sql, false);
}

// 글쓰기 버튼 클릭시 공지
if (is_null($mw_basic[cf_write_notice])) {
    $sql = "alter table $mw[basic_config_table] add cf_write_notice text not null";
    sql_query($sql, false);
}

// 사용자 정의 css
if (is_null($mw_basic[cf_css])) {
    $sql = "alter table $mw[basic_config_table] add cf_css text not null";
    sql_query($sql, false);
}

// 썸네일 비율유지
if (is_null($mw_basic[cf_thumb_keep])) {
    $sql = "alter table $mw[basic_config_table] add cf_thumb_keep char(1) not null";
    sql_query($sql, false);
}

// 이미지 정보 
if (is_null($mw_basic[cf_exif])) {
    $sql = "alter table $mw[basic_config_table] add cf_exif char(1) not null";
    sql_query($sql, false);
}

// 인쇄 
if (is_null($mw_basic[cf_print])) {
    $sql = "alter table $mw[basic_config_table] add cf_print tinyint default '1' not null";
    sql_query($sql, false);
}

// 짧은글주소
if (is_null($mw_basic[cf_umz])) {
    $sql = "alter table $mw[basic_config_table] add cf_umz tinyint default '0' not null";
    sql_query($sql, false);
}
if (is_null($write[wr_umz])) {
    $sql = "alter table $write_table add wr_umz varchar(30) default '' not null";
    sql_query($sql, false);
}

// 짧은글주소 - 자체도메인
if (is_null($mw_basic[cf_shorten])) {
    $sql = "alter table $mw[basic_config_table] add cf_shorten tinyint default '0' not null";
    sql_query($sql, false);
}

// View 본문 상단 파일
if (is_null($mw_basic[cf_include_view_head])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_view_head varchar(255) not null";
    sql_query($sql, false);
}

// View 본문 하단 파일
if (is_null($mw_basic[cf_include_view_tail])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_view_tail varchar(255) not null";
    sql_query($sql, false);
}

// View 첨부파일 상단 파일
if (is_null($mw_basic[cf_include_file_head])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_file_head varchar(255) not null";
    sql_query($sql, false);
}

// View 첨부파일 하단 파일
if (is_null($mw_basic[cf_include_file_tail])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_file_tail varchar(255) not null";
    sql_query($sql, false);
}

// 목록 레코드
if (is_null($mw_basic[cf_include_list_main])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_list_main varchar(255) not null";
    sql_query($sql, false);
}

// 코멘트 레코드
if (is_null($mw_basic[cf_include_comment_main])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_comment_main varchar(255) not null";
    sql_query($sql, false);
}

// View 최상단
if (is_null($mw_basic[cf_include_view_top])) {
    $sql = "alter table $mw[basic_config_table] add cf_include_view_top varchar(255) not null";
    sql_query($sql, false);
}

// thumb 확장
if (is_null($mw_basic[cf_thumb2_width])) {
    sql_query("alter table $mw[basic_config_table] add cf_thumb2_width smallint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_thumb2_height smallint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_thumb3_width smallint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_thumb3_height smallint not null", false);
}

// 제목스타일
if (is_null($mw_basic[cf_subject_style])) {
    sql_query("alter table $mw[basic_config_table] add cf_subject_style tinyint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_subject_style_level tinyint not null", false);
}
if (is_null($write[wr_subject_font])) {
    sql_query("alter table $write_table add wr_subject_font varchar(10) not null", false);
    sql_query("alter table $write_table add wr_subject_color varchar(10) not null", false);
}

//sql_query("alter table $mw[basic_config_table] change cf_uploader_point cf_uploader_point int not null", false);
//sql_query("alter table $mw[basic_config_table] change cf_uploader_day cf_uploader_day int not null", false);

// 썸네일2,3 비율유지
if (is_null($mw_basic[cf_thumb2_keep])) {
    sql_query("alter table $mw[basic_config_table] add cf_thumb2_keep char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_thumb3_keep char(1) not null", false);
}

// 지업로더
if (is_null($mw_basic[cf_guploader])) {
    sql_query("alter table $mw[basic_config_table] add cf_guploader char(1) not null", false);
}

// 다운로드 팝업
if (is_null($mw_basic[cf_download_popup])) {
    sql_query("alter table $mw[basic_config_table] add cf_download_popup tinyint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_download_popup_msg text not null", false);
}

// 코멘트 기간
if (is_null($mw_basic[cf_comment_period])) {
    $sql = "alter table $mw[basic_config_table] add cf_comment_period int default '0' not null";
    sql_query($sql, false);
}

// 서비스 점검중 안내
if (is_null($mw_basic[cf_under_construction])) {
    $sql = "alter table $mw[basic_config_table] add cf_under_construction char(1) not null";
    sql_query($sql, false);
}

// 삭제금지
if (is_null($mw_basic[cf_no_delete])) {
    $sql = "alter table $mw[basic_config_table] add cf_no_delete char(1) not null";
    sql_query($sql, false);
}

// 글작성조건
if (is_null($mw_basic[cf_write_point])) {
    sql_query("alter table $mw[basic_config_table] add cf_write_point int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_write_register int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_write_day int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_write_day_count int not null", false);
}

// 글작성자의 최신글
if (is_null($mw_basic[cf_latest])) {
    $sql = "alter table $mw[basic_config_table] add cf_latest tinyint not null";
    sql_query($sql, false);
}

// sns
if (is_null($mw_basic[cf_sns])) {
    $sql = "alter table $mw[basic_config_table] add cf_sns char(1) not null";
    sql_query($sql, false);
}

// 설문 
if (is_null($mw_basic[cf_vote])) {
    sql_query("alter table $mw[basic_config_table] add cf_vote char(1) not null", false);
}
    $sql = "create table if not exists $mw[vote_table] (
            vt_id int not null auto_increment,
            bo_table varchar(20) not null,
            wr_id int not null,
            vt_edate date not null,
            vt_total int not null,
            vt_point int not null,
            primary key (vt_id),
            index (bo_table, wr_id))";
    sql_query($sql, false);
    $sql = "create table if not exists $mw[vote_item_table] (
            vt_id int not null,
            vt_num int not null,
            vt_item varchar(255) not null,
            vt_hit int not null,
            primary key (vt_id, vt_num))";
    sql_query($sql, false);
    $sql = "create table if not exists $mw[vote_log_table] (
            vt_id int not null,
            vt_num int not null,
            mb_id varchar(20) not null,
            vt_ip varchar(20) not null,
            vt_datetime datetime not null,
            index (vt_id, mb_id))";
    sql_query($sql,false);

// 설문등록가능 레벨 
if (is_null($mw_basic[cf_vote_level])) {
    $sql = "alter table $mw[basic_config_table] add cf_vote_level tinyint not null";
    sql_query($sql, false);
}

// 설문참여가능 레벨 
if (is_null($mw_basic[cf_vote_join_level])) {
    $sql = "alter table $mw[basic_config_table] add cf_vote_join_level tinyint not null";
    sql_query($sql, false);
}

// 리워드
if (is_null($mw_basic[cf_reward])) {
    sql_query("alter table $mw[basic_config_table] add cf_reward char(1) not null", false);
}
    $sql = "create table if not exists $mw[reward_log_table] (
        re_no int not null auto_increment,
        bo_table varchar(20) not null,
        wr_id int not null,
        mb_id varchar(20) not null,
        re_date date not null,
        re_time time not null,
        re_merchant_id varchar(255) not null,
        re_merchant_site varchar(255) not null,
        re_order_no varchar(255) not null,
        re_product_no varchar(255) not null,
        re_product_name varchar(255) not null,
        re_category varchar(255) not null,
        re_qty int not null,
        re_payment int not null,
        re_paytype varchar(255) not null,
        re_commission int not null,
        re_id varchar(255) not null,
        re_ip varchar(255) not null,
        primary key (re_no),
        index (bo_table, wr_id, mb_id))";
    sql_query($sql, false);

    $sql = "create table if not exists $mw[reward_table] (
        bo_table varchar(20) not null,
        wr_id int not null,
        re_site varchar(20) not null,
        re_point int not null,
        re_url varchar(255) not null,
        re_status char(1) not null,
        re_edate date not null,
        re_hit int not null,
        primary key (bo_table, wr_id))";
    sql_query($sql, false);

// 목록에서 추천,비추천 출력 여부
if (is_null($mw_basic[cf_list_good])) {
    sql_query("alter table $mw[basic_config_table] add cf_list_good tinyint default '0' not null", false);
}

// 추천,비추천 그래프 사용
if (is_null($mw_basic[cf_good_graph])) {
    sql_query("alter table $mw[basic_config_table] add cf_good_graph char(1) not null", false);
}

// 신고 삭제? 이동?
if (is_null($mw_basic[cf_singo_after])) {
    sql_query("alter table $mw[basic_config_table] add cf_singo_after varchar(20) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_singo_number tinyint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_singo_id_block char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_singo_write_block char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_singo_level tinyint default '2' not null", false);
}
    sql_query("create table if not exists $mw[singo_log_table] (
        si_id int not null auto_increment,
        bo_table varchar(20) not null,
        wr_id int not null,
        mb_id varchar(20) not null,
        si_type varchar(255) not null,
        si_memo text not null,
        si_datetime datetime not null,
        si_ip varchar(20) not null,
        primary key (si_id),
        index (bo_table, wr_id, mb_id))", false);

// 리워드 테이블 버그 수정
sql_query("alter table $mw[reward_table] change re_url re_url varchar(255) not null", false);
sql_query("alter table $mw[reward_log_table] add re_remote varchar(20) not null", false);

// 검색위
if (is_null($mw_basic[cf_search_top])) {
    sql_query("alter table $mw[basic_config_table] add cf_search_top char(1) not null", false);
}

// 공지읽어야 글쓰기 가능 
if (is_null($mw_basic[cf_must_notice])) {
    sql_query("alter table $mw[basic_config_table] add cf_must_notice char(1) not null", false);
}
    sql_query("create table if not exists $mw[must_notice_table] (
        bo_table varchar(20) not null,
        wr_id int not null,
        mb_id varchar(20) not null,
        mu_datetime datetime not null,
        primary key (bo_table, wr_id, mb_id))", false);

// 분류탭
if (is_null($mw_basic[cf_category_tab])) {
    sql_query("alter table $mw[basic_config_table] add cf_category_tab char(1) not null", false);
}

// 분류 선택 라디오버튼
if (is_null($mw_basic[cf_category_radio])) {
    sql_query("alter table $mw[basic_config_table] add cf_category_radio char(1) not null", false);
}

// 공지상단
if (is_null($mw_basic[cf_notice_top])) {
    sql_query("alter table $mw[basic_config_table] add cf_notice_top char(1) not null", false);
}

// 코멘트 추천,반대,베플
if (is_null($mw_basic[cf_comment_good])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_good char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_comment_nogood char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_comment_best char(1) not null", false);
}
    sql_query("create table if not exists $mw[comment_good_table] (
        bo_table varchar(20) not null,
        parent_id int not null,
        wr_id int not null,
        mb_id varchar(20) not null,
        bg_flag varchar(6) not null,
        bg_datetime datetime not null,
        primary key (bo_table, parent_id, wr_id, mb_id))",false);

// 신고 후 게시물 잠금
if (is_null($mw_basic[cf_write_secret])) {
    sql_query("alter table $mw[basic_config_table] add cf_singo_write_secret char(1) not null", false);
}

// 레벨 아이콘
if (is_null($mw_basic[cf_icon_level])) {
    sql_query("alter table $mw[basic_config_table] add cf_icon_level char(1) not null", false);
}
if (is_null($mw_basic[cf_icon_level_point])) {
    sql_query("alter table $mw[basic_config_table] add cf_icon_level_point int default '10000' not null", false);
}

// 게시판 상,하단
if (is_null($mw_basic[cf_include_head])) {
    sql_query("alter table $mw[basic_config_table] add cf_include_head varchar(255) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_include_tail varchar(255) not null", false);
}

// 본문추가
if (is_null($mw_basic[cf_include_view])) {
    sql_query("alter table $mw[basic_config_table] add cf_include_view varchar(255) not null", false);
}

// 코멘트 첨부파일
if (is_null($mw_basic[cf_comment_file])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_file char(1) not null", false);
}
    sql_query(" create  table if not exists $mw[comment_file_table] (
     bo_table varchar(20)  not null default  '',
     wr_id int not null default '0',
     bf_no int not null default '0',
     bf_source varchar(255) not null default  '',
     bf_file varchar(255) not null default  '',
     bf_download varchar(255) not null default  '',
     bf_content text not null ,
     bf_filesize int not null default  '0',
     bf_width int not null default  '0',
     bf_height smallint not null default  '0',
     bf_type tinyint not null default  '0',
     bf_datetime datetime not null default '0000-00-00 00:00:00',
     primary  key (bo_table, wr_id, bf_no))", false);

// 코멘트 첨부파일
if (is_null($mw_basic[cf_contents_shop_download_count])) {
    sql_query("alter table $mw[basic_config_table] add cf_contents_shop_download_count int unsigned not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_contents_shop_download_day int unsigned not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_contents_shop_write char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_contents_shop_write_cash int unsigned not null", false);
}

// 코멘트 페이징
if (is_null($mw_basic[cf_comment_page])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_page char(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_comment_page_rows int not null", false);
}

// 코멘트 html 
if (is_null($mw_basic[cf_comment_html])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_html char(1) not null", false);
}

// 닉네임 치환
if (is_null($mw_basic[cf_replace_word])) {
    sql_query("alter table $mw[basic_config_table] add cf_replace_word int default '10' not null", false);
}

// 호칭
if (is_null($mw_basic[cf_name_title])) {
    sql_query("alter table $mw[basic_config_table] add cf_name_title varchar(20) not null", false);
}

// 선택익명
if (is_null($mw_basic[cf_anonymous])) {
    sql_query("alter table $mw[basic_config_table] add cf_anonymous char(1) not null", false);
}
if (is_null($write[wr_anonymous])) {
    sql_query("alter table $write_table add wr_anonymous char(1) not null", false);
}

// 댓글감춤
if (is_null($write[wr_comment_hide])) {
    sql_query("alter table $write_table add wr_comment_hide char(1) not null", false);
}

//  이미지 확대 사용 안함
if (is_null($mw_basic[cf_no_img_ext])) {
    sql_query("alter table $mw[basic_config_table] add cf_no_img_ext char(1) not null", false);
}

// 다운로드 팝업 크기
if (is_null($mw_basic[cf_download_popup_w])) {
    sql_query("alter table $mw[basic_config_table] add cf_download_popup_w int default '500' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_download_popup_h int default '300' not null", false);
}

// 링크로그
if (is_null($mw_basic[cf_link_log])) {
    $sql = "alter table $mw[basic_config_table] add cf_link_log char(1) not null";
    sql_query($sql);

    $sql = "create table if not exists $mw[link_log_table] (
            ll_id int auto_increment not null
            ,bo_table varchar(20) not null
            ,wr_id int not null
            ,ll_no int not null
            ,mb_id varchar(20) not null
            ,ll_name varchar(20) not null
            ,ll_ip varchar(20) not null
            ,ll_datetime datetime not null
            ,primary key(ll_id)
            ,index(bo_table, wr_id, ll_no, mb_id));";
    sql_query($sql);
}

// 에디터 종류
if (is_null($mw_basic[cf_editor])) {
    sql_query("alter table $mw[basic_config_table] add cf_editor varchar(10) not null", false);
}

// 워터마크
if (is_null($mw_basic[cf_watermark_path])) {
    sql_query("alter table $mw[basic_config_table] add cf_watermark_use varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_watermark_use_thumb varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_watermark_path varchar(255) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_watermark_position varchar(20) default 'center' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_watermark_transparency tinyint default 100 not null", false);
}

// 업로더수익
if (is_null($mw_basic[cf_contents_shop_uploader])) {
    sql_query("alter table $mw[basic_config_table] add cf_contents_shop_uploader varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_contents_shop_uploader_cash int not null", false);
}

// 원본 강제 리사이징
if (is_null($mw_basic[cf_original_width])) {
    sql_query("alter table $mw[basic_config_table] add cf_original_width smallint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_original_height smallint not null", false);
}

// 첨부파일 기본 갯수
if (is_null($mw_basic[cf_attach_count])) {
    sql_query("alter table $mw[basic_config_table] add cf_attach_count smallint default '1' not null", false);
}

// 관련글 타게시판
if (is_null($mw_basic[cf_related_table])) {
    sql_query("alter table $mw[basic_config_table] add cf_related_table varchar(20) not null", false);
}

// 최신글 타게시판
if (is_null($mw_basic[cf_latest_table])) {
    sql_query("alter table $mw[basic_config_table] add cf_latest_table varchar(20) not null", false);
}

// 게시물별 글읽기 레벨
if (is_null($write[wr_read_level])) {
    sql_query("alter table $mw[basic_config_table] add cf_read_level varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_read_level_own tinyint default '10' not null", false);
    sql_query("alter table $write_table add wr_read_level tinyint not null", false);
}

// 추천,비추천포인트
if (is_null($mw_basic[cf_good_point])) {
    sql_query("alter table $mw[basic_config_table] add cf_good_point int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_nogood_point int not null", false);
}

// 베플 기준
if (is_null($mw_basic[cf_comment_best_limit])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_best_limit int not null", false);
}

// 추천,비추천한 사람 포인트
if (is_null($mw_basic[cf_good_re_point])) {
    sql_query("alter table $mw[basic_config_table] add cf_good_re_point int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_nogood_re_point int not null", false);
}

// 본문 미리보기
/*if (is_null($mw_basic[cf_preview_level])) {
    sql_query("alter table $mw[basic_config_table] add cf_preview_level tinyint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_preview_size int not null", false);
}*/

// 코멘트 입력시 비밀글 사용안함
if (is_null($mw_basic[cf_comment_secret_no])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_secret_no char(1) not null", false);
}

// kcb 실명인증
if (is_null($write[wr_kcb_use])) {
    sql_query("alter table $mw[basic_config_table] add cf_kcb_id varchar(20) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_kcb_type varchar(6) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_kcb_list varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_kcb_read varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_kcb_write varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_kcb_post varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_kcb_post_level tinyint default 10 not null", false);
    sql_query("alter table $write_table add wr_kcb_use varchar(1) not null", false);

    $sql = "create table if not exists $mw[okname_table] (
    mb_id varchar(20) not null,
    ok_ip varchar(50) not null,
    ok_datetime datetime not null,
    primary key (mb_id))";
    sql_query($sql);
}

// 질문답변
if (is_null($mw_basic[wr_qna_status])) {
    sql_query("alter table $mw[basic_config_table] add cf_qna_point_use varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_qna_point_min int default '10' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_qna_point_max int default '1000' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_qna_point_add int default '100' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_qna_save tinyint default '70' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_qna_hold tinyint default '50' not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_qna_count tinyint default '1' not null", false);
    sql_query("alter table $write_table drop cf_qna_status", false);
    sql_query("alter table $write_table drop cf_qna_point", false);
    sql_query("alter table $write_table add wr_qna_status varchar(1) default '1' not null", false);
    sql_query("alter table $write_table add wr_qna_point int not null", false);
    sql_query("alter table $write_table add wr_qna_id int not null", false);
}

// 럭키라이팅
if (is_null($mw_basic[cf_lucky_writing_chance])) {
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_chance tinyint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_point_start int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_point_end int not null", false);
}

// 럭키라이팅
if (is_null($mw_basic[cf_lucky_writing_comment_chance])) {
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_comment_ment varchar(255) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_comment_chance tinyint not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_comment_point_start int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_comment_point_end int not null", false);
}
if (is_null($mw_basic[cf_lucky_writing_ment])) {
    sql_query("alter table $mw[basic_config_table] add cf_lucky_writing_ment varchar(255) not null", false);
}

// 임시저장
$sql = "create table if not exists $mw[temp_table] (
tp_id int not null auto_increment,
bo_table varchar(20) not null,
mb_id varchar(20) not null,
tp_subject varchar(255) not null,
tp_content text not null,
tp_datetime datetime not null,
tp_ip varchar(30) not null,
primary key (tp_id))";
sql_query($sql);

// 추천,비추천포인트
if (is_null($mw_basic[cf_comment_good_point])) {
    sql_query("alter table $mw[basic_config_table] add cf_comment_good_point int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_comment_good_re_point int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_comment_nogood_point int not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_comment_nogood_re_point int not null", false);
}

// 글작성시 이모티콘 사용
if (is_null($mw_basic[cf_post_emoticon])) {
    sql_query("alter table $mw[basic_config_table] add cf_post_emoticon varchar(1) not null", false);
}

// 시간에 인덱스
sql_query("alter table $write_table add index wr_datetime (wr_datetime)", false);

// 이미지크기 사용자정의
//if (is_null($mw_basic[cf_change_image_size])) {
    sql_query("alter table $mw[basic_config_table] add cf_change_image_size varchar(1) not null", false);
    sql_query("alter table $mw[basic_config_table] add cf_change_image_size_level tinyint not null", false);
//}


sql_query("alter table $mw[basic_config_table] add cf_singo_writer varchar(1) not null", false);

// iframe 사용권한
if (is_null($mw_basic[cf_iframe_level])) {
    sql_query("alter table $mw[basic_config_table] add cf_iframe_level int default 10 not null", false);
}

// 추천/비추 기간
if (is_null($mw_basic[cf_good_days])) {
    sql_query("alter table $mw[basic_config_table] add cf_good_days int not null", false);
}
?>
