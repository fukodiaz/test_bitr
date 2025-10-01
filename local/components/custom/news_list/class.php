<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Context;
use Bitrix\Main\Loader; 
use Bitrix\Main; 
use Bitrix\Iblock;

class NewsListComponent extends CBitrixComponent implements Controllerable {
    public function configureActions() {
        return [
            'filter' => [
                'prefilters' => []
            ],
        ];
    }

    public function getElements() {
        if (!Loader::includeModule('iblock')) {
            throw new \Exception('Ошибка при подключении модуля iblock');
        }

        $arrFilter = [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y'
        ];

        $res = \CIBlockElement::GetList(
            ['ACTIVE_FROM' => 'DESC'],
            $arrFilter,
            false,
            false,
            ['*']
        );

        $items = [];
        while ($el = $res->GetNextElement()) {
            $fields = $el->GetFields();
            $props  = $el->GetProperties();

            $fields['FEATURE'] = $props['FEATURE']['VALUE'];
            $fields['COST']    = $props['COST']['VALUE'];

            $items[] = $fields;
        }

        return $items;
    }

    public function executeComponent() {
        $request = Context::getCurrent()->getRequest();
        // $period = $request->getPost("period") ?: 'all';

        $this->arResult['ITEMS'] = $this->getElements();

        $this->includeComponentTemplate();
    }
}