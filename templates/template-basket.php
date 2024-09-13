<?php
if (!session_id()) {
    session_start();
}

get_header();
/* Template Name: Basket */
?>
<main class="main">
    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>

    <div class="basket">
        <div class="container">
            <div class="basket__content">
                <h1>Корзина</h1>

                <!-- Вариант через сессию -->
                <!-- <div class="basket__product">
                    <div class="basket__cards">
                        <?php
                        $cart_items = isset($_SESSION['simple_cart']) ? $_SESSION['simple_cart'] : [];

                        if (!empty($cart_items)) {
                            foreach ($cart_items as $index => $item) {
                        ?>
                                <div class="basket__card" data-index="<?php echo $index; ?>">
                                    <div class="basket__img">
                                        <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['name']); ?>">
                                    </div>

                                    <div class="basket__info">
                                        <p><?php echo esc_html($item['name']); ?></p>

                                        <div class="basket__params">
                                            <?php
                                            $details = explode(', ', $item['details']);
                                            $count = 0;
                                            foreach ($details as $detail) {
                                                if ($count >= 2) break;
                                                list($dt, $dd) = explode(': ', $detail);
                                            ?>
                                                <dl>
                                                    <dt><?php echo esc_html($dt); ?>:</dt>
                                                    <dd><?php echo esc_html($dd); ?></dd>
                                                </dl>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="basket__end">
                                        <p class="basket__price">
                                            <span><?php echo number_format($item['price'], 0, ',', ' '); ?></span>
                                            <span>руб/мес</span>
                                        </p>
                                    </div>

                                    <div class="basket__del" data-index="<?php echo $index; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 12 12">
                                            <path stroke="#F7F7F7" stroke-width="1.607" d="M11.359.643.645 11.357m10.715 0L.644.643" />
                                        </svg>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <p>Корзина пуста.</p>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="basket__right">
                        <div class="basket__fullprice">
                            <p><span>Элементов:</span> <span><?php echo count($cart_items); ?> шт</span></p>
                            <p><span>Общая стоимость:</span> <span>
                                    <?php
                                    $total_price = array_sum(array_column($cart_items, 'price'));
                                    echo number_format($total_price, 0, ',', ' ');
                                    ?> руб/мес
                                </span></p>
                        </div>

                        <form class="application__form">
                            <input type="text" placeholder="Название организации">
                            <input type="text" placeholder="Электронная почта">
                            <input type="text" placeholder="Телефон">
                            <textarea cols="1" rows="5" maxlength="290" placeholder="Комментарий к заявке"></textarea>

                            <label>
                                <input class="application__chekbox" type="checkbox">
                                <span>
                                    Нажимая на кнопку, вы соглашаетесь с политикой конфиденциальности, согласием на передачу персональных данных, согласием на обработку персональных данных, публичной офертой.
                                </span>
                            </label>

                            <button class="home__button"><span>оставить заявку</span><span></span></button>
                        </form>
                    </div>
                </div> -->

                <!-- Вариант через сетлок -->
                <div class="basket__product">
                    <div class="basket__cards" id="basket-cards">
                        <!-- Товары будут динамически добавлены здесь -->
                    </div>

                    <div class="basket__right">
                        <div class="basket__fullprice" id="basket-fullprice">
                            <!-- Общая стоимость будет динамически обновляться -->
                        </div>

                        <form class="application__form">
                            <input type="text" placeholder="Название организации">
                            <input type="text" placeholder="Электронная почта">
                            <input type="text" placeholder="Телефон">
                            <textarea cols="1" rows="5" maxlength="290" placeholder="Комментарий к заявке"></textarea>

                            <label>
                                <input class="application__chekbox" type="checkbox">
                                <span>
                                    Нажимая на кнопку, вы соглашаетесь с политикой конфиденциальности, согласием на передачу персональных данных, согласием на обработку персональных данных, публичной офертой.
                                </span>
                            </label>

                            <button class="home__button"><span>оставить заявку</span><span></span></button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>
<?php get_footer(); ?>