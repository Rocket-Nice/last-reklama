<?php get_header();
$post_id = get_the_ID();

// Добавляем данные каждой записи в массив
$elementsList[] = array(
    'coords' => get_field('indoor_coordinate'), // Получаем координаты точки
    'title' => get_the_title(), // Получаем заголовок записи
    'image' => get_the_post_thumbnail_url(), // Получаем URL изображения записи
    'timeWork' => get_field('indoor_time_work'), // Получаем рабочее время
    'typeUp' => get_field('indoor_type_up'), // Получаем тип поверхности
);
?>
<main class="main">
    <div class="container">
        <nav class="navigation-page">
            <?php
            if (is_singular('indoor')) {
                echo '<div class="breadcrumbs">';
                echo '<span>';
                echo '<span><a href="' . home_url('/') . '">Главная</a></span> / ';
                echo '<span><a href="' . home_url('/uslugi') . '">Услуги</a></span> / ';
                echo '<span><a href="' . home_url('/indoor') . '">indoor</a></span> / ';
                echo '<span class="breadcrumb_last" aria-current="page">' . the_title() . '</span>';
                echo '</span>';
                echo '</div>';
            } else {
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
                }
            }
            ?>
        </nav>
    </div>
    <section class="construction">
        <div class="container">
            <div class="construction__content">
                <div class="construction__grid">
                    <div class="construction__block">
                        <h1><?= the_title(); ?></h1>

                        <div class="construction__text">
                            <?= the_content(); ?>
                        </div>
                    </div>

                    <div class="construction__img">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>Адрес:</dt>
                            <dd><?php
                                $term = get_term(get_the_terms(get_the_ID(), 'map_street')[0]);
                                echo $term->name;
                                ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>время работы:</dt>
                            <dd><?= get_field("indoor_time_work"); ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>наши конструкции:</dt>
                            <dd><?= get_field("indoor_our_construction"); ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>Тип поверхностей:</dt>
                            <dd><?= get_field("indoor_type_up"); ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>Метро:</dt>
                            <dd><?= get_field("indoor_metro"); ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>площадь объекта:</dt>
                            <dd><?= get_field("indoor_square_circle"); ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>общий охват объекта:</dt>
                            <dd><?= get_field("indoor_main_ob_obj"); ?></dd>
                        </dl>
                    </div>

                    <div class="construction__mini-block">
                        <dl>
                            <dt>рейтинг яндекс:</dt>
                            <dd><?= get_field("indoor_raiting_yandex"); ?></dd>
                        </dl>
                    </div>
                </div>

                <div class="single-page-map">
                    <div class="map-block__maps">

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

                <div class="container-elements-offer">
                    <?php
                    if (get_field("construction_elements")) :
                        foreach (get_field("construction_elements") as $index => $key) :
                    ?>
                            <div class="slider-info">
                                <div class="slider-info__title">
                                    <h3><?= $key["indoor_con_title_up"]; ?></h3>

                                    <!-- <div class="slider-info__btns">
                                        <button class="slider-info__next">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="10" fill="none" viewBox="0 0 50 10">
                                                <path fill="#00468A" d="M0 5 7.5.67v8.66L0 5Zm50 .75H6.75v-1.5H50v1.5Z" />
                                            </svg>
                                        </button>
                                        <button class="slider-info__prev">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="10" fill="none" viewBox="0 0 50 10">
                                                <path fill="#00468A" d="M50 5 42.5.67v8.66L50 5ZM0 5.75h43.25v-1.5H0v1.5Z" />
                                            </svg>
                                        </button>
                                    </div> -->
                                </div>


                                <div class="slider-info__container">
                                    <div class="slider-info__text-block">
                                        <dl class="not-vissible">
                                            <dt>Адрес:</dt>
                                            <dd><?php
                                                $term = get_term(get_the_terms(get_the_ID(), 'map_street')[0]);
                                                echo $term->name;
                                                ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>Расположение:</dt>
                                            <dd><?= $key["indoor_con_location"]; ?></dd>
                                        </dl>

                                        <dl>
                                            <dt>размеры:</dt>
                                            <dd><?= $key['construction_first_razmer']; ?></dd>
                                        </dl>

                                        <dl>
                                            <dt>рекламный блок:</dt>
                                            <dd><?= $key['construction_first_rek_block']; ?></dd>
                                        </dl>

                                        <dl>
                                            <dt>хронометраж ролика:</dt>
                                            <dd><?= $key['construction_first_hron_rol']; ?></dd>
                                        </dl>

                                        <dl>
                                            <dt>количество показов в блоке:</dt>
                                            <dd><?= $key['construction_first_count_see_block']; ?></dd>
                                        </dl>

                                        <dl>
                                            <dt>количество показов в день:</dt>
                                            <dd><?= $key['construction_first_count_see_day']; ?></dd>
                                        </dl>

                                        <div class="indoor_price">
                                            <?= $key['indoor_con_first_price']; ?>
                                        </div>

                                        <?php if ( ! empty( $key['construction_first_tt'] ) ) : ?>
                                            <a href="<?php echo esc_url($key['construction_first_tt']); ?>" class="btn-outline btn-indoor" target="_blank">
                                                <span>технические требования</span>
                                                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M22.7778 15.5V23.2778H7.22222V15.5H5V23.2778C5 24.5 6 25.5 7.22222 25.5H22.7778C24 25.5 25 24.5 25 23.2778V15.5H22.7778ZM16.1111 16.2444L18.9889 13.3778L20.5556 14.9444L15 20.5L9.44444 14.9444L11.0111 13.3778L13.8889 16.2444V5.5H16.1111V16.2444Z"/>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        <button class="slider-info__button-b home__button add_to_cart" data-link="<?php echo esc_url(get_permalink($post_id)); ?>" data-product_id="<?php echo get_the_ID(); ?>" data-construction="<?= $index + 1; ?>"><span>в корзину конструкцию <?= $index + 1; ?></span><span></span></button>

                                    </div>
                                    <div class="slider-info__slider">
                                        <div class="swiper-wrapper">
                                            <?php if ($key['construction_first_example_img']) :
                                                foreach ($key['construction_first_example_img'] as $keyx) : ?>
                                                    <div class="slider-info__slide swiper-slide">
                                                        <div class="slider-info__slide-img">
                                                            <img src="<?= $keyx; ?>" alt="jpg">
                                                        </div>
                                                    </div>
                                            <?php endforeach;
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="slider-info__pag"></div>
                                </div>
                            </div>
                            <div class="construction__constract">
                                <h2><?= $key["indoor_con_title_down"]; ?></h2>

                                <div class="construction__object">
                                    <img src="<?= $key['construction_first_img']; ?>" alt="jpg">
                                </div>
                            </div>
                    <?php endforeach;
                    endif; ?>
                </div>

                <div class="construction__cards-block">
                    <h2>indoor-объекты рядом</h2>

                    <div class="construction__cards">
                        <?php

                        if (have_rows('indoor_object_select_list')) :
                            while (have_rows('indoor_object_select_list')) : the_row();
                                $post_object = get_sub_field('indoor_object_select');

                                if ($post_object) :

                                    // Перезаписать $post
                                    $post = $post_object;
                                    setup_postdata($post);
                        ?>
                                    <div class="construction__top indoor__card">
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="card">

                                        <div class="indoor__info">
                                            <h3><?php the_title(); ?></h3>
                                            <div class="indoor__list">
                                                <span><?php
                                                        $term = get_term(get_the_terms(get_the_ID(), 'map_street')[0]);
                                                        echo $term->name;
                                                        ?></span>
                                                <span>Охват: <?php the_field('indoor_main_ob_obj'); ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="indoor__button-b home__button"><span>подробнее</span><span></span></a>
                                        </div>
                                    </div>
                        <?php
                                    wp_reset_postdata();
                                endif;

                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
    </section>

