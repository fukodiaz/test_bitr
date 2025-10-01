<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<!DOCTYPE html>
<html>
<head>
	<?php 
		use Bitrix\Main\Page\Asset;
		$APPLICATION -> ShowHead();
	?>

	<title>
		<?php $APPLICATION -> ShowTitle(); ?>

		<?php
			Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . "/css/style.css");

			Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . "/js/jquery.min.js");
			Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . "/js/scripts.js");

			Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">');
			Asset::getInstance()->addString('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />');
		?>
	</title>
</head>
<body>
	<div id="panel">
		<?php 
			// $APPLICATION->ShowPanel();
		?>
	</div>
    
	<div class="mainWrapper">
        <main class="mainBox">
            <h1  class="headingMain">
				Тестовое
			</h1>