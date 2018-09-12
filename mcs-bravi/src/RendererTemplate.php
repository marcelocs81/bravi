<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi;

use Gamajo_Template_Loader;


class RendererTemplate extends Gamajo_Template_Loader
{

    /**
     * Prefix for filter names.
     *
     * @var string
     */
    protected $filter_prefix = 'mcs-bravi';

    /**
     * Directory name where custom templates for this plugin should be found in the theme.
     *
     * @var string
     */
    protected $theme_template_directory = 'mcs-bravi';

    /**
     * Reference to the root directory path of this plugin.
     *
     * @var string
     */
    protected $plugin_directory = MCS_BRAVI_DIR;


}