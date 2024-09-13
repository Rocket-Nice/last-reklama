<?php
get_header();
?>

<main class="main">
  <div class="container">
    <nav class="navigation-page">
      <?php
      if (is_singular('product')) {
        echo '<div class="breadcrumbs">';
        echo '<span>';
        echo '<span><a href="' . home_url('/') . '">Главная</a></span> / ';
        echo '<span><a href="' . home_url('/uslugi') . '">Услуги</a></span> / ';
        echo '<span><a href="' . home_url('/uslugi/outdoor') . '">outdoor</a></span> / ';
        echo '<span class="breadcrumb_last" aria-current="page">' . get_the_title() . '</span>';
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
            <h1><?php the_title(); ?></h1>

            <div class="structure__param">
              <dl>
                <dt>Район:</dt>
                <dd>
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'map_outdoor_district');
                  if ($terms && !is_wp_error($terms)) {
                    $term = $terms[0];
                    echo esc_html($term->name);
                  }
                  ?>
                </dd>
              </dl>

              <dl>
                <dt>Координаты:</dt>
                <dd><?php echo esc_html(get_field("outdoor_coordinate")); ?></dd>
              </dl>

              <dl>
                <dt>Направление:</dt>
                <dd><?php echo esc_html(get_field("outdoor_direction")); ?></dd>
              </dl>

              <dl>
                <dt>Идентификационный номер:</dt>
                <dd><?php echo esc_html(get_field("outdoor_id")); ?></dd>
              </dl>
            </div>
          </div>

          <div class="structure__img">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="jpg">
          </div>
        </div>

        <?php
        $product = wc_get_product(get_the_ID());

        if ($product->is_type('variable')) :
          $variations = $product->get_available_variations();
          $side_a_variation = null;
          $side_b_variation = null;

          foreach ($variations as $variation) {

            $side = $variation['attributes']['attribute_pa_attribute_side'];
            if ($side === 'a') {
              $side_a_variation = $variation;
            } elseif ($side === 'b') {
              $side_b_variation = $variation;
            }
          }

        ?>

          <?php if ($side_a_variation) : ?>
            <div class="structure__map">
              <h2>Сторона A</h2>
              <div class="slider-info__slide structure__slide">
                <div class="slider-info__text-block structure__text-block">
                  <dl>
                    <dt>формат:</dt>
                    <dd><?= get_field("outdoor_side_a_format"); ?></dd>
                  </dl>

                  <dl>
                    <dt>GID:</dt>
                    <dd><?= get_field("outdoor_side_a_gid"); ?></dd>
                  </dl>

                  <dl>
                    <dt>Сторона:</dt>
                    <dd>А</dd>
                  </dl>

                  <dl>
                    <dt>Тип поверхности:</dt>
                    <dd><?= get_field("outdoor_side_a_type_of_surfa"); ?></dd>
                  </dl>

                  <dl>
                    <dt>Ограничение:</dt>
                    <dd><?= get_field("outdoor_side_a_limitation"); ?></dd>
                  </dl>

                  <dl>
                    <dt>Рейтинг поверхности GRP:</dt>
                    <dd>
                      <span><?= get_field("outdoor_side_a_grp_surface_rating"); ?></span>

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
                      <span><?= get_field("outdoor_side_a_effective_ots_audience"); ?></span>

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

                  <button class="slider-info__button-a home__button" data-product_id="<?php echo get_the_ID(); ?>" data-variation_id="<?php echo $side_a_variation['variation_id']; ?>" data-side="A"><span>В корзину сторону А</span><span></span></button>
                </div>

                <div class="slider-info__slide-img">
                  <img src="<?php echo esc_url($side_a_variation['image']['url']); ?>" alt="jpg">
                </div>
              </div>
            </div>

            <div class="example">
              <h2>Примеры готовых решений <br> на стороне A</h2>
              <div class="example__sliders">
                <div class="swiper-wrapper">
                  <?php
                  $side_a_images = get_field("outdoor_side_a_img_example");
                  if ($side_a_images) :
                    foreach ($side_a_images as $img) : ?>
                      <img src="<?php echo esc_url($img); ?>" alt="slide" class="swiper-slide">
                  <?php endforeach;
                  endif; ?>
                </div>
                <div class="example__pagination"></div>
              </div>
            </div>
          <?php endif; ?>

          <?php if ($side_b_variation) : ?>
            <div class="structure__map">
              <h2>Сторона B</h2>
              <div class="slider-info__slide structure__slide">
                <div class="slider-info__text-block structure__text-block">
                  <dl>
                    <dt>формат:</dt>
                    <dd><?= get_field("outdoor_side_b_format"); ?></dd>
                  </dl>

                  <dl>
                    <dt>GID:</dt>
                    <dd><?= get_field("outdoor_side_b_gid"); ?></dd>
                  </dl>

                  <dl>
                    <dt>Сторона:</dt>
                    <dd>B</dd>
                  </dl>

                  <dl>
                    <dt>Тип поверхности:</dt>
                    <dd><?= get_field("outdoor_side_b_type_of_surfa"); ?></dd>
                  </dl>

                  <dl>
                    <dt>Ограничение:</dt>
                    <dd><?= get_field("outdoor_side_b_limitation"); ?></dd>
                  </dl>

                  <dl>
                    <dt>Рейтинг поверхности GRP:</dt>
                    <dd>
                      <span><?= get_field("outdoor_side_b_grp_surface_rating"); ?></span>

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
                      <span><?= get_field("outdoor_side_b_effective_ots_audience"); ?></span>

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

                  <button class="slider-info__button-b home__button" data-product_id="<?php echo get_the_ID(); ?>" data-variation_id="<?php echo $side_b_variation['variation_id']; ?>" data-side="B"><span>В корзину сторону B</span><span></span></button>
                </div>

                <div class="slider-info__slide-img">
                  <img src="<?php echo esc_url($side_b_variation['image']['url']); ?>" alt="jpg">
                </div>
              </div>
            </div>

            <div class="example">
              <h2>Примеры готовых решений <br> на стороне B</h2>
              <div class="example__sliders">
                <div class="swiper-wrapper">
                  <?php
                  $side_b_images = get_field("outdoor_side_b_img_example");
                  if ($side_b_images) :
                    foreach ($side_b_images as $img) : ?>
                      <img src="<?php echo esc_url($img); ?>" alt="slide" class="swiper-slide">
                  <?php endforeach;
                  endif; ?>
                </div>
                <div class="example__pagination"></div>
              </div>
            </div>
          <?php endif; ?>

        <?php else : ?>
          <p>Этот товар не имеет вариаций. Добавьте вариации через WooCommerce административную панель.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const addToCartButtons = document.querySelectorAll('.home__button');

    addToCartButtons.forEach(button => {
      button.addEventListener('click', function() {
        const productID = this.getAttribute('data-product_id');
        const variationID = this.getAttribute('data-variation_id');
        const side = this.getAttribute('data-side');
        const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";

        const formData = new FormData();
        formData.append('action', 'woocommerce_add_to_cart');
        formData.append('product_id', productID);
        formData.append('quantity', 1);

        if (variationID) {
          formData.append('variation_id', variationID);
        }

        fetch(ajaxurl, {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Товар успешно добавлен в корзину!');
            } else {
              if (data.error) {
                alert('Ошибка добавления в корзину: ' + data.error);
              } else {
                alert('Произошла неизвестная ошибка.');
              }
            }
          })
          .catch(error => console.error('Ошибка:', error));
      });
    });
  });
</script>