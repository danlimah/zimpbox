<?php
/**
 * Version 0.0.2
 */

require dirname( __FILE__ ) .'/importer/mevo-importer.php'; //load admin theme data importer

class MI_Theme_Demo_Data_Importer extends MI_Theme_Importer {

    /**
     * Holds a copy of the object for easy reference.
     *
     * @since 0.0.1
     *
     * @var object
     */
    private static $instance;
     
    /**
     * Set the key to be used to store theme options
     *
     * @since 0.0.2
     *
     * @var object
     */
    public $theme_option_name = 'redux_options.json'; //set theme options name here

    public $content_demo_file_onepage_1_image  =  'onepage-1-image.xml';
    public $content_demo_file_onepage_2_image  =  'onepage-2-image.xml';
    public $content_demo_file_onepage_3_image  =  'onepage-3-image.xml';
    public $content_demo_file_onepage_1_slider =  'onepage-1-slider.xml';
    public $content_demo_file_onepage_2_slider =  'onepage-2-slider.xml';
    public $content_demo_file_onepage_3_slider =  'onepage-3-slider.xml';
    public $content_demo_file_onepage_1_video  =  'onepage-1-video.xml';
    public $content_demo_file_onepage_2_video  =  'onepage-2-video.xml';
    public $content_demo_file_onepage_3_video  =  'onepage-3-video.xml';

    
	/**
	 * Holds a copy of the widget settings 
	 *
	 * @since 0.0.2
	 *
	 * @var object
	 */
	public $widget_import_results;
	
    /**
     * Constructor. Hooks all interactions to initialize the class.
     *
     * @since 0.0.1
     */
    public function __construct() {
    
		$this->demo_files_path = dirname(__FILE__) . '/demo-files/';

        self::$instance = $this;
		parent::__construct();

    }

}

new MI_Theme_Demo_Data_Importer;