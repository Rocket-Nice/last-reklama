<?php get_header();

// WC()->cart->empty_cart();
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

                <div class="basket__product">
                    <div class="basket__cards">
                        <?php
                        // Проверяем, есть ли товары в корзине
                        if (WC()->cart->get_cart_contents_count() > 0) {
                            // Получаем товары в корзине
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                // Получаем данные о товаре
                                $_product = $cart_item['data'];

                                // Выводим карту товара
                        ?>
                                <div class="basket__card">
                                    <div class="basket__img">
                                        <?php echo $_product->get_image(); ?>
                                    </div>

                                    <div class="basket__info">
                                        <p><?php echo $_product->get_name(); ?></p>

                                        <div class="basket__params">
                                            <?php
                                            // Выводим характеристики товара
                                            echo wc_get_formatted_cart_item_data($cart_item);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="basket__end">
                                        <div class="basket__counter">
                                            <span class="basket__min"></span>

                                            <p><?php echo $cart_item['quantity']; ?></p>

                                            <span class="basket__plus"></span>
                                        </div>

                                        <p class="basket__price">
                                            <span><?php echo wc_price($_product->get_price()); ?></span>
                                        </p>
                                    </div>

                                    <div class="basket__del">
                                        <?php
                                        // Выводим кнопку удаления товара из корзины
                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            __('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ), $cart_item_key);
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            // Если корзина пуста
                            echo '<p class="empty-cart">' . __('Your cart is currently empty.', 'woocommerce') . '</p>';
                        }
                        ?>
                    </div>

                    <div class="basket__right">
                        <?php
                        // Выводим общую стоимость корзины
                        echo '<div class="basket__fullprice">';
                        echo '<p><span>' . __('Total items:', 'woocommerce') . '</span> <span>' . WC()->cart->get_cart_contents_count() . __(' pcs', 'woocommerce') . '</span></p>';
                        echo '<p><span>' . __('Total price:', 'woocommerce') . '</span> <span>' . WC()->cart->get_cart_total() . '</span></p>';
                        echo '</div>';
                        ?>

                        <form class="application__form">
                            <input type="text" placeholder="<?php _e('Organization name', 'textdomain'); ?>">
                            <input type="text" placeholder="<?php _e('Email', 'textdomain'); ?>">
                            <input type="text" placeholder="<?php _e('Phone', 'textdomain'); ?>">
                            <textarea cols="1" rows="5" maxlength="290" placeholder="<?php _e('Comment to order', 'textdomain'); ?>"></textarea>

                            <label>
                                <input class="application__chekbox" type="checkbox">
                                <span>
                                    <?php _e('By clicking the button, you agree to the privacy policy, consent to the transfer of personal data, consent to the processing of personal data, public offer.', 'textdomain'); ?>
                                </span>
                            </label>

                            <button class="home__button" type="submit"><span><?php _e('Place order', 'textdomain'); ?></span><span></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>