<?php
include_once("_common.php");

// ---------------------------------------------------------------------------

# �̹����� ����� ���丮�� ��ü ��θ� �����մϴ�.
# ���� ������(/)�� ������ �ʽ��ϴ�.
# ����: �� ����� ���� ������ ����, �бⰡ �����ϵ��� ������ �ֽʽÿ�.

@mkdir("$g4[path]/data/mw.cheditor/", 0707);
@chmod("$g4[path]/data/mw.cheditor/", 0707);

$ym = date("ym", $g4[server_time]);

//$document_root = substr($_SERVER[SCRIPT_FILENAME], 0, strpos($_SERVER[SCRIPT_FILENAME], 'skin/board')-1);
define("SAVE_DIR", "$g4[path]/data/mw.cheditor/$ym");

@mkdir(SAVE_DIR, 0707);
@chmod(SAVE_DIR, 0707);

# ������ ������ 'SAVE_DIR'�� URL�� �����մϴ�.
# ���� ������(/)�� ������ �ʽ��ϴ�.

define("SAVE_URL", "$g4[url]/data/mw.cheditor/$ym");

// ---------------------------------------------------------------------------

?>
