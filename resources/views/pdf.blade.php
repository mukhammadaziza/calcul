<?php 

$metadata = array_pop($storedValuesArray);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фунфилмент Москва м.Каширское - склад-bot.ru</title>
    <style>
      
        
        body {
            font-family: "DejaVu Sans", sans-serif;
            padding: 0;
        }

        table{
            width: 100%;
        }

        .date{
            text-align: right;
        }

        .head-table tr{
            text-align: center;
            font-size: 28px;
            color: #5670fd;
        }

        .service-table td{
            vertical-align: top;
            font-size: 12px;
            border-left: 1px solid;
            padding-left: 4px;
        }
        .service-table span{
            font-weight: bold;
            font-size: 24px;
        }

        .main-info span{
            font-weight: bold;
        }
        
        .product-cost caption{
            color: #5670fd;
            text-align: center;
            font-size: 28px;
        }

        .footer-section span, caption{
            font-weight: bold;
            font-size: 24px;
        }

        .footer-section table{
            border-top: 1px solid;
            border-bottom: 1px solid;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="date">{{ $generated_date }}</div>
    {{ $loading_unloading_service_price }}
    <table class="head-table">
        <tr>
            <td>
                <img src="/resources/views/skladbot.svg">
            </td>
            <td>
               Фулфилмент Москва м.Каширское
            </td>
        </tr>
    </table>


    <table class="service-table">
        <tr>
            <td>
                <span>Услуги</span>  <br>
                Фулфилмент <br>
                Забор товара у поставщика <br>
                Закупка и доставка из Китая <br>
                Продвижение на маркетплейсах <br>
                Контент для маркетплейсов <br>
            </td>
            <td>
                <span>Время работы </span><br>
                Склад: пн-сб 10-19 <br>
                Отдел продаж: пн-сб 10-19 <br>
                Менеджер проекта: пн-вс 9-21 
            </td>
            <td>
                <span>Контакты</span>  <br>
                Каширское шоссе, 13Б <br> 
                стр 1, 8 (495) 776-00-75 <br>
                Ваш Менеджер: Игорь Власов <br>
                Тел: +79267776752 <br>
                Email: Info@skladbot.ru
                
            </td>
        </tr>
    </table>

    <div class="main-info">
        <h2>Почему выбирают нас?</h2>
        <p>
            <span>В топ 20 лучших фунфилментов</span> <br>
            Сервис WMS входит в <a href="https://skladbot.ru">топ 20 лучших фунфилментов Москвы</a> по версии iналёта и других изданий в сфере электронной коммерции. А наша WMS входит в <a href="https://skladbot.ru">рейтинг лучших складских России</a>.
            Система подготовки автоматизирована с помощью Wildberries. Мы принимаем товары прямо на склад с <a href="https://skladbot.ru">таких маркетплейсов как Wildberries OZON</a>
        </p>
        <p>
            <span>Автоматизированный склад</span> <br>
            Мы работаем в собственной системе автоматизации app.kladbot.ru. У вас будет личный кабинет, где вы сможете следить за товарам и работой в реальном времени.
        </p>
        <p>
            <span>Материальная ответственность</span> <br>
            Ваши товары находятся под круглосуточной охраной.
        </p>
    </div>

    <div class="product-info">
        <table  border="1" cellpadding="2" cellspacing="0">
            <caption>Прайслист расчитан из следущих характеристик товара</caption>
            <tr style="color: white; background-color: #5670fd">
                <th>Количество</th>
                <th>Сумма 3х сторон</th>
                <th>Общий обьем в кубах</th>
            </tr>
            <tr>
                <td>{{ $metadata['numberOfUnits'] ?? '' }}</td>
                <td>{{ $metadata['sumOfSides'] ?? '' }}</td>
                <td>{{ $metadata['volume'] ?? '' }}</td>
            </tr>
            
        </table>
    </div>
    

    <div class="product-cost">
        <table border="1" cellpadding="2" cellspacing="0">
            <caption>Расчет стоимости</caption>
            <tr style="color: white; background-color: #5670fd">
                <th>Вид услуги</th>
                <th>Кол-во</th>
                <th>Стоимость</th>
                <th>Сумма</th>
            </tr>
            @foreach ($storedValuesArray as $item)
                <tr>
                    <td>{{ $item['name'] ?? '' }}</td>
                    <td>{{ $item['units'] ?? '' }}</td>
                    <td>{{ $item['price'] ?? '' }}</td>
                    <td>{{ $item['summ'] ?? '' }}</td>
                </tr>
            @endforeach
        </table>

        <table border="1" cellpadding="2" cellspacing="0">
            <caption>Сумма по услугам</caption>
            <tr style="color: white; background-color: #5670fd">
                <th>Вид услуги</th>
                <th>Цена</th>
                <th>Скидка</th>
                <th>После скидки</th>
            </tr>
            @foreach ($workTypesArray as $item)
                <tr>
                    <td>{{ $item['name'] ?? '' }}</td>
                    <td>{{ $item['summ'] ?? '' }}</td>
                    <td>{{ $item['discount'] ?? '' }}</td>
                    <td>{{ $item['summAfterDiscount'] ?? '' }}</td>
                </tr>
            @endforeach

            
            <tr style="font-weight: bold;">
                <td>Сумма итог</td>
                <td>{{ $WorkTypesBeforeDiscount }}</td>
                <td></td>
                <td>{{ $WorkTypesAfterDiscount }}</td>
            </tr>

        </table>
    </div>

    <div class="footer-section">
        <p>
            <span>Средняя оценка нашей работы — 4,7</span> <br>
            С большинством клиентов мы работаем 2+ года
        </p>

        <table>
            <caption>Как строится работа после подписания договора?</caption>
            <tr>
                <td>
                    <p>Регистрация в системе автоматизации</p>
                </td>
                <td>
                    <p>Добавление API маркетплейсов</p>
                </td>
                <td>
                    <p>Создание личных чатов WMS</p>
                </td>
                <td>
                    <p>Отправка к дальнейшим клиентам</p>
                </td>
                <td>
                    <p>Работа с возвратами</p>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
