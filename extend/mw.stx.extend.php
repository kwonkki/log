<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (isset($stx))
{ 
    // 검색어 디코딩
    $stx = urldecode($stx);

    // 검색어에 슬래쉬가 있는 것은 해킹시도 간주, 검색막음 (인기검색어 출력시 보기좋지 않음)
    if (strstr($stx, "/")) $stx = "";
}

if (isset($_GET[q]))
{ 
    // 검색어 디코딩
    $_GET[q] = urldecode($_GET[q]);

    // 검색어에 슬래쉬가 있는 것은 해킹시도 간주, 검색막음 (인기검색어 출력시 보기좋지 않음)
    if (strstr($_GET[q], "/")) $_GET[q] = "";
}
?>
