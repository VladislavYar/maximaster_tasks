/** Функции, отвечающие за калькулятор доставки. (PHP)Калькулятор доставки*/

/** Выводит ошибку.*/
function outputErrorDelivery() {
    $('#resultdelivery').remove();
    var message = '<div id="resultdelivery" class="alert alert-danger"> Error </div>';
    $('#form-delivery').after(message);
}

/** Выводит ответ сервера.*/
function outputServerResponseDelivery(data) {
    if (data.status=='OK') {
        $('#resultdelivery').remove();
        var message = '<div id="resultdelivery" class="alert alert-success">'+ data.message + '</div>';
        $('#form-delivery').after(message);
    } else {
        $('#resultdelivery').remove();
        var message = '<div id="resultdelivery" class="alert alert-danger">'+ data.message + '</div>';
        $('#form-delivery').after(message);
    }
}

/** Делает POST запрос(AJAX) на сервер.*/
function getInfoDelivery(e) {
        $url = $(location).attr('href');
        e.preventDefault(); // Отменяет переход и запрос из браузера.
 
        $.ajax({
            type: 'POST',
            url: $url,
            data: $('#form-delivery').serialize(),
            dataType: 'json',
            success: outputServerResponseDelivery,
            error: outputErrorDelivery
        });
    }


/** Функции, отвечающие за размер и рандомный цвет прямоугольника. (JS)Случайный цвет*/

/** Возвращает рандомный цвет.*/
function randomColor(){
    var colorR = Math.floor((Math.random() * 256)),
        colorG = Math.floor((Math.random() * 256)),
        colorB = Math.floor((Math.random() * 256));
    return "rgb(" + colorR + "," + colorG + "," + colorB + ")";
}

/** Задаёт рандомный цвет.*/
function changeColor() {
    $('#canvas-color').css('background', randomColor);
}

/** 
 * Получает из поля ширину и задаёт её прямоугольнику.
 * Если меньше 0, то поле равно 0.
*/
function changeWidth() {
    var width = $('#width').val();
    if (width && width > 0){
        $('#canvas-color').attr('width', width);
    }
    else{
        $('#canvas-color').attr('width', 0);
    }
}

/** 
 * Получает из поля высоту и задаёт её прямоугольнику.
 * Если меньше 0, то поле равно 0.
*/
function changeHeight() {
    var height = $('#height').val();
    if (height && height > 0){
        $('#canvas-color').attr('height', height);
    }
    else{
        $('#canvas-color').attr('height', 0);
    }


}


/** Функции, отвечающие за Yandex карту. (JS)Оформление заказа*/

var yandMap; // Инициализация переменной для глобальной работы с картой

/** Удаляет старую метку и выводит новую. */
function putPlacemark(yandMap, latitude, longitude){
    yandMap.geoObjects.removeAll();
    var placemark = new ymaps.Placemark([latitude, longitude], { 
        }, {
        preset: 'twirl#blueStretchyIcon'
        });
        yandMap.geoObjects.add(placemark);
}

/** Инициализирует карту.*/
function mapInit(){
    yandMap = new ymaps.Map("map", {
        center: [54.194084, 37.613957],
        zoom: 20
    }, {
        balloonMaxWidth: 200,
        searchControlProvider: 'yandex#search'
    });

    ymaps.geolocation.get(
        {mapStateAutoApply: true}
    ).then(
        function(result) {
        yandMap.geoObjects.add(result.geoObjects)
    });

    /** 
     * При клике выводит подсказку с координатами и метку.
     * При втором клике убирает подсказку.
     */
    yandMap.events.add('click', function (e) {
    if (!yandMap.balloon.isOpen()) {
        var coords = e.get('coords');
        yandMap.balloon.open(coords, {
            contentBody:'<br><p>Координаты: ' + [
                coords[0].toPrecision(6),
                coords[1].toPrecision(6)
                ].join(', ') + '</p>',
        });
        putPlacemark(yandMap, coords[0], coords[1]);
    }
    else {
        yandMap.balloon.close();
    }
});
}

/** Функции, отвечающие за оформление заказа. (JS)Оформление заказа*/

/** 
 * Выводит оповещение об ошибках в полях и отсутсвии маркера на карте.
 * По большей мере - это костыль, потому что я не знал как мне обработать наличие маркера на карте.
*/
function errorOutputOrder(event, validator){
    if (yandMap.geoObjects.get(0)){
        $('#error-map').remove();
    } else if(!$('#error-map').length) {
        var message = '<div id="error-map" class="alert alert-danger">Укажите адресс доставки</div>'
        $('#map').after(message);
    };
    var errors = validator.numberOfInvalids()
    if (errors) {
      var message = errors == 1
        ? 'You missed 1 field. It has been highlighted'
        : 'You missed ' + errors + ' fields. They have been highlighted';
      $("div.error span").html(message);
      $("div.error").show();
    } else {
      $("div.error").hide();
    }
}

