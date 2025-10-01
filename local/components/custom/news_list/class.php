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

    private function getFilterByDate($period) {
        $filter = [];
        $now = new \Bitrix\Main\Type\DateTime();

        switch ($period) {
            case 'week':
                // определение начало текущей недели
                $dayOfWeek = (int)$now->format('N');
                $start = clone $now;
                $start->setTime(0, 0, 0);
                if ($dayOfWeek > 1) {
                    $start->add('-' . ($dayOfWeek - 1) . ' days');
                }
                $filter['>=DATE_ACTIVE_FROM'] = $start;
                $filter['<=DATE_ACTIVE_FROM'] = $now;
                break;

            case 'month':
                // начало текущего месяца 
                $phpDate = new \DateTime($now->format('Y-m-01 00:00:00'));
                $start = \Bitrix\Main\Type\DateTime::createFromPhp($phpDate);

                $filter['>=DATE_ACTIVE_FROM'] = $start;
                $filter['<=DATE_ACTIVE_FROM'] = $now;
                break;

            case 'all':
            default:
                break;
        }

        return $filter;
    }

    public function getElements($period = "all", $search = "", $cost = "") {
        if (!Loader::includeModule('iblock')) {
            throw new \Exception('Ошибка при подключении модуля iblock');
        }

        $arrFilter = [
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y'
        ];

        $arrFilter = array_merge($arrFilter, $this->getFilterByDate($period));

        //фильтр по имени
        if (!empty($search)) {
            $arrFilter['%NAME'] = $search;
        }

        //фильтр по стоимости
        if (!empty($cost)) {
            $arrFilter['PROPERTY_COST'] = $cost;
        }

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
        $period = $request->getPost("period") ?: 'all';
        // $period = $request->getPost("period") ?: 'month';

        $this->arResult['ITEMS'] = $this->getElements($period);

        $this->includeComponentTemplate();
    }

    public function filterAction($period) {
        return [
            'items' => $this->getElements($period)
        ];
    }
}