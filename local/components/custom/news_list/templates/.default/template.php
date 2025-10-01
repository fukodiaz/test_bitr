<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="boxNewsList">
    <div class="boxFormNews">
        <form   class="formNews"
        >
            <ul class="listFields">
                <li class='itemField'>
                    <label  class='labelSearch'
                            for='search'        
                    >
                        Поиск по имени:
                    </label>

                    <input  name="search"
                            type="search"
                            placeholder="search"
                            class="searchName"
                            id="search"
                    />
                </li>
                <li class='itemField'>
                    <label  class='labelCost'
                            for='cost'
                    >
                        Стоимость:
                    </label>

                    <input  name="cost"
                            type="number"
                            min='0'
                            placeholder="0"
                            class="inputCost"
                            id="cost"
                    />
                </li>
            </ul>
            
            <button type="submit"
                    class="btnSubmitNews"
            >
                Отправить
            </button>
        </form>

        <div class="boxSelect">
            <select name="period"
                    class="selectPeriod"
                    value="all"
            >
                <option value="all" selected>
                    за все время
                </option>
                <option value="month">
                    за этот месяц
                </option>
                <option value="week">
                    за эту неделю
                </option>
            </select>
        </div>
    </div>

    <h2 class="headingListNews">
        Список новостей
    </h2>

    <ul class="listNews">
        <li class="itemNews header">
            <span>#</span>
            <span>Название</span>
            <span>Дата активности</span>
            <span>Особенность</span>
            <span>Стоимость</span>
        </li>
        <?php foreach ($arResult['ITEMS'] as $item): ?>
            <li class="itemNews">
                <span>
                    <?= $item['ID'] ?>
                </span>
                <span class='nameNews'>
                    <?= $item['NAME'] ?>
                </span>
                <span class='dataNews'>
                    <?= $item['ACTIVE_FROM'] ?>
                </span>
                <span class='feature'>
                    <?= $item['FEATURE'] ?>
                </span>
                <span class='cost'>
                    <?= $item['COST'] ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    BX.message({
        NEWS_LIST_AJAX: '<?=$this->__component->getPath()?>/ajax.php'
    });
</script>