/** 
 * Если поля прошли валидацию и на карте есть маркер, выводит сообщение 'Заказ оформлен'.
 * По большей мере - это костыль, потому что я не знал как мне обработать наличие маркера на карте.
*/
function orderProcessingOutput(form) {
    if (yandMap.geoObjects.get(0) && !$('#resultdelivery').length){
        $('#error-map').remove();
        var message = '<div id="resultdelivery" class="alert alert-success">Заказ оформлен!</div>';
        $('#submit-order').after(message);
    } else if(!$('#error-map').length  && !$('#resultdelivery').length) {
        var message = '<div id="error-map" class="alert alert-danger">Укажите адресс доставки</div>'
        $('#map').after(message);
    }
}

/** Валидация полей и карты заказа.*/
function validateOrder(){
    $('#making-order').validate({
        submitHandler: orderProcessingOutput,
        invalidHandler: errorOutputOrder,
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            fio: {
                required: true,
                minlength: 5
            },
            phone: {
                required: true,
                number: true,
                minlength: 8
            },
            email: {
                email: true
            },
            message: {
                maxlength: 500
            },
        },
        messages : {
            fio: {
                required: 'Пожалуйста, укажите ФИО',
                minlength: 'ФИО должно содержать не менее 5 символов'
            },
            phone: {
                required: 'Пожалуйста, укажите номер телефона',
                number: 'Пожалуйста, введите только цирфы',
                minlength: 'Минимальная длина номера 8 символов'
            },
            email: {
                email: 'Пожалуйста, введите корректный адрес электронной почты, например: abc123@email.com'
            },
            message: {
                maxlength: 'Максимальная длина сообщения составляет 500 символов'
            }
        }
    });
}

/** Функции, отвечающие за таблицу товаров. (JS)Таблица товаров*/

var products; // Инициализация глобальной переменной для последующей фильтрации товаров по цене.

/** 
 * Возвращает отфильтрованные продукты(или пустой массив).
 * Если поля равны 0, то все продукты.
*/
function outputFilterTable(data) {
    var from = Number ($('#pricefrom').val()),
    up = Number ($('#priceup').val());
    if (!from && !up){
        displayProducts(products);
    } else if (from || up) {
        var filter_products = [];
        for (var i = 0; i < products.length; i++){
            if (from <= products[i].price && products[i].price <= up){
                filter_products.push(products[i]);
            }
        }
        displayProducts(filter_products);
    }
}

/** Валидирует поля с ценами.*/
function updateTable() {
    $('#filter-price').validate({
        submitHandler: outputFilterTable,
        errorClass: 'error fail-alert',
        rules: {
            pricefrom: {
                min: 0,
                required: true,
                number: true,
            },
            priceup: {
                min: 0,
                required: true,
                number: true,
            },
        },
        messages : {
            pricefrom: {
                min: 'Число должно быть положительным',
                required: 'Пожалуйста, введите значение',
                number: 'Пожалуйста, введите только числа'
            },
            priceup: {
                min: 'Число должно быть положительным',
                required: 'Пожалуйста, введите значение',
                number: 'Пожалуйста, введите только числа'
            },
        }
    });

}

/** Выводит продукты в таблицу или сообщение об их отсутсвии.*/
function displayProducts(products) {
    $('#resultproduct').remove();
    if (!products.length){
        $('table').hide();
        var message = 'Нет данных, попадающих под условие фильтра',
            no_products_message = '<div id="resultproduct" class="alert alert-danger d-grid gap-2 col-4 mx-auto top-1rem">' + message + '</div>';
        $('form').after(no_products_message);
        return ;
    }

    $('tbody').html('');
    $('table').show();
    for (var i = 0; i < products.length; i++) {
        var product = products[i],
            column = ('<tr><td>'+i+'</td><td>'+product.name+'</td><td>'+product.quantity+'</td><td>'
                      +product.price+'</td><td>'+(product.quantity*product.price)+'</td></tr>')
        $('tbody').append(column);
    }
}

/** Сохраняет все продукты в глобальную переменную 'product'.*/
function outputServerResponseProduct(data) {
    products = data;
    displayProducts(products);
}

/** Выводит ошибку в случае неудачи.*/
function outputErrorProduct() {
    var error = '<div id="resultproduct" class="alert alert-danger d-grid gap-2 col-4 mx-auto top-1rem">Error</div>';
    $('table').after(error);
}

