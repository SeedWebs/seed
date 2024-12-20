<?php
/**
 * Seed4 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Seed4
 * @since Seed4 4.0
 */

// Enqueue Styles
if (!function_exists('seed4_enqueue_styles')) :
    /**
     * Enqueues style.css on the front.
     *
     * @since Seed4 4.0
     *
     * @return void
     */
    function seed4_enqueue_styles()
    {
        wp_enqueue_style(
            'seed4',
            get_parent_theme_file_uri('assets/css/seed.css'),
            [],
            wp_get_theme()->get('Version')
        );
    }
endif;
add_action('wp_enqueue_scripts', 'seed4_enqueue_styles');

// Enqueues wp-editor.css in the editors.
if (!function_exists('seed4_editor_style')) :
    /**
     * Enqueues wp-editor.css in the editors.
     *
     * @since Seed4 4.0
     *
     * @return void
     */
    function seed4_editor_style()
    {
        add_editor_style(get_parent_theme_file_uri('assets/css/wp-editor.css'));
    }
endif;
add_action('after_setup_theme', 'seed4_editor_style');

// Enqueues wp-admin.css in the admin.
if (!function_exists('seed4_wp_admin_style')) :
    /**
     * Enqueues wp-admin.css in the admin.
     *
     * @since Seed4 4.0
     *
     * @return void
     */
    function seed4_wp_admin_style()
    {
        wp_enqueue_style(
            'seed-admin',
            get_parent_theme_file_uri('assets/css/wp-admin.css'),
            [],
            wp_get_theme()->get('Version')
        );
    }
endif;
add_action('admin_enqueue_scripts', 'seed4_wp_admin_style');

// Registers block binding sources.
if (!function_exists('seed4_register_block_bindings')) :
    /**
     * Registers the copyright block binding source.
     *
     * @since Seed4 4.0
     *
     * @return void
     */
    function seed4_register_block_bindings()
    {
        register_block_bindings_source(
            'seed/copyright',
            array(
                'label'              => _x('&copy; (YEAR)', 'Label for the copyright placeholder in the editor', 'seed4'),
                'get_value_callback' => 'seed4_copyright_binding',
            )
        );
    }
endif;
if (!function_exists('seed4_copyright_binding')) :
    /**
     * Callback function for the copyright block binding source.
     *
     * @since Seed4 4.0
     *
     * @return string Copyright text.
     */
    function seed4_copyright_binding()
    {
        $copyright_text = sprintf(
            /* translators: 1: Copyright symbol or word, 2: Year */
            esc_html__('%1$s %2$s', 'seed4'),
            '&copy;',
            wp_date('Y')
        );

        return $copyright_text;
    }
endif;
add_action('init', 'seed4_register_block_bindings');

