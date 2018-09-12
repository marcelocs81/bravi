<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi;


use Mcs\Bravi\Service\SettingsService;
use Mcs\Bravi\ValueObject\SettingApi;

class McsBraviPlugin extends AbstractMcsBravi
{

    protected $pluginContext;
    protected $pluginContextClass;

    public $pluginDir;
    public $pluginPath;
    public $pluginUrl;

    /**
     * McsBraviPlugin constructor.
     */
    public function __construct($context = NULL)
    {
        if (is_object($context)) {
            $this->pluginContext = $context;
            $this->pluginContextClass = get_class($context);
        }

        $this->pluginPath = trailingslashit(dirname(dirname(__FILE__)));
        $this->pluginDir = trailingslashit(basename($this->pluginPath));

        $parent_plugin_dir = trailingslashit(plugin_basename($this->pluginDir));

        $this->pluginUrl = plugins_url($parent_plugin_dir === $this->pluginDir ? $this->pluginDir : $parent_plugin_dir);

    }

    public function init()
    {

        $this->registerAction();

        \register_activation_hook(MCS_BRAVI_FILE, array($this, 'createTables'));

        $this->registerShortCode();

    }

    private function registerShortCode()
    {
        $short = new ShortCode();
        $short->init();

    }

    private function registerAction()
    {
        //Admin Settings
        \add_action('admin_menu', array($this, 'addMenuConfigAPI'));
        \add_action('admin_init', array($this, 'initAdminAPI'));

        // Register the css
        \add_action('wp_enqueue_scripts', array($this, "registerStyle"));

        // Register the js
        \add_action('wp_enqueue_scripts', array($this, 'registerJS'));

        \add_action('wp_enqueue_scripts', array($this, 'registerJsFavorites'));
    }

    public function addMenuConfigAPI()
    {
        \add_options_page('OMDB API', 'OMDB API', 'manage_options', 'omdb_api', array($this, 'settingsPage'));
    }

    public function initAdminAPI()
    {
        \register_setting('omdb_settings', 'api_url');
        \register_setting('omdb_settings', 'api_key');
    }

    /**
     * A function to register the stylesheet
     * @return [type] [description]
     */
    public function registerStyle()
    {

        wp_register_style('bootstrap-style', $this->pluginUrl . 'assets/css/bootstrap.min.css');
        wp_enqueue_style('bootstrap-style');

        wp_register_style('dataTables-bootstrap-style', $this->pluginUrl . 'assets/css/dataTables.bootstrap.min.css');
        wp_enqueue_style('dataTables-bootstrap-style');

        wp_register_style('mcs-style', $this->pluginUrl . 'assets/css/mcs-bravi-style.css');
        wp_enqueue_style('mcs-style');

        wp_register_style('pagination-style', $this->pluginUrl . 'assets/css/pagination.css');
        wp_enqueue_style('pagination-style');
    }

    /**
     * A function to register the script
     * @return [type] [description]
     */
    public function registerJS()
    {

        wp_register_script('url-script', 'url');
        wp_enqueue_script('url-script');
        wp_localize_script('url-script', 'pluginUrl', array('dir' => plugin_dir_url(MCS_BRAVI_FILE) . '/public/'));

        wp_localize_script('url-script', 'apiUrl', SettingApi::init()->getUrlComplete());

        wp_register_script('bootstrap-script', $this->pluginUrl . 'assets/js/bootstrap.min.js', array('jquery'));
        wp_enqueue_script('bootstrap-script');

        wp_register_script('dataTables-script', $this->pluginUrl . 'assets/js/jquery.dataTables.min.js', array('jquery'));
        wp_enqueue_script('dataTables-script');

        wp_register_script('dataTables-bootstrap-script', $this->pluginUrl . 'assets/js/dataTables.bootstrap.min.js', array('jquery'));
        wp_enqueue_script('dataTables-bootstrap-script');

        wp_register_script('mcs-movies-script', $this->pluginUrl . 'assets/js/mcs-bravi-movies.js?31312', array('jquery'));
        wp_enqueue_script('mcs-movies-script');
    }

    public function registerJsFavorites()
    {

        global $post;

        if (has_shortcode($post->post_content, 'mcs-favorites') && !is_admin()) {
            wp_register_script('mcs-favorites-script', $this->pluginUrl . 'assets/js/mcs-bravi-favorites.js', array('jquery'));
            wp_enqueue_script('mcs-favorites-script');
        }

    }

    //Create tables
    public function createTables()
    {
        global $wpdb;

        $tableFavorite = $wpdb->prefix . \Mcs\Bravi\ValueObject\SettingApi::TABLE_FAVORITE;
        $tableSettings = $wpdb->prefix . \Mcs\Bravi\ValueObject\SettingApi::TABLE_SETTINGS;

        $query = [];

        #Check to see if the table exists already, if not, then create it

        if ($wpdb->get_var("show tables like '$tableFavorite'") != $tableFavorite) {
            $sql = "CREATE TABLE `" . $tableFavorite . "` ( ";
            $sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
            $sql .= "  `user_id`  int(11)   NOT NULL, ";
            $sql .= "  `imdb_id`  varchar(20)   NOT NULL, ";
            $sql .= "  `created_at` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, ";
            $sql .= "  PRIMARY KEY (`id`) ";
            $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

            $query[] = $sql;
        }

        if ($wpdb->get_var("show tables like '$tableSettings'") != $tableSettings) {
            $sql = "CREATE TABLE `" . $tableSettings . "` ( ";
            $sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
            $sql .= "  `api_url`  varchar(255)   NOT NULL, ";
            $sql .= "  `api_key` varchar(50)   NOT NULL, ";
            $sql .= "  PRIMARY KEY (`id`) ";
            $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
            $query[] = $sql;
        }

        $query[] = "INSERT INTO `" . $tableSettings . "` (`id`, `api_url`, `api_key`) VALUES (1, 'https://www.omdbapi.com', '8e50c549');";

        $tableName = $wpdb->prefix . 'options';
        $query[] = "UPDATE ".$tableName." SET option_value = 1 WHERE option_name = 'users_can_register'";

        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        dbDelta($query);
    }


    public function settingsPage()
    {
        try {

            $service = new SettingsService();
            $msg = "Error, data not changed.";

            if (isset($_POST['wphw_submit'])) {
                $result = $service->savePost($_POST);

                if ($result) {
                    $msg = "Updated with success!";
                }

            }

            $setting = $service->find();

            $template_loader = new RendererTemplate();

            $data = array('settings' => $setting, 'post' => $_POST, 'msg' => $msg);
            $template_loader
                ->set_template_data($data, 'context')
                ->get_template_part('settings-api');

        } catch (\Exception $ex) {
            $this->trataExceptioShortCode($ex);
        }

    }


    public static function runner()
    {
        $pluginx = new McsBraviPlugin();
        $pluginx->init();

    }


}