</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Инициализация списка элементов в зависимости от данных PHP
        let elementsList = <?php echo json_encode($elementsList); ?>;
        // Определяем начальные координаты центра карты
        let initialCoords = elementsList.length > 0 ? elementsList[0].coords.split(',').map(parseFloat) : [59.938784, 30.314997];

        // Функция для инициализации карты
        function initializeMap() {
            // Ждем, пока API Яндекс.Карт станет доступен
            ymaps.ready(function() {
                // Инициализация карты с центром и начальным уровнем масштабирования
                let map = new ymaps.Map("map", {
                    center: initialCoords, // Используем координаты первой точки
                    zoom: 12, // Начальный уровень масштабирования
                    controls: [], // Убираем все встроенные элементы управления карты
                    type: 'yandex#map'
                });

                // Массив для хранения меток
                let placemarks = [];

                // Создаем собственный макет с информацией о выбранном геообъекте.
                let customBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
                        '<ul class=list>',
                        // Выводим в цикле список всех геообъектов.
                        '{% for geoObject in properties.geoObjects %}',
                            '<li><a href=# data-placemarkid="{{ geoObject.properties.placemarkId }}" class="list_item">{{ geoObject.properties.balloonContentHeader|raw }}</a></li>',
                        '{% endfor %}',
                        '</ul>'
                ].join(''));

                // Инициализация кластеризатора с заданными параметрами
                let clusterer = new ymaps.Clusterer({
                    clusterIconLayout: 'default#pieChart',
                    clusterIconPieChartRadius: 25,
                    clusterIconPieChartCoreRadius: 15,
                    clusterIconColor: '#ff0000',
                    clusterBalloonMaxHeight: 200,
                    clusterBalloonMaxWidth: 500,
                    // Устанавливаем собственный макет контента балуна.
                    clusterBalloonContentLayout: customBalloonContentLayout
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
                <img src="${customPoint.popup.image}" alt="img">
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
                            let districtPoints = elementsList.filter(element => ((element.term === point.popup.description) || element.address === point.popup.description)).map(element => ({
                                coords: element.coords.split(',').map(parseFloat),
                                popup: {
                                    image: element.image,
                                    header: element.title,
                                    body: `Рабочее время: ${element.timeWork}<br>Тип поверхности: ${element.typeUp}`,
                                    description: element.address,
                                    permalink: element.permalink
                                }
                            }));
                        }
                    }
                    // Обработчик клика по координатам в списке
                    clickCoordinateList();
                });

                // Массив для хранения точек
                let customPoints = [];

                // Заполнение массива customPoints данными из elementsList
                elementsList.forEach(element => {
                    if (element.coords) {
                        let coords = element.coords.split(',').map(parseFloat); // Преобразуем строку с координатами в массив чисел
                        customPoints.push({
                            coords: coords,
                            popup: {
                                image: element.image,
                                header: element.title,
                                body: `Рабочее время: ${element.timeWork}<br>Тип поверхности: ${element.typeUp}`,
                                description: element.address,
                                permalink: element.permalink,
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