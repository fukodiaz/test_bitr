<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовое");
?>

<?$APPLICATION->IncludeComponent(
    "custom:news_list",
    ".default",
    [
        "IBLOCK_ID" => 1,
    ]
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>