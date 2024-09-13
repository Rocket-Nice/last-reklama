<?php get_header();
/* Template Name: Requirements*/
?>
<main class="main">
    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>

    <section class="accordions">
        <div class="container">
            <div class="accordions__content">
                <button class="accordions__downland" id="banners">
                    <span>Технические требования к Оригинал — Макетам и материалам</span>
                    <span>
                        <a href="<?= get_field("tehnik_maket_and_materials_file"); ?>" download>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.7778 10V17.7778H2.22222V10H0V17.7778C0 19 1 20 2.22222 20H17.7778C19 20 20 19 20 17.7778V10H17.7778ZM11.1111 10.7444L13.9889 7.87778L15.5556 9.44444L10 15L4.44444 9.44444L6.01111 7.87778L8.88889 10.7444V0H11.1111V10.7444Z" />
                            </svg>
                        </a>
                    </span>
                </button>

                <ul class="accordions__ul">
                    <?php if (get_field("tehnik_maket_and_materials")) :
                        foreach (get_field("tehnik_maket_and_materials") as $key) : ?>
                            <li class="accordions__li">
                                <button class="accordions__card">
                                    <span class="accordions"><?= $key['tehnik_maket_and_materials_title']; ?></span>
                                    <span class="accordions__arrows"></span>
                                </button>
                                <div class="accordions__content-li">
                                    <div class="accordions__top">
                                        <div class="accordions__info">
                                            <h4>технические требования к оригинал-макетам</h4>

                                            <div class="accordions__all">
                                                <?= $key['tehnik_maket_and_materials_desk']; ?>
                                            </div>
                                        </div>

                                        <div class="accordions__info">
                                            <h4>технические требования к Материалам</h4>

                                            <div class="accordions__all">
                                                <?= $key['tehnik_materials_desk']; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordions__bottom">
                                        <div class="accordions__info">
                                            <h4>Транспортировка</h4>

                                            <div class="accordions__all">
                                                <?= $key['tehnik_transportir']; ?>

                                            </div>
                                        </div>

                                        <div class="accordions__diagram">
                                            <img src="<?= $key['tehnik_img']; ?>" alt="png">

                                            <a href="<?= $key['tehnik_file']; ?>" download>
                                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="50" height="50" rx="25" fill="#00468A" />
                                                    <path d="M32.7778 25V32.7778H17.2222V25H15V32.7778C15 34 16 35 17.2222 35H32.7778C34 35 35 34 35 32.7778V25H32.7778ZM26.1111 25.7444L28.9889 22.8778L30.5556 24.4444L25 30L19.4444 24.4444L21.0111 22.8778L23.8889 25.7444V15H26.1111V25.7444Z" fill="#F7F7F7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                    <?php endforeach;
                    endif; ?>
                </ul>

                <div class="accordions__blocks">
                    <div class="accordions__block">
                        <?= get_field("tehnik_maket_and_materials_desk"); ?>
                    </div>

                    <div class="accordions__block-img">
                        <img src="<?= get_field("tehnik_maket_and_materials_img"); ?>" alt="jpg">
                    </div>
                </div>

                <button class="accordions__downland" id="video">
                    <span>Технические требования к оригинал-макетам</span>
                    <a href="<?= get_field("tehnik_original_maket_file"); ?>" download>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.7778 10V17.7778H2.22222V10H0V17.7778C0 19 1 20 2.22222 20H17.7778C19 20 20 19 20 17.7778V10H17.7778ZM11.1111 10.7444L13.9889 7.87778L15.5556 9.44444L10 15L4.44444 9.44444L6.01111 7.87778L8.88889 10.7444V0H11.1111V10.7444Z" />
                        </svg>
                    </a>
                </button>

                <ul class="accordions__ul">
                    <?php if (get_field("tehnik_original_maket")) :
                        foreach (get_field("tehnik_original_maket") as $key) : ?>
                            <li class="accordions__li">
                                <button class="accordions__card">
                                    <span class="accordions"><?= $key['tehnik_original_maket_title']; ?></span>
                                    <span class="accordions__arrows"></span>
                                </button>
                                <div class="accordions__content-li">
                                    <div class="accordions__top">
                                        <div class="accordions__info">
                                            <h4>технические требования к оригинал-макетам</h4>

                                            <div class="accordions__all">
                                                <?= $key['tehnik_original_maket_desk']; ?>
                                            </div>
                                        </div>

                                        <div class="accordions__info">
                                            <h4>технические требования к Материалам</h4>

                                            <div class="accordions__all">
                                                <?= $key['tehnik_materials_desk_orig']; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordions__bottom">
                                        <div class="accordions__info">
                                            <h4>Транспортировка</h4>

                                            <div class="accordions__all">
                                                <?= $key['tehnik_original_maket_transportir']; ?>

                                            </div>
                                        </div>

                                        <div class="accordions__diagram">
                                            <img src="<?= $key['tehnik_original_maket_img']; ?>" alt="png">

                                            <a href="<?= $key['tehnik_original_maket_file_in']; ?>" download>
                                                <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="50" height="50" rx="25" fill="#00468A" />
                                                    <path d="M32.7778 25V32.7778H17.2222V25H15V32.7778C15 34 16 35 17.2222 35H32.7778C34 35 35 34 35 32.7778V25H32.7778ZM26.1111 25.7444L28.9889 22.8778L30.5556 24.4444L25 30L19.4444 24.4444L21.0111 22.8778L23.8889 25.7444V15H26.1111V25.7444Z" fill="#F7F7F7" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                    <?php endforeach;
                    endif; ?>
                </ul>

                <div class="accordions__blocks">
                    <div class="accordions__block">
                        <?= get_field("tehnik_original_maket_desk_two"); ?>
                    </div>

                    <div class="accordions__block-img accordions__img-two">
                        <img src="<?= get_field("tehnik_original_maket_img_two"); ?>" alt="jpg">
                    </div>
                </div>

                <div class="accordions__markers">
                    <div class="accordions__marker-block">
                        <h2><?= get_field("about_mark_title"); ?></h2>

                        <?= get_field("about_mark_top_desk"); ?>
                    </div>

                    <div class="accordions__marker-block">

                        <?= get_field("about_mark_down_desk"); ?>
                    </div>

                    <div class="accordions__marker-img">
                        <img src="<?= get_field("about_mark_img"); ?>" alt="jpg">
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

</main>
<?php get_footer(); ?>