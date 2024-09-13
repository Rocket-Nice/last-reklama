<?php get_header();
/* Template Name: About*/

// Получаем ID главной страницы
$frontPageID = get_option('page_on_front');

$elementsListContact[] = array(
    'coords' => get_field('contact_coordinate', 57), // Получаем координаты точки
    'title' => 'Реклама Центр',
    'address' => get_field('address', 'option')
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

    <section class="aboutUs">
        <div class="container">
            <div class="aboutUs__content">

                <div class="aboutUs__grid">

                    <div class="aboutUs__text">
                        <?= the_content(); ?>
                    </div>

                    <div class="aboutUs__img">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/aboutPage/about.jpg" alt="aboutUs">
                    </div>

                    <div class="aboutUs__text-services">
                        <?= get_field("about_us_blue_text"); ?>
                    </div>

                </div>

                <div class="info__more">

                    <div class="aboutUs__more info__more-block">
                        <h2><?= get_field("dignities_blue_title", $frontPageID); ?></h2>

                        <h3>занимаем второе место по количеству рекламных конструкций в санкт-петербурге</h3>
                    </div>

                    <img src="<?= get_field("dignities_img", $frontPageID); ?>" alt="img" class="info__more-block">

                    <div class="info__more-block">
                        <h2><?= get_field("dignities_year_count", $frontPageID); ?></h2>
                        <p><?= get_field("dignities_year_count_desk", $frontPageID); ?></p>
                    </div>

                    <div class="info__more-block">
                        <h2><?= get_field("dignities_partners_count", $frontPageID); ?></h2>
                        <p><?= get_field("dignities_partners_count_desk", $frontPageID); ?></p>
                    </div>

                </div>

                <div class="info__cards">
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/one.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_first_title", $frontPageID); ?></h2>
                            <?= get_field("dignities_first_subtitle", $frontPageID); ?>
                        </div>
                    </div>
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/two.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_second_title", $frontPageID); ?></h2>
                            <?= get_field("dignities_second_subtitle", $frontPageID); ?>
                        </div>
                    </div>
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/three.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_third_title", $frontPageID); ?></h2>
                            <?= get_field("dignities_third_subtitle", $frontPageID); ?>
                        </div>
                    </div>
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/four.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_fourth_title", $frontPageID); ?></h2>
                            <?= get_field("dignities_fourth_subtitle", $frontPageID); ?>
                        </div>
                    </div>
                </div>

                <div class="aboutUs__company advertisement__company">
                    <h2>нам доверяют</h2>

                    <div class="advertisement__sliders">
                        <div class="advertisement__slider-company">
                            <?php $theyTrustUs = get_field('they_trust_us', 'option');
                            if ($theyTrustUs) :
                                foreach ($theyTrustUs as $key) :
                            ?>
                                    <img src="<?= $key['they_trust_us_logo']; ?>" alt="slide">
                            <?php endforeach;
                            endif; ?>
                        </div>
                        <div class="advertisement__slider-company">
                            <?php $theyTrustUs = get_field('they_trust_us', 'option');
                            if ($theyTrustUs) :
                                foreach ($theyTrustUs as $key) :
                            ?>
                                    <img src="<?= $key['they_trust_us_logo']; ?>" alt="slide">
                            <?php endforeach;
                            endif; ?>
                        </div>
                    </div>
                </div>

                <div class="map">
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

                    <div class="map-block__map" id="map" style="width: 100%; height: 100%; min-height: 505px; border-radius: 30px; overflow:hidden"></div>

                </div>

            </div>
        </div>
    </section>

</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Инициализация списка элементов в зависимости от данных PHP
        let elementsListContact = <?php echo json_encode($elementsListContact); ?>;
        // Определяем начальные координаты центра карты
        let initialCoords1 = elementsListContact.length > 0 ? elementsListContact[0].coords.split(',').map(parseFloat) : [59.938784, 30.314997];

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

        // Вызываем функцию для инициализации карты при загрузке страницы
        initializeMap();
    });
</script>
<?php get_footer(); ?>