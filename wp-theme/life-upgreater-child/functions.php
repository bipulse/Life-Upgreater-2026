<?php
/**
 * Life Upgreater Child Theme
 *
 * Child Theme für Hello Elementor
 * Optimiert für Elementor Pro + Crocoblock (JetEngine, JetElements, JetPopup)
 */

if (!defined('ABSPATH')) exit;

define('LU_CHILD_VERSION', '1.0.0');

/**
 * Enqueue Styles & Fonts
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'hello-elementor',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme('hello-elementor')->get('Version')
    );

    wp_enqueue_style(
        'life-upgreater-child',
        get_stylesheet_uri(),
        ['hello-elementor'],
        LU_CHILD_VERSION
    );

    wp_enqueue_style(
        'lu-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Caveat:wght@600&display=swap',
        [],
        null
    );
});

/**
 * Announcement Bar (vor dem Header)
 */
add_action('wp_body_open', function () {
    $text = get_theme_mod('lu_announcement_text', 'Bist du bereit zum Glücklichsein?');
    $link_text = get_theme_mod('lu_announcement_link_text', 'Nimm jetzt Kontakt auf!');
    $link_url = get_theme_mod('lu_announcement_link_url', '/kontakt');
    $show = get_theme_mod('lu_announcement_show', true);

    if (!$show) return;
    ?>
    <div class="lu-announcement-bar">
        <p><?php echo esc_html($text); ?> <a href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_text); ?></a></p>
    </div>
    <?php
});

/**
 * Customizer: Announcement Bar Einstellungen
 */
add_action('customize_register', function ($wp_customize) {
    $wp_customize->add_section('lu_announcement', [
        'title'    => 'Announcement Bar',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('lu_announcement_show', ['default' => true]);
    $wp_customize->add_control('lu_announcement_show', [
        'label'   => 'Announcement Bar anzeigen',
        'section' => 'lu_announcement',
        'type'    => 'checkbox',
    ]);

    $wp_customize->add_setting('lu_announcement_text', ['default' => 'Bist du bereit zum Glücklichsein?']);
    $wp_customize->add_control('lu_announcement_text', [
        'label'   => 'Text',
        'section' => 'lu_announcement',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('lu_announcement_link_text', ['default' => 'Nimm jetzt Kontakt auf!']);
    $wp_customize->add_control('lu_announcement_link_text', [
        'label'   => 'Link-Text',
        'section' => 'lu_announcement',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('lu_announcement_link_url', ['default' => '/kontakt']);
    $wp_customize->add_control('lu_announcement_link_url', [
        'label'   => 'Link-URL',
        'section' => 'lu_announcement',
        'type'    => 'url',
    ]);
});

/**
 * Elementor: Eigene Farbpalette registrieren
 */
add_action('elementor/editor/after_enqueue_scripts', function () {
    wp_add_inline_script('elementor-editor', "
        elementor.settings.editorPreferences.addChangeCallback('ui_theme', function() {});
    ");
});

/**
 * Elementor: Custom Widget Category
 */
add_action('elementor/elements/categories_registered', function ($elements_manager) {
    $elements_manager->add_category('life-upgreater', [
        'title' => 'Life Upgreater',
        'icon'  => 'fa fa-heart',
    ]);
});

/**
 * Crocoblock JetEngine: Custom Post Types registrieren
 */
add_action('init', function () {
    // Seminare CPT
    register_post_type('lu_seminar', [
        'labels' => [
            'name'               => 'Seminare',
            'singular_name'      => 'Seminar',
            'add_new'            => 'Neues Seminar',
            'add_new_item'       => 'Neues Seminar hinzufügen',
            'edit_item'          => 'Seminar bearbeiten',
            'all_items'          => 'Alle Seminare',
            'search_items'       => 'Seminare durchsuchen',
            'not_found'          => 'Keine Seminare gefunden',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'seminare'],
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-calendar-alt',
    ]);

    // Testimonials CPT
    register_post_type('lu_testimonial', [
        'labels' => [
            'name'               => 'Testimonials',
            'singular_name'      => 'Testimonial',
            'add_new'            => 'Neues Testimonial',
            'add_new_item'       => 'Neues Testimonial hinzufügen',
            'edit_item'          => 'Testimonial bearbeiten',
            'all_items'          => 'Alle Testimonials',
        ],
        'public'       => true,
        'has_archive'  => false,
        'supports'     => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-format-quote',
    ]);
});

/**
 * Custom Meta Fields für Seminare
 */
add_action('add_meta_boxes', function () {
    add_meta_box('lu_seminar_details', 'Seminar-Details', function ($post) {
        wp_nonce_field('lu_seminar_meta', 'lu_seminar_nonce');
        $date = get_post_meta($post->ID, '_lu_seminar_date', true);
        $location = get_post_meta($post->ID, '_lu_seminar_location', true);
        $price = get_post_meta($post->ID, '_lu_seminar_price', true);
        $price_early = get_post_meta($post->ID, '_lu_seminar_price_early', true);
        $spots = get_post_meta($post->ID, '_lu_seminar_spots', true);
        ?>
        <p><label>Datum: <input type="date" name="lu_seminar_date" value="<?php echo esc_attr($date); ?>" style="width:100%"></label></p>
        <p><label>Ort: <input type="text" name="lu_seminar_location" value="<?php echo esc_attr($location); ?>" style="width:100%" placeholder="z.B. Aachen oder Online"></label></p>
        <p><label>Preis (€): <input type="number" name="lu_seminar_price" value="<?php echo esc_attr($price); ?>" style="width:100%"></label></p>
        <p><label>Frühbucher-Preis (€): <input type="number" name="lu_seminar_price_early" value="<?php echo esc_attr($price_early); ?>" style="width:100%"></label></p>
        <p><label>Freie Plätze: <input type="number" name="lu_seminar_spots" value="<?php echo esc_attr($spots); ?>" style="width:100%"></label></p>
        <?php
    }, 'lu_seminar', 'side');
});

add_action('save_post_lu_seminar', function ($post_id) {
    if (!isset($_POST['lu_seminar_nonce']) || !wp_verify_nonce($_POST['lu_seminar_nonce'], 'lu_seminar_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $fields = ['date', 'location', 'price', 'price_early', 'spots'];
    foreach ($fields as $field) {
        $key = "lu_seminar_{$field}";
        if (isset($_POST[$key])) {
            update_post_meta($post_id, "_lu_seminar_{$field}", sanitize_text_field($_POST[$key]));
        }
    }
});

/**
 * Custom Meta Fields für Testimonials
 */
add_action('add_meta_boxes', function () {
    add_meta_box('lu_testimonial_details', 'Testimonial-Details', function ($post) {
        wp_nonce_field('lu_testimonial_meta', 'lu_testimonial_nonce');
        $role = get_post_meta($post->ID, '_lu_testimonial_role', true);
        $category = get_post_meta($post->ID, '_lu_testimonial_category', true);
        ?>
        <p><label>Rolle/Position: <input type="text" name="lu_testimonial_role" value="<?php echo esc_attr($role); ?>" style="width:100%" placeholder="z.B. Aufsichtsratsvorsitzender"></label></p>
        <p><label>Kategorie:
          <select name="lu_testimonial_category" style="width:100%">
            <option value="seminar" <?php selected($category, 'seminar'); ?>>Seminar</option>
            <option value="personal" <?php selected($category, 'personal'); ?>>Personal Training</option>
            <option value="business" <?php selected($category, 'business'); ?>>Business Training</option>
          </select>
        </label></p>
        <?php
    }, 'lu_testimonial', 'side');
});

add_action('save_post_lu_testimonial', function ($post_id) {
    if (!isset($_POST['lu_testimonial_nonce']) || !wp_verify_nonce($_POST['lu_testimonial_nonce'], 'lu_testimonial_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['lu_testimonial_role'])) {
        update_post_meta($post_id, '_lu_testimonial_role', sanitize_text_field($_POST['lu_testimonial_role']));
    }
    if (isset($_POST['lu_testimonial_category'])) {
        update_post_meta($post_id, '_lu_testimonial_category', sanitize_text_field($_POST['lu_testimonial_category']));
    }
});

/**
 * Shortcode: Selbsttest
 * Verwendung: [lu_selbsttest]
 */
add_shortcode('lu_selbsttest', function () {
    ob_start();
    include get_stylesheet_directory() . '/templates/selbsttest.php';
    return ob_get_clean();
});

/**
 * AJAX Handler für Selbsttest E-Mail Capture
 */
add_action('wp_ajax_lu_test_submit', 'lu_handle_test_submit');
add_action('wp_ajax_nopriv_lu_test_submit', 'lu_handle_test_submit');

function lu_handle_test_submit() {
    check_ajax_referer('lu_test_nonce', 'nonce');

    $email = sanitize_email($_POST['email'] ?? '');
    $test_type = sanitize_text_field($_POST['test_type'] ?? '');
    $score = intval($_POST['score'] ?? 0);

    if (!is_email($email)) {
        wp_send_json_error('Ungültige E-Mail-Adresse');
    }

    // MailerLite / Newsletter Integration
    do_action('lu_lead_captured', $email, $test_type, $score);

    wp_send_json_success([
        'message' => 'Ergebnis wird gesendet',
        'score'   => $score,
    ]);
}

/**
 * Enqueue Selbsttest Scripts
 */
add_action('wp_enqueue_scripts', function () {
    if (is_page() || is_front_page()) {
        wp_enqueue_script(
            'lu-selbsttest',
            get_stylesheet_directory_uri() . '/assets/js/selbsttest.js',
            [],
            LU_CHILD_VERSION,
            true
        );

        wp_localize_script('lu-selbsttest', 'luTest', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('lu_test_nonce'),
        ]);
    }
});

/**
 * Kontaktformular Spam-Schutz (Honeypot + Rate Limiting)
 */
add_action('wp_ajax_lu_contact_submit', 'lu_handle_contact');
add_action('wp_ajax_nopriv_lu_contact_submit', 'lu_handle_contact');

function lu_handle_contact() {
    check_ajax_referer('lu_contact_nonce', 'nonce');

    // Honeypot Check
    if (!empty($_POST['website_url'])) {
        wp_send_json_error('Spam detected');
    }

    // Rate Limiting (max 3 pro IP pro Stunde)
    $ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $transient_key = 'lu_contact_' . md5($ip);
    $count = get_transient($transient_key) ?: 0;

    if ($count >= 3) {
        wp_send_json_error('Zu viele Anfragen. Bitte versuche es später erneut.');
    }

    set_transient($transient_key, $count + 1, HOUR_IN_SECONDS);

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $interest = sanitize_text_field($_POST['interest'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || !is_email($email)) {
        wp_send_json_error('Bitte fülle alle Pflichtfelder aus.');
    }

    $to = get_option('admin_email');
    $subject = "Kontaktanfrage von {$name} – {$interest}";
    $body = "Name: {$name}\nE-Mail: {$email}\nInteresse: {$interest}\n\nNachricht:\n{$message}";
    $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>"];

    wp_mail($to, $subject, $body, $headers);

    wp_send_json_success('Nachricht gesendet!');
}