/** Делает GET запрос (AJAX) на сервер и получает список продуктов.  (Сервер на Laravel, а тот уже на Ваш)*/
function getInfoProduct(){
    $url = $(location).attr('href') + '/products';

    $.ajax({
        type: 'GET',
        url: $url,
        success: outputServerResponseProduct,
        error: outputErrorProduct
    });
}


/** Функции, отвечающие за нагрузку на CPU. (JS)График закруженности процессора*/

var chart, // Инициализация глобальной переменной для графика.
    time = count_error = 0, // Инициализация глобальных переменных прошедшего времени и количество ошибок.
    old_data; // Инициализация глобальной переменной для старого значения загрузки(для вывода в случае ошибки).

/** 
 * Обновляет время, в случае успеха, выводит на график новое значени, иначе старое,
 * так же выводит кол-во запросов и процент ошибок.
*/
function outputServerResponseCPU(data) {
    time = time + 5;
    if (data==0){
        count_error++;
        data = old_data;
    }
    else {
        old_data = data;
    }
    $('#count-error').text('Процент ошибок: ' + ((count_error / time * 500).toPrecision(3)) + '%');
    $('#count-request').text('Количество запросов: ' + (time / 5));
    chart.data.labels.push(time);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
}

/** Делает GET запрос (AJAX) на сервер и получает значение. (Сервер на Laravel, а тот уже на Ваш)*/
function updateGraph() {
    $url = $(location).attr('href') + '/cpu-info';

    $.ajax({
        type: 'GET',
        url: $url,
        success: outputServerResponseCPU,
    });
}

/** Инициализация графика.*/
function displayGraph() {
    const ctx = $('#line-cpu').get();

    const labels = [];
    const data = {
        labels: labels,
        datasets: [{
          label: 'Загрузка CPU',
          data: [],
          backgroundColor: 'rgba(3,74,254, 0.5)',
          borderColor: 'rgb(3,74,254)',
          borderWidth: 2
        }]
      };
    
    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    min: 0,
                    max: 100,
                    title: {
                        display: true,
                        text: '%'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Секунды'
                    }
                }
            }
        }
    };
    
    chart = new Chart(ctx, config);
    

    setInterval(updateGraph, 5000); //Запрос каждые 5 секунд.
}


/** Функции, отвечающие за электронную таблицу. (JS)Электронная таблица*/

var count_column = localStorage.getItem('count_column'), // Глобально получает из localStorage кол-во колонок.
    count_line = localStorage.getItem('count_line'), // Глобально получает из localStorage кол-во строк.

    id_input, /** Инициализация глобальной переменной для хранения id поля, с последующим сохранением значения и выводом в ячейку.
    * id, так же ключ значения ячейки localStorage представяляет из себя 'input-{i}-{j}', где i - строка, j - колонка.
    */ 

    td_element, // Инициализация глобальной переменной для хранения элемента, в который выводится значение поля.
    warning; // Инициализация глобальной переменной для хранения модального окна.

/** Скрывает предупреждение, удаляет строку, значения ячеек в localStorage и обновляет их кол-во в переменных.*/
function delLine() {
    warning.hide();
    var id_tr = $('tbody').children().last().attr('id');
    for (var i = 1; i <= count_column; i++){
        localStorage.removeItem('input-'+id_tr+'-'+i);
    }
    $('tbody').children().last().remove();
    count_line--;
    localStorage.setItem('count_line', count_line);
}

/**
 * Выводит предупреждение о наличии данных в ячейке, при отмене, скрывается,
 * при согласии на удаление, вызывает фукнцию удаления строки.
*/
function displayWarningDelLine() {
    warning.show();
    $('#close-cross').on('click', function(){warning.hide();});
    $('#close').on('click', function(){warning.hide();});
    $('#del').off('click').on('click', delLine);
}

/**
 * Логика удаления строк. Если строк больше 1, проверяет на наличие значений
 * в ячейках, если есть, вызвает функцию с предупреждением, иначе просто удаляет.
*/
function minusLine() {
    if (count_line > 1){
        var id_tr = $('tbody').children().last().attr('id');
        for (var i = 1; i <= count_column; i++){
            if (localStorage.getItem('input-'+id_tr+'-'+i)) {
                displayWarningDelLine();
                return;
            }
        }
        delLine();
    }  
}

/** Скрывает предупреждение, удаляет колонку, значения ячеек в localStorage и обновляет их кол-во в переменных.*/
function delColumn() {
    warning.hide();
    for (var i = 1; i <= count_line; i++){
        localStorage.removeItem('input-'+i+'-'+count_column);
        $('#'+i+'-'+count_column).remove();
    }
    count_column--;
    localStorage.setItem('count_column', count_column);   
}

