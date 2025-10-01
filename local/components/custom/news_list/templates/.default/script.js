$(function() {
    $(".formNews").on('submit', function(e) {
        e.preventDefault();

        let search = $(this).find(".searchName").val();
        let cost = $(this).find(".inputCost").val();
        let period = $(".selectPeriod").val();

        $.ajax({
            url: BX.message('NEWS_LIST_AJAX'),
            type: 'POST',
            dataType: 'json',
            data: {
                sessid: BX.bitrix_sessid(),
                search: search,
                cost: cost,
                period: period,
                component: 'custom:news_list'
            },
            success: function(data) {
                let items = data.items;
                console.log('items_success: ', items);

                //для списка убираем все элементы, кроме образующего шапку
                let $list = $(".listNews");
                $list.find("li.itemNews:not(.header)").remove();

                $.each(items, function(index, item) {
                    let $li = $(`
                        <li class="itemNews">
                            <span>${item.ID}</span>
                            <span class="nameNews">${item.NAME}</span>
                            <span class="dataNews">${item.ACTIVE_FROM}</span>
                            <span class="feature">${item.FEATURE}</span>
                            <span class="cost">${item.COST}</span>
                        </li>
                    `);
                    $list.append($li);
                });
                
            },
            catch(e) {
                    console.error('Ошибка: ', e, data);
            }
        });
    });

    $('.selectPeriod').on('change', function() {
        let period = $(this).val();

        console.log('period: ', period);

        $.ajax({
            url: BX.message('NEWS_LIST_AJAX'),
            type: 'POST',
            dataType: 'json',
            data: {
                sessid: BX.bitrix_sessid(),
                period: period,
                component: 'custom:news_list'
            },
            success: function(data) {
                let items = data.items;
                console.log('items_success: ', items);

                //для списка убираем все элементы, кроме образующего шапку
                let $list = $(".listNews");
                $list.find("li.itemNews:not(.header)").remove();

                $.each(items, function(index, item) {
                    let $li = $(`
                        <li class="itemNews">
                            <span>${item.ID}</span>
                            <span class="nameNews">${item.NAME}</span>
                            <span class="dataNews">${item.ACTIVE_FROM}</span>
                            <span class="feature">${item.FEATURE}</span>
                            <span class="cost">${item.COST}</span>
                        </li>
                    `);
                    $list.append($li);
                });
                
            },
            catch(e) {
                    console.error('Ошибка: ', e, data);
            }
        });
    });
});