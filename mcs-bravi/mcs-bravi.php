<?php
/*
Plugin Name: MCS Bravi Plugin
Description: Prova para avaliação de conhecimento para vaga de desenvolvedor PHP
Author: Marcelo Cardoso de Souza
*/

define( 'MCS_BRAVI_FILE', __FILE__ );
define( 'MCS_BRAVI_DIR', plugin_dir_path( __FILE__ ) );

include dirname(__FILE__) . '/../../../wp-config.php';

require_once("vendor/autoload.php");

\Mcs\Bravi\McsBraviPlugin::runner();