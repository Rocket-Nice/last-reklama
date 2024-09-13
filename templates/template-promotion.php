<?php get_header();
/* Template Name: Promotion*/
?>
<main class="main">

    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>

    <div class="promotion">
        <div class="container">
            <div class="promotion__content">

                <div class="promotion__blocks">

                    <div class="promotion__key">
                        <h2><?= the_title(); ?></h2>
                        <?= the_content(); ?>
                        <button class="home__button home__button-active-b"><span>оставить заявку</span><span></span></button>
                    </div>

                    <img src="<?= get_field("complex_bg_img"); ?>" alt="img">

                    <div class="promotion__seo">
                        <?= get_field("complex_first"); ?>
                    </div>

                    <div class="promotion__advertisement">
                        <?= get_field("complex_second"); ?>
                    </div>

                    <div class="promotion__analitics">
                        <?= get_field("complex_third"); ?>
                    </div>

                </div>

                <div class="promotion__trust">
                    <h2>почему нам можно доверить продвижение компании</h2>

                    <div class="promotion__trust-cards">

                        <div class="promotion__trust-card">
                            <?= get_field("complex_two_first"); ?>
                        </div>

                        <div class="promotion__trust-card">
                            <?= get_field("complex_two_second"); ?>
                        </div>

                        <div class="promotion__trust-card">
                            <?= get_field("complex_two_third"); ?>
                        </div>

                        <div class="promotion__trust-card">
                            <?= get_field("complex_two_fourth"); ?>
                        </div>

                        <div class="promotion__trust-card">
                            <?= get_field("complex_two_fifth"); ?>
                        </div>

                        <div class="promotion__trust-card">
                            <?= get_field("complex_two_sixth"); ?>
                        </div>

                    </div>
                </div>

                <div class="promotion__result">
                    <h2>результаты от продвижения с нами</h2>

                    <div class="promotion__results">
                        <div class="promotion__result-cards">
                            <div class="promotion__result-card">
                                <h3><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="25" cy="25" r="4" fill="#00468A" />
                                        <circle cx="25" cy="15" r="3" fill="#00468A" />
                                        <circle cx="25" cy="7" r="2" fill="#00468A" />
                                        <circle cx="25" cy="1" r="1" fill="#00468A" />
                                        <circle cx="35" cy="25" r="3" transform="rotate(90 35 25)" fill="#00468A" />
                                        <circle cx="43" cy="25" r="2" transform="rotate(90 43 25)" fill="#00468A" />
                                        <circle cx="49" cy="25" r="1" transform="rotate(90 49 25)" fill="#00468A" />
                                        <circle cx="25" cy="35" r="3" transform="rotate(-180 25 35)" fill="#00468A" />
                                        <circle cx="25" cy="43" r="2" transform="rotate(-180 25 43)" fill="#00468A" />
                                        <circle cx="25" cy="49" r="1" transform="rotate(-180 25 49)" fill="#00468A" />
                                        <circle cx="15" cy="25" r="3" transform="rotate(-90 15 25)" fill="#00468A" />
                                        <circle cx="7" cy="25" r="2" transform="rotate(-90 7 25)" fill="#00468A" />
                                        <circle cx="1" cy="25" r="1" transform="rotate(-90 1 25)" fill="#00468A" />
                                        <circle cx="17" cy="17" r="3" fill="#00468A" />
                                        <circle cx="17" cy="33" r="3" fill="#00468A" />
                                        <circle cx="33" cy="17" r="3" fill="#00468A" />
                                        <circle cx="33" cy="33" r="3" fill="#00468A" />
                                        <circle cx="10" cy="13" r="2" fill="#00468A" />
                                        <circle cx="10" cy="37" r="2" fill="#00468A" />
                                        <circle cx="40" cy="13" r="2" fill="#00468A" />
                                        <circle cx="40" cy="37" r="2" fill="#00468A" />
                                        <circle cx="5" cy="10" r="1" fill="#00468A" />
                                        <circle cx="5" cy="40" r="1" fill="#00468A" />
                                        <circle cx="45" cy="10" r="1" fill="#00468A" />
                                        <circle cx="45" cy="40" r="1" fill="#00468A" />
                                    </svg><?= get_field("complex_third_first_title"); ?></h3>
                                <?= get_field("complex_third_first"); ?>
                            </div>
                            <div class="promotion__result-card">
                                <h3><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M43.1156 0.278418L42.6234 0L42.1311 0.278417L35.724 3.902L28.8798 0.265749L28.4106 0.0164808L27.9414 0.265749L21.0894 3.9061L14.4563 0.271855L13.9758 0.00859666L13.4953 0.271855L6.89775 3.88656L1.04585 0.296474L0 2.00123L6.34647 5.89473L6.84104 6.19814L7.34989 5.91935L13.9758 2.28911L20.6016 5.91935L21.0748 6.1786L21.5513 5.92545L28.4106 2.28122L35.2699 5.92545L35.7541 6.18271L36.2313 5.91279L42.6234 2.2977L49.0154 5.91279L49.9999 4.17192L43.1156 0.278418ZM42.6234 8.76074L43.1156 9.03916L49.9999 12.9327L49.0154 14.6735L42.6234 11.0584L36.2313 14.6735L35.7541 14.9434L35.2699 14.6862L28.4106 11.042L21.5513 14.6862L21.0748 14.9393L20.6016 14.6801L13.9758 11.0498L7.34989 14.6801L6.84104 14.9589L6.34647 14.6555L5.96046e-08 10.762L1.04585 9.05722L6.89775 12.6473L13.4953 9.0326L13.9758 8.76934L14.4563 9.0326L21.0894 12.6668L27.9414 9.02649L28.4106 8.77722L28.8798 9.02649L35.724 12.6627L42.1311 9.03916L42.6234 8.76074ZM43.1157 17.7994L42.6234 17.521L42.1311 17.7994L35.724 21.423L28.8798 17.7868L28.4106 17.5375L27.9414 17.7868L21.0895 21.4271L14.4563 17.7929L13.9758 17.5296L13.4953 17.7929L6.89776 21.4076L1.04586 17.8175L1.22786e-05 19.5223L6.34648 23.4158L6.84105 23.7192L7.3499 23.4404L13.9758 19.8101L20.6017 23.4404L21.0748 23.6996L21.5513 23.4465L28.4106 19.8023L35.2699 23.4465L35.7541 23.7037L36.2314 23.4338L42.6234 19.8187L49.0154 23.4338L50 21.6929L43.1157 17.7994ZM43.1157 26.56L42.6234 26.2816L42.1311 26.56L35.724 30.1836L28.8798 26.5473L28.4106 26.298L27.9414 26.5473L21.0895 30.1877L14.4563 26.5534L13.9758 26.2902L13.4953 26.5534L6.89776 30.1681L1.04586 26.578L1.22786e-05 28.2828L6.34648 32.1763L6.84105 32.4797L7.3499 32.2009L13.9758 28.5707L20.6017 32.2009L21.0748 32.4602L21.5513 32.207L28.4106 28.5628L35.2699 32.207L35.7541 32.4643L36.2314 32.1943L42.6234 28.5793L49.0154 32.1943L50 30.4535L43.1157 26.56ZM43.1157 35.3205L42.6234 35.0421L42.1311 35.3205L35.724 38.9441L28.8798 35.3078L28.4106 35.0586L27.9414 35.3078L21.0895 38.9482L14.4563 35.3139L13.9758 35.0507L13.4953 35.3139L6.89776 38.9286L1.04586 35.3386L1.20401e-05 37.0433L6.34648 40.9368L6.84105 41.2402L7.3499 40.9614L13.9758 37.3312L20.6017 40.9614L21.0748 41.2207L21.5513 40.9675L28.4106 37.3233L35.2699 40.9675L35.7541 41.2248L36.2314 40.9549L42.6234 37.3398L49.0154 40.9549L50 39.214L43.1157 35.3205ZM42.6234 43.8026L43.1157 44.081L50 47.9745L49.0154 49.7154L42.6234 46.1003L36.2314 49.7154L35.7541 49.9853L35.2699 49.7281L28.4106 46.0838L21.5513 49.7281L21.0748 49.9812L20.6017 49.722L13.9758 46.0917L7.3499 49.722L6.84105 50.0008L6.34648 49.6973L1.20401e-05 45.8038L1.04586 44.0991L6.89776 47.6892L13.4953 44.0745L13.9758 43.8112L14.4563 44.0745L21.0895 47.7087L27.9414 44.0684L28.4106 43.8191L28.8798 44.0684L35.724 47.7046L42.1311 44.081L42.6234 43.8026Z" fill="#00468A" />
                                    </svg><?= get_field("complex_third_second_title"); ?></h3>
                                <?= get_field("complex_third_second"); ?>
                            </div>
                            <div class="promotion__result-card">
                                <h3><svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25 0L32.7168 2.41241L40.4509 4.77457L45.203 11.0401L50 17.2746L49.9722 25L50 32.7254L45.203 38.9599L40.4509 45.2254L32.7168 47.5876L25 50L17.2832 47.5876L9.54915 45.2254L4.79704 38.9599L0 32.7254L0.0277717 25L0 17.2746L4.79704 11.0401L9.54915 4.77457L17.2832 2.41241L25 0ZM32.1326 4.32518L39.2481 6.49844L43.6094 12.2487L43.6094 12.2487L43.6179 12.2597L47.9976 17.9518L47.9722 24.9928L47.9722 25L47.9722 25.0072L47.9976 32.0482L43.6179 37.7403L43.6178 37.7402L43.6094 37.7513L39.2481 43.5016L32.1326 45.6748L32.1326 45.6748L32.1201 45.6787L25 47.9045L17.8799 45.6787L17.8799 45.6787L17.8674 45.6748L10.7519 43.5016L6.39055 37.7513L6.39059 37.7513L6.38213 37.7403L2.00245 32.0482L2.02776 25.0072L2.02778 25L2.02776 24.9928L2.00245 17.9518L6.38213 12.2597L6.38217 12.2598L6.39055 12.2487L10.7519 6.49844L17.8674 4.32518L17.8674 4.32522L17.8799 4.32131L25 2.09545L32.1201 4.32131L32.1201 4.32135L32.1326 4.32518ZM31.1735 6.92993L25 5L18.8265 6.92993L12.6393 8.81966L8.83764 13.8321L5 18.8197L5.02222 25L5 31.1803L8.83764 36.1679L12.6393 41.1803L18.8265 43.0701L25 45L31.1735 43.0701L37.3607 41.1803L41.1624 36.1679L45 31.1803L44.9778 25L45 18.8197L41.1624 13.8321L37.3607 8.81966L31.1735 6.92993ZM36.158 10.5435L30.5893 8.8427L30.5767 8.83886L30.5767 8.83882L25 7.09545L19.4233 8.83882L19.4107 8.84274L19.4107 8.8427L13.842 10.5435L10.4311 15.0407L10.4228 15.0517L10.4227 15.0517L7.00245 19.4969L7.0222 24.9928L7.02223 25L7.0222 25.0072L7.00245 30.5031L10.4227 34.9483L10.4312 34.9593L10.4311 34.9593L13.842 39.4565L19.4107 41.1573L19.4233 41.1611L19.4233 41.1612L25 42.9045L30.5767 41.1612L30.5893 41.1573L30.5893 41.1573L36.158 39.4565L39.5689 34.9593L39.5772 34.9483L39.5773 34.9483L42.9976 30.5031L42.9778 25.0072L42.9778 25L42.9778 24.9928L42.9976 19.4969L39.5773 15.0517L39.5688 15.0407L39.5689 15.0407L36.158 10.5435ZM25 10L29.6301 11.4474L34.2705 12.8647L37.1218 16.6241L40 20.3647L39.9833 25L40 29.6353L37.1218 33.3759L34.2705 37.1353L29.6301 38.5526L25 40L20.3699 38.5526L15.7295 37.1353L12.8782 33.3759L10 29.6353L10.0167 25L10 20.3647L12.8782 16.6241L15.7295 12.8647L20.3699 11.4474L25 10ZM29.0459 13.3602L33.0678 14.5886L35.5283 17.8327L35.5282 17.8327L35.5367 17.8437L37.9976 21.042L37.9833 24.9928L37.9833 25L37.9833 25.0072L37.9976 28.958L35.5367 32.1563L35.5366 32.1563L35.5283 32.1673L33.0678 35.4114L29.0459 36.6398L29.0459 36.6397L29.0334 36.6437L25 37.9045L20.9666 36.6437L20.9667 36.6436L20.9541 36.6398L16.9322 35.4114L14.4717 32.1673L14.4718 32.1673L14.4633 32.1563L12.0024 28.958L12.0167 25.0072L12.0167 25L12.0167 24.9928L12.0024 21.042L14.4633 17.8437L14.4634 17.8437L14.4717 17.8327L16.9322 14.5886L20.9541 13.3602L20.9541 13.3603L20.9666 13.3563L25 12.0955L29.0334 13.3563L29.0333 13.3564L29.0459 13.3602ZM25 15L28.0867 15.965L31.1803 16.9098L33.0812 19.416L35 21.9098L34.9889 25L35 28.0902L33.0812 30.584L31.1803 33.0902L28.0867 34.035L25 35L21.9133 34.035L18.8197 33.0902L16.9188 30.584L15 28.0902L15.0111 25L15 21.9098L16.9188 19.416L18.8197 16.9098L21.9133 15.965L25 15ZM27.5025 17.8777L29.9776 18.6337L31.4877 20.6246L31.4876 20.6247L31.4961 20.6357L32.9976 22.587L32.9889 24.9928L32.9889 25L32.9889 25.0072L32.9976 27.413L31.4961 29.3643L31.4961 29.3643L31.4877 29.3754L29.9776 31.3663L27.5025 32.1223L27.5025 32.1222L27.49 32.1261L25 32.9045L22.51 32.1261L22.51 32.1261L22.4975 32.1223L20.0224 31.3663L18.5123 29.3754L18.5124 29.3753L18.5039 29.3643L17.0024 27.413L17.0111 25.0072L17.0111 25L17.0111 24.9928L17.0024 22.587L18.5039 20.6357L18.5039 20.6357L18.5123 20.6246L20.0224 18.6337L22.4975 17.8777L22.4975 17.8778L22.51 17.8739L25 17.0955L27.49 17.8739L27.49 17.8739L27.5025 17.8777Z" fill="#00468A" />
                                    </svg>
                                    <?= get_field("complex_third_third_title"); ?></h3>
                                <?= get_field("complex_third_third"); ?>
                            </div>
                        </div>
                        <img src="<?= get_field("complex_third_bg"); ?>" alt="img">
                    </div>
                </div>

                <div class="promotion__work work__stages">
                    <h2>этапы работы</h2>

                    <div class="promotion__work-cards">

                        <div class="promotion__work-card work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/one.svg" alt="stages">

                            <div class="promotion__work-text work__stages-text">
                                <h3>Этап 1: стратегия</h3>
                                <p><?= get_field("complex_first_etap"); ?></p>
                            </div>
                        </div>

                        <div class="promotion__work-card work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/two.svg" alt="stages">

                            <div class="promotion__work-text work__stages-text">
                                <h3>2 этап: аналитика</h3>
                                <p><?= get_field("complex_second_etap"); ?></p>
                            </div>
                        </div>

                        <div class="promotion__work-card work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/three.svg" alt="stages">

                            <div class="promotion__work-text work__stages-text">
                                <h3>3 этап: настройка</h3>
                                <p><?= get_field("complex_third_etap"); ?></p>
                            </div>
                        </div>

                        <div class="promotion__work-card work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/four.svg" alt="stages">

                            <div class="promotion__work-text work__stages-text">
                                <h3>4 этап: конверсии</h3>
                                <p><?= get_field("complex_fourth_etap"); ?></p>
                            </div>
                        </div>

                        <div class="promotion__work-card work__stages-card">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/stages/five.svg" alt="stages">

                            <div class="promotion__work-text work__stages-text">
                                <h3>5 этап: отчётность</h3>
                                <p><?= get_field("complex_fifth_etap"); ?></p>
                            </div>
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

                <div class="application">
                    <div class="application__block">
                        <h2>ПОЛУЧИТЕ ПЛАН ПРОДВИЖЕНИЯ САЙТА</h2>

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
                                согласием на передачу персональных данных, согласием на обработку персональных данных, публичной офертой.
                            </span>
                        </label>

                        <button class="home__button"><span>оставить заявку</span><span></span></button>
                        </а>
                </div>

            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>