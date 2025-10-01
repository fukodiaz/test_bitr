<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Context;

define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('PUBLIC_AJAX_MODE', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!check_bitrix_sessid()) {
    die(json_encode(['error' => 'session expired']));
}

require_once $_SERVER["DOCUMENT_ROOT"] . "/local/components/custom/news_list/class.php";

$period = $_POST['period'] ?? 'all';
$search = $_POST['search'] ?? '';
$cost = $_POST['cost'] ?? '';

$component = new NewsListComponent(null);
$component->arParams['IBLOCK_ID'] = 1;
$items = $component->getElements($period, $search, $cost);

header('Content-Type: application/json');
echo json_encode(['items' => $items]);