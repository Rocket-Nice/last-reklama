<?php get_header();
/* Template Name: Services*/
?>
<main class="main">

  <div class="container">
    <nav class="navigation-page">
      <?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
      } ?>
    </nav>
  </div>

  <section class="services">
    <div class="container">
      <div class="services__content">

        <div class="services__services-top">

          <div class="services__text">
            <h2><?= the_title(); ?></h2>
            <?= the_content(); ?>
          </div>

          <img src="<?= get_field("media_bg_img"); ?>" alt="services">

        </div>

        <div class="services__links">
          <a href="/indoor">indoor <span><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2H32M32 2V32M32 2L2 32" stroke-width="3" />
              </svg></span></a>
          <a href="/uslugi/outdoor">Наружная реклама <span><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2H32M32 2V32M32 2L2 32" stroke-width="3" />
              </svg></span></a>
          <a href="/kompleksnoe-internet-prodvizhenie-pod-kljuch">Комплексное интернет-продвижение под ключ <span><svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2H32M32 2V32M32 2L2 32" stroke-width="3" />
              </svg></span></a>
        </div>

        <div class="services__company advertisement__company">
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

        <div class="services__work work__stages">
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

          <img class="map__img" src="<?php echo get_template_directory_uri(); ?>/assets/img/mainPage/blog/map.jpg" alt="jpg">

        </div>

      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>