<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi;


use Mcs\Bravi\Service\MovieService;

class ShortCode extends AbstractMcsBravi
{

    public function init()
    {
        \add_shortcode('mcs-home', array($this, 'home'));
        \add_shortcode('mcs-movies', array($this, 'searchMovies'));
        \add_shortcode('mcs-favorites', array($this, 'listFavorites'));
        \add_shortcode('mcs-banner', array($this, 'banner'));
        \add_shortcode('force-login', array($this, 'forceLogin'));
        \add_shortcode('login-form', array($this, 'loginForm'));

    }

    public function searchMovies($atts, $content = "")
    {
        $template = new RendererTemplate();

        $imageUrl = esc_url(plugins_url('images/banner.png', MCS_BRAVI_FILE));

        $data = array('imageUrl' => $imageUrl);
        $template->set_template_data($data, 'context')
            ->get_template_part('search-movies');

    }


    public function listFavorites($atts, $content = "")
    {

        try {
            $service = new MovieService();
            $movies = $service->getListMovieFavorite();

            $template = new RendererTemplate();

            $data = array('movies' => $movies);
            $template->set_template_data($data, 'context')
                ->get_template_part('list-favorites');

        } catch (\Exception $ex) {
            $this->trataExceptioShortCode($ex);
        }

    }

    public function home($atts, $content = null)
    {
        try {

            if (! is_user_logged_in()) {
                $this->banner($atts, $content);
            }else{
                $this->searchMovies($atts, $content);
            }

        } catch (\Exception $ex) {
            $this->trataExceptioShortCode($ex);
        }

    }

    public function banner($atts, $content = null)
    {
        try {

            $template = new RendererTemplate();

            extract(shortcode_atts(array(
                'redirect' => ''
            ), $atts));

            if ($redirect) {
                $redirect_url = $redirect;
            } else {
                $redirect_url = get_permalink();
            }

            $imageUrl = esc_url(plugins_url('images/banner.png', MCS_BRAVI_FILE));
            $urlRegister = esc_url(wp_registration_url());
            $urlLogin = esc_url(wp_login_url($redirect_url));

            $data = array('imageUrl' => $imageUrl, 'urlLogin' => $urlLogin, 'urlRegister' => $urlRegister);
            $template->set_template_data($data, 'context')
                ->get_template_part('banner');

        } catch (\Exception $ex) {
            $this->trataExceptioShortCode($ex);
        }

    }

    public function loginForm($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'redirect' => ''
        ), $atts));

        if (!is_user_logged_in()) {
            if ($redirect) {
                $redirect_url = $redirect;
            } else {
                $redirect_url = get_permalink();
            }
            $form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url));
        }
        return $form;
    }

    public function forceLogin($atts, $content = null)
    {

        if (!is_user_logged_in()) {
            $url = site_url('/wp-login.php?action=login&redirect_to=' . get_permalink());
            echo '<script>window.location="' . $url . '";</script>';
            exit;
        }
    }

}