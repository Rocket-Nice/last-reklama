<?php get_header();
$has_thumbnail = has_post_thumbnail();
?>
<main class="main">
    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>

    <section class="new">
        <div class="container">
            <div class="new__content">
                <div class="article__card new__card">
                    <div class="article__text new__text">
                        <h2><?= the_title(); ?></h2>
                        <span><?= get_the_date(); ?></span>

                        <?= the_content(); ?>

                        <a class="article__link new__link-card" href="/tehnicheskie-trebovanija">изучить технические требования</a>
                    </div>
                    <?php if ($has_thumbnail) : ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">
                    <?php endif; ?>
                </div>
                <a class="article__link-end new__link" href="/news">к другим новостям</a>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>