<?php

/**
 * Файл с подключениями и удалениями скриптов / стилей.
 */


add_action('wp_enqueue_scripts', 'remove_block_library_css');
/**
 * Удаление стилей блочного редактора Guttenberg
 * @return void
 */
function remove_block_library_css(): void
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');
}


// Удалить WLWmanifest из секции head.
remove_action('wp_head', 'wlwmanifest_link');

// Скрытие лишних inline стилей добавки их в wordpress после 5.9 обновления.
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);


add_action('wp_enqueue_scripts', 'wpdocs_dequeue_dashicon');
//  Отключаем загрузку файла dashicons.min.css стилей, не для залогиненых пользователей в админку.
function wpdocs_dequeue_dashicon(): void
{
    if (is_admin()) {
        return;
    }
    wp_deregister_style('dashicons');
}


add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
/**
 * Добавить всем встраиваемым скриптам вне админки добавить атрибут defer.
 *
 * @param string $tag
 * @param string $handle
 *
 * @return string
 */
function add_defer_attribute($tag, $handle): string
{
    if (is_admin()) {
        return $tag;
    }

    return str_replace(' src', ' defer="defer" src', $tag);
}


add_action('wp_enqueue_scripts', 'js_scripts');
/**
 * Подключение основных скриптов проекта для фронтаю
 * @return void
 */
function js_scripts(): void
{
    register_dist_js('/dist/js/runtime.*', 'runtime', [], '1.0.1');
    register_dist_js('/dist/js/vendor.*', 'vendor', ['runtime']);
    register_dist_js('/dist/js/index.*', 'index', ['runtime'], '1.0.1');

    register_dist_css('/dist/css/index.*', 'theme-style', [], '1.0.6');
}


/**
 * @param string $pattern
 * @param string $name
 * @param array|null $deps
 * @param bool $inFooter
 *
 * @return void
 */
function register_dist_js(string $pattern, string $name, array $deps = [], string $version = '1.0.0', bool $inFooter = true): void
{
    $find = glob(get_template_directory() . $pattern);
    if ($find && count($find)) {
        $fileName = basename($find[0]);
        $uri      = get_template_directory_uri() . '/dist/js/' . $fileName;
        wp_enqueue_script($name, $uri, $deps, $version, $inFooter);
    }
}

/**
 * Регистрация файлов стилей
 *
 * @param string $pattern Шаблон пути к файлам стилей
 * @param string $name Имя стиля
 * @param array $deps Массив зависимостей (опционально)
 * @return void
 */
function register_dist_css(string $pattern, string $name, array $deps = [], string $version = '1.0.0'): void
{
    $find = glob(get_template_directory() . $pattern);
    if ($find && count($find)) {
        $fileName = basename($find[0]);
        $uri      = get_template_directory_uri() . '/dist/css/' . $fileName;

        // Убедимся, что URL использует HTTPS
        $uri = set_url_scheme($uri, 'http');

        wp_enqueue_style($name, $uri, $deps, $version, false);
    }
}