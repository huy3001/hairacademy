<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
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
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
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
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Hercules Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Hercules Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
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
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


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

    Redux::setSection( $opt_name,array(
                'icon'      => 'el-icon-home-alt',
                'title'     => __('General Settings', 'hercules'),
                'fields'    => array(
                    array(
                        'id'        => 'hercules_primary_colour',
                        'type'      => 'color',
                        'title'     => __('Color Scheme', 'hercules'),
                        'subtitle'  => __('Pick a color scheme for the site.', 'hercules'),
                        'default'   => '#dd9933',
                        'transparent'=> false,
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'layout_bw',
                        'type'      => 'select',
                        'title'     => __('Theme Stylesheet', 'hercules'),
                        'subtitle'  => __('Select your themes layout boxed or wide.', 'hercules'),
                        'options'   => array('boxed' => 'Boxed', 'wide' => 'Wide'),
                        'default'   => 'wide',
                    ),
                    array(
                        'id'    => 'logo_icon',
                        'type'  => 'text',
                        'title' => 'Logo Icon',
                        'desc'  => '<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Use Any font awesome Icon</a>'
                    ),
                    array(
                        'id'    => 'logo_txt',
                        'type'  => 'text',
                        'title' => 'Logo Text',
                    ),
                    array(
                        'id'        => 'logo_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Logo', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Basic media uploader with disabled URL input field.', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'fav_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Fav Icon', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Basic media uploader with disabled URL input field.', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                   array(
                        'id'        => 'menu-mode',
                        'type'      => 'switch',
                        'title'     => __('One page or multipage menu', 'hercules'),
                        'subtitle'  => __('Change menu for multipage or singel page On is for multiplage and off is for one page', 'hercules'),
                        //'options' => array('on', 'off'),
                        'default'   => false,
                    ),
                )
            ));
            Redux::setSection( $opt_name,array(
                'title'   => 'Header settings',
                'icon'    => 'el-icon-cogs',
                'heading' => 'Expanded New Section Title',
                'desc'    => '<br />Top of the header phone and timing can be edited from here.<br />',
                'fields'  => array(
                    array(
                        'id'    => 'phone_no',
                        'type'  => 'text',
                        'title' => 'Phone No',
                    ),
                    array(
                        'id'    => 'of_timing',
                        'type'  => 'text',
                        'title' => 'Timing',
                    ),
                ),
            ));
            Redux::setSection( $opt_name,array(
                'title'   => 'Slider',
                'icon'    => 'el-icon-eye-open',
                'heading' => 'Expanded New Section Title',
                'desc'    => '<br />Main slider slides can be edited from here.<br />',
                'fields'  => array(
                    array(
                        'id'        => 'main-slides',
                        'type'      => 'slides',
                        'title'     => __('Slides Options', 'hercules'),
                        'subtitle'  => __('Unlimited slides with drag and drop sortings.', 'hercules'),
                        'desc'      => __('', 'hercules'),
                        'placeholder'   => array(
                            'title'         => __('This is a title', 'hercules'),
                            'description'   => __('Description Here', 'hercules'),
                            'btntitle'         => __('This is button title', 'hercules'),
                            'url'           => __('Give us a link!', 'hercules'),
                        ))
                    ),
            ));
            Redux::setSection( $opt_name,array(
                'title'   => 'Schedule Options',
                'icon'    => 'el-icon-list-alt',
                'heading' => 'Expanded New Section Title',
                'desc'    => '<br />After slider schedule section content can be edited from here.<br />',
                'fields'  => array(
                    array(
                        'id'    => 'title_1',
                        'type'  => 'text',
                        'title' => 'Title Schedule section 1',
                    ),
                    array(
                        'id'    => 'sub_title_1',
                        'type'  => 'text',
                        'title' => 'Sub Title Schedule section 1',
                    ),
                    array(
                        'id'    => 'icon_1',
                        'type'  => 'text',
                        'title' => 'Icon Name',
                        'desc'  =>  'Please Enter the Font Awesome icon here e.g fa-asterisk'
                    ),
                    array(
                        'id'        => 'desc_1',
                        'type'      => 'textarea',
                        'title'     => __('Desc Section 1', 'hercules'),
                        'subtitle'  => __('All HTML will be stripped', 'hercules'),
                        'desc'      => __('', 'hercules'),
                        'validate'  => 'no_html',
                        'default'   => 'No HTML is allowed in here.'
                    ),
                    array(
                        'id'    => 'title_2',
                        'type'  => 'text',
                        'title' => 'Title Schedule section 2',
                    ),
                    array(
                        'id'    => 'sub_title_2',
                        'type'  => 'text',
                        'title' => 'Sub Title Schedule section 2',
                    ),
                     array(
                        'id'    => 'icon_2',
                        'type'  => 'text',
                        'title' => 'Icon Name',
                        'desc'  =>  'Please Enter the Font Awesome icon here e.g fa-asterisk'
                    ),
                    array(
                        'id'        => 'desc_2',
                        'type'      => 'textarea',
                        'title'     => __('Desc Section 1', 'hercules'),
                        'subtitle'  => __('All HTML will be stripped', 'hercules'),
                        'desc'      => __('', 'hercules'),
                        'validate'  => 'no_html',
                        'default'   => 'No HTML is allowed in here.'
                    ),
                    array(
                        'id'    => 'title_3',
                        'type'  => 'text',
                        'title' => 'Title Schedule section 3',
                    ),
                    array(
                        'id'    => 'sub_title_3',
                        'type'  => 'text',
                        'title' => 'Sub Title Schedule section 3',
                    ),
                     array(
                        'id'    => 'icon_3',
                        'type'  => 'text',
                        'title' => 'Icon Name',
                        'desc'  =>  'Please Enter the Font Awesome icon here e.g fa-asterisk'
                    ),
                    array(
                        'id'        => 'desc_3',
                        'type'      => 'textarea',
                        'title'     => __('Desc Section 3', 'hercules'),
                        'subtitle'  => __('All HTML will be stripped', 'hercules'),
                        'desc'      => __('', 'hercules'),
                        'validate'  => 'no_html',
                        'default'   => 'No HTML is allowed in here.'
                    ),
                    array(
                        'id'    => 'title_4',
                        'type'  => 'text',
                        'title' => 'Title Schedule section 4',
                    ),
                    array(
                        'id'    => 'sub_title_4',
                        'type'  => 'text',
                        'title' => 'Sub Title Schedule section 4',
                    ),
                     array(
                        'id'    => 'icon_4',
                        'type'  => 'text',
                        'title' => 'Icon Name',
                        'desc'  =>  'Please Enter the Font Awesome icon here e.g fa-asterisk'
                    ),
                    array(
                        'id'        => 'desc_4',
                        'type'      => 'textarea',
                        'title'     => __('Desc Section 4', 'hercules'),
                        'subtitle'  => __('Some Html tags are allowed', 'hercules'),
                        'desc'      => __('', 'hercules'),
                        'validate'  => 'html',
                        'default'   => 'Some HTML are allowed in here.',
                        'allowed_html' => array(
                            'ul' => array(),
                            'li' => array(),
                            'i' => array(
                                'class' => array()
                                ),
                            'span' => array()
                        )
                    )
                ),
            ));
                Redux::setSection( $opt_name,array(
                'icon'      => 'el-icon-star',
                'title'     => __('What\' New Section', 'hercules'),
                'fields'    => array(
                    array(     
                        "id"        => "class_title",
                        "type"      => "text",
                        "title"      => "Class Title",
                ),array(  
                        "id"        => "class_desc",                        
                        "type"      => "textarea",
                        "title"      => "Class Details",
                ),array(  
                        "id"        => "pro_days",
                        "type"      => "text",
                        "title"      => "Program Days",
                ),array(  
                        "id"        => "pro_timing",
                        "type"      => "text",
                        "title"      => "Program Timing",
                ),array(  
                        "id"        => "trainer_name",
                        "type"      => "text",
                        "title"      => "Trainer Name",
                ),array( 
                        "id"        => "timetable_link",
                        "type"      => "text",
                         "title"      => "Timetable Link",
                ),array(                         
                        "id"        => "class_link",
                        "type"      => "text",
                        "title"      => "Class Link",
                ),array(
                        'id'        => 'pro_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Media w/ URL', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Basic media uploader with disabled URL input field.', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                )));
                Redux::setSection( $opt_name,array(
                'icon'      => ' el-icon-photo',
                'title'     => __('Application Section', 'hercules'),
                'fields'    => array( array( "title"      => "Title",
                        "id"        => "app_title_text",
                        "type"      => "text"
                ),array(  "title"      => "Description 1",
                        "id"        => "app_desc_1",
                        "type"      => "text"
                ),array(  "title"      => "Description 2",
                        "id"        => "app_desc_2",
                        "type"      => "text"
                ),array(  "title"      => "Description 3",
                        "id"        => "app_desc_3",
                        "type"      => "text"
                ),array(  "title"      => "Description 4",
                        "id"        => "app_desc_4",
                        "type"      => "text"
                ),array(  "title"      => "Button Text",
                        "id"        => "app_btn_text",
                        "type"      => "text"
                ),array(  "title"      => "Button Link",
                        "id"        => "down_btn_link",
                        "type"      => "text"
                ),array(
                        'id'        => 'app_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Media w/ URL', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Basic media uploader with disabled URL input field.', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                )));
                Redux::setSection( $opt_name,array(
                'title'   => 'Parallex background images',
                'icon'    => 'el-icon-eye-open',
                'heading' => 'Parallex background images',
                'desc'    => '<br />You can change parallex background images from here.<br />',
                'fields'  => array(
                    array(
                        'id'        => 'p2_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Tweets section', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Tweets section parallex background image', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'p3_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('App section', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('App section parallex background image', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'p4_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Parallexblock', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Parallexblock with one or two button parallex bakground image.', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),
                    array(
                        'id'        => 'p5_img',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Testimonial', 'hercules'),
                        'compiler'  => 'true',
                        //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Testimonial parallex bakground image', 'hercules'),
                        'subtitle'  => __('Upload any media using the WordPress native uploader', 'hercules'),
                        'default'   => array('url' => 'http://s.wordpress.org/style/images/codeispoetry.png'),
                        //'hint'      => array(
                        //    'title'     => 'Hint Title',
                        //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        //)
                    ),)
            ));
               Redux::setSection( $opt_name,array(
                'icon'      => 'el-icon-map-marker-alt',
                'title'     => __('Contact', 'hercules'),
                'fields'    => array( array( "title"      => "Email Address to receive emails",
                        "id"        => "e_add",
                        "type"      => "text"
                ),array(  "title"      => "Address",
                        "id"        => "address",
                        "type"      => "text"
                ),array(  "title"      => "Latitutde",
                        "id"        => "g_lat",
                        "type"      => "text"
                ),array(  "title"      => "Longitude",
                        "id"        => "g_long",
                        "type"      => "text"
                ),array(  "title"      => "Zoom",
                        "id"        => "g_zoom",
                        "type"      => "text"
                )
                )));
               Redux::setSection( $opt_name,array(
                'icon'      => 'el-icon-website',
                'title'     => __('Footer', 'hercules'),
                'fields'    => array(array( "title"      => "Footer Copyright Text",
                        "id"        => "copy_text",
                        "type"      => "text"
                ),array(  "title"      => "Facebook",
                        "id"        => "face_link",
                        "type"      => "text"
                ),array(  "title"      => "Twitter",
                        "id"        => "twit_link",
                        "type"      => "text"
                ),array(  "title"      => "pinterest",
                        "id"        => "pin_link",
                        "type"      => "text"
                ),array(  "title"      => "Google Plus",
                        "id"        => "gplus_link",
                        "type"      => "text"
                ),array(  "title"      => "Dribbble",
                        "id"        => "dri_link",
                        "type"      => "text"
                ),array(  "title"      => "LimkedIn",
                        "id"        => "lin_link",
                        "type"      => "text"
                ),array(  "title"      => "Rss",
                        "id"        => "rss_link",
                        "type"      => "text"
                )
                )));
            Redux::setSection( $opt_name,array(
                'title'     => __('Import / Export', 'hercules'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'hercules'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            ));                     
            Redux::setSection( $opt_name,array(
                'type' => 'divide',
            ));
            Redux::setSection( $opt_name,array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'hercules'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'hercules'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            ));

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
