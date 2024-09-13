<?php get_header();
/* Template Name: Outdoor*/
?>
<main class="main">

  <div class="container">
    <nav class="navigation-page">
      <?php
      if (is_post_type_archive('outdoor')) {
        echo '<div class="breadcrumbs">';
        echo '<span>';
        echo '<span><a href="' . home_url('/') . '">Главная</a></span> / ';
        echo '<span><a href="' . home_url('/uslugi') . '">Услуги</a></span> / ';
        echo '<span class="breadcrumb_last" aria-current="page">outdoor</span>';
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

  <section class="advertising">
    <div class="container">
      <div class="advertising__content">

        <div class="advertising__grid">

          <div class="advertising__info">
            <h2><?php
                // $page_id = 61;
                // $post = get_post($page_id);
                // echo apply_filters('the_title', $post->post_title);
                the_title();
                ?></h2>
            <?php
            // echo apply_filters('the_content', $post->post_content); 
            // wp_reset_postdata();
            the_content();
            ?>

          </div>

          <div class="advertising__img">
            <img src="<?= get_field("outdoor_main_bg"); ?>" alt="advertising">
          </div>

          <div class="advertising__services">
            <h2>В услугу размещения наружной рекламы входит:</h2>

            <?= get_field("what_in_usl_razm"); ?>
          </div>

          <div class="advertising__day advertising__day-one">
            <h2><?= get_field("count_days_what_first_block"); ?></h2>
            <p><?= get_field("count_days_what_first"); ?></p>
          </div>

          <div class="advertising__day advertising__day-two">
            <h2><?= get_field("count_days_what_second_block"); ?></h2>
            <p><?= get_field("count_days_what_second"); ?></p>
          </div>

        </div>

        <div class="example">
          <h2>примеры готовых <br> рекламных решений</h2>

          <div class="example__sliders">

            <div class="swiper-wrapper">
              <?php $exampleRek = get_field('example_rek_contr', 'option');
              if ($exampleRek) :
                foreach ($exampleRek as $key) :
              ?>
                  <img src="<?= $key; ?>" alt="slide" class="swiper-slide">
              <?php endforeach;
              endif; ?>
            </div>

            <div class="example__pagination"></div>

          </div>
        </div>

        <div class="advertising__map-block map-block__content">

          <div class="map-block__filter-main">
            <div class="map-block__filter">

              <div class="map-block__top">
                <h3>фильтр</h3>
                <button><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.954636 17.9512C0.367987 18.5378 0.367986 19.489 0.954636 20.0756C1.54129 20.6623 2.49243 20.6623 3.07908 20.0756L10.5146 12.6401L17.9502 20.0756C18.5369 20.6623 19.488 20.6623 20.0747 20.0756C20.6613 19.489 20.6613 18.5378 20.0747 17.9512L12.6391 10.5156L20.0747 3.08006C20.6613 2.49341 20.6613 1.54226 20.0747 0.955612C19.488 0.368962 18.5369 0.368963 17.9502 0.955612L10.5146 8.39118L3.07908 0.955612C2.49243 0.368963 1.54129 0.368962 0.954636 0.955612C0.367986 1.54226 0.367986 2.49341 0.954636 3.08006L8.3902 10.5156L0.954636 17.9512Z" fill="#878787" />
                  </svg></button>
              </div>

              <div class="map-block__main" data-simplebar>

                <div class="map-block__direction">
                  <h4>Направление:</h4>
                  <div class="map-block__points">
                    <label class="map-block__point">
                      <input type="radio" name="direction" id="dir1" value="outdoor" checked>
                      <span></span>
                      Outdoor
                    </label>
                  </div>
                </div>

                <div class="map-block__choices format">
                  <h4>Формат</h4>

                  <div class="map-block__choice">
                    <button class="map-block__choice-button">Выберите формат конструкции</button>
                    <div class="map-block__choice-content">
                      <?php
                      $map_format_types = get_terms(array(
                        'taxonomy' => 'map_format_type',
                        'hide_empty' => false,
                      ));

                      if (!empty($map_format_types) && !is_wp_error($map_format_types)) : ?>
                        <?php foreach ($map_format_types as $map_format_type) : ?>
                          <label class="map-block__point">
                            <input type="checkbox" value="<?php echo esc_html($map_format_type->name); ?>">
                            <span></span>
                            <?php echo esc_html($map_format_type->name); ?>
                          </label>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="map-block__id">
                  <h4>id</h4>

                  <input type="text" placeholder="Введите ID">
                </div>

                <div class="map-block__choices rajon">
                  <h4>Район</h4>

                  <div class="map-block__choice">
                    <button class="map-block__choice-button">Выберите район конструкции</button>
                    <div class="map-block__choice-content">
                      <?php
                      $map_district_types = get_terms(array(
                        'taxonomy' => 'map_outdoor_district',
                        'hide_empty' => false,
                      ));

                      if (!empty($map_district_types) && !is_wp_error($map_district_types)) : ?>
                        <?php foreach ($map_district_types as $map_dis_type) : ?>
                          <label class="map-block__point">
                            <input type="checkbox" value="<?php echo esc_html($map_dis_type->name); ?>">
                            <span></span>
                            <?php echo esc_html($map_dis_type->name); ?>
                          </label>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="map-block__choices raspolozhenie" style="display: none;">
                  <h4>Расположение</h4>

                  <div class="map-block__choice">
                    <button class="map-block__choice-button">Выберите расположение</button>
                    <div class="map-block__choice-content">
                      <?php
                      $outdoorLocation = get_terms(array(
                        'taxonomy' => 'outdoor_location',
                        'hide_empty' => false,
                      ));

                      if (!empty($outdoorLocation) && !is_wp_error($outdoorLocation)) : ?>
                        <?php foreach ($outdoorLocation as $location) : ?>
                          <label class="map-block__point">
                            <input type="checkbox" value="<?php echo esc_html($location->name); ?>">
                            <span></span>
                            <?php echo esc_html($location->name); ?>
                          </label>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="map-block__choices features">
                  <h4>Особенности</h4>

                  <div class="map-block__choice">
                    <button class="map-block__choice-button">Выберите особенности</button>
                    <div class="map-block__choice-content">
                      <?php
                      $outdoorFeatures = get_terms(array(
                        'taxonomy' => 'outdoor_features',
                        'hide_empty' => false,
                      ));

                      if (!empty($outdoorFeatures) && !is_wp_error($outdoorFeatures)) : ?>
                        <?php foreach ($outdoorFeatures as $features) : ?>
                          <label class="map-block__point">
                            <input type="checkbox" value="<?php echo esc_html($features->name); ?>">
                            <span></span>
                            <?php echo esc_html($features->name); ?>
                          </label>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>

          <div class="map-block__maps">
            <div class="loader"></div>
            <div class="map-block__mob">
              <button><svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M23.5395 4.55556H19.9079M15.0658 2V7.11111M15.0658 4.55556H1.75M6.59211 13.5H1.75M11.4342 10.9444V16.0556M24.75 13.5H11.4342M23.5395 22.4444H19.9079M15.0658 19.8889V25M15.0658 22.4444H1.75" stroke="#00468A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg> Фильтры</button>
            </div>

            <div class="map-page__maps-img map-block__map" id="map" style="width: 100%; height: 100%; border-radius: 30px; overflow:hidden"></div>

            <div class="map-block__functions">

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

        <div class="application">
          <div class="application__block">
            <h2><?= get_field("form_title", 'option') ?></h2>

            <svg width="100" height="48" viewBox="0 0 100 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M85.2468 0.558594L86.2314 1.11549L100 8.90286L98.0307 12.3846L85.2468 5.15416L72.4628 12.3846L71.5082 12.9245L70.5398 12.41L56.8213 5.1212L43.1028 12.41L42.1497 12.9163L41.2033 12.3978L27.9516 5.13697L14.6999 12.3978L13.6821 12.9554L12.6929 12.3485L0 4.56115L2.09183 1.1516L13.7956 8.33208L26.9905 1.10236L27.9516 0.575789L28.9126 1.10236L42.179 8.37117L55.8828 1.09015L56.8212 0.591559L57.7597 1.09015L71.4481 8.36296L84.2621 1.11549L85.2468 0.558594ZM85.2468 18.0806L86.2314 18.6375L100 26.4248L98.0307 29.9066L85.2468 22.6761L72.4628 29.9066L71.5082 30.4465L70.5398 29.9319L56.8213 22.6432L43.1028 29.9319L42.1497 30.4383L41.2033 29.9197L27.9516 22.6589L14.6999 29.9197L13.6821 30.4774L12.6929 29.8705L0 22.0831L2.09183 18.6736L13.7956 25.8541L26.9905 18.6243L27.9516 18.0978L28.9126 18.6243L42.179 25.8931L55.8828 18.6121L56.8212 18.1135L57.7597 18.6121L71.4481 25.8849L84.2621 18.6375L85.2468 18.0806ZM86.2314 36.1594L85.2468 35.6025L84.2621 36.1594L71.4481 43.4069L57.7597 36.1341L56.8212 35.6355L55.8828 36.1341L42.179 43.4151L28.9126 36.1463L27.9516 35.6197L26.9905 36.1463L13.7956 43.376L2.09183 36.1955L0 39.6051L12.6929 47.3925L13.6821 47.9994L14.6999 47.4417L27.9516 40.1809L41.2033 47.4417L42.1497 47.9603L43.1028 47.4539L56.8213 40.1651L70.5398 47.4539L71.5082 47.9685L72.4628 47.4286L85.2468 40.1981L98.0307 47.4286L100 43.9468L86.2314 36.1594Z" fill="#F7F7F7" />
            </svg>
          </div>

          <form class="application__form">
            <input type="text" placeholder="Название организации">
            <input type="text" placeholder="Электронная почта">
            <input type="text" placeholder="Телефон">
            <textarea maxlength="500" placeholder="Комментарий к заявке"></textarea>

            <label>
              <input class="application__chekbox" type="checkbox">
              <span>
                Нажимая на кнопку, вы соглашаетесь с политикой конфиденциальности, 
                согласием на передачу персональных данных, согласием на обработку персональных данных, публичной
                офертой.
              </span>
            </label>

            <button class="home__button"><span>оставить заявку</span><span></span></button>
            </а>
        </div>

        <div class="advertising__service article">
          <h1>другие услуги</h1>

          <div class="article__cards">
            <div class="article__card">
              <?php
              $page_id = 69;
              $post = get_post($page_id);
              $content = $post->post_content;
              ?>
              <img src="<?= get_field("indoor_main_bg", $page_id) ?>" alt="jpg">

              <div class="article__text">
                <h2>indoor</h2>

                <p>
                  <?php

                  // Find the position of the first closing paragraph tag
                  $closing_p_pos = strpos($content, '</p>');

                  // Extract the first paragraph
                  $first_paragraph = substr($content, 0, $closing_p_pos);

                  // Remove any HTML tags from the first paragraph
                  $first_paragraph = strip_tags($first_paragraph);

                  echo $first_paragraph;
                  wp_reset_postdata();
                  ?>
                </p>

                <a class="article__link" href="/indoor">подробнее</a>
              </div>
            </div>

            <div class="article__card">
              <?php
              $page_id = 182;
              $post = get_post($page_id);
              ?>
              <img src="<?= get_field("complex_bg_img"); ?>" alt="jpg">

              <div class="article__text">
                <h2>Комплексное интернет-продвижение под ключ</h2>

                <p>
                  <?php
                  echo apply_filters('the_content', $post->post_content);
                  wp_reset_postdata();
                  ?>
                </p>

                <a class="article__link" href="/kompleksnoe-internet-prodvizhenie-pod-kljuch">подробнее</a>
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

    // Получение всех радио-кнопок для выбора типа объекта
    let directionInputs = document.querySelectorAll('.map-block__direction input[type="radio"]');

    // Тип объекта по умолчанию
    let typeObject = 'outdoor';

    // Функция для обновления URL
    function updateURL() {
      const params = new URLSearchParams();

      // Обновление параметров URL для outdoor
      if (selectedFormatValues.length > 0) params.set('format', selectedFormatValues.join(','));
      if (selectedRajonValues.length > 0) params.set('rajon', selectedRajonValues.join(','));
      if (selectedRaspValues.length > 0) params.set('rasp', selectedRaspValues.join(','));
      if (selectedFeaturesValues.length > 0) params.set('features', selectedFeaturesValues.join(','));
      if (selectedIdOutdoor) params.set('id', selectedIdOutdoor);

      // Устанавливаем параметр 'type' в URL
      params.set('type', typeObject);
      history.replaceState(null, '', '?' + params.toString());
    }

    // Функция для применения параметров URL
    function applyURLParams() {
      const params = new URLSearchParams(window.location.search);

      // Установка значения type в 'outdoor', если его нет в URL
      if (!params.has('type')) {
        typeObject = 'outdoor';
        updateURL(); // Вызываем функцию обновления URL
      }

      // Установка типа объекта на основе параметра в URL
      if (params.get('type')) {
        typeObject = params.get('type');

        if (typeObject === 'outdoor') {
          // Помечаем радио-кнопку для outdoor
          document.getElementById('dir1').checked = true;

          // Показываем фильтры для outdoor
          document.querySelector('.map-block__id').style.display = 'block';
          document.querySelector('.map-block__choices.format').style.display = 'block';
          document.querySelector('.map-block__choices.rajon').style.display = 'block';
          // document.querySelector('.map-block__choices.raspolozhenie').style.display = 'block';
          document.querySelector('.map-block__choices.features').style.display = 'block';
        }
      }

      // Применяем фильтры на основе параметров URL
      if (typeObject === 'outdoor') {
        selectedFormatValues = params.get('format') ? params.get('format').split(',') : [];
        selectedRajonValues = params.get('rajon') ? params.get('rajon').split(',') : [];
        selectedRaspValues = params.get('rasp') ? params.get('rasp').split(',') : [];
        selectedFeaturesValues = params.get('features') ? params.get('features').split(',') : [];
        selectedIdOutdoor = params.get('id') ? params.get('id') : '';

        // Устанавливаем состояние чекбоксов для outdoor
        setCheckboxState(formatOutdoor, selectedFormatValues);
        setCheckboxState(rajonOutdoor, selectedRajonValues);
        setCheckboxState(locationOutdoor, selectedRaspValues);
        setCheckboxState(featuresOutdoor, selectedFeaturesValues);
        idOutdoorInput.value = selectedIdOutdoor;

        // Отправляем формат для outdoor
        sendFormatOutdoor();
      }

      // Обновляем URL
      updateURL();
    }

    // Функция для установки состояния чекбоксов
    function setCheckboxState(checkboxes, selectedValues) {
      checkboxes.forEach((input) => {
        input.checked = selectedValues.includes(input.value);
      });
    }

    // Обработчики изменения радио-кнопок
    directionInputs.forEach((input) => {
      input.addEventListener('change', function() {
        setTimeout(() => {
          typeObject = this.value; // Устанавливаем тип объекта
          updateURL(); // Обновляем URL
          applyURLParams(); // Применяем параметры URL

        }, 300);
      });
    });

    // Списки чекбоксов для фильтров outdoor
    let formatOutdoor = document.querySelectorAll('.map-block__choices.format input[type="checkbox"]');
    let rajonOutdoor = document.querySelectorAll('.map-block__choices.rajon input[type="checkbox"]');
    let locationOutdoor = document.querySelectorAll('.map-block__choices.raspolozhenie input[type="checkbox"]');
    let featuresOutdoor = document.querySelectorAll('.map-block__choices.features input[type="checkbox"]');

    // Выбранные значения фильтров outdoor
    let selectedFormatValues = [];
    let selectedRajonValues = [];
    let selectedRaspValues = [];
    let selectedFeaturesValues = [];

    // Обработчики изменения состояния чекбоксов для формата outdoor
    formatOutdoor.forEach((input) => {
      input.addEventListener('change', function() {
        let value = this.value;
        if (this.checked) {
          selectedFormatValues.push(value);
        } else {
          let index = selectedFormatValues.indexOf(value);
          if (index !== -1) {
            selectedFormatValues.splice(index, 1);
          }
        }
        updateURL(); // Обновляем URL
        sendFormatOutdoor(); // Отправляем формат для outdoor
      });
    });

    // Поле ввода для ID outdoor
    let selectedIdOutdoor = '';
    let idOutdoorInput = document.querySelector('.map-block__id input[type="text"]');
    idOutdoorInput.addEventListener('input', function() {
      setTimeout(() => {
        selectedIdOutdoor = this.value;
        updateURL(); // Обновляем URL
        sendFormatOutdoor(); // Отправляем формат для outdoor
      }, 300);
    });

    // Обработчики изменения состояния чекбоксов для районов outdoor
    rajonOutdoor.forEach((input) => {
      input.addEventListener('change', function() {
        let value = this.value;
        if (this.checked) {
          selectedRajonValues.push(value);
        } else {
          let index = selectedRajonValues.indexOf(value);
          if (index !== -1) {
            selectedRajonValues.splice(index, 1);
          }
        }
        updateURL(); // Обновляем URL
        sendFormatOutdoor(); // Отправляем формат для outdoor
      });
    });

    // Обработчики изменения состояния чекбоксов для расположения outdoor
    locationOutdoor.forEach((input) => {
      input.addEventListener('change', function() {
        let value = this.value;
        if (this.checked) {
          selectedRaspValues.push(value);
        } else {
          let index = selectedRaspValues.indexOf(value);
          if (index !== -1) {
            selectedRaspValues.splice(index, 1);
          }
        }
        updateURL(); // Обновляем URL
        sendFormatOutdoor(); // Отправляем формат для outdoor
      });
    });

    // Обработчики изменения состояния чекбоксов для особенностей outdoor
    featuresOutdoor.forEach((input) => {
      input.addEventListener('change', function() {
        let value = this.value;
        if (this.checked) {
          selectedFeaturesValues.push(value);
        } else {
          let index = selectedFeaturesValues.indexOf(value);
          if (index !== -1) {
            selectedFeaturesValues.splice(index, 1);
          }
        }
        updateURL(); // Обновляем URL
        sendFormatOutdoor(); // Отправляем формат для outdoor
      });
    });

    // Функция для отправки формата и обновления элементов outdoor
    const sendFormatOutdoor = async () => {
      const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";
      let mapHtml = document.querySelectorAll('.ymaps-2-1-79-map'); // Получаем все карты

      // Создаем новый экземпляр FormData
      let formData = new FormData();
      formData.append("action", "load_map_outdoor");

      // Преобразуем массивы в строки, разделенные запятыми
      if (selectedFormatValues.length > 0) {
        const selectedFormatValuesStr = selectedFormatValues.join(',');
        formData.append("selectedFormatValues", selectedFormatValuesStr);
      }

      if (selectedRajonValues.length > 0) {
        const selectedRajonValuesStr = selectedRajonValues.join(',');
        formData.append("selectedRajonValues", selectedRajonValuesStr);
      }

      if (selectedRaspValues.length > 0) {
        const selectedRaspValuesStr = selectedRaspValues.join(',');
        formData.append("selectedRaspValues", selectedRaspValuesStr);
      }

      if (selectedFeaturesValues.length > 0) {
        const selectedFeaturesValuesStr = selectedFeaturesValues.join(',');
        formData.append("selectedFeaturesValues", selectedFeaturesValuesStr);
      }

      // Добавляем выбранное значение ID в FormData
      if (selectedIdOutdoor) {
        formData.append("idOutdoor", selectedIdOutdoor);
      }

      // Находим контейнер списка outdoor
      const containerOutdoorList = document.querySelector(".outdoor-list");

      try {
        // Отправляем запрос fetch
        const response = await fetch(ajaxurl, {
          method: "POST",
          body: formData,
        });

        if (response.ok) {
          // Если ответ успешен
          const dataFetch = await response.json();
          if (dataFetch.success) {
            // Обновляем элементы списка
            elementsList = dataFetch.data.elementsListOutdoor;
            setTimeout(() => {
              if (containerOutdoorList) {
                containerOutdoorList.innerHTML = dataFetch.data.outputOutdoor;
              }

              // Удаляем все карты
              mapHtml.forEach((map) => {
                map.remove();
              });

              // Инициализируем карту с новыми данными
              initializeMap();
            }, 300);
          }
        } else {
          console.error("Network response was not ok");
        }
      } catch (error) {
        console.error("Fetch error:", error);
      }
    };

    // Вызываем функцию для применения параметров URL при загрузке страницы
    applyURLParams();

    function initializeMap() {
      // Ждем, пока API Яндекс.Карт станет доступен
      ymaps.ready(function() {
        // Инициализация карты с центром и начальным уровнем масштабирования
        let map = new ymaps.Map("map", {
          center: [59.938784, 30.314997], // Начальные координаты центра карты
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
                    <div class="map-block__tag">
                        <span>${customPoint.popup.description}</span>
                    </div>
                    <div class="map-block__num">
                        <span>${customPoint.popup.body}</span>
                    </div>
                    <a class="map-block__more-link" href="${customPoint.popup.permalink}">подробнее 
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2 3H18M18 3V19M18 3L2 19" stroke="#00468A" stroke-width="2"></path>
                        </svg>
                    </a>
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
                body: (typeObject === "outdoor") ? `GRP: ${element.grp}<br>OTS: ${element.ots}` : `Рабочее время: ${element.timeWork}<br>Тип поверхности: ${element.typeUp}`,
                description: (typeObject === "outdoor") ? element.term : element.address,
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

        // // Находим кастомные кнопки по селектору и привязываем обработчики событий
        // var customButtons = document.querySelectorAll('.map-block__more button');

        // customButtons.forEach(button => {
        //     button.addEventListener('click', function() {
        //         measureFun(button);
        //     });
        // });

        // function measureFun(button) {
        //     button.classList.add("active");
        //     // Симулируем клик по встроенной кнопке измерения расстояния
        //     var ymapsFloatButton = document.querySelector('.ymaps-2-1-79-float-button');
        //     if (ymapsFloatButton) {
        //         ymapsFloatButton.click(); // Вызываем клик на встроенной кнопке
        //     }
        // }
      });
    }
  });
</script>
<?php get_footer(); ?>