/* Block Style */
if (!function_exists('seed4_block_styles')) :
    /**
     * Registers block styles for the responsive.
     *
     * @since Seed4 4.0
     *
     * @return void
     */
    function seed4_block_styles()
    {
        // Image styles
        $img_blocks = ['core/image', 'core/site-logo'];
        register_block_style(
            $img_blocks,
            [
            'name' => 'rounded-sm',
            'label' => 'Rounded S',
            'inline_style' => '.is-style-rounded-sm img{border-radius: 5px}',
            ]
        );
        register_block_style(
            $img_blocks,
            [
            'name' => 'rounded-md',
            'label' => 'Rounded M',
            'inline_style' => '.is-style-rounded-md img{border-radius: 10px}',
            ]
        );
        register_block_style(
            $img_blocks,
            [
            'name' => 'rounded-lg',
            'label' => 'Rounded L',
            'inline_style' => '.is-style-rounded-lg img{border-radius: 1rem}',
            ]
        );
        register_block_style(
            $img_blocks,
            [
            'name' => 'rounded-xl',
            'label' => 'Rounded XL',
            'inline_style' => '.is-style-rounded-xl img{border-radius: 1.5rem}',
            ]
        );
        register_block_style(
            $img_blocks,
            [
            'name' => 'm-60',
            'label' => 'Mobile: 60%',
            'inline_style' => '@media(max-width: 767px){.is-style-m-60 img{transform: scale(0.6)}}',
            ]
        );
        register_block_style(
            $img_blocks,
            [
            'name' => 'm-80',
            'label' => 'Mobile: 80%',
            'inline_style' => '@media(max-width: 767px){.is-style-m-80 img{transform: scale(0.8)}}',
            ]
        );

        // Nav Styles
        $nav_blocks = ['core/navigation'];
        register_block_style(
            $nav_blocks,
            [
            'name' => 'nav-outline',
            'label' => 'Outline',
            'inline_style' => '.is-style-nav-outline button{border: 1.5px solid;border-radius: 4px}',
            ]
        );

        // Search Styles
        register_block_style(
            ['core/search'],
            [
            'name' => 'search-no-button',
            'label' => 'No Button',
            'inline_style' => '@media(max-width: 599px){.is-style-search-no-button{order: -1}}
                .is-style-search-no-button .wp-block-search__button{
                    background: none;
                    border: none;
                    padding: 0 4px;
                    color: inherit;
                }
                .is-style-search-no-button .wp-block-search__button svg{
                    transform: scaleX(-1);
                    height: 26px;
                    width: 26px;
                }
                    
                .is-style-search-no-button .wp-block-search__inside-wrapper {
                    border-color: var(--wp--preset--color--line);
                    border-radius: 4px;
                    justify-content: flex-end;
                }
                .is-style-search-no-button .wp-block-search__input{
                    padding: 4px 8px;
                    line-height: 1.25;
                    max-width: clamp(120px, 25vw, 240px);
                }',
            ]
        );

        // Button Styles
        $button_blocks = ['core/buttons', 'core/button'];
        register_block_style(
            $button_blocks,
            [
            'name' => 'button-light',
            'label' => 'Light Button',
            'inline_style' => '
            .is-style-button-light a,
            .is-style-button-light .block-editor-rich-text__editable{
                background: var(--wp--preset--color--dark-contrast);
                color: var(--wp--preset--color--dark-base);
            }
            .is-style-button-light a:hover{
                transform: scale(1.04);
            }',
            ]
        );

        // Responsive styles
        $blocks = ['core/group', 'core/image', 'core/post-featured-image', 'core/site-logo', 'core/buttons', 'core/button', 'core/spacer'];
        register_block_style(
            $blocks,
            [
            'name' => 'mobile-only',
            'label' => 'Mobile Only',
            'inline_style' => '@media(min-width: 1024px){.is-style-mobile-only{display: none !important}}',
            ]
        );
        register_block_style(
            $blocks,
            [
            'name' => 'desktop-only',
            'label' => 'Desktop Only',
            'inline_style' => '@media(max-width: 1023px){.is-style-desktop-only{display: none !important}}',
            ]
        );



        // Aspect Ratio
        $blocks = ['core/post-featured-image'];
        register_block_style(
            $blocks,
            [
            'name' => 'ratio-1200-630',
            'label' => 'Ratio 120:63',
            'inline_style' => '.is-style-ratio-1200-630 img{aspect-ratio: 120 / 63;object-fit: cover}',
            ]
        );

        // Overflow Hidden
        $blocks = ['core/group'];
        register_block_style(
            $blocks,
            [
            'name' => 'overflow-hidden',
            'label' => 'No Overflow',
            'inline_style' => '.is-style-overflow-hidden{overflow: hidden}',
            ]
        );

        // Author Name Link
        register_block_style(
            ['core/post-author-name','core/comment-author-name'],
            [
            'name' => 'author-no-underline',
            'label' => 'No Underline',
            'inline_style' => '.is-style-author-no-underline a{text-decoration: none}',
            ]
        );

        // Term Link
        register_block_style(
            'core/post-terms',
            [
            'name'         => 'term-outline',
            'label'        => 'Outline',
            'inline_style' => '
            .is-style-term-outline {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75em;
              }
              .is-style-term-outline a,
              .is-style-term-outline span:not([class], [data-rich-text-placeholder]) {
                display: inline-block;
                border: 1px solid var(--wp--preset--color--line-alt);
                background-color: var(--wp--preset--color--base-alt);
                color: var(--wp--preset--color--contrast-alt);
                padding: 0.2em 0.6em;
                border-radius: 4px;
                text-decoration: none;
              }
              .is-style-term-outline a:hover {
                background-color: var(--wp--preset--color--accent-1);
                border-color: var(--wp--preset--color--accent-1);
                color: var(--wp--preset--color--base-alt);
              }
              .is-style-term-outline .wp-block-post-terms__separator {
                display: none;
              }',
            ]
        );
        register_block_style(
            'core/post-terms',
            [
            'name'         => 'term-button',
            'label'        => 'Button',
            'inline_style' => '
              .is-style-term-button {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75em;
              }
              .is-style-term-button a,
              .is-style-term-button span:not([class], [data-rich-text-placeholder]) {
                border: none;
                background-color: var(--wp--preset--color--base-alt);
                color: var(--wp--preset--color--contrast-alt);
                box-shadow: var(--wp--preset--shadow--shadow);
                padding: 0.2em 0.6em;
                border-radius: 4px;
                text-decoration: none;
              }
              .is-style-term-button a:hover {
                background-color: var(--wp--preset--color--accent-1);
                color: var(--wp--preset--color--base-alt);
              }
              .is-style-term-button .wp-block-post-terms__separator {
                display: none;
              }',
            ]
        );
        register_block_style(
            'core/post-terms',
            [
            'name'         => 'term-pill',
            'label'        => 'Pill',
            'inline_style' => '
              .is-style-term-pill {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75em;
              }
              .is-style-term-pill a,
              .is-style-term-pill span:not([class], [data-rich-text-placeholder]) {
                border: none;
                background-color: var(--wp--preset--color--line-alt);
                color: var(--wp--preset--color--contrast);
                padding: 0.2em 1em;
                border-radius: 99em;
                text-decoration: none;
              }
              .is-style-term-pill a:hover {
                background-color: var(--wp--preset--color--accent-1);
                color: var(--wp--preset--color--base-alt);
              }
              .is-style-term-pill .wp-block-post-terms__separator {
                display: none;
              }',
            ]
        );
    }
endif;
add_action('init', 'seed4_block_styles');
