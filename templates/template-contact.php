<?php get_header();
/* Template Name: Contact*/

// Добавляем данные каждой записи в массив
$elementsListContact[] = array(
    'coords' => get_field('contact_coordinate'), // Получаем координаты точки
    'title' => 'Реклама Центр',
    'address' => get_field('address', 'option')
);
$elementsListWarehouse[] = array(
    'coords' => get_field('contact_warehouse_coordinate'), // Получаем координаты точки
    'title' => 'Склад',
    'address' => get_field('warehouse_address')
);
?>
<main class="main">
    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>
    <section class="office">
        <div class="container">
            <div class="office__content">

                <div class="map office__map">
                    <div class="map__contact">
                        <h2>контакты</h2>

                        <div class="map__text">
                            <p>
                                <span><?= get_field("graphik_days_first", 'option') ?></span>
                                <span><?= get_field("graphik_hours_first", 'option') ?></span>
                            </p>

                            <p class="map__last">
                                <span><?= get_field("graphik_days_second", 'option') ?></span>
                                <span><?= get_field("graphik_hours_second", 'option') ?></span>
                            </p>

                            <address class="map__address">
                                <span><?= get_field("address", 'option') ?></span>
                            </address>

                            <a class="map__number" href="tel:<?= str_replace([' ', '-', '(', ')'], '', get_field('phone', 'option')) ?>"><?= get_field("phone", 'option') ?></a>
                            <a class="map__email" href="mailto:<?= get_field("email", 'option') ?>"><?= get_field("email", 'option') ?></a>
                        </div>

                    </div>

                    <!-- <img class="map__img" src="<?php //echo get_template_directory_uri(); ?>/assets/img/mainPage/blog/map.jpg" alt="jpg"> -->
                    <div class="office__map-wrapper">
                        <div class="map-page__maps-img map-block__map" id="map" style="width: 100%; height: 100%; border-radius: 30px; overflow:hidden"></div>

                        <div class="indoor__block-map map-block__functions">

                            <div class="map-block__fun">
                                <div class="map-block__scale">
                                    <button><svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 25.5C12 26.3284 12.6716 27 13.5 27C14.3284 27 15 26.3284 15 25.5V15H25.5C26.3284 15 27 14.3284 27 13.5C27 12.6716 26.3284 12 25.5 12H15V1.5C15 0.671574 14.3284 0 13.5 0C12.6716 0 12 0.671574 12 1.5V12H1.5C0.671573 12 0 12.6716 0 13.5C0 14.3284 0.671573 15 1.5 15H12V25.5Z" fill="#00468A" />
                                        </svg></button>
                                    <button><svg width="27" height="3" viewBox="0 0 27 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 1.5H25.5" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                        </svg></button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="office__grid">

                    <div class="office__grid-block">
                        <img src="<?= get_field("advertising_department_img")['url']; ?>" alt="jpg">
                    </div>

                    <div class="office__block office__grid-block">
                        <h3>отдел наружной рекламы</h3>

                        <div class="office__texts">
                            <?php if (get_field("advertising_department_out")) :
                                foreach (get_field("advertising_department_out") as $key) : ?>
                                    <div class="office__text">
                                        <p class="office__name"><?= $key["advertising_department_out_name"]; ?></p>
                                        <p class="office__email">
                                            <?php if ($key["advertising_department_out_number"]) : ?>
                                                <span><?= $key["advertising_department_out_number"] ?></span>
                                            <?php endif; ?>
                                            <a href="mailto:<?= $key["advertising_department_out_email"]; ?>"><?= $key["advertising_department_out_email"]; ?></a>
                                        </p>
                                    </div>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>

                    <div class="office__block office__grid-block">
                        <h3>Отдел indoor рекламы</h3>

                        <div class="office__texts">
                            <?php if (get_field("advertising_department_in")) :
                                foreach (get_field("advertising_department_in") as $key) : ?>
                                    <div class="office__text">
                                        <p class="office__name"><?= $key["advertising_department_in_name"]; ?></p>
                                        <p class="office__email">
                                            <?php if ($key["advertising_department_in_number"]) : ?>
                                                <span><?= $key["advertising_department_in_number"] ?></span>
                                            <?php endif; ?>
                                            <a href="mailto:<?= $key["advertising_department_in_email"]; ?>"><?= $key["advertising_department_in_email"]; ?></a>
                                        </p>
                                    </div>
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>

                <div class="map">
                    <div class="map__contact">
                        <h2>Склад</h2>

                        <div class="map__text">
                            <?= get_field("warehouse_time_days"); ?>

                            <address class="map__address">
                                <?= get_field("warehouse_address"); ?>
                            </address>

                            <div class="map__coordinate">
                                <?= get_field("warehouse_coordinate"); ?>
                            </div>

                            <div class="map__info">
                                <?= get_field("warehouse_info"); ?>
                            </div>
                        </div>

                    </div>

                    <div class="office__map-wrapper">
                        <div class="map-page__maps-img map-block__map" id="map2" style="width: 100%; height: 100%; border-radius: 30px; overflow:hidden"></div>

                        <div class="indoor__block-map map-block__functions">

                            <div class="map-block__fun">
                                <div class="map-block__scale">
                                    <button><svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 25.5C12 26.3284 12.6716 27 13.5 27C14.3284 27 15 26.3284 15 25.5V15H25.5C26.3284 15 27 14.3284 27 13.5C27 12.6716 26.3284 12 25.5 12H15V1.5C15 0.671574 14.3284 0 13.5 0C12.6716 0 12 0.671574 12 1.5V12H1.5C0.671573 12 0 12.6716 0 13.5C0 14.3284 0.671573 15 1.5 15H12V25.5Z" fill="#00468A" />
                                        </svg></button>
                                    <button><svg width="27" height="3" viewBox="0 0 27 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 1.5H25.5" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                        </svg></button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Инициализация списка элементов в зависимости от данных PHP
        let elementsListContact = <?php echo json_encode($elementsListContact); ?>;
        let elementsListWarehouse = <?php echo json_encode($elementsListWarehouse); ?>;
        // Определяем начальные координаты центра карты
        let initialCoords1 = elementsListContact.length > 0 ? elementsListContact[0].coords.split(',').map(parseFloat) : [59.938784, 30.314997];
        let initialCoords2 = elementsListWarehouse.length > 0 ? elementsListWarehouse[0].coords.split(',').map(parseFloat) : [59.938784, 30.314997];

        // Функция для инициализации карты
        function initializeMap() {
            // Ждем, пока API Яндекс.Карт станет доступен
            ymaps.ready(function() {
                // Инициализация карты с центром и начальным уровнем масштабирования
                let map = new ymaps.Map("map", {
                    center: initialCoords1, // Используем координаты первой точки
                    zoom: 14, // Начальный уровень масштабирования
                    controls: [], // Убираем все встроенные элементы управления карты
                    type: 'yandex#map'
                });

                // Массив для хранения меток
                let placemarks = [];

                // Инициализация кластеризатора с заданными параметрами
                let clusterer = new ymaps.Clusterer({
                    clusterIconLayout: 'default#pieChart',
                    clusterIconPieChartRadius: 25,
                    clusterIconPieChartCoreRadius: 15,
                    clusterIconColor: '#ff0000'
                });

                // Функция для добавления пользовательских точек на карту
                function addCustomPoints(customPoints) {
                    // Удаляем все предыдущие метки с карты
                    placemarks.forEach(placemark => map.geoObjects.remove(placemark));
                    placemarks = [];

                    // Добавляем новые метки на карту
                    customPoints.forEach(customPoint => {
                        let placemark = new ymaps.Placemark(customPoint.coords, {
                            balloonContentHeader: `
            <div class="map-block__card">
                <div class="map-block__info">
                    <h2>${customPoint.popup.header}</h2>
                    <div class="map-block__num">
                        <span>${customPoint.popup.body}</span>
                    </div>
                </div>
            </div>`,
                            hintContent: customPoint.popup.header,
                        });

                        // Добавляем метку в массив placemarks
                        placemarks.push(placemark);
                    });

                    // Добавляем метки в кластеризатор и на карту
                    clusterer.add(placemarks);
                    map.geoObjects.add(clusterer);
                }

                // Обработчик события клика на кластер
                clusterer.events.add('click', function(e) {
                    let target = e.get('target');

                    // Проверяем, является ли кликнутый объект кластером
                    if (target.getGeoObjects) {
                        // Если это кластер
                        let geoObjects = target.getGeoObjects();
                        let points = geoObjects.map(geoObject => {
                            let coords = geoObject.geometry.getCoordinates();
                            let properties = geoObject.properties.getAll();
                            return {
                                coords: coords,
                                popup: {
                                    header: properties.balloonContentHeader,
                                    body: properties.balloonContentBody,
                                    description: properties.description,
                                    image: properties.image,
                                    permalink: properties.permalink
                                }
                            };
                        });

                    } else {
                        // Если это одиночная метка
                        let coords = target.geometry.getCoordinates();
                        let properties = target.properties.getAll();
                        let point = {
                            coords: coords,
                            popup: {
                                header: properties.balloonContentHeader,
                                body: properties.balloonContentBody,
                                description: properties.description,
                                image: properties.image,
                                permalink: properties.permalink
                            }
                        };

                        if ([point]) {
                            // Находим все точки, принадлежащие тому же району (description)
                            let districtPoints = elementsListContact.filter(element => ((element.term === point.popup.description) || element.address === point.popup.description)).map(element => ({
                                coords: element.coords.split(',').map(parseFloat),
                                popup: {
                                    // image: element.image,
                                    header: element.title,
                                    body: `Адрес: ${element.address}`,
                                }
                            }));
                        }
                    }
                    // Обработчик клика по координатам в списке
                    clickCoordinateList();
                });

                // Массив для хранения точек
                let customPoints = [];

                // Заполнение массива customPoints данными из elementsListContact
                elementsListContact.forEach(element => {
                    if (element.coords) {
                        let coords = element.coords.split(',').map(parseFloat); // Преобразуем строку с координатами в массив чисел
                        customPoints.push({
                            coords: coords,
                            popup: {
                                // image: element.image,
                                header: element.title,
                                body: `Адрес: ${element.address}`,
                            }
                        });
                    }
                });

                // Обработчик клика на элемент списка
                function clickCoordinateList() {
                    document.querySelectorAll('.map-block__card').forEach(item => {
                        item.addEventListener('click', function() {
                            let coords = this.getAttribute('data-coords').split(',').map(parseFloat);
                            // Устанавливаем центр карты по координатам
                            map.setCenter(coords, 13.5);
                        });
                    });
                }

                clickCoordinateList();

                // Добавление точек на карту
                addCustomPoints(customPoints);

                // Функция для увеличения масштаба карты
                function zoomIn() {
                    let currentZoom = map.getZoom();
                    map.setZoom(currentZoom + 1);
                }

                // Функция для уменьшения масштаба карты
                function zoomOut() {
                    let currentZoom = map.getZoom();
                    map.setZoom(currentZoom - 1);
                }

                // Привязываем функции увеличения и уменьшения масштаба к кнопкам
                document.querySelector('.map-block__scale button:nth-child(1)').addEventListener('click', zoomIn);
                document.querySelector('.map-block__scale button:nth-child(2)').addEventListener('click', zoomOut);

                // Добавляем встроенную кнопку измерения расстояния
                var measureControl = new ymaps.control.RulerControl();
                map.controls.add(measureControl);
            });
        }

        // Функция для инициализации карты
        function initializeWarehouse() {
            // Ждем, пока API Яндекс.Карт станет доступен
            ymaps.ready(function() {
                // Инициализация карты с центром и начальным уровнем масштабирования
                let map = new ymaps.Map("map2", {
                    center: initialCoords2, // Используем координаты первой точки
                    zoom: 14, // Начальный уровень масштабирования
                    controls: [], // Убираем все встроенные элементы управления карты
                    type: 'yandex#map'
                });

                // Массив для хранения меток
                let placemarks = [];

                // Инициализация кластеризатора с заданными параметрами
                let clusterer = new ymaps.Clusterer({
                    clusterIconLayout: 'default#pieChart',
                    clusterIconPieChartRadius: 25,
                    clusterIconPieChartCoreRadius: 15,
                    clusterIconColor: '#ff0000'
                });

                // Функция для добавления пользовательских точек на карту
                function addCustomPoints(customPoints) {
                    // Удаляем все предыдущие метки с карты
                    placemarks.forEach(placemark => map.geoObjects.remove(placemark));
                    placemarks = [];

                    // Добавляем новые метки на карту
                    customPoints.forEach(customPoint => {
                        let placemark = new ymaps.Placemark(customPoint.coords, {
                            balloonContentHeader: `
            <div class="map-block__card">
                <div class="map-block__info">
                    <h2>${customPoint.popup.header}</h2>
                    <div class="map-block__num">
                        <span>${customPoint.popup.body}</span>
                    </div>
                </div>
            </div>`,
                            hintContent: customPoint.popup.header,
                        });

                        // Добавляем метку в массив placemarks
                        placemarks.push(placemark);
                    });

                    // Добавляем метки в кластеризатор и на карту
                    clusterer.add(placemarks);
                    map.geoObjects.add(clusterer);
                }

                // Обработчик события клика на кластер
                clusterer.events.add('click', function(e) {
                    let target = e.get('target');

                    // Проверяем, является ли кликнутый объект кластером
                    if (target.getGeoObjects) {
                        // Если это кластер
                        let geoObjects = target.getGeoObjects();
                        let points = geoObjects.map(geoObject => {
                            let coords = geoObject.geometry.getCoordinates();
                            let properties = geoObject.properties.getAll();
                            return {
                                coords: coords,
                                popup: {
                                    header: properties.balloonContentHeader,
                                    body: properties.balloonContentBody,
                                    description: properties.description,
                                    image: properties.image,
                                    permalink: properties.permalink
                                }
                            };
                        });

                    } else {
                        // Если это одиночная метка
                        let coords = target.geometry.getCoordinates();
                        let properties = target.properties.getAll();
                        let point = {
                            coords: coords,
                            popup: {
                                header: properties.balloonContentHeader,
                                body: properties.balloonContentBody,
                                description: properties.description,
                                image: properties.image,
                                permalink: properties.permalink
                            }
                        };

                        if ([point]) {
                            // Находим все точки, принадлежащие тому же району (description)
                            let districtPoints = elementsListWarehouse.filter(element => ((element.term === point.popup.description) || element.address === point.popup.description)).map(element => ({
                                coords: element.coords.split(',').map(parseFloat),
                                popup: {
                                    header: element.title,
                                    body: `Адрес: ${element.address}`,
                                }
                            }));
                        }
                    }
                    // Обработчик клика по координатам в списке
                    clickCoordinateList();
                });

                // Массив для хранения точек
                let customPoints = [];

                // Заполнение массива customPoints данными из elementsListWarehouse
                elementsListWarehouse.forEach(element => {
                    if (element.coords) {
                        let coords = element.coords.split(',').map(parseFloat); // Преобразуем строку с координатами в массив чисел
                        customPoints.push({
                            coords: coords,
                            popup: {
                                header: element.title,
                                body: `Адрес: ${element.address}`,
                            }
                        });
                    }
                });

                // Обработчик клика на элемент списка
                function clickCoordinateList() {
                    document.querySelectorAll('.map-block__card').forEach(item => {
                        item.addEventListener('click', function() {
                            let coords = this.getAttribute('data-coords').split(',').map(parseFloat);
                            // Устанавливаем центр карты по координатам
                            map.setCenter(coords, 13.5);
                        });
                    });
                }

                clickCoordinateList();

                // Добавление точек на карту
                addCustomPoints(customPoints);

                // Функция для увеличения масштаба карты
                function zoomIn() {
                    let currentZoom = map.getZoom();
                    map.setZoom(currentZoom + 1);
                }

                // Функция для уменьшения масштаба карты
                function zoomOut() {
                    let currentZoom = map.getZoom();
                    map.setZoom(currentZoom - 1);
                }

                // Привязываем функции увеличения и уменьшения масштаба к кнопкам
                document.querySelector('.map-block__scale button:nth-child(1)').addEventListener('click', zoomIn);
                document.querySelector('.map-block__scale button:nth-child(2)').addEventListener('click', zoomOut);

                // Добавляем встроенную кнопку измерения расстояния
                var measureControl = new ymaps.control.RulerControl();
                map.controls.add(measureControl);
            });
        }

        // Вызываем функцию для инициализации карты при загрузке страницы
        initializeMap();
        initializeWarehouse();
    });
</script>
<?php get_footer(); ?>