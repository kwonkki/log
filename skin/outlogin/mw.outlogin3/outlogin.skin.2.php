<?
/**
 * Bechu-Outlogin Skin for Gnuboard4
 *
 * Copyright (c) 2008 Choi Jae-Young <www.miwit.com>
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

// 회원가입후 몇일째인지? + 1 은 당일을 포함한다는 뜻
$sql = " select (TO_DAYS('$g4[time_ymdhis]') - TO_DAYS('$member[mb_datetime]') + 1) as days ";
$row = sql_fetch($sql);
$mb_reg_after = number_format($row[days]);
?>

<!-- 로그인 후 외부로그인 시작 -->
<div id="mw-outlogin">
<form name="flogin" method="post" action="javascript:flogin_submit(document.flogin);" autocomplete="off">
<input type="hidden" name="url" value="<?=$url?>">
<div class="box-outside">
<div class="box-inside">
    <? if ($is_admin == "super" || $is_auth) { ?>
    <div class="login-title"><a href="<?=$g4[admin_path]?>/"><strong><?=$nick?></strong> are loggined</a></div>
    <? } else { ?>
    <div class="login-title"><strong><?=$nick?></strong> are loggined</div>
    <? } ?>
    <div class="login-level"><strong>Authentication LV : </strong><?=$member[mb_level]?></div>
    <!--<div celass="login-days"><strong>Reg Date</strong>: <?=$mb_reg_after?> </div>-->
    <div class="login-membership">
        <a href="<?=$g4[bbs_path]?>/logout.php?url=<?=$g4['url']?>">LOGOUT</a>        
    </div>
</div>
</div>
</form>
</div>
<!-- 로그인 후 외부로그인 끝 -->

<style type="text/css">
#mw-outlogin a { color:#7dacd8; font-size:8pt; text-decoration:none; }
#mw-outlogin .box-outside { width:180px; height:100px; background-color:#d0e1f1; }
#mw-outlogin .box-inside { position:absolute; margin:2px; width:176px; height:96px; background-color:#f3f9fc; background-color:#fff; }
#mw-outlogin .box-inside { line-height:16px; color:#7dacd8; font-size:8pt; font-family:gulim }
#mw-outlogin .login-title { position:absolute; margin:5px 0 0 7px; width:162px; border-bottom:1px solid #d0e1f1; }
#mw-outlogin .login-memo { position:absolute; margin:30px 0 0 7px; }
#mw-outlogin .login-memo-count { font-size:8pt; color:#ff6600; }
#mw-outlogin .login-point { position:absolute; margin:30px 0 0 55px; }
#mw-outlogin .login-point-number { color:#ff6600; color:#468AC8; }
#mw-outlogin .login-days { position:absolute; margin:48px 0 0 55px; }
#mw-outlogin .login-level { position:absolute; margin:48px 0 0 7px; }
#mw-outlogin .login-membership { position:absolute; margin:72px 0 0 7px; padding:3px 0 0 0; border-top:1px solid #d0e1f1; width:162px; }
#mw-outlogin .login-membership { text-align:center; font-size:8pt; color:#d0e1f1; }
#mw-outlogin .login-membership a { font-size:8pt; }

#mw-outlogin .box-outside { background-color:#e1e1e1; }
#mw-outlogin .box-inside { background-color:#fff; color:#6b7bb3; color:#777; }
#mw-outlogin .box-inside a { color:#6b7bb3; color:#777; }
#mw-outlogin .login-title { border-bottom:1px solid #e1e1e1; }
#mw-outlogin .login-membership { color:#6b7bb3; border-top:1px solid #e1e1e1; }
#mw-outlogin .login-membership a { color:#6b7bb3; color:#777; }
</style>

