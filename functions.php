<?php

// Старт сессии, нужен был для корзины, которая работала сначала через сессию
// function start_session()
// {
//     if (!session_id()) {
//         session_start();
//     }
// }
// add_action('init', 'start_session', 1);

/**
 * Отключение админ панели на сайте, когда залогинен в админ панель.
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Подключение всех основным стилей и скриптов.
 */
require_once('inc/script_and_styles.php');

/**
 * Включение автоматической подстановки title страниц.
 * В данном случае title прописывает плагин Yoast SEO
 * Тэг <title> в header должен отсутствовать.
 */
add_theme_support('title-tag');

// Добавление страницы настроек для шапки
// if (function_exists('acf_add_options_page')) {
//     acf_add_options_page(array(
//         'page_title'    => 'Header Settings',
//         'menu_title'    => 'Header Settings',
//         'menu_slug'     => 'header-settings',
//         'capability'    => 'edit_posts',
//         'redirect'      => false
//     ));
// }

// Страница "indoor" переходит на архивную страницу "indoor"
add_action('init', 'custom_news_archive_rewrite', 10, 0);
function custom_news_archive_rewrite()
{
    add_rewrite_rule('^/indoor/?$', 'index.php?post_type=indoor', 'top');
    flush_rewrite_rules();
}

function set_custom_seo_title($title)
{
    $page_id = null;

    if (is_post_type_archive('indoor')) {
        // Получаем ID страницы по слагу
        $page = get_page_by_path('indoor');
        if ($page) {
            $page_id = $page->ID;
        }
    }

    if (is_post_type_archive('news')) {
        // Получаем ID страницы по слагу
        $page = get_page_by_path('news');
        if ($page) {
            $page_id = $page->ID;
        }
    }

    if ($page_id) {
        // Получаем значение поля SEO-заголовка из Yoast SEO
        $yoast_seo_title = get_post_meta($page_id, '_yoast_wpseo_title', true);

        // Если поле SEO-заголовка не пустое, используем его в качестве заголовка страницы
        if ($yoast_seo_title) {
            // Используем Yoast функцию для парсинга шаблона
            $yoast_seo_title = wpseo_replace_vars($yoast_seo_title, get_post($page_id));
            return $yoast_seo_title;
        }
    }

    return $title;
}
add_filter('wpseo_title', 'set_custom_seo_title');


//Пагинация новостей
function load_posts_by_ajax()
{
    // Получение последней записи типа "news"
    $latest_news_query = new WP_Query(array(
        'post_type' => 'news',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    if ($latest_news_query->have_posts()) {
        $latest_news_query->the_post();
        $latest_post_id = get_the_ID();
    }

    $paged = $_GET['page'];
    $posts_per_page = 4;

    $news_query = new WP_Query(array(
        'post_type' => 'news',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC',
        'post__not_in' => array($latest_post_id)
    ));

    $content = '';
    if ($news_query->have_posts()) :
        while ($news_query->have_posts()) : $news_query->the_post();
            $has_thumbnail = has_post_thumbnail();
            ob_start();
?>
            <div class="advertising__container <?php echo !$has_thumbnail ? 'blue' : ''; ?>">
                <?php if ($has_thumbnail) : ?>
                    <div class="advertising__card">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">
                    </div>
                <?php endif; ?>
                <div class="advertising__card">
                    <?php if (!$has_thumbnail) : ?>
                        <h3><?php the_title(); ?></h3>
                    <?php else : ?>
                        <h2><?php the_title(); ?></h2>
                    <?php endif; ?>
                    <span><?php echo get_the_date(); ?></span>
                    <?php the_content(); ?>
                    <a class="advertising__link" href="<?php echo get_post_permalink(); ?>">подробнее</a>
                </div>
            </div>
        <?php
            $content .= ob_get_clean();
        endwhile;
    endif;
    wp_reset_postdata();

    $response = array(
        'content' => $content,
        'total_pages' => $news_query->max_num_pages,
        'current_page' => $paged
    );

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_load_posts', 'load_posts_by_ajax');
add_action('wp_ajax_nopriv_load_posts', 'load_posts_by_ajax');


// Map filters

//outdoor map
function load_map_outdoor()
{
    ob_start();

    // Получаем значения из POST
    $format = isset($_POST['selectedFormatValues']) ? $_POST['selectedFormatValues'] : '';
    $idOutdoor = isset($_POST['idOutdoor']) ? $_POST['idOutdoor'] : '';
    $rajon = isset($_POST['selectedRajonValues']) ? $_POST['selectedRajonValues'] : '';
    $location = isset($_POST['selectedRaspValues']) ? $_POST['selectedRaspValues'] : '';
    $features = isset($_POST['selectedFeaturesValues']) ? $_POST['selectedFeaturesValues'] : '';
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;

    // Преобразуем строки в массивы, если это необходимо
    $formatArray = !empty($format) ? array_map('sanitize_text_field', explode(',', $format)) : array();
    $rajonArray = !empty($rajon) ? array_map('sanitize_text_field', explode(',', $rajon)) : array();
    $locationArray = !empty($location) ? array_map('sanitize_text_field', explode(',', $location)) : array();
    $featuresArray = !empty($features) ? array_map('sanitize_text_field', explode(',', $features)) : array();

    $listQueryArgs = array(
        'post_type'      => 'outdoor',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'paged'          => $page
    );

    $listQueryArgsAll = array(
        'post_type'      => 'outdoor',
        'posts_per_page' => -1,
        'orderby'        => 'date',
    );

    // Строим tax_query в зависимости от переданных параметров
    $tax_query = array('relation' => 'AND');

    if (!empty($formatArray)) {
        $tax_query[] = array(
            'taxonomy' => 'map_format_type',
            'field'    => 'name',
            'terms'    => $formatArray,
        );
    }

    if (!empty($rajonArray)) {
        $tax_query[] = array(
            'taxonomy' => 'map_outdoor_district',
            'field'    => 'name',
            'terms'    => $rajonArray,
        );
    }

    if (!empty($locationArray)) {
        $tax_query[] = array(
            'taxonomy' => 'outdoor_location',
            'field'    => 'name',
            'terms'    => $locationArray,
        );
    }

    if (!empty($featuresArray)) {
        $tax_query[] = array(
            'taxonomy' => 'outdoor_features',
            'field'    => 'name',
            'terms'    => $featuresArray,
        );
    }

    // Добавляем tax_query в запрос, только если есть условия фильтрации
    if (count($tax_query) > 1) {
        $listQueryArgs['tax_query'] = $tax_query;
        $listQueryArgsAll['tax_query'] = $tax_query;
    }

    // Если передан idOutdoor, добавляем мета-запрос
    if (!empty($idOutdoor)) {
        $meta_query = array(
            'key'     => 'outdoor_id',
            'value'   => sanitize_text_field($idOutdoor),
            'compare' => '=',
        );
        $listQueryArgs['meta_query'] = array($meta_query);
        $listQueryArgsAll['meta_query'] = array($meta_query);
    }

    // // Логируем запросы для отладки
    // error_log(print_r($listQueryArgs, true));

    $listQuery = new WP_Query($listQueryArgs);

    if ($listQuery->have_posts()) :
        while ($listQuery->have_posts()) : $listQuery->the_post();
            $terms = wp_get_post_terms(get_the_ID(), 'map_outdoor_district');
            $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';

            $outdoor_elements_offer = get_field("outdoor_elements_offer");

            // Проверяем, что массив повторителя существует и содержит элементы
            if ($outdoor_elements_offer && is_array($outdoor_elements_offer)) {
                $first_element = $outdoor_elements_offer[0];
                $grp = isset($first_element['outdoor_side_a_grp_surface_rating']) ? $first_element['outdoor_side_a_grp_surface_rating'] : '';
                $ots = isset($first_element['outdoor_side_a_effective_ots_audience']) ? $first_element['outdoor_side_a_effective_ots_audience'] : '';
                $format = isset($first_element['outdoor_side_a_format']) ? $first_element['outdoor_side_a_format'] : '';
            } else {
                $grp = '';
                $ots = '';
                $format = '';
            }
        ?>
            <div class="address__card">
                <div class="address__title">
                    <h2><?= the_title(); ?></h2>
                    <div class="address__tag">
                        <span><?= $term_name; ?></span>
                        <span>GRP: <?= esc_html($grp); ?>, OTS: <?= esc_html($ots); ?></span>
                        <span><?= esc_html($format); ?></span>
                    </div>
                </div>
                <div class="address__buttons-card">
                    <a class="address__link" href="<?= get_permalink() ?>">подробнее<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 3H18M18 3V19M18 3L2 19" stroke="#00468A" stroke-width="2" />
                        </svg></a>
                </div>
            </div>
            <?php
        endwhile;
    endif;

    $elementsListOutdoor = array();
    $listQueryAll = new WP_Query($listQueryArgsAll);

    if ($listQueryAll->have_posts()) :
        while ($listQueryAll->have_posts()) : $listQueryAll->the_post();
            $terms = wp_get_post_terms(get_the_ID(), 'map_outdoor_district');
            $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';
            $outdoor_elements_offer = get_field("outdoor_elements_offer");

            // Проверяем, что массив повторителя существует и содержит элементы
            if ($outdoor_elements_offer && is_array($outdoor_elements_offer)) {
                $first_element = $outdoor_elements_offer[0];
                $grp = isset($first_element['outdoor_side_a_grp_surface_rating']) ? $first_element['outdoor_side_a_grp_surface_rating'] : '';
                $ots = isset($first_element['outdoor_side_a_effective_ots_audience']) ? $first_element['outdoor_side_a_effective_ots_audience'] : '';
            } else {
                $grp = '';
                $ots = '';
            }

            if (get_field("outdoor_elements_offer")) :
                foreach (get_field("outdoor_elements_offer") as $key) :
                    if (isset($key['outdoor_side_a_img_example']) && is_array($key['outdoor_side_a_img_example'])) :
                        $first_img = reset($key['outdoor_side_a_img_example']);
                        break;
                    endif;
                endforeach;
            endif;
            // Добавляем данные каждой записи в массив
            $element = array(
                'coords' => get_field('outdoor_coordinate'),
                'title' => get_the_title(),
                'image' => get_the_post_thumbnail_url(),
                'term' => $term_name,
                'grp' => $grp,
                'ots' => $ots,
                'permalink' => get_permalink(),
                'firstgallery' => $first_img
            );

            array_push($elementsListOutdoor, $element);
        endwhile;
    endif;

    // Завершение буферизации и отправка данных
    $totalPages = $listQuery->max_num_pages; // Получаем общее количество страниц
    $outputOutdoor = ob_get_clean();
    wp_reset_postdata();

    wp_send_json_success(array('outputOutdoor' => $outputOutdoor, 'elementsListOutdoor' => $elementsListOutdoor, 'totalPages' => $totalPages, 'currentPage' => $page));
}

add_action('wp_ajax_load_map_outdoor', 'load_map_outdoor');
add_action('wp_ajax_nopriv_load_map_outdoor', 'load_map_outdoor');


//indoor map
function load_map_indoor()
{
    ob_start();

    // Получаем значения из POST
    $format = isset($_POST['selectedFormatValuesIndoor']) ? $_POST['selectedFormatValuesIndoor'] : '';
    $address = isset($_POST['selectedAddressValues']) ? $_POST['selectedAddressValues'] : '';
    $page = isset($_POST['pageIn']) ? (int)$_POST['pageIn'] : 1;

    // Преобразуем строки в массивы, если это необходимо
    $formatArray = !empty($format) ? array_map('sanitize_text_field', explode(',', $format)) : array();
    $addressArray = !empty($address) ? array_map('sanitize_text_field', explode(',', $address)) : array();

    $listQueryArgs = array(
        'post_type'      => 'indoor',
        'posts_per_page' => -1,
        'orderby'        => 'date',
    );

    // Строим tax_query в зависимости от переданных параметров
    $tax_query = array('relation' => 'AND');

    if (!empty($formatArray)) {
        $tax_query[] = array(
            'taxonomy' => 'map_format_type_indoor',
            'field'    => 'name',
            'terms'    => $formatArray,
        );
    }

    if (!empty($addressArray)) {
        $tax_query[] = array(
            'taxonomy' => 'map_street',
            'field'    => 'name',
            'terms'    => $addressArray,
        );
    }

    // Добавляем tax_query в запрос, только если есть условия фильтрации
    if (count($tax_query) > 1) {
        $listQueryArgs['tax_query'] = $tax_query;
    }

    // // Логируем запросы для отладки
    // error_log(print_r($listQueryArgs, true));

    $listQuery = new WP_Query($listQueryArgs);

    $elementsListIndoor = array();

    if ($_POST['isIndoorPage'] === "true") {
        if ($listQuery->have_posts()) :
            while ($listQuery->have_posts()) : $listQuery->the_post();
                $terms = wp_get_post_terms(get_the_ID(), 'map_street');
                $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';

                // Добавляем данные каждой записи в массив
                $element = array(
                    'coords' => get_field('indoor_coordinate'), // Получаем координаты точки
                    'title' => get_the_title(), // Получаем заголовок записи
                    'image' => get_the_post_thumbnail_url(), // Получаем URL изображения записи
                    'address' => $term_name, // Получаем адрес
                    'timeWork' => get_field('indoor_time_work'), // Получаем рабочее время
                    'typeUp' => get_field('indoor_type_up'), // Получаем тип поверхности
                    'permalink' => get_permalink(), // Получаем ссылку на запись
                );

                array_push($elementsListIndoor, $element);
            ?>
                <div class="indoor__card">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="card">

                    <div class="indoor__info">
                        <div>
                            <h3><?php the_title(); ?></h3>
                            <div class="indoor__list">
                                <span><?= get_field("indoor_address"); ?></span>
                                <span>Охват: <?= get_field("indoor_main_ob_obj"); ?></span>
                            </div>
                        </div>
                        <a href="<?php echo get_post_permalink(); ?>" class="indoor__button-b home__button"><span>подробнее</span><span></span></a>
                    </div>
                </div>
            <?php endwhile;
        endif;

        // Завершение буферизации и отправка данных
        $outputIndoor = ob_get_clean();
        wp_reset_postdata();
        wp_send_json_success(array('outputIndoor' => $outputIndoor, 'elementsListIndoor' => $elementsListIndoor));
    } else if ($_POST['isAddresPage'] === "true") {

        // Добавляем параметр 'paged' в массив
        $listQueryArgs = array_merge($listQueryArgs, array('paged' => $page));

        $listQuery = new WP_Query($listQueryArgs);
        if ($listQuery->have_posts()) :
            while ($listQuery->have_posts()) : $listQuery->the_post();
                $terms = wp_get_post_terms(get_the_ID(), 'map_street');
                $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';

                // Добавляем данные каждой записи в массив
                $element = array(
                    'coords' => get_field('indoor_coordinate'), // Получаем координаты точки
                    'title' => get_the_title(), // Получаем заголовок записи
                    'image' => get_the_post_thumbnail_url(), // Получаем URL изображения записи
                    'address' => $term_name, // Получаем адрес
                    'timeWork' => get_field('indoor_time_work'), // Получаем рабочее время
                    'typeUp' => get_field('indoor_type_up'), // Получаем тип поверхности
                    'permalink' => get_permalink(), // Получаем ссылку на запись
                );

                array_push($elementsListIndoor, $element);
            ?>
                <div class="address__card">
                    <div class="address__title">
                        <h2><?= the_title(); ?></h2>
                        <div class="address__tag">
                            <span><?= $term_name; ?></span>
                            <span><?= get_field("indoor_type_up"); ?></span>
                            <span><?= get_field("indoor_time_work"); ?></span>
                        </div>
                    </div>
                    <div class="address__buttons-card">
                        <a class="address__link" href="<?= get_permalink() ?>">подробнее<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 3H18M18 3V19M18 3L2 19" stroke="#00468A" stroke-width="2" />
                            </svg></a>
                    </div>
                </div>
            <?php endwhile;
        endif;

        // Завершение буферизации и отправка данных
        $totalPages = $listQuery->max_num_pages; // Получаем общее количество страниц
        $outputIndoor = ob_get_clean();
        wp_reset_postdata();
        wp_send_json_success(array('outputIndoor' => $outputIndoor, 'elementsListIndoor' => $elementsListIndoor, 'totalPagesIndoor' => $totalPages, 'currentPageIndoor' => $page));
    } else {
        if ($listQuery->have_posts()) :
            while ($listQuery->have_posts()) : $listQuery->the_post();
                $terms = wp_get_post_terms(get_the_ID(), 'map_street');
                $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';
            ?>
                <div class="map-block__card" data-coords="<?= get_field('indoor_coordinate'); ?>">
                    <img src="<?= get_the_post_thumbnail_url(); ?>" alt="img">
                    <div class="map-block__info">
                        <h2><?= get_the_title(); ?></h2>
                        <div class="map-block__tag">
                            <span><?= $term_name; ?></span>
                        </div>
                        <div class="map-block__num">
                            <span>Рабочее время: <?= get_field("indoor_time_work"); ?></span>
                            <span>Тип поверхности: <?= get_field("indoor_type_up"); ?></span>
                        </div>
                        <a class="map-block__more-link" href="<?= get_permalink() ?>"> ПОДРОБНЕЕ
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 3H18M18 3V19M18 3L2 19" stroke="#00468A" stroke-width="2"></path>
                            </svg>
                        </a>
                    </div>
                </div>
<?php endwhile;
        endif;

        if ($listQuery->have_posts()) :
            while ($listQuery->have_posts()) : $listQuery->the_post();
                $terms = wp_get_post_terms(get_the_ID(), 'map_street');
                $term_name = !empty($terms) ? esc_html($terms[0]->name) : '';

                // Добавляем данные каждой записи в массив
                $element = array(
                    'coords' => get_field('indoor_coordinate'), // Получаем координаты точки
                    'title' => get_the_title(), // Получаем заголовок записи
                    'image' => get_the_post_thumbnail_url(), // Получаем URL изображения записи
                    'address' => $term_name, // Получаем адрес
                    'timeWork' => get_field('indoor_time_work'), // Получаем рабочее время
                    'typeUp' => get_field('indoor_type_up'), // Получаем тип поверхности
                    'permalink' => get_permalink(), // Получаем ссылку на запись
                );

                array_push($elementsListIndoor, $element);
            endwhile;
        endif;

        // Завершение буферизации и отправка данных
        $outputIndoor = ob_get_clean();
        wp_reset_postdata();
        wp_send_json_success(array('outputIndoor' => $outputIndoor, 'elementsListIndoor' => $elementsListIndoor));
    }
}

add_action('wp_ajax_load_map_indoor', 'load_map_indoor');
add_action('wp_ajax_nopriv_load_map_indoor', 'load_map_indoor');



// // Добавление товара в корзину
// function my_custom_add_to_cart()
// {
//     // if (!isset($_POST['product_id']) || !isset($_POST['side']) || !isset($_POST['construction']) || !isset($_POST['characteristics'])) {
//     //     wp_send_json_error(['error' => 'Отсутствуют необходимые параметры']);
//     // }

//     $product_id = sanitize_text_field($_POST['product_id']);
//     $side = sanitize_text_field($_POST['side']);
//     $construction = sanitize_text_field($_POST['construction']);
//     $characteristics = json_decode(stripslashes($_POST['characteristics']), true);

//     // Создание уникального идентификатора для товара
//     $item_id = $product_id . '_' . ($side !== "" ? $side : '') . ($construction !== "" ? '_' . $construction : '');

//     // Создание имени товара и деталей для добавления в корзину
//     $item_name = get_the_title($product_id) . "\n" .
//         ($side !== "" ? 'Сторона: ' . $side : '') .
//         ($construction !== "" ? 'Конструкция: ' . $construction : '');

//     $item_details = implode(', ', array_map(
//         function ($key, $value) {
//             return "$key: $value";
//         },
//         array_keys($characteristics['details']),
//         $characteristics['details']
//     ));

//     // Добавление товара в корзину
//     $cart_item = [
//         'id' => $item_id,
//         'name' => $item_name,
//         'price' => $characteristics['price'],
//         'quantity' => 1,
//         'image' => $characteristics['image'],
//         'details' => $item_details
//     ];

//     if (!session_id()) {
//         session_start();
//     }

//     if (!isset($_SESSION['simple_cart'])) {
//         $_SESSION['simple_cart'] = [];
//     }

//     // Проверка на наличие товара с той же стороной в корзине
//     foreach ($_SESSION['simple_cart'] as $item) {
//         if ($item['id'] === $item_id) {
//             wp_send_json_error(['error' => 'Этот товар уже добавлен в корзину']);
//         }
//     }

//     // Добавление товара в корзину, если его нет
//     $_SESSION['simple_cart'][] = $cart_item;

//     // Вывод содержимого корзины для отладки
//     error_log(print_r($_SESSION['simple_cart'], true));

//     wp_send_json_success(['message' => 'Товар успешно добавлен в корзину']);
// }

// add_action('wp_ajax_add_to_cart', 'my_custom_add_to_cart');
// add_action('wp_ajax_nopriv_add_to_cart', 'my_custom_add_to_cart');


// // Удаление элементов с корзины
// add_action('wp_ajax_remove_from_cart', 'remove_from_cart');
// add_action('wp_ajax_nopriv_remove_from_cart', 'remove_from_cart');

// function remove_from_cart()
// {
//     // Старт сессии
//     if (!session_id()) {
//         session_start();
//     }

//     // Получение индекса элемента, который нужно удалить
//     $index = isset($_POST['index']) ? intval($_POST['index']) : -1;

//     // Удаление элемента из сессии
//     if ($index >= 0 && isset($_SESSION['simple_cart'][$index])) {
//         unset($_SESSION['simple_cart'][$index]);
//         // Пересоздание массива для сброса ключей
//         $_SESSION['simple_cart'] = array_values($_SESSION['simple_cart']);
//     }

//     // Завершаем обработку
//     wp_die();
// }


// // Функция отправки сообщения на почту через сессии
// add_action('wp_ajax_send_application', 'send_application');
// add_action('wp_ajax_nopriv_send_application', 'send_application');

// function send_application()
// {
//     $organization = sanitize_text_field($_POST['organization']);
//     $email = sanitize_email($_POST['email']);
//     $phone = sanitize_text_field($_POST['phone']);
//     $comment = sanitize_textarea_field($_POST['comment']);
//     $has_cart_items = isset($_POST['has_cart_items']) && $_POST['has_cart_items'] === 'true';

//     $to = 'lisdb@bk.ru';
//     $subject = 'Новая заявка с сайта';
//     $body = "Название организации: $organization\nЭлектронная почта: $email\nТелефон: $phone\nКомментарий: $comment\n\n";

//     if ($has_cart_items) {
//         session_start();
//         $cart_items = isset($_SESSION['simple_cart']) ? $_SESSION['simple_cart'] : [];
//         $total_price = array_sum(array_column($cart_items, 'price'));
//         $total_items = count($cart_items);

//         $body .= "Корзина:\n";
//         foreach ($cart_items as $item) {
//             $body .= "Название: {$item['name']}\n";
//             $body .= "Детали: {$item['details']}\n";
//             $body .= "Цена: " . number_format($item['price'], 0, ',', ' ') . " руб/мес\n\n";
//         }
//         $body .= "Общее количество элементов: $total_items шт\n";
//         $body .= "Общая стоимость: " . number_format($total_price, 0, ',', ' ') . " руб/мес\n";
//     }

//     $headers = ['Content-Type: text/plain; charset=UTF-8'];
//     $mail_sent = wp_mail($to, $subject, $body, $headers);

//     if ($mail_sent) {
//         wp_send_json_success('Заявка успешно отправлена.');
//     } else {
//         wp_send_json_error('Ошибка при отправке заявки.');
//     }

//     wp_die();
// }

// Функция отправки сообщения на почту через сетлок
add_action('wp_ajax_send_application', 'send_application');
add_action('wp_ajax_nopriv_send_application', 'send_application');

function send_application()
{
    $organization = sanitize_text_field($_POST['organization']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $comment = sanitize_textarea_field($_POST['comment']);
    $cart_items = isset($_POST['cart_items']) ? json_decode(stripslashes($_POST['cart_items']), true) : [];

    $to = 'lisdb@bk.ru';
    $subject = 'Новая заявка с сайта';
    $body = "Название организации: $organization\nЭлектронная почта: $email\nТелефон: $phone\nКомментарий: $comment\n\n";

    if (!empty($cart_items)) {
        $total_price = array_sum(array_column($cart_items, 'price'));
        $total_items = count($cart_items);

        $body .= "Корзина:\n";
        foreach ($cart_items as $item) {
            $body .= "Название: {$item['name']}\n";
            $body .= "Детали: {$item['details']}\n";
            $body .= "Цена: " . number_format($item['price'], 0, ',', ' ') . " руб/мес\n\n";
        }
        $body .= "Общее количество элементов: $total_items шт\n";
        $body .= "Общая стоимость: " . number_format($total_price, 0, ',', ' ') . " руб/мес\n";
    }

    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    $mail_sent = wp_mail($to, $subject, $body, $headers);

    if ($mail_sent) {
        wp_send_json_success('Заявка успешно отправлена.');
    } else {
        wp_send_json_error('Ошибка при отправке заявки.');
    }

    wp_die();
}

// Добавляем хук для зарегистрированных пользователей
add_action('wp_ajax_send_call_request', 'send_call_request');
// Добавляем хук для неавторизованных пользователей
add_action('wp_ajax_nopriv_send_call_request', 'send_call_request');

function send_call_request()
{
    // Проверяем наличие данных в POST запросе
    if (!isset($_POST['name'], $_POST['phone'], $_POST['action']) || $_POST['action'] !== 'send_call_request') {
        wp_send_json_error('Invalid request');
        wp_die();
    }

    // Получаем данные из POST и очищаем их
    $name = sanitize_text_field($_POST['name']);
    $phone = sanitize_text_field($_POST['phone']);

    // Создаем сообщение для отправки по электронной почте
    $to = 'lisdb@bk.ru'; // Замените на вашу почту или адрес администратора
    $subject = 'Запрос на обратный звонок с сайта';
    $body = "Имя: $name\nТелефон: $phone\n";

    // Определяем заголовки для электронной почты
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
    );

    // Отправляем сообщение
    $mail_sent = wp_mail($to, $subject, $body, $headers);

    // Проверяем успешность отправки и отправляем ответ в JSON формате
    if ($mail_sent) {
        wp_send_json_success('Ваш запрос успешно отправлен.');
    } else {
        wp_send_json_error('Ошибка при отправке запроса.');
    }

    wp_die();
}


// Функция для дебагинга сессий
// function debug_session()
// {
//     if (!session_id()) {
//         session_start();
//     }
//     error_log(print_r($_SESSION, true));
// }
// add_action('wp_footer', 'debug_session');


//Функция для очистки сессии конкретной. На случай, если багнулось содержимое

// // Запустить сессию
// session_start();

// // Очистить переменную сессии 'simple_cart'
// unset($_SESSION['simple_cart']);

// // Проверить, что переменная сессии очищена
// if (!isset($_SESSION['simple_cart'])) {
//     echo 'Переменная simple_cart успешно очищена.';
// } else {
//     echo 'Не удалось очистить переменную simple_cart.';
// }

/**
 * Get terms by post type
 * @link https://wordpress.stackexchange.com/questions/237270/same-taxonomy-for-several-post-types-how-to-hide-empty-in-a-specific-post-type
 */
function get_terms_by_post_type( $taxonomies, $post_types ) {
    global $wpdb;

    $post_types = array_map( 'esc_sql', $post_types );
	$IN_post_types = sprintf( "'%s'", join( "', '", $post_types ) );

	$taxonomies = array_map( 'esc_sql', $taxonomies );
	$IN_taxonomies = sprintf( "'%s'", join( "', '", $taxonomies ) );

	$query = "
	SELECT t.*, COUNT(*) from $wpdb->terms AS t
		INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
		INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
		INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id
		WHERE p.post_type IN($IN_post_types) AND tt.taxonomy IN($IN_taxonomies)
		GROUP BY t.term_id
	";

    $results = $wpdb->get_results( $query );

    return $results;
}
