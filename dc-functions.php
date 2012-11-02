<?php

/**
 * daCommerce Functions
 */

namespace Functions;

class Dc
{

    /**
     * Return true if the file of the active page exists.
     */
    public function getActivePage(&$url = array(), $path)
    {
        if (empty($url))
            return false;

        if (!file_exists($path.'/'.$url[0].'.php'))
            return false;

        return $url;
    }

    /**
     * Get the first element not empty from args
     */
    public function notEmpty()
    {

        for ($i=0;$i<func_num_args();$i++){
          $arg = func_get_arg($i);
          if (($arg != null)&&($arg != "")){
            return $arg;
          }
        }
        return null;

    }

    /**
     * Sanitize text for URL
     */
    public function sanitize($text)
    {

        $text = html_entity_decode($text);
        $text = mb_strtolower($text);

        $text = preg_replace('[aáàãâä]', 'a', $text);
        $text = preg_replace('[eéèêë]', 'e', $text);
        $text = preg_replace('[iíìîï]', 'i', $text);
        $text = preg_replace('[oóòõôö]', 'o', $text);
        $text = preg_replace('[uúùûü]', 'u', $text);
        $text = preg_replace('[ç]', 'c', $text);
        $text = preg_replace('[ñ]', 'n', $text);
        $text = preg_replace('( )', '-', $text);
        $text = preg_replace('[^a-z0-9\-]', '', $text);
        $text = preg_replace('/(\-)+/', '-', $text);

        return $text;
    }

    /**
     * Create URL array
     */
    public function URL($url, $inicio, $pg_inicial)
    {
        if ($retira = strpos($url, '?'))
          $url = substr($url, 0, $retira-1);

        $url = explode('/', $url);

        for ($k = $inicio;$k < count($url); $k++)
            $pg[] = $this->sanitize($url[$k]);

        $pg[0] = $this->notEmpty($pg[0], $pg[0], $pg_inicial);

        return $pg;
    }

    /**
     * Set a option in dc_options database
     */
    public function add_option($key, $value)
    {
        global $em;

        $option = new \Entities\Option($key, $value);
        $em->persist($option);
        $em->flush();
    }

    /**
     * Get a option from dc_options database
     */
    public function get_option($key)
    {
        global $em;

        // return 'teste';

        $option = $em->getRepository('Entities\Option')->findOneBy(array('option_key' => $key));
        return $option->getOptionValue();
    }

    /**
     * Login form
     */

    public function login_form() {
        echo '
        <form id="da-login-form" method="post" action="dc-login-action">
            <div id="da-login-input-wrapper">
                <div class="da-login-input">
                    <input type="text" name="username" id="da-login-username" placeholder="E-mail" />
                </div><!-- #da-login-input -->
                <div class="da-login-input">
                    <input type="password" name="password" id="da-login-password" placeholder="Senha" />
                </div><!-- #da-login-input -->
            </div><!-- #da-login-input-wrapper -->
            <div id="da-login-button">
                <input name="loginForm" type="submit" value="Login" id="da-login-submit" />
            </div><!-- #da-login-button -->
        </form>
        ';
    }

}

/**
 * Function for Content files
 */

class Dc_Content
{

    public function get_header()
    {
        include_once CONTENTPATH.'/header.php';
    }

    public function get_footer()
    {
        include_once CONTENTPATH.'/footer.php';
    }

    public function get_sidebar()
    {
        include_once CONTENTPATH.'/sidebar.php';
    }

}

/**
 * Function for Admin files
 */

class Dc_Admin
{

    public function get_header()
    {
        include_once ADMINPATH.'/header.php';
    }

    public function get_footer()
    {
        include_once ADMINPATH.'/footer.php';
    }

    public function get_sidebar()
    {
        include_once ADMINPATH.'/sidebar.php';
    }

}