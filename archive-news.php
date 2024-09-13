<?php get_header(); ?>
<main class="main">
    <div class="container">
        <nav class="navigation-page">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
            } ?>
        </nav>
    </div>
    <section class="advertising">
        <div class="container">
            <div class="advertising__content">
                <h1>Блог о рекламе</h1>

                <div class="article__card advertising__redaction">
                    <?php
                    // Получение последней записи типа "news"
                    $latest_news_query = new WP_Query(array(
                        'post_type' => 'news',
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                    if ($latest_news_query->have_posts()) :
                        $latest_news_query->the_post();
                        $latest_post_id = get_the_ID();
                    ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">
                        <div class="article__text advertising__text">
                            <h2><?php the_title(); ?></h2>
                            <span><?php echo get_the_date(); ?></span>
                            <?php the_content(); ?>
                            <a class="article__link" href="<?php echo get_post_permalink(); ?>">подробнее</a>
                        </div>
                    <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <div class="advertising__all">
                    <div class="advertising__blocks">
                        <?php
                        // Параметры для пагинации
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $posts_per_page = 6; // Количество записей на страницу

                        // Получение остальных записей типа "news", исключая последнюю
                        $news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => $posts_per_page,
                            'paged' => $paged,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'post__not_in' => array($latest_post_id)
                        ));
                        $countPostsNews = 0;
                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                                $countPostsNews++;
                        ?>
                                <div class="advertising__container <?php echo ($countPostsNews % 3 === 0) ? 'blue' : ''; ?>">
                                    <?php if ($countPostsNews % 3 !== 0) : ?>
                                        <div class="advertising__card">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="jpg">
                                        </div>
                                    <?php endif; ?>
                                    <div class="advertising__card">
                                        <?php if ($countPostsNews % 3 === 0) : ?>
                                            <h3><?php the_title(); ?></h3>
                                        <?php else : ?>
                                            <h2><?php the_title(); ?></h2>
                                        <?php endif; ?>
                                        <span><?php echo get_the_date(); ?></span>
                                        <?php the_content(); ?>
                                        <a class="advertising__link" href="<?php echo get_post_permalink(); ?>">подробнее</a>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>

                <div class="advertising__end">
                    <div class="advertising__paginations" id="pagination-container">
                        <?php
                        $total_pages = $news_query->max_num_pages;
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active_class = ($i == 1) ? ' active-page' : ''; // Добавляем класс active-page для первой страницы
                            echo '<button class="advertising__button' . $active_class . '" data-page="' . $i . '">' . $i . '</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paginationContainer = document.getElementById('pagination-container');

        paginationContainer.addEventListener('click', function(event) {
            if (event.target.tagName === 'BUTTON') {
                const page = event.target.getAttribute('data-page');
                loadPosts(page);
            }
        });

        function loadPosts(page) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `<?php echo home_url('/'); ?>wp-admin/admin-ajax.php?action=load_posts&page=${page}`);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    document.querySelector('.advertising__blocks').innerHTML = response.content;
                    updatePagination(response.total_pages, response.current_page);
                }
            };
            xhr.send();
        }

        function updatePagination(totalPages, currentPage) {
            paginationContainer.innerHTML = '';
            for (let i = 1; i <= totalPages; i++) {
                const button = document.createElement('button');
                button.className = 'advertising__button';
                button.setAttribute('data-page', i);
                if (i == currentPage) {
                    button.classList.add('active-page');
                }
                button.textContent = i;
                paginationContainer.appendChild(button);
            }
        }
    });
</script>
<?php get_footer(); ?>