/**
 * Выводит предупреждение о наличии данных в ячейке, при отмене, скрывается,
 * при согласии на удаление, вызывает фукнцию удаления колонки.
*/
function displayWarningDelColumn() {
    warning.show();
    $('#close-cross').on('click', function(){warning.hide();});
    $('#close').on('click', function(){warning.hide();});
    $('#del').off('click').on('click', delColumn);
}

/**
 * Логика удаления колонки. Если колонок больше 1, проверяет на наличие значений
 * в ячейках, если есть, вызвает функцию с предупреждением, иначе просто удаляет.
*/
function minusColumn() {
    if (count_column > 1){
        for (var i = 1; i <= count_line; i++){
            if (localStorage.getItem('input-'+i+'-'+count_column)) {
                displayWarningDelColumn();
                return;
            }
        }
        delColumn();
    }
}

/** Добавляет строку, и обновляет их кол-во в переменных.*/
function plusLine() {
    count_line++;
    localStorage.setItem('count_line', count_line);
    var line = '<tr id="' + count_line +'">';
    for (var i = 1; i <= count_column; i++){
        line += '<td class="border size-cell" id="'+ count_line +'-'+ i +'"></td>';
    }
    line += '</tr>';
    $('tbody').append(line);

}

/** Добавляет колонку, и обновляет их кол-во в переменных.*/
function plusColumn() {
    count_column++;
    localStorage.setItem('count_column', count_column);
    for (var i = 1; i <= count_line; i++){
        var line = '<td class="border size-cell" id="'+ i +'-'+ count_column +'">';
        $('#'+i).append(line);
    }

}

/** Сохраняет значение поля в localStorage и выводит в ячейку.*/
function saveInput() {
    var value = $('#'+id_input).val();
    localStorage.setItem(id_input, value);
    $(td_element).text(value);
}

/**
 * Создаёт поле ввода в выбранной ячейке, делает на нем фокус,
 * добавляет значение из ячейки, если такое имеется,
 * при потере фокусах, вызвает функцию сохранения.
*/
function openInput() {
    td_element = this;
    id_input = 'input-' + $(td_element).attr('id');
    var value = $(td_element).text(),
        html = '<input id="'+id_input+'" type="text">';
    $(td_element).html(html);
    $('#'+id_input).focus().val(value);
    $('#'+id_input).focusout('blur', saveInput);
}

/** 
 * При заходе на страницу выводит выводит колонки, строки и значения в них(из localStorage).
 * Если посещение в первый раз, то сохраняет в глобальных переменных и localStorage таблицу 1х1.
*/
function displayColumnsRowsData() {
    var line = '',
        value = '';
        table= '';
    if (!count_line || !count_column) {
        count_line = count_column = 1;
        localStorage.setItem('count_column', count_column);
        localStorage.setItem('count_line', count_line);
    }

    /**
     * Первый цикл создаёт строку, второй ячейки в этой строке(так же добавляет значения, если такие имеются),
     * в конце итерации по строке, она добавляет к общей переменной table, после циклов table добавляется в HTML.
    */
    for (var i = 1; i <= count_line; i++){
            line = '<tr id="' + i +'">';
        for (var j = 1; j <= count_column; j++){
            id_input = 'input-' + i + '-' + j;
            value = localStorage.getItem(id_input);
            if (value == null){
                value = '';
            }
            line += '<td class="border size-cell" id="'+ i +'-'+ j +'">'+value+'</td>';
        }
        table += line + '</tr>';
    }
    $('tbody').append(table);
}

/** Логика работы с таблицей.*/
function displaySpreadsheet() {
    warning = new bootstrap.Modal($('#staticBackdrop')); // Создаёт модальное окно.
    displayColumnsRowsData();
    $('#plus-column').click(plusColumn);
    $('#minus-column').click(minusColumn);
    $('#plus-line').click(plusLine);
    $('#minus-line').click(minusLine);
    $(document).on('dblclick', 'td', openInput);
}

/** Логика работы всего JS, по 'pathname' определяет что именно надо исполнить.*/
function handler () {
    var windowLoc = $(location).attr('pathname');
    switch(windowLoc){
        case '/making-order':
            ymaps.ready(mapInit);
            validateOrder();
        break;
        case '/random-color':
            $('#button-random-color').click(changeColor);
            $('#width').on('input', changeWidth);
            $('#height').on('input', changeHeight);
        break;
        case '/delivery-calculator':
            $('#form-delivery').on('submit', getInfoDelivery);
        break;
        case '/table-product':
            getInfoProduct();
            updateTable();
        break;
        case '/cpu-usage':
            displayGraph();
        case '/spreadsheet':
            displaySpreadsheet();
    };
}

$(document).ready(handler());

