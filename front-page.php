<?php get_header();
// Добавляем данные каждой записи в массив
$elementsListContact[] = array(
    'coords' => get_field('contact_coordinate', 57),
    'title' => 'Реклама Центр',
    'address' => get_field('address', 'option')
);
?>

<main class="main">
    <section class="home">
        <div class="container">
            <div class="home__content">

                <div class="home__text">
                    <?= get_the_content(); ?>

                    <button class="home__button-active-b home__button"><span>оставить заявку</span><span></span></button>
                </div>

                <div class="home__info">
                    <div class="home__photo">
                        <div class="home__info-text">
                            <h2><?= get_field('count_rek_construction'); ?></h2>
                            <p>Собственных рекламных конструкций Outdoor и Indoor</p>
                        </div>
                    </div>

                    <a href="/uslugi/outdoor" class="home__photo-card">
                        <div class="home__info-block">
                            <h2>Outdoor</h2>
                            <span></span>
                        </div>
                    </a>

                    <a href="/indoor" class="home__photo-card">
                        <div class="home__info-block">
                            <h2>Indoor</h2>
                            <span></span>
                        </div>
                    </a>
                </div>
                <style>
                    .home__photo {
                        background-image: url("<?= get_field("count_rek_first_img"); ?>");
                    }

                    .home__photo-card:nth-child(2) {
                        background-image: url("<?= get_field("count_rek_outdoor_img"); ?>");
                    }

                    .home__photo-card:nth-child(3) {
                        background-image: url("<?= get_field("count_rek_indoor_img"); ?>");
                    }
                </style>
            </div>
        </div>
    </section>

    <section class="map-block">
        <div class="container">
            <div class="map-block__content">
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
                                    <label class="map-block__point">
                                        <input type="radio" name="direction" value="indoor" id="dir2">
                                        <span></span>
                                        Indoor
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

                            <div class="map-block__choices raspolozhenie" style="display: none !important;">
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

                            <div class="map-block__choices format-indoor" style="display: none;">
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

                            <div class="map-block__choices address" style="display: none;">
                                <h4>Адрес</h4>

                                <div class="map-block__choice">
                                    <button class="map-block__choice-button">Выберите адрес конструкции</button>
                                    <div class="map-block__choice-content">
                                        <?php
                                        // $address_indoor = get_terms(array(
                                        //     'taxonomy' => 'map_street',
                                        //     'hide_empty' => false,
                                        // ));
                                        $address_indoor = get_terms_by_post_type(array('map_street'), array('indoor'));

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
        </div>
    </section>

    <section class="info">
        <div class="container">
            <div class="info__content">

                <div class="info__more">

                    <div class="info__more-block">
                        <h2><?= get_field("dignities_blue_title"); ?></h2>
                        <a href="/about-page">подробнее о компании</a>
                    </div>

                    <img src="<?= get_field("dignities_img"); ?>" alt="img" class="info__more-block">

                    <div class="info__more-block">
                        <h2><?= get_field("dignities_year_count"); ?></h2>
                        <p><?= get_field("dignities_year_count_desk"); ?></p>
                    </div>

                    <div class="info__more-block">
                        <h2><?= get_field("dignities_partners_count"); ?></h2>
                        <p><?= get_field("dignities_partners_count_desk"); ?></p>
                    </div>

                </div>

                <div class="info__cards">
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/one.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_first_title"); ?></h2>
                            <?= get_field("dignities_first_subtitle"); ?>
                        </div>
                    </div>
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/two.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_second_title"); ?></h2>
                            <?= get_field("dignities_second_subtitle"); ?>
                        </div>
                    </div>
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/three.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_third_title"); ?></h2>
                            <?= get_field("dignities_third_subtitle"); ?>
                        </div>
                    </div>
                    <div class="info__card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/decMain/four.svg" alt="card">
                        <div class="info__card-text">
                            <h2><?= get_field("dignities_fourth_title"); ?></h2>
                            <?= get_field("dignities_fourth_subtitle"); ?>
                        </div>
                    </div>
                </div>

                <div class="application">
                    <div class="application__photo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/mainPage/application.jpg" alt="application">
                    </div>
                    <div class="application__info">
                        <h2>Оставьте заявку сейчас <br> и получите скидку на размещение рекламы.</h2>

                        <button class="home__button-active-b home__button"><span>оставить заявку</span><span></span></button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="advertisement">
        <div class="container">
            <div class="advertisement__content">

                <div class="advertisement__company">
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

                <div class="advantages">
                    <h2>преимущества <br> наружной рекламы</h2>

                    <div class="advantages__cards">

                        <div class="advantages__card">
                            <div class="advantages__title">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/advantages/one.svg" alt="card">
                                <h3><?= get_field("advantages_first_title", 'option'); ?></h3>
                            </div>
                            <?= get_field("advantages_first_desk", 'option'); ?>
                        </div>

                        <div class="advantages__card">
                            <div class="advantages__title">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/advantages/two.svg" alt="card">
                                <h3><?= get_field("advantages_second_title", 'option'); ?></h3>
                            </div>
                            <?= get_field("advantages_second_desk", 'option'); ?>
                        </div>

                        <div class="advantages__card">
                            <div class="advantages__title">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/advantages/three.svg" alt="card">
                                <h3><?= get_field("advantages_third_title", 'option'); ?></h3>
                            </div>
                            <?= get_field("advantages_third_desk", 'option'); ?>
                        </div>

                        <div class="advantages__card">
                            <div class="advantages__title">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/advantages/four.svg" alt="card">
                                <h3><?= get_field("advantages_fourth_title", 'option'); ?></h3>
                            </div>
                            <?= get_field("advantages_fourth_desk", 'option'); ?>
                        </div>

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

            </div>
        </div>
    </section>

    <section class="work">
        <div class="container">
            <div class="work__content">

                <div class="work__stages">
                    <h2>как мы работаем</h2>

                    <div class="work__stages-cards">

                        <div class="work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/one.svg" alt="stages">

                            <div class="work__stages-text">
                                <span>Шаг 1</span>
                                <h3><?= get_field("first_step", 'option'); ?></h3>
                            </div>
                        </div>

                        <div class="work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/two.svg" alt="stages">

                            <div class="work__stages-text">
                                <span>Шаг 2</span>
                                <h3><?= get_field("second_step", 'option'); ?></h3>
                            </div>
                        </div>

                        <div class="work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/three.svg" alt="stages">

                            <div class="work__stages-text">
                                <span>Шаг 3</span>
                                <h3><?= get_field("third_step", 'option'); ?></h3>
                            </div>
                        </div>

                        <div class="work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/four.svg" alt="stages">

                            <div class="work__stages-text">
                                <span>Шаг 4</span>
                                <h3><?= get_field("fourth_step", 'option'); ?></h3>
                            </div>
                        </div>

                        <div class="work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/five.svg" alt="stages">

                            <div class="work__stages-text">
                                <span>Шаг 5</span>
                                <h3><?= get_field("fifth_step", 'option'); ?></h3>
                            </div>
                        </div>

                        <div class="work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/six.svg" alt="stages">

                            <div class="work__stages-text">
                                <span>Шаг 6</span>
                                <h3><?= get_field("sixth_step", 'option'); ?></h3>
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
                    </form>
                </div>

            </div>
        </div>
    </section>

    <section class="blog">
        <div class="container">
            <div class="blog__content">

                <div class="article">
                    <h1>блог о рекламе</h1>

                    <div class="article__cards">
                        <?php $news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 3,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        ));
                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                        ?>
                                <div class="article__card">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">

                                    <div class="article__text">
                                        <h2><?php the_title(); ?></h2>
                                        <span><?php echo get_the_date(); ?></span>

                                        <?php the_content(); ?>

                                        <a class="article__link" href="<?php echo get_post_permalink(); ?>">подробнее</a>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </div>

                    <a class="article__link-end" href="/news">перейти ко всем статьям блога</a>
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

                    <div class="map-block__map" id="map2" style="width: 100%; height: 100%; min-height: 505px; border-radius: 30px; overflow:hidden"></div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Получение всех радио-кнопок для выбора типа объекта
        let directionInputs = document.querySelectorAll('.map-block__direction input[type="radio"]');
        let elementsListContact = <?php echo json_encode($elementsListContact); ?>;
        let initialCoords1 = elementsListContact.length > 0 ? elementsListContact[0].coords.split(',').map(parseFloat) : [59.938784, 30.314997];

        // Тип объекта по умолчанию
        let typeObject = 'outdoor';

        // Функция для обновления URL
        function updateURL() {
            const params = new URLSearchParams();

            // Обновление параметров URL для outdoor
            if (typeObject === 'outdoor') {
                if (selectedFormatValues.length > 0) params.set('format', selectedFormatValues.join(','));
                if (selectedRajonValues.length > 0) params.set('rajon', selectedRajonValues.join(','));
                if (selectedRaspValues.length > 0) params.set('rasp', selectedRaspValues.join(','));
                if (selectedFeaturesValues.length > 0) params.set('features', selectedFeaturesValues.join(','));
                if (selectedIdOutdoor) params.set('id', selectedIdOutdoor);
            }
            // Обновление параметров URL для indoor
            else if (typeObject === 'indoor') {
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
                    document.querySelector('.map-block__choices.format-indoor').style.display = 'none';
                    document.querySelector('.map-block__choices.address').style.display = 'none';

                } else if (typeObject === 'indoor') {
                    // Помечаем радио-кнопку для indoor
                    document.getElementById('dir2').checked = true;

                    // Показываем список indoor и скрываем outdoor
                    if (document.querySelector('.outdoor-list')) {
                        document.querySelector('.outdoor-list').style.display = 'none';
                    }
                    if (document.querySelector('.indoor-list')) {
                        document.querySelector('.indoor-list').style.display = 'flex';
                    }

                    // Скрываем фильтры для outdoor, так как мы на indoor
                    document.querySelector('.map-block__id').style.display = 'none';
                    document.querySelector('.map-block__choices.format').style.display = 'none';
                    document.querySelector('.map-block__choices.rajon').style.display = 'none';
                    // document.querySelector('.map-block__choices.raspolozhenie').style.display = 'none';
                    document.querySelector('.map-block__choices.features').style.display = 'none';
                    document.querySelector('.map-block__choices.format-indoor').style.display = 'block';
                    document.querySelector('.map-block__choices.address').style.display = 'block';
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
            } else if (typeObject === 'indoor') {
                selectedFormatValuesIndoor = params.get('format-indoor') ? params.get('format-indoor').split(',') : [];
                selectedAddressValues = params.get('address') ? params.get('address').split(',') : [];

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

        // Списки чекбоксов для фильтров indoor
        let formatIndoor = document.querySelectorAll('.map-block__choices.format-indoor input[type="checkbox"]');
        let addressIndoor = document.querySelectorAll('.map-block__choices.address input[type="checkbox"]');

        // Выбранные значения фильтров indoor
        let selectedFormatValuesIndoor = [];
        let selectedAddressValues = [];

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

            // Находим контейнер списка indoor
            const containerIndoorList = document.querySelector(".indoor-list");

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

        // Применяем параметры URL при загрузке страницы
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

                        if ([point]) {
                            // Находим все точки, принадлежащие тому же району (description)
                            let districtPoints = elementsList.filter(element => ((element.term === point.popup.description) || element.address === point.popup.description)).map(element => ({
                                coords: element.coords.split(',').map(parseFloat),
                                popup: {
                                    image: element.image,
                                    header: element.title,
                                    body: (typeObject === "outdoor") ? `GRP: ${element.grp}<br>OTS: ${element.ots}` : `Рабочее время: ${element.timeWork}<br>Тип поверхности: ${element.typeUp}`,
                                    description: (typeObject === "outdoor") ? element.term : element.address,
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
                //     // Симулируем клик по встроенной кнопке измерения расстояния1
                //     var ymapsFloatButton = document.querySelector('.ymaps-2-1-79-float-button');
                //     if (ymapsFloatButton) {
                //         ymapsFloatButton.click(); // Вызываем клик на встроенной кнопке
                //     }
                // }
            });
        }

        function initializeMapContact() {
            // Ждем, пока API Яндекс.Карт станет доступен
            ymaps.ready(function() {
                // Инициализация карты с центром и начальным уровнем масштабирования
                let map = new ymaps.Map("map2", {
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
        initializeMapContact();
    });
</script>
<?php get_footer(); ?>