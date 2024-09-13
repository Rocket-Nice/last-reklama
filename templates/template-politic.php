<?php get_header();
/* Template Name: Politic*/

// Получаем ID главной страницы
$frontPageID = get_option('page_on_front');
?>
<main class="main">

    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>

    <div class="container" style="margin-top: 50px;">
        <div>
            <?= the_content(); ?>
        </div>
    </div>

</main>
<?php get_footer(); ?>