<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}


// This is your option name where all the Redux data is stored.
$opt_name = "redux_demo";


/*
 *
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 *
 */

$sampleHTML = '';
if (file_exists(dirname(__FILE__) . '/info-html.html')) {
    Redux_Functions::initWpFilesystem();

    global $wp_filesystem;

    $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
}

// Background Patterns Reader
$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
$sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
$sample_patterns = array();

if (is_dir($sample_patterns_path)) {

    if ($sample_patterns_dir = opendir($sample_patterns_path)) {
        $sample_patterns = array();

        while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

            if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                $name = explode('.', $sample_patterns_file);
                $name = str_replace('.' . end($name), '', $sample_patterns_file);
                $sample_patterns[] = array(
                    'alt' => $name,
                    'img' => $sample_patterns_url . $sample_patterns_file
                );
            }
        }
    }
}

/*
 *
 * --> Action hook examples
 *
 */

// If Redux is running as a plugin, this will remove the demo notice and links
//add_action( 'redux/loaded', 'remove_demo' );

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
//add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

// Change the arguments after they've been declared, but before the panel is created
//add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

// Change the default value of a field after it's been set, but before it's been useds
//add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

// Dynamically add a section. Can be also used to modify sections/fields
//add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => __('Cozano Options', 'redux-framework-demo'),
    'page_title' => __('Cozano Options', 'redux-framework-demo'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    )
);

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args['admin_bar_links'][] = array(
    'id' => 'redux-docs',
    'href' => 'http://docs.reduxframework.com/',
    'title' => __('Documentation', 'redux-framework-demo'),
);

$args['admin_bar_links'][] = array(
    //'id'    => 'redux-support',
    'href' => 'https://github.com/ReduxFramework/redux-framework/issues',
    'title' => __('Support', 'redux-framework-demo'),
);

$args['admin_bar_links'][] = array(
    'id' => 'redux-extensions',
    'href' => 'reduxframework.com/extensions',
    'title' => __('Extensions', 'redux-framework-demo'),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
/*$args['share_icons'][] = array(
    'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
    'title' => 'Visit us on GitHub',
    'icon'  => 'el el-github'
    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
);
$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
    'title' => 'Like us on Facebook',
    'icon'  => 'el el-facebook'
);
$args['share_icons'][] = array(
    'url'   => 'http://twitter.com/reduxframework',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el el-twitter'
);
$args['share_icons'][] = array(
    'url'   => 'http://www.linkedin.com/company/redux-framework',
    'title' => 'Find us on LinkedIn',
    'icon'  => 'el el-linkedin'
);*/

// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    $args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
} else {
    $args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
}

// Add content after the form.
$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');

Redux::setArgs($opt_name, $args);

/*
 * ---> END ARGUMENTS
 */


/*
 * ---> START HELP TABS
 */

$tabs = array(
    array(
        'id' => 'redux-help-tab-1',
        'title' => __('Theme Information 1', 'redux-framework-demo'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
    ),
    array(
        'id' => 'redux-help-tab-2',
        'title' => __('Theme Information 2', 'redux-framework-demo'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
    )
);
Redux::setHelpTab($opt_name, $tabs);

// Set the help sidebar
$content = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
Redux::setHelpSidebar($opt_name, $content);


/*
 * <--- END HELP TABS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

/*

    As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


 */

// -> START Basic Fields

Redux::setSection($opt_name, array(
    'icon' => 'el-icon-home-alt',
    'title' => __('General Settings', 'sutunam'),
    'fields' => array(
        array(
            'id' => 'logo_icon',
            'type' => 'text',
            'title' => __('Logo Icon', 'sutunam'),
            'desc' => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Use Any font awesome Icon</a>'
        ),
        array(
            'id' => 'logo_txt',
            'type' => 'text',
            'title' => __('Logo Text', 'sutunam'),
        ),
        array(
            'id' => 'logo_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Logo', 'sutunam'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam'),
            'default' => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
            //'hint'      => array(
            //    'title'     => 'Hint Title',
            //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
            //)
        ),
        array(
            'id' => 'fav_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Fav Icon', 'sutunam'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam'),
            'default' => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
            //'hint'      => array(
            //    'title'     => 'Hint Title',
            //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
            //)
        ),
        array(
            'id' => 'addon_script',
            'type' => 'textarea',
            'title' => __('Addon Scipt', 'sutunam'),
            'desc' => __('Insert your script here.', 'sutunam'),
            'subtitle' => __('Add a special effect on your site', 'sutunam'),
        )
    )
));

Redux::setSection($opt_name, array(
    'title' => 'Cozano Overview',
    'icon' => 'el-icon-eye-open',
    'heading' => 'Cozano Overview',
    'desc' => '<br />Cozano Overview can be edited from here.<br />',
    'fields' => array(
        array(
            'id' => 'overview_content',
            'type' => 'textarea',
            'title' => __('Overview Content 1'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'overview_url',
            'type' => 'text',
            'title' => 'Overview Url',
        ),
        array(
            'id' => 'overview_content_2',
            'type' => 'textarea',
            'title' => __('Overview Content 2'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'overview_url_2',
            'type' => 'text',
            'title' => 'Overview Url 2',
        ),
        array(
            'id' => 'overview_content_3',
            'type' => 'textarea',
            'title' => __('Overview Content 3'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'overview_url_3',
            'type' => 'text',
            'title' => 'Overview Url 3',
        ),
        array(
            'id' => 'overview_content_4',
            'type' => 'textarea',
            'title' => __('Overview Content 4'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'overview_url_4',
            'type' => 'text',
            'title' => 'Overview Url 4',
        ),
        array(
            'id' => 'overview_content_5',
            'type' => 'textarea',
            'title' => __('Overview Content 5'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'overview_url_5',
            'type' => 'text',
            'title' => 'Overview Url 5',
        ),
        array(
            'id' => 'overview_content_6',
            'type' => 'textarea',
            'title' => __('Overview Content 6'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'overview_url_6',
            'type' => 'text',
            'title' => 'Overview Url 6',
        )
    )
));
Redux::setSection($opt_name, array(
    'title' => 'Home Overview',
    'icon' => 'el-icon-eye-open',
    'heading' => 'Home Overview',
    'desc' => '<br />All home overview can be edited from here.<br />',
    'fields' => array(
        // Section men overview
        array(
            'id' => 'section-men-overview-start',
            'type' => 'section',
            'title' => __('Men Overview'),
            'subtitle' => __('Men overview can be edited from here', 'sutunam'),
            'indent' => true // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id' => 'men_desc',
            'type' => 'textarea',
            'title' => __('Men description'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Men Image'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'men_url',
            'type' => 'text',
            'title' => 'Men Url',
        ),
        array(
            'id' => 'men_button_title',
            'type' => 'text',
            'title' => 'Button title',
        ),
        array(
            'id' => 'men_button_position',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'section-men-overview-end',
            'type' => 'section',
            'indent' => false // Indent all options below until the next 'section' option is set.
        ),
        // Section women overview
        array(
            'id' => 'section-women-overview-start',
            'type' => 'section',
            'title' => __('Women Overview'),
            'subtitle' => __('Women overview can be edited from here', 'sutunam'),
            'indent' => true // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id' => 'women_desc',
            'type' => 'textarea',
            'title' => __('Women description'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Women Image'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'women_url',
            'type' => 'text',
            'title' => 'Women Url',
        ),
        array(
            'id' => 'women_button_title',
            'type' => 'text',
            'title' => 'Button title',
        ),
        array(
            'id' => 'women_button_position',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'section-women-overview-end',
            'type' => 'section',
            'indent' => false // Indent all options below until the next 'section' option is set.
        ),
        // Section shoes overview
        array(
            'id' => 'section-shoes-overview-start',
            'type' => 'section',
            'title' => __('Shoes Overview'),
            'subtitle' => __('Shoes overview can be edited from here', 'sutunam'),
            'indent' => true // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id' => 'shoes_desc',
            'type' => 'textarea',
            'title' => __('Shoes description'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'shoes_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Shoes Image'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'shoes_url',
            'type' => 'text',
            'title' => 'Shoes Url',
        ),
        array(
            'id' => 'shoes_button_title',
            'type' => 'text',
            'title' => 'Button title',
        ),
        array(
            'id' => 'shoes_button_position',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'section-shoes-overview-end',
            'type' => 'section',
            'indent' => false // Indent all options below until the next 'section' option is set.
        ),
        // Section bigsize overview
        array(
            'id' => 'section-bigsize-overview-start',
            'type' => 'section',
            'title' => __('Bigsize Overview'),
            'subtitle' => __('Bigsize overview can be edited from here', 'sutunam'),
            'indent' => true // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id' => 'bigsize_desc',
            'type' => 'textarea',
            'title' => __('Bigsize description'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'bigsize_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Bigsize Image'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'bigsize_url',
            'type' => 'text',
            'title' => 'Bigsize Url',
        ),
        array(
            'id' => 'bigsize_button_title',
            'type' => 'text',
            'title' => 'Button title',
        ),
        array(
            'id' => 'bigsize_button_position',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'section-bigsize-overview-end',
            'type' => 'section',
            'indent' => false // Indent all options below until the next 'section' option is set.
        ),
        // Section touch overview
        array(
            'id' => 'section-touch-overview-start',
            'type' => 'section',
            'title' => __('Touch Overview'),
            'subtitle' => __('Touch overview can be edited from here', 'sutunam'),
            'indent' => true // Indent all options below until the next 'section' option is set.
        ),
        array(
            'id' => 'touch_desc',
            'type' => 'textarea',
            'title' => __('Touch description'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'touch_img',
            'type' => 'media',
            'url' => true,
            'title' => __('Touch Image'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'touch_url',
            'type' => 'text',
            'title' => 'Touch Url',
        ),
        array(
            'id' => 'touch_button_title',
            'type' => 'text',
            'title' => 'Button title',
        ),
        array(
            'id' => 'touch_button_position',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'section-touch-overview-end',
            'type' => 'section',
            'indent' => false // Indent all options below until the next 'section' option is set.
        )
    ),
));

Redux::setSection($opt_name, array(
    'title' => 'Promotion Overview',
    'icon' => 'el-icon-eye-open',
    'heading' => 'Promotion Overview',
    'desc' => '<br />Promotion overview can be edited from here.<br />',
    'fields' => array(
        array(
            'id' => 'promotion_img_1',
            'type' => 'media',
            'url' => true,
            'title' => __('Promotion Image 1'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'promotion_url_1',
            'type' => 'text',
            'title' => 'Promotion Url 1',
        ),
        array(
            'id' => 'promotion_img_2',
            'type' => 'media',
            'url' => true,
            'title' => __('Promotion Image 2'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'promotion_url_2',
            'type' => 'text',
            'title' => 'Promotion Url 2',
        ),
        array(
            'id' => 'promotion_img_3',
            'type' => 'media',
            'url' => true,
            'title' => __('Promotion Image 3'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'promotion_url_3',
            'type' => 'text',
            'title' => 'Promotion Url 3',
        ),
        array(
            'id' => 'promotion_img_4',
            'type' => 'media',
            'url' => true,
            'title' => __('Promotion Image 4'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'promotion_url_4',
            'type' => 'text',
            'title' => 'Promotion Url 4',
        ),
        array(
            'id' => 'promotion_img_5',
            'type' => 'media',
            'url' => true,
            'title' => __('Promotion Image 5'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'promotion_url_5',
            'type' => 'text',
            'title' => 'Promotion Url 5',
        ),
        array(
            'id' => 'promotion_img_6',
            'type' => 'media',
            'url' => true,
            'title' => __('Promotion Image 6'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'promotion_url_6',
            'type' => 'text',
            'title' => 'Promotion Url 6',
        ),
    ),
));

Redux::setSection($opt_name, array(
    'title' => 'Men Option',
    'icon' => 'el-icon-eye-open',
    'heading' => 'Men Overview',
    'desc' => '<br />Men  can be edited from here.<br />',
    'fields' => array(

        array(
            'id' => 'men_des_option_1',
            'type' => 'textarea',
            'title' => __('Men option description 1'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_img_option_1',
            'type' => 'media',
            'url' => true,
            'title' => __('Men Option Image 1'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'men_url_option_1',
            'type' => 'text',
            'title' => 'Men Url Option 1',
        ),
        array(
            'id' => 'men_category_1',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'men_content_option_1',
            'type' => 'textarea',
            'title' => __('Men Content Option 1'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_button_option_1',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'men_des_option_2',
            'type' => 'textarea',
            'title' => __('Men option description 2'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_img_option_2',
            'type' => 'media',
            'url' => true,
            'title' => __('Men Option Image 2'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'men_url_option_2',
            'type' => 'text',
            'title' => 'Men Url Option 2',
        ),
        array(
            'id' => 'men_category_2',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'men_content_option_2',
            'type' => 'textarea',
            'title' => __('Men Content Option 2'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_button_option_2',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'men_des_option_3',
            'type' => 'textarea',
            'title' => __('Men option description 3'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_img_option_3',
            'type' => 'media',
            'url' => true,
            'title' => __('Men Option Image 3'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'men_url_option_3',
            'type' => 'text',
            'title' => 'Men Url Option 3',
        ),
        array(
            'id' => 'men_category_3',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'men_content_option_3',
            'type' => 'textarea',
            'title' => __('Men Content Option 3'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_button_option_3',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'men_des_option_4',
            'type' => 'textarea',
            'title' => __('Men option description 4'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_img_option_4',
            'type' => 'media',
            'url' => true,
            'title' => __('Men Option Image 4'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'men_url_option_4',
            'type' => 'text',
            'title' => 'Men Url Option 4',
        ),
        array(
            'id' => 'men_category_4',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'men_content_option_4',
            'type' => 'textarea',
            'title' => __('Men Content Option 4'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_button_option_4',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'men_des_option_5',
            'type' => 'textarea',
            'title' => __('Men option description 5'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_img_option_5',
            'type' => 'media',
            'url' => true,
            'title' => __('Men Option Image 5'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'men_url_option_5',
            'type' => 'text',
            'title' => 'Men Url Option 5',
        ),
        array(
            'id' => 'men_category_5',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'men_content_option_5',
            'type' => 'textarea',
            'title' => __('Men Content Option 5'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'men_button_option_5',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        )
    ),
));

Redux::setSection($opt_name, array(
    'title' => 'Women Option',
    'icon' => 'el-icon-eye-open',
    'heading' => 'Women Overview',
    'desc' => '<br />Men  can be edited from here.<br />',
    'fields' => array(

        array(
            'id' => 'women_des_option_1',
            'type' => 'textarea',
            'title' => __('Women option description 1'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_img_option_1',
            'type' => 'media',
            'url' => true,
            'title' => __('Women Option Image 1'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'women_url_option_1',
            'type' => 'text',
            'title' => 'Women Url Option 1',
        ),
        array(
            'id' => 'women_category_1',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'women_content_option_1',
            'type' => 'textarea',
            'title' => __('Women Content Option 1'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_button_option_1',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'women_des_option_2',
            'type' => 'textarea',
            'title' => __('Women option description 2'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_img_option_2',
            'type' => 'media',
            'url' => true,
            'title' => __('Women Option Image 2'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'women_url_option_2',
            'type' => 'text',
            'title' => 'Women Url Option 2',
        ),
        array(
            'id' => 'women_category_2',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'women_content_option_2',
            'type' => 'textarea',
            'title' => __('Women Content Option 2'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_button_option_2',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'women_des_option_3',
            'type' => 'textarea',
            'title' => __('Women option description 3'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_img_option_3',
            'type' => 'media',
            'url' => true,
            'title' => __('Women Option Image 3'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'women_url_option_3',
            'type' => 'text',
            'title' => 'Women Url Option 3',
        ),
        array(
            'id' => 'women_category_3',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'women_content_option_3',
            'type' => 'textarea',
            'title' => __('Women Content Option 3'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_button_option_3',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'women_des_option_4',
            'type' => 'textarea',
            'title' => __('Women option description 4'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_img_option_4',
            'type' => 'media',
            'url' => true,
            'title' => __('Women Option Image 4'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'women_url_option_4',
            'type' => 'text',
            'title' => 'Women Url Option 4',
        ),
        array(
            'id' => 'women_category_4',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'women_content_option_4',
            'type' => 'textarea',
            'title' => __('Women Content Option 4'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_button_option_4',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'women_des_option_5',
            'type' => 'textarea',
            'title' => __('Women option description 5'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_img_option_5',
            'type' => 'media',
            'url' => true,
            'title' => __('Women Option Image 5'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'women_url_option_5',
            'type' => 'text',
            'title' => 'Women Url Option 5',
        ),
        array(
            'id' => 'women_category_5',
            'type' => 'select',
            'title' => __('Select category to display feature product', 'redux-framework-demo'),
            'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
            'desc' => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            // Must provide key => value pairs for select options
            'data' => 'product_cat'
        ),
        array(
            'id' => 'women_content_option_5',
            'type' => 'textarea',
            'title' => __('Women Content Option 5'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'women_button_option_5',
            'type' => 'select',
            'title' => __('Position of button'),
            'subtitle' => __('No validation can be done on this field type'),
            'desc' => __('This is the description field, again good for additional info.'),
            // Must provide key => value pairs for select options
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center'
            ),
            'default' => 'left',
        )
    ),
));

Redux::setSection($opt_name, array(
    'title' => 'Shoes Option',
    'icon' => 'el-icon-eye-open',
    'heading' => 'Shoes Overview',
    'desc' => '<br />Shoes can be edited from here.<br />',
    'fields' => array(

        array(
            'id' => 'shoes_des_option_1',
            'type' => 'textarea',
            'title' => __('Shoes option description 1'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'shoes_img_option_1',
            'type' => 'media',
            'url' => true,
            'title' => __('Shoes Option Image 1'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'shoes_url_option_1',
            'type' => 'text',
            'title' => 'Shoes Url Option 1',
        ),
        array(
            'id' => 'shoes_des_option_2',
            'type' => 'textarea',
            'title' => __('Shoes option description 2'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'shoes_img_option_2',
            'type' => 'media',
            'url' => true,
            'title' => __('Shoes Option Image 2'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'shoes_url_option_2',
            'type' => 'text',
            'title' => 'Shoes Url Option 2',
        ),
        array(
            'id' => 'shoes_des_option_3',
            'type' => 'textarea',
            'title' => __('Shoes option description 3'),
            'subtitle' => __('HTML can be used', 'sutunam'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            )
        ),
        array(
            'id' => 'shoes_img_option_3',
            'type' => 'media',
            'url' => true,
            'title' => __('Shoes Option Image 3'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Basic media uploader with disabled URL input field.', 'sutunam'),
            'subtitle' => __('Upload any media using the WordPress native uploader', 'sutunam')
        ),
        array(
            'id' => 'shoes_url_option_3',
            'type' => 'text',
            'title' => 'Shoes Url Option 3',
        )
    ),
));

Redux::setSection($opt_name, array(
    'icon' => 'el-icon-map-marker-alt',
    'title' => __('Contact', 'sutunam'),
    'fields' => array(array("title" => "Email Address to receive emails",
        "id" => "e_add",
        "type" => "text"
    ), array("title" => "Address",
        "id" => "address",
        "type" => "text"
    ), array("title" => "Latitutde",
        "id" => "g_lat",
        "type" => "text"
    ), array("title" => "Longitude",
        "id" => "g_long",
        "type" => "text"
    ), array("title" => "Telephone",
        "id" => "telephone",
        "type" => "text"
    )
    )));
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-website',
    'title' => __('Footer', 'sutunam'),
    'fields' => array(
        array("title" => "Facebook",
            "id" => "face_link",
            "type" => "text"
        ), array("title" => "Twitter",
            "id" => "twit_link",
            "type" => "text"
        ), array("title" => "Youtube",
            "id" => "youtube_link",
            "type" => "text"
        ),
        array("title" => "Gmail",
            "id" => "gmail_link",
            "type" => "text"
        ), array("title" => "Instagram",
            "id" => "instagram_link",
            "type" => "text"
        ), array("title" => "pinterest",
            "id" => "pinterest_link",
            "type" => "text"
        ),
        array("title" => "Google Plus",
            "id" => "google_link",
            "type" => "text"
        ), array("title" => "Linkin",
            "id" => "linkin_link",
            "type" => "text"
        ), array("title" => "tumblr",
            "id" => "tumblr_link",
            "type" => "text"
        ),
        array("title" => "MasterCard",
            "id" => "mastercard_link",
            "type" => "text"
        ), array("title" => "Visa",
            "id" => "visa_link",
            "type" => "text"
        ), array("title" => "Paypal",
            "id" => "paypal_link",
            "type" => "text"
        ),
        array("title" => "Footer Copyright Title",
            "id" => "copy_text",
            "type" => "text"
        )
    )));


if (file_exists(dirname(__FILE__) . '/../README.md')) {
    $section = array(
        'icon' => 'el el-list-alt',
        'title' => __('Documentation', 'redux-framework-demo'),
        'fields' => array(
            array(
                'id' => '17',
                'type' => 'raw',
                'markdown' => true,
                'content' => file_get_contents(dirname(__FILE__) . '/../README.md')
            ),
        ),
    );
    Redux::setSection($opt_name, $section);
}
/*
 * <--- END SECTIONS
 */

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */
function compiler_action($options, $css, $changed_values)
{
    echo '<h1>The compiler hook has run!</h1>';
    echo "<pre>";
    print_r($changed_values); // Values that have changed since the last save
    echo "</pre>";
    //print_r($options); //Option values
    //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
}

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')) {
    function redux_validate_callback_function($field, $value, $existing_value)
    {
        $error = false;
        $warning = false;

        //do your validation
        if ($value == 1) {
            $error = true;
            $value = $existing_value;
        } elseif ($value == 2) {
            $warning = true;
            $value = $existing_value;
        }

        $return['value'] = $value;

        if ($error == true) {
            $return['error'] = $field;
            $field['msg'] = 'your custom error message';
        }

        if ($warning == true) {
            $return['warning'] = $field;
            $field['msg'] = 'your custom warning message';
        }

        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')) {
    function redux_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 * */
function dynamic_section($sections)
{
    //$sections = array();
    $sections[] = array(
        'title' => __('Section via hook', 'redux-framework-demo'),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
        'icon' => 'el el-paper-clip',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */
function change_arguments($args)
{
    //$args['dev_mode'] = true;

    return $args;
}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */
function change_defaults($defaults)
{
    $defaults['str_replace'] = 'Testing filter hook!';

    return $defaults;
}

// Remove the demo link and the notice of integrated demo from the redux-framework plugin
function remove_demo()
{

    // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(
            ReduxFrameworkPlugin::instance(),
            'plugin_metalinks'
        ), null, 2);

        // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
        remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
    }
}
