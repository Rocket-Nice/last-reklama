<?php get_header();
$post_id = get_the_ID();

// Добавляем данные каждой записи в массив
$elementsList[] = array(
  'coords' => get_field('outdoor_coordinate'),
  'title' => get_the_title(),
  'image' => get_the_post_thumbnail_url(),
  'grp' => get_field('outdoor_side_a_grp_surface_rating'),
  'ots' => get_field('outdoor_side_a_effective_ots_audience'),
);
?>
<main class="main">
  <div class="container">
    <nav class="navigation-page">
      <?php
      if (is_singular('outdoor')) {
        echo '<div class="breadcrumbs">';
        echo '<span>';
        echo '<span><a href="' . home_url('/') . '">Главная</a></span> / ';
        echo '<span><a href="' . home_url('/uslugi') . '">Услуги</a></span> / ';
        echo '<span><a href="' . home_url('/uslugi/outdoor') . '">outdoor</a></span> / ';
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
  <section class="structure">
    <div class="container">
      <div class="structure__content">

        <div class="structure__blocks">
          <div class="structure__block">
            <h1><?= the_title(); ?></h1>

            <div class="structure__param">
              <dl>
                <dt>Район:</dt>
                <dd>
                  <?php
                  $term = get_term(get_the_terms(get_the_ID(), 'map_outdoor_district')[0]);
                  echo $term->name;
                  ?>
                </dd>
              </dl>

              <dl>
                <dt>Координаты:</dt>
                <dd><?= get_field("outdoor_coordinate"); ?></dd>
              </dl>

              <dl>
                <dt>Направление:</dt>
                <dd><?= get_field("outdoor_direction"); ?></dd>
              </dl>

              <dl>
                <dt>Идентификационный номер:</dt>
                <dd><?= get_field("outdoor_id"); ?></dd>
              </dl>
            </div>
          </div>

          <div class="structure__img">
            <?php if (has_post_thumbnail()) : ?>
              <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">
            <?php else : ?>
              <?php
              if (get_field("outdoor_elements_offer")) :
                foreach (get_field("outdoor_elements_offer") as $key) :
                  if (isset($key['outdoor_side_a_img_example']) && is_array($key['outdoor_side_a_img_example'])) :
                    $first_img = reset($key['outdoor_side_a_img_example']);
              ?>
                    <img src="<?= esc_url($first_img); ?>" alt="slide">
              <?php
                    break;
                  endif;
                endforeach;
              endif;
              ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="single-page-map">
          <div class="map-block__maps">
            <div class="loader"></div>
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
          if (get_field("outdoor_elements_offer")) :
            foreach (get_field("outdoor_elements_offer") as $key) :
          ?>
              <div class="structure__map">
                <h2>Сторона <?= $key['outdoor_side_a_side']; ?></h2>
                <div class="slider-info__slide structure__slide">
                  <div class="slider-info__text-block structure__text-block">
                    <dl>
                      <dt>Размер:</dt>
                      <dd><?= $key['outdoor_side_a_format']; ?></dd>
                    </dl>

                    <dl>
                      <dt>Район:</dt>
                      <dd><?php
                          $term = get_term(get_the_terms(get_the_ID(), 'map_outdoor_district')[0]);
                          echo $term->name;
                          ?></dd>
                    </dl>
                    <dl>
                      <dt>Формат:</dt>
                      <dd><?php
                          $term = get_term(get_the_terms(get_the_ID(), 'map_format_type')[0]);
                          echo $term->name;
                          ?></dd>
                    </dl>
                    <dl>
                      <dt>GID:</dt>
                      <dd><?= $key['outdoor_side_a_gid']; ?></dd>
                    </dl>

                    <dl>
                      <dt>Освещение:</dt>
                      <dd><?= $key['outdoor_side_a_type_of_surfa']; ?></dd>
                    </dl>

                    <dl>
                      <dt>Ограничение:</dt>
                      <dd><?= $key['outdoor_side_a_limitation']; ?></dd>
                    </dl>

                    <dl>
                      <dt>Рейтинг поверхности GRP:</dt>
                      <dd>
                        <span><?= $key['outdoor_side_a_grp_surface_rating']; ?></span>

                        <span class="structure__svg">
                          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" fill="none" viewBox="0 0 15 16">
                            <circle cx="7.5" cy="8" r="7.5" fill="#00468A" />
                            <path fill="#F7F7F7" d="M8.155 9.655h-1.31L6.572 3.5h1.842l-.26 6.155Zm.043 2.58a1.034 1.034 0 0 1-.705.265c-.269 0-.504-.089-.705-.266a.88.88 0 0 1-.288-.651c0-.257.096-.474.288-.652.201-.186.436-.279.705-.279.268 0 .503.093.705.28a.835.835 0 0 1 .302.65.86.86 0 0 1-.302.652Z" />
                          </svg>
                        </span>

                        <div class="structure__info-text">
                          <p>Рейтинг поверхности GRP — это суммарный рейтинг, который показывает общее количество контактов аудитории с событием.</p>
                          <p> Показывает процент населения, который был подвергнут рекламному воздействию. Считается методом суммирования рейтингов каждого показа.</p>
                        </div>
                      </dd>
                    </dl>

                    <dl>
                      <dt>Эффективная аудитория OTS:</dt>
                      <dd>
                        <span><?= $key['outdoor_side_a_effective_ots_audience']; ?></span>

                        <span class="structure__svg">
                          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" fill="none" viewBox="0 0 15 16">
                            <circle cx="7.5" cy="8" r="7.5" fill="#00468A" />
                            <path fill="#F7F7F7" d="M8.155 9.655h-1.31L6.572 3.5h1.842l-.26 6.155Zm.043 2.58a1.034 1.034 0 0 1-.705.265c-.269 0-.504-.089-.705-.266a.88.88 0 0 1-.288-.651c0-.257.096-.474.288-.652.201-.186.436-.279.705-.279.268 0 .503.093.705.28a.835.835 0 0 1 .302.65.86.86 0 0 1-.302.652Z" />
                          </svg>
                        </span>

                        <div class="structure__info-text">
                          <p>Рейтинг поверхности GRP — это суммарный рейтинг, который показывает общее количество контактов аудитории с событием.</p>
                          <p> Показывает процент населения, который был подвергнут рекламному воздействию. Считается методом суммирования рейтингов каждого показа.</p>
                        </div>
                      </dd>
                    </dl>

                    <button class="slider-info__button-a home__button add_to_cart" data-link="<?php echo esc_url(get_permalink($post_id)); ?>" data-product_id="<?php echo get_the_ID(); ?>" data-side="<?= $key['outdoor_side_a_side']; ?>"><span>В корзину сторону <?= $key['outdoor_side_a_side']; ?></span><span></span></button>
                  </div>

                  <div class="slider-info__slide-img">
                    <img src="<?= $key['outdoor_side_a_img']; ?>" alt="jpg">
                  </div>

                  <div class="outdoor_price">
                    <?= $key['outdoor_side_a_price']; ?>
                  </div>
                </div>
              </div>

              <div class="example">
                <h2>примеры готовых решений <br> на стороне <?= $key['outdoor_side_a_side']; ?></h2>

                <div class="example__sliders">

                  <div class="swiper-wrapper">
                    <?php if ($key['outdoor_side_a_img_example']) :
                      foreach ($key['outdoor_side_a_img_example'] as $img) : ?>
                        <img src="<?= $img; ?>" alt="slide" class="swiper-slide">
                    <?php endforeach;
                    endif; ?>
                  </div>

                  <div class="example__pagination"></div>

                </div>
              </div>
          <?php endforeach;
          endif; ?>
        </div>
        <div class="construction__cards-block">
          <h2>конструкции рядом</h2>

          <div class="construction__cards">
            <?php
            $terms = wp_get_post_terms(get_the_ID(), 'map_outdoor_district');
            $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';

            $listQueryArgs = array(
              'post_type'      => 'outdoor',
              'posts_per_page' => 3,
              'orderby'        => 'date',
              'order'          => 'ASC',
              'tax_query'      => array(
                array(
                  'taxonomy' => 'map_outdoor_district',
                  'field'    => 'name',
                  'terms'    => $term_name,
                  'operator' => 'IN',
                ),
              ),
              'post__not_in'   => array($post_id),
            );

            $listQuery = new WP_Query($listQueryArgs);

            if ($listQuery->have_posts()) :
              while ($listQuery->have_posts()) :
                $listQuery->the_post();
            ?>
                <div class="construction__top indoor__card">
                  <?php if (the_post_thumbnail_url()) { ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="card">
                    <?php } else {
                    if (get_field("outdoor_elements_offer")) :
                      foreach (get_field("outdoor_elements_offer") as $key) :
                        if (isset($key['outdoor_side_a_img_example']) && is_array($key['outdoor_side_a_img_example'])) :
                          $first_img = reset($key['outdoor_side_a_img_example']);
                    ?>
                          <img src="<?= esc_url($first_img); ?>" alt="card">
                  <?php
                          break;
                        endif;
                      endforeach;
                    endif;
                  }
                  ?>
                  <div class="indoor__info">
                    <h3><?php the_title(); ?></h3>
                    <div class="indoor__list">
                      <span><?php echo $term_name ?></span>
                      <span>Направление: <?php echo get_field('outdoor_direction'); ?></span>
                      <span>ID: <?php echo get_field('outdoor_id'); ?></span>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="indoor__button-b home__button">
                      <span>подробнее</span><span></span>
                    </a>
                  </div>
                </div>
            <?php
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </div>

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
        // let customBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
        //         '<ul class=list>',
        //         // Выводим в цикле список всех геообъектов.
        //         '{% for geoObject in properties.geoObjects %}',
        //             '<li><a href=# data-placemarkid="{{ geoObject.properties.placemarkId }}" class="list_item">{{ geoObject.properties.balloonContentHeader|raw }}</a></li>',
        //         '{% endfor %}',
        //         '</ul>'
        // ].join(''));

        // Инициализация кластеризатора с заданными параметрами
        let clusterer = new ymaps.Clusterer({
          clusterIconLayout: 'default#pieChart',
          clusterIconPieChartRadius: 25,
          clusterIconPieChartCoreRadius: 15,
          clusterIconColor: '#ff0000',
          // clusterBalloonMaxHeight: 200,
          // clusterBalloonMaxWidth: 500,
          // // Устанавливаем собственный макет контента балуна.
          // clusterBalloonContentLayout: customBalloonContentLayout
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
                </div>
                <img src="${customPoint.popup.image}" alt="img">
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
                  image: properties.image,
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
                image: properties.image,
              }
            };

            if ([point]) {
              // Находим все точки, принадлежащие тому же району (description)
              let districtPoints = elementsList.filter(element => ((element.term === point.popup.description) || element.address === point.popup.description)).map(element => ({
                coords: element.coords.split(',').map(parseFloat),
                popup: {
                  image: element.image,
                  header: element.title,
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
                image: element.image ? element.image : element.firstgallery,
                header: element.title,
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