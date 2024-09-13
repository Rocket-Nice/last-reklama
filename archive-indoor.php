<?php get_header();

$page_id = 69;
$post = get_post($page_id);

$indoor_query = new WP_Query(array(
    'post_type' => 'indoor',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
));
$indoor_count = $indoor_query->found_posts;

$word_form = 'объектов';
if ($indoor_count % 10 == 1 && $indoor_count % 100 != 11) {
    $word_form = 'объект';
} elseif (($indoor_count % 10 >= 2 && $indoor_count % 10 <= 4) && !($indoor_count % 100 >= 12 && $indoor_count % 100 <= 14)) {
    $word_form = 'объекта';
}
?>
<main class="main">

    <div class="container">
        <nav class="navigation-page">
            <?php
            if (is_post_type_archive('indoor')) {
                echo '<div class="breadcrumbs">';
                echo '<span>';
                echo '<span><a href="' . home_url('/') . '">Главная</a></span> / ';
                echo '<span><a href="' . home_url('/uslugi') . '">Услуги</a></span> / ';
                echo '<span class="breadcrumb_last" aria-current="page">indoor</span>';
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

    <section class="indoor">
        <div class="container">
            <div class="indoor__content">

                <div class="advertising__grid">

                    <div class="advertising__info">
                        <h2><?php echo apply_filters('the_ title', $post->post_title); ?></h2>
                        <?php
                        echo apply_filters('the_content', $post->post_content);
                        wp_reset_postdata();
                        ?>
                    </div>

                    <div class="advertising__img">
                        <img src="<?= get_field("indoor_main_bg", $page_id) ?>" alt="advertising">
                    </div>

                    <div class="indoor__services advertising__services">
                        <h2><?= $indoor_count; ?> <?= $word_form; ?> для размещения indoor-рекламы</h2>

                        <?= get_field("indoor_what_in_usl_razm", $page_id); ?>
                    </div>

                    <div class="advertising__day advertising__day-one">
                        <h2><?= get_field("indoor_count_days_what_first_block", $page_id); ?></h2>
                        <p><?= get_field("indoor_count_days_what_first", $page_id); ?></p>
                    </div>

                    <div class="advertising__day advertising__day-two">
                        <h2><?= get_field("indoor_count_days_what_second_block", $page_id); ?></h2>
                        <p><?= get_field("indoor_count_days_what_second", $page_id);
                            wp_reset_postdata();
                            ?></p>
                    </div>

                </div>

                <?php

                $indoor_video = get_field('indoor_video', $page_id);
                $indoor_video_img = get_field('indoor_video_img', $page_id);

                // Проверяем, если поле не пустое
                if ($indoor_video) {
                ?>
                    <div class="indoor-video">
                        <video id="indoorVideo" src="<?php echo esc_url($indoor_video); ?>" controls <?php if ($indoor_video_img) { ?>poster="<?php echo esc_url($indoor_video_img); ?>" <?php } ?>></video>
                        <svg class="icon-play" width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="150" height="150" rx="75" fill="#F7F7F7" />
                            <path d="M102.5 70.6699C105.833 72.5944 105.833 77.4056 102.5 79.3301L65 100.981C61.6667 102.905 57.5 100.5 57.5 96.6506L57.5 53.3494C57.5 49.5004 61.6667 47.0947 65 49.0192L102.5 70.6699Z" fill="#00468A" />
                        </svg>
                    </div>
                    <script>
                        var video = document.getElementById('indoorVideo');
                        let playIcon = document.querySelector('.icon-play');

                        // Обработчик события play на видео
                        video.addEventListener('play', function() {
                            video.style.height = '100%';
                            playIcon.style.display = "none";
                        });

                        // Обработчик события pause на видео
                        video.addEventListener('pause', function() {
                            playIcon.style.display = "block";
                        });

                        // Обработчик события click на playIcon
                        playIcon.addEventListener('click', function() {
                            video.play();
                            playIcon.style.display = "none";
                        });
                    </script>
                <?php
                }
                ?>

                <div class="indoor__obj">
                    <div class="indoor__top">
                        <h2>indoor-объекты</h2>
                        <button><svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="path-1-inside-1_3507_23369" fill="white">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 12.3547L14.567 7.68119C16.168 5.24164 14.418 2 11.5 2C8.58204 2 6.83203 5.24164 8.43299 7.68119L11.5 12.3547ZM12.6961 14.1774L16.2391 8.7785C18.7129 5.00894 16.0088 0 11.5 0C6.99121 0 4.28712 5.00894 6.76089 8.77851L10.3039 14.1774L11.5 16L12.6961 14.1774ZM18.2368 9.00098C18.2368 8.44869 18.6846 8.00098 19.2368 8.00098H21C22.1046 8.00098 23 8.89641 23 10.001V20.001C23 21.1055 22.1046 22.001 21 22.001H2C0.895431 22.001 0 21.1055 0 20.001V10.501C0 9.39641 0.895431 8.50098 2 8.50098H4.31579C4.86807 8.50098 5.31579 8.94869 5.31579 9.50098C5.31579 10.0533 4.86807 10.501 4.31579 10.501H2V20.001H21L21 10.001H19.2368C18.6846 10.001 18.2368 9.55326 18.2368 9.00098ZM11.5 7.00098C12.3284 7.00098 13 6.3294 13 5.50098C13 4.67255 12.3284 4.00098 11.5 4.00098C10.6716 4.00098 10 4.67255 10 5.50098C10 6.3294 10.6716 7.00098 11.5 7.00098Z" />
                                </mask>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 12.3547L14.567 7.68119C16.168 5.24164 14.418 2 11.5 2C8.58204 2 6.83203 5.24164 8.43299 7.68119L11.5 12.3547ZM12.6961 14.1774L16.2391 8.7785C18.7129 5.00894 16.0088 0 11.5 0C6.99121 0 4.28712 5.00894 6.76089 8.77851L10.3039 14.1774L11.5 16L12.6961 14.1774ZM18.2368 9.00098C18.2368 8.44869 18.6846 8.00098 19.2368 8.00098H21C22.1046 8.00098 23 8.89641 23 10.001V20.001C23 21.1055 22.1046 22.001 21 22.001H2C0.895431 22.001 0 21.1055 0 20.001V10.501C0 9.39641 0.895431 8.50098 2 8.50098H4.31579C4.86807 8.50098 5.31579 8.94869 5.31579 9.50098C5.31579 10.0533 4.86807 10.501 4.31579 10.501H2V20.001H21L21 10.001H19.2368C18.6846 10.001 18.2368 9.55326 18.2368 9.00098ZM11.5 7.00098C12.3284 7.00098 13 6.3294 13 5.50098C13 4.67255 12.3284 4.00098 11.5 4.00098C10.6716 4.00098 10 4.67255 10 5.50098C10 6.3294 10.6716 7.00098 11.5 7.00098Z" />
                                <path d="M14.567 7.68119L13.731 7.13253L14.567 7.68119ZM11.5 12.3547L10.664 12.9034L11.5 14.1774L12.336 12.9034L11.5 12.3547ZM8.43299 7.68119L9.26904 7.13254L8.43299 7.68119ZM16.2391 8.7785L15.4031 8.22985L16.2391 8.7785ZM12.6961 14.1774L11.8601 13.6287L12.6961 14.1774ZM6.76089 8.77851L7.59694 8.22985L6.76089 8.77851ZM10.3039 14.1774L9.46785 14.726L10.3039 14.1774ZM11.5 16L10.664 16.5487L11.5 17.8226L12.336 16.5487L11.5 16ZM2 10.501V9.50098H1V10.501H2ZM2 20.001H1V21.001H2V20.001ZM21 20.001V21.001H22V20.001H21ZM21 10.001H22V9.00098H21V10.001ZM13.731 7.13253L10.664 11.8061L12.336 12.9034L15.4031 8.22985L13.731 7.13253ZM11.5 3C13.6225 3 14.8955 5.35799 13.731 7.13253L15.4031 8.22985C17.4404 5.12529 15.2134 1 11.5 1V3ZM9.26904 7.13254C8.10449 5.35799 9.37746 3 11.5 3V1C7.78663 1 5.55957 5.12529 7.59694 8.22985L9.26904 7.13254ZM12.336 11.8061L9.26904 7.13254L7.59694 8.22985L10.664 12.9034L12.336 11.8061ZM15.4031 8.22985L11.8601 13.6287L13.5322 14.726L17.0752 9.32716L15.4031 8.22985ZM11.5 1C15.2134 1 17.4404 5.12529 15.4031 8.22985L17.0752 9.32716C19.9853 4.89259 16.8042 -1 11.5 -1V1ZM7.59694 8.22985C5.55957 5.12529 7.78663 1 11.5 1V-1C6.19579 -1 3.01466 4.89259 5.92485 9.32716L7.59694 8.22985ZM11.1399 13.6287L7.59694 8.22985L5.92485 9.32716L9.46785 14.726L11.1399 13.6287ZM12.336 15.4513L11.1399 13.6287L9.46785 14.726L10.664 16.5487L12.336 15.4513ZM11.8601 13.6287L10.664 15.4513L12.336 16.5487L13.5322 14.726L11.8601 13.6287ZM19.2368 7.00098C18.1323 7.00098 17.2368 7.89641 17.2368 9.00098H19.2368V7.00098ZM21 7.00098H19.2368V9.00098H21V7.00098ZM24 10.001C24 8.34412 22.6569 7.00098 21 7.00098V9.00098C21.5523 9.00098 22 9.44869 22 10.001H24ZM24 20.001V10.001H22V20.001H24ZM21 23.001C22.6569 23.001 24 21.6578 24 20.001H22C22 20.5533 21.5523 21.001 21 21.001V23.001ZM2 23.001H21V21.001H2V23.001ZM-1 20.001C-1 21.6578 0.343146 23.001 2 23.001V21.001C1.44772 21.001 1 20.5533 1 20.001H-1ZM-1 10.501V20.001H1V10.501H-1ZM2 7.50098C0.343147 7.50098 -1 8.84412 -1 10.501H1C1 9.94869 1.44772 9.50098 2 9.50098V7.50098ZM4.31579 7.50098H2V9.50098H4.31579V7.50098ZM6.31579 9.50098C6.31579 8.39641 5.42036 7.50098 4.31579 7.50098V9.50098H6.31579ZM4.31579 11.501C5.42036 11.501 6.31579 10.6055 6.31579 9.50098H4.31579V11.501ZM2 11.501H4.31579V9.50098H2V11.501ZM3 20.001V10.501H1V20.001H3ZM21 19.001H2V21.001H21V19.001ZM20 10.001L20 20.001H22L22 10.001H20ZM19.2368 11.001H21V9.00098H19.2368V11.001ZM17.2368 9.00098C17.2368 10.1055 18.1323 11.001 19.2368 11.001V9.00098H17.2368ZM12 5.50098C12 5.77712 11.7761 6.00098 11.5 6.00098V8.00098C12.8807 8.00098 14 6.88169 14 5.50098H12ZM11.5 5.00098C11.7761 5.00098 12 5.22483 12 5.50098H14C14 4.12026 12.8807 3.00098 11.5 3.00098V5.00098ZM11 5.50098C11 5.22483 11.2239 5.00098 11.5 5.00098V3.00098C10.1193 3.00098 9 4.12026 9 5.50098H11ZM11.5 6.00098C11.2239 6.00098 11 5.77712 11 5.50098H9C9 6.88169 10.1193 8.00098 11.5 8.00098V6.00098Z" mask="url(#path-1-inside-1_3507_23369)" />
                            </svg> Смотреть на карте</button>
                    </div>

                    <div class="indoor__cards">
                        <?php
                        if ($indoor_query->have_posts()) :
                            while ($indoor_query->have_posts()) : $indoor_query->the_post();
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
                        endif; ?>
                    </div>
                </div>

                <div class="indoor__map-block map-block__content closeIndoor">

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
                                            <input type="radio" name="direction" value="indoor" id="dir2">
                                            <span></span>
                                            Indoor
                                        </label>
                                    </div>
                                </div>

                                <div class="map-block__choices format-indoor">
                                    <h4>Формат</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите формат конструкции</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            $map_format_types_indoor = get_terms(array(
                                                'taxonomy' => 'map_format_type_indoor',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($map_format_types_indoor) && !is_wp_error($map_format_types_indoor)) : ?>
                                                <?php foreach ($map_format_types_indoor as $map_format_type) : ?>
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

                                <div class="map-block__choices address">
                                    <h4>Адрес</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите адрес конструкции</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            // $address_indoor = get_terms(array(
                                            //     'taxonomy' => 'map_street',
                                            //     'hide_empty' => false,
                                            // ));
                                            $address_indoor = get_terms_by_post_type( array('map_street'), array('indoor'));

                                            if (!empty($address_indoor) && !is_wp_error($address_indoor)) : ?>
                                                <?php foreach ($address_indoor as $address) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($address->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($address->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="map-block__bottom"></div>
                        </div>
                    </div>

                    <div class="map-block__maps">

                        <div class="map-block__mob">
                            <button><svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.5395 4.55556H19.9079M15.0658 2V7.11111M15.0658 4.55556H1.75M6.59211 13.5H1.75M11.4342 10.9444V16.0556M24.75 13.5H11.4342M23.5395 22.4444H19.9079M15.0658 19.8889V25M15.0658 22.4444H1.75" stroke="#00468A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg> Фильтры</button>
                            <button class="buttonNone"><svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 1.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    <rect y="9" width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 10.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    <rect y="18" width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 19.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                </svg>
                                К списку</button>
                            <button class="indoor__list-mob"><svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 1.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    <rect y="9" width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 10.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    <rect y="18" width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 19.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                </svg>
                                К списку</button>
                        </div>

                        <div class="map-page__maps-img map-block__map" id="map" style="width: 100%; height: 100%; border-radius: 30px; overflow:hidden"></div>

                        <div class="indoor__block-map map-block__functions">

                            <button class="map-block__block-toggle buttonNone"></button>

                            <button class="indoor__none-map"><svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 1.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    <rect y="9" width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 10.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    <rect y="18" width="3" height="3" rx="1.5" fill="#00468A" />
                                    <path d="M8 19.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                </svg>Показать списком</button>

                            <div class="map-block__fun">
                                <div class="map-block__scale">
                                    <button><svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 25.5C12 26.3284 12.6716 27 13.5 27C14.3284 27 15 26.3284 15 25.5V15H25.5C26.3284 15 27 14.3284 27 13.5C27 12.6716 26.3284 12 25.5 12H15V1.5C15 0.671574 14.3284 0 13.5 0C12.6716 0 12 0.671574 12 1.5V12H1.5C0.671573 12 0 12.6716 0 13.5C0 14.3284 0.671573 15 1.5 15H12V25.5Z" fill="#00468A" />
                                        </svg></button>
                                    <button><svg width="27" height="3" viewBox="0 0 27 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.5 1.5H25.5" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                        </svg></button>
                                </div>

                                <!-- <div class="map-block__more">
                                    <button><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.23286 19.0744C3.16767 19.1394 3.11595 19.2167 3.08066 19.3017C3.04537 19.3868 3.02721 19.4779 3.02721 19.57C3.02721 19.6621 3.04537 19.7533 3.08066 19.8383C3.11595 19.9233 3.16767 20.0006 3.23286 20.0656L8.18326 25.0146C8.31453 25.1458 8.49254 25.2196 8.67816 25.2196C8.86377 25.2196 9.04179 25.1458 9.17306 25.0146L25.0127 9.17501C25.1439 9.04374 25.2176 8.86573 25.2176 8.68011C25.2176 8.4945 25.1439 8.31648 25.0127 8.18521L20.0623 3.23621C19.931 3.10498 19.753 3.03126 19.5674 3.03126C19.3817 3.03126 19.2037 3.10498 19.0725 3.23621L17.5885 4.72021L19.9811 7.11421C20.0478 7.17888 20.101 7.2562 20.1376 7.34165C20.1742 7.4271 20.1933 7.51898 20.194 7.61192C20.1947 7.70487 20.1768 7.79701 20.1415 7.88299C20.1062 7.96896 20.0541 8.04704 19.9883 8.11267C19.9225 8.1783 19.8443 8.23017 19.7582 8.26524C19.6721 8.30031 19.5799 8.3179 19.487 8.31696C19.394 8.31602 19.3022 8.29659 19.2169 8.25979C19.1315 8.22298 19.0543 8.16955 18.9899 8.10261L16.5987 5.71001L14.6177 7.69101L15.8553 8.92861C15.9828 9.06063 16.0533 9.23745 16.0517 9.42099C16.0501 9.60453 15.9765 9.7801 15.8467 9.90988C15.7169 10.0397 15.5414 10.1133 15.3578 10.1149C15.1743 10.1165 14.9975 10.0459 14.8655 9.91841L13.6279 8.68081L11.6483 10.6604L14.0409 13.053C14.1077 13.1176 14.161 13.1948 14.1977 13.2802C14.2344 13.3656 14.2537 13.4575 14.2545 13.5504C14.2553 13.6434 14.2376 13.7356 14.2024 13.8216C14.1672 13.9076 14.1153 13.9858 14.0495 14.0515C13.9838 14.1172 13.9057 14.1692 13.8196 14.2044C13.7336 14.2396 13.6414 14.2573 13.5485 14.2565C13.4555 14.2557 13.3637 14.2364 13.2783 14.1997C13.1929 14.163 13.1156 14.1097 13.0511 14.0428L10.6585 11.6502L8.67886 13.6298L9.91646 14.8674C9.98332 14.932 10.0366 15.0092 10.0733 15.0946C10.11 15.18 10.1293 15.2719 10.1301 15.3648C10.1309 15.4578 10.1132 15.55 10.078 15.636C10.0428 15.722 9.99086 15.8002 9.92514 15.8659C9.85941 15.9316 9.78125 15.9836 9.69523 16.0188C9.6092 16.054 9.51702 16.0717 9.42408 16.0709C9.33113 16.0701 9.23928 16.0508 9.15387 16.0141C9.06847 15.9774 8.99123 15.9241 8.92666 15.8572L7.68906 14.6196L5.70806 16.6006L8.10206 18.9932C8.16705 19.0583 8.21859 19.1355 8.25372 19.2205C8.28886 19.3055 8.30691 19.3966 8.30685 19.4886C8.30678 19.5806 8.2886 19.6716 8.25334 19.7566C8.21809 19.8415 8.16644 19.9187 8.10136 19.9837C8.03627 20.0487 7.95903 20.1002 7.87403 20.1354C7.78903 20.1705 7.69794 20.1886 7.60596 20.1885C7.51399 20.1884 7.42292 20.1703 7.33797 20.135C7.25302 20.0997 7.17585 20.0481 7.11086 19.983L4.71826 17.589L3.23286 19.0744ZM2.24446 21.0554C2.04931 20.8604 1.89451 20.6288 1.78889 20.374C1.68327 20.1191 1.62891 19.8459 1.62891 19.57C1.62891 19.2941 1.68327 19.0209 1.78889 18.7661C1.89451 18.5112 2.04931 18.2796 2.24446 18.0846L18.0827 2.24641C18.2777 2.05127 18.5092 1.89646 18.7641 1.79084C19.019 1.68522 19.2922 1.63086 19.5681 1.63086C19.8439 1.63086 20.1171 1.68522 20.372 1.79084C20.6269 1.89646 20.8584 2.05127 21.0535 2.24641L26.0025 7.19541C26.3961 7.58922 26.6173 8.12327 26.6173 8.68011C26.6173 9.23696 26.3961 9.771 26.0025 10.1648L10.1629 26.0044C9.76911 26.3977 9.23536 26.6186 8.67886 26.6186C8.12236 26.6186 7.58861 26.3977 7.19486 26.0044L2.24446 21.0554Z" fill="#00468A" />
                                        </svg></button>
                                    <button class="map-block__width"></button>
                                </div> -->
                            </div>

                        </div>
                    </div>
                </div>

                <div class="example">
                    <h2>примеры готовых <br> indoor решений</h2>

                    <div class="example__sliders">

                        <div class="swiper-wrapper">
                            <?php $exampleRek = get_field('example_rek_contr_indoor', $page_id);
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
                    </form>
                </div>

                <div class="advertising__service article">
                    <h1>другие услуги</h1>

                    <div class="article__cards">
                        <div class="article__card">
                            <?php
                            $page_id = 61;
                            $post = get_post($page_id);
                            ?>
                            <img src="<?= get_field("outdoor_main_bg", $page_id); ?>" alt="jpg">

                            <div class="article__text">
                                <h2>Наружная реклама</h2>

                                <p>
                                    <?php
                                    $content = $post->post_content;

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

                                <a class="article__link" href="/uslugi/outdoor">подробнее</a>
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
        let typeObject = 'indoor';

        // Функция для обновления URL
        function updateURL() {
            const params = new URLSearchParams();

            if (typeObject === 'indoor') {
                if (selectedFormatValuesIndoor.length > 0) params.set('format-indoor', selectedFormatValuesIndoor.join(','));
                if (selectedAddressValues.length > 0) params.set('address', selectedAddressValues.join(','));
            }

            // Устанавливаем параметр 'type' в URL
            params.set('type', typeObject);
            history.replaceState(null, '', '?' + params.toString());
        }

        // Функция для применения параметров URL
        function applyURLParams() {
            const params = new URLSearchParams(window.location.search);

            // Установка значения type в 'indoor', если его нет в URL
            if (!params.has('type')) {
                typeObject = 'indoor';
                updateURL(); // Вызываем функцию обновления URL
            }

            // Установка типа объекта на основе параметра в URL
            if (params.get('type')) {
                typeObject = params.get('type');
                if (typeObject === 'indoor') {
                    // Помечаем радио-кнопку для indoor
                    document.getElementById('dir2').checked = true;
                }
            }

            // Применяем фильтры на основе параметров URL
            if (typeObject === 'indoor') {
                if (selectedFormatValuesIndoor.length > 0) params.set('format-indoor', selectedFormatValuesIndoor.join(','));
                if (selectedAddressValues.length > 0) params.set('address', selectedAddressValues.join(','));

                // Устанавливаем состояние чекбоксов для indoor
                setCheckboxState(formatIndoor, selectedFormatValuesIndoor);
                setCheckboxState(addressIndoor, selectedAddressValues);

                // Отправляем формат для indoor
                sendFormatIndoor();
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

        // Списки чекбоксов для фильтров indoor
        let formatIndoor = document.querySelectorAll('.map-block__choices.format-indoor input[type="checkbox"]');
        let addressIndoor = document.querySelectorAll('.map-block__choices.address input[type="checkbox"]');

        // Выбранные значения фильтров indoor
        let selectedFormatValuesIndoor = [];
        let selectedAddressValues = [];

        // Обработчики изменения состояния чекбоксов для формата indoor
        formatIndoor.forEach((input) => {
            input.addEventListener('change', function() {
                let value = this.value;
                if (this.checked) {
                    selectedFormatValuesIndoor.push(value);
                } else {
                    let index = selectedFormatValuesIndoor.indexOf(value);
                    if (index !== -1) {
                        selectedFormatValuesIndoor.splice(index, 1);
                    }
                }
                updateURL(); // Обновляем URL
                sendFormatIndoor(); // Отправляем формат для indoor
            });
        });

        // Обработчики изменения состояния чекбоксов для адресов indoor
        addressIndoor.forEach((input) => {
            input.addEventListener('change', function() {
                let value = this.value;
                if (this.checked) {
                    selectedAddressValues.push(value);
                } else {
                    let index = selectedAddressValues.indexOf(value);
                    if (index !== -1) {
                        selectedAddressValues.splice(index, 1);
                    }
                }
                updateURL(); // Обновляем URL
                sendFormatIndoor(); // Отправляем формат для indoor
            });
        });

        // Функция для отправки формата и обновления элементов indoor
        const sendFormatIndoor = async () => {
            const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";
            let mapHtml = document.querySelectorAll('.ymaps-2-1-79-map'); // Получаем все карты

            // Создаем новый экземпляр FormData
            let formData = new FormData();
            formData.append("action", "load_map_indoor");

            // Преобразуем массивы в строки, разделенные запятыми
            if (selectedFormatValuesIndoor.length > 0) {
                const selectedFormatValuesIndoorStr = selectedFormatValuesIndoor.join(',');
                formData.append("selectedFormatValuesIndoor", selectedFormatValuesIndoorStr);
            }

            if (selectedAddressValues.length > 0) {
                const selectedAddressValuesStr = selectedAddressValues.join(',');
                formData.append("selectedAddressValues", selectedAddressValuesStr);
            }

            formData.append("isIndoorPage", window.location.href.includes("indoor"));

            // Находим контейнер списка indoor
            const containerIndoorList = document.querySelector(".indoor__cards");

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
                        elementsList = dataFetch.data.elementsListIndoor;

                        setTimeout(() => {
                            if (containerIndoorList) {
                                containerIndoorList.innerHTML = dataFetch.data.outputIndoor;
                            }
                            // Удаляем все карты
                            mapHtml.forEach((map) => {
                                map.remove();
                            });

                            // document.querySelector('.map-block__more button:nth-child(1)').style.display = 'none';
                            // document.querySelector('.map-block__more button:nth-child(2)').style.display = 'flex';

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