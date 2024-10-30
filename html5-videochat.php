<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
Plugin Name: html5-videochat
Plugin URI: https://www.html5-videochat.com/index.php?/integrazione/wordpress/
Description: Insert this chat HTML5 plugin, it integrates perfectly into your blog
Version: 1.05
Author: CST Software Corp
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.html 
*/



class HTML5_VideoChat_HtmlChat
{
	private static $scriptUrl = 'https://www.html5-videochat.com/index.php?/wordpress/chat-wp/';
	private static $registerAccountUrl = 'https://www.html5-videochat.com/index.php?/wordpress/registrazione-account/';
	private static $get_json = 'https://www.html5-videochat.com/index.php?/wordpress/get-json-wp/';
	private static $noticeName = 'html5videochat-notice';
	private static $domain;
	private $countShortcode = 0;
	private $adminPanel;
	private $code;
	private static $genderField;

	/*
	 * init
	 */
	function __construct()
	{
		$this->init();
		$this->setEvents();
	}

	/*
	 * create an account when plugin activated
	 */
	static function pluginActivated()
	{
		if( !ini_get('allow_url_fopen') ) {
			exit ('Error: "allow_url_fopen" is not enabled. "file_get_contents" plugin cannot be activated if allow_url_fopen is not enabled.
			<a target="_blank" href="https://www.php.net/manual/en/filesystem.configuration.php#ini.allow-url-fopen">More details</a>');
		}

		$user = wp_get_current_user();
		$roles = $user->roles;
		$isAdmin = (in_array('administrator', $roles));
		$email = $user->user_email;
		$username = $user->user_login;;
		$domain = get_site_url(null, '', '');

		if (!$domain) {
			$domain = get_home_url(null, '', '');
		}
		if (!$domain) {
			$domain = sanitize_text_field($_SERVER['SERVER_NAME']);
		}
		$domain = parse_url($domain)['host'];
		$wp_register_url = wp_registration_url();
		$wp_login_url = wp_login_url();

		$params = array('a' => 'createAccountWP', 'username' => $username, 'email' => $email, 'isAdmin' => $isAdmin, 'url' => $domain,
			'wp_register_url' => $wp_register_url, 'wp_login_url' => $wp_login_url);
		$query = http_build_query($params);
		$contextData = array(
			'method' => 'POST',
			'header' => "Connection: close\r\n" . "Content-Length: " . strlen($query) . "\r\n",
			'content' => $query
		);
		$context = stream_context_create(array('http' => $contextData));
		$result = file_get_contents(self::$registerAccountUrl, false, $context);
		set_transient(self::$noticeName, $context, 5);
	}

	/*
	 * display notice when account is activated
	 */
	static function display_notice()
	{
		$jsonString = get_transient(self::$noticeName);
		$json = json_decode($jsonString);
		echo "<div id='message' class='updated notice is-dismissible'>" . esc_html($json->message) . "</div>"; 
		delete_transient(self::$noticeName);
	}

	function init()
	{
		self::$domain = $this->getDomain();
	}

	function setEvents()
	{
		add_action('admin_init', array($this, 'adminInit'));

		add_action('admin_menu', array($this, 'setMenu'));
		add_shortcode('HTML5VIDEOCHAT', array($this, 'html5_videochat_do_shortcode')); 
		add_filter('the_content', 'do_shortcode');
		add_filter("mce_external_plugins", array($this, 'enqueuePluginScripts'));
		add_filter("mce_buttons", array($this, 'registerButtonEditor'));
	}

	function adminInit()
	{
		wp_register_style('html5-videochat-style', plugin_dir_url(__FILE__) . 'css/style.css');
	}

	function styleAdmin()
	{
		wp_enqueue_style('html5-videochat-style');
	}
	//-------------------------------------------------------------------------------------------------------------------------------
	/*
	 * shortcode
	 */
	function isSingleShortcode()
	{
		return $this->countShortcode == 0;
	}

	function isLoggedon()
	{
		$current_user = wp_get_current_user();
		return ($current_user);
	}

	function getDomain()
	{
		$str = get_site_url(null, '', '');
		$str = parse_url($str)['host'];
		return $str;
	}

	function getCurrentUser()
	{
		$current_user = wp_get_current_user();
		return $current_user->user_login;
	}

	function getSrcScript($width = '100%', $height = 'fullscreen')
	{       
       

                $roles = wp_get_current_user()->roles;
		$role = ($roles) ? $roles[0] : 'user';


		$isAdmin = in_array('administrator', $roles);
		$currentUser = wp_get_current_user();
		$email = $currentUser->user_email;
		$user_pass       = $currentUser->user_pass;
		$avatar = urlencode(get_avatar_url($currentUser->ID));
		$nickname = $currentUser->user_login;
                $pulisci_pass = preg_replace('/[^A-Za-z0-9\-]/', '', strval($user_pass));

		$src = self::$scriptUrl;
		$src .= '?&url=' . urlencode(self::$domain);
                $src .= "&user_pass=$pulisci_pass";
                $src .= "&nickname=$nickname";
	         
                if (function_exists('bp_has_profile')) {
                    $gender = $this->bbGetGenderUser();
                   if(strtolower($gender) == 'femmina' || strtolower($gender) == 'female' || strtolower($gender) == 'chica' || strtolower($gender) == 'weiblich' || strtolower($gender) == 'femelle' || strtolower($gender) == 'Kobieta' || strtolower($gender) == 'kvinde'){
                    $src .= '&gender=2';
                   }else if(strtolower($gender) == 'maschio' || strtolower($gender) == 'man' || strtolower($gender) == 'hombre' || strtolower($gender) == 'Mann' || strtolower($gender) == 'mâle' || strtolower($gender) == 'Mezczyzna' || strtolower($gender) == 'han-'){
                    $src .= '&gender=1';
                   }else{
                   $src .= '&gender=3';
                  }
		 }else{
                  $src .= '&gender=1';
               }

                if(empty($email)){
                 $role = 'ospite';
                }
		 // GET JSON
		 $params_ = array(
		    'role' => $role,
		    'user_pass' => $user_pass,
		    'isAdmin' => $isAdmin,
  		    'username' => $currentUser->user_login,
		    'email' => $email,
		    'avatar' => $avatar,
  		    'url' => urlencode(self::$domain)
		 );

		 $query_ = http_build_query($params_);
		 $contextData_ = array(
 		   'method' => 'POST',
  		   'header' => "Connection: close\r\n" . "Content-Type: application/x-www-form-urlencoded\r\n" . "Content-Length: " . strlen($query_) . "\r\n",
 		   'content' => $query_
		 );

		 $context_ = stream_context_create(array('http' => $contextData_));
		 $result_ = file_get_contents(self::$get_json, false, $context_);
		return $src;

	}

function html5_videochat_do_shortcode($attributes)
{
    if (!$this->isSingleShortcode()) {
        return '';
    }
    $this->countShortcode++;
    $escapedWidth = htmlspecialchars($attributes['width']);
    $escapedHeight = htmlspecialchars($attributes['height']);
    $escapedSrcScript = htmlspecialchars($this->getSrcScript($attributes['width'], $attributes['height']));
    
    if (strtolower($escapedHeight) == 'fullscreen') {
         $iframeMarkup = '<div style="position: fixed;left: 0;width: 100%;height: 100%;top: 0;margin: 0;z-index: 999999999;"><iframe src="' . $escapedSrcScript . '" width="' . $escapedWidth . '" height="' . $escapedHeight . '" allowfullscreen="" allow="geolocation; microphone; camera; allowfullscreen; autoplay;" style=" height: 100%; border: 0; " ></iframe></div>';
    }else{
         $iframeMarkup = '<iframe src="' . $escapedSrcScript . '" width="' . $escapedWidth . '" height="' . $escapedHeight . '" allowfullscreen="" allow="geolocation; microphone; camera; allowfullscreen; autoplay;"></iframe>';
    }
    return $iframeMarkup;
}

	//-------------------------------------------------------------------------------------------------------------------------------
	/*
	 * WP admin panel
	 */
	function getIconMenu()
	{
		return plugin_dir_url(__FILE__) . 'images/icon-menu.png';
	}

	function getPageAdmin()
	{

		//$url = get_admin_url(null, 'admin.php?page='.$this->adminPanel['menu_slug']);
		$email = wp_get_current_user()->user_email;
	 
		ob_start(); ?>
		<div id="html5videochat-help">
			<h1>Insert HTML5 videochat</h1>
			<p>
				To add the chat to your post or page, please <b>paste:</b>
			</p>
			<div>
				<input type="text" value="[HTML5VIDEOCHAT width=100% height=640px]" style="width: 50%;">
				<button id="copyClipBoardHtml5chat1" onclick="copyToClipBoardHtml5(event)">copy</button>
			</div>

			<p>(Specify the width and height of the chat you want)</p>
			<p>
				If you want the chat to be fullScreen, use height=fullscreen ex:
			</p>
			<div>
				<input type="text" value="[HTML5VIDEOCHAT width=100% height=100%]" style="width: 50%;">
				<button id="copyClipBoardHtml5chat1" onclick="copyToClipBoardHtml5(event)">copy</button>
			</div>
			<div style="margin: 50px"></div>
			<a style="background: #CCC;padding: 10px;color: black;text-decoration: none;cursor: pointer;border: 1px solid #AAA;	border-radius: 5px;font-size: 1.1em;font-weight: bold;" target="_blank" href="<?php echo esc_url($url); ?>">Configure the chat here</a>

		</div>
		<script>
			function copyToClipBoardHtml5(e) {
				jQuery(e.currentTarget).parent().find("input[type='text']").select()
				document.execCommand('copy');
			}
		</script>

		<?php $src = ob_get_clean();
		echo esc_url($src); 
	}


	function setMenu()
	{
		$parent = array(
			'page_title' => 'HTML5 videochat setting',
			'menu_title' => 'HTML5-VIDEOCHAT',
			'capability' => 'manage_options',
			'menu_slug' => 'html5-videochat',
			'function' => array($this, 'getPageAdmin'),
			'icon_url' => $this->getIconMenu()
		);
		$adminPanelTitle = 'Configure chat';
		$this->adminPanel = array(
			'parent_slug' => $parent['menu_slug'],
			'page_title' => $adminPanelTitle,
			'menu_title' => $adminPanelTitle,
			'capability' => $parent['capability'],
			'menu_slug' => $parent['menu_slug'],
			'function' => array($this, 'getPageAdmin')
		);

		add_menu_page($parent['page_title'], $parent['menu_title'], $parent['capability'], $parent['menu_slug'], $parent['function'], $parent['icon_url']);
	}
	//-------------------------------------------------------------------------------------------------------------------------------
	/*
	 * register button in editor
	 */
	function enqueuePluginScripts($plugin_array)
	{
		if ($this->isSingleShortcode()) {
			$plugin_array['button_html5_videochat'] = $this->getButtonScript();
		}

		return $plugin_array;
	}

	function registerButtonEditor($buttons)
	{
		if ($this->isSingleShortcode()) {
			array_push($buttons, 'btn_html5_videochat');
		}

		return $buttons;
	}

	function getButtonScript()
	{
		$src = plugin_dir_url(__FILE__) . 'js/main.js';

		return $src;
	}

	// buddyPress
	function bbGetGenderUser() 	{
	       $possibleSexes = [ 'Sono', 'I am', 'Soy', 'Ich bin', 'Je suis', 'Jestem', 'Ik ben', 'Jeg er'];
                global $bp;
		$currentUser = wp_get_current_user();
		$userid = ($currentUser->data->ID);
                
                if(function_exists( 'xprofile_get_field_data' )) {
		   foreach ($possibleSexes as $field_name) {
                      $field_id = BP_XProfile_Field::get_id_from_name($field_name);
                   if ($field_id) {
                    // Il campo è stato trovato, esegui ulteriori operazioni
                    $gender = xprofile_get_field_data($field_id, $userid);
                    // Esci dal ciclo perché hai trovato un campo
                      break;
                   }
                  }
	           return $gender;
	        }

		$gender = 'male';

	 	foreach ($possibleSexes as $possibleSex) {
			$args = array('field' => $possibleSex, 'user_id' => $userid);
			$gender = bp_get_profile_field_data($args);
			if ($gender) {
				exit("DOUNF");
				break;
			}
		}
		return $gender;
	}

	// buddyPress
	function bbGetTypeUser()
	{
		$role = bp_get_member_type(bp_loggedin_user_id(), true);
		return $role;
	}

}

register_activation_hook(__FILE__, array('HTML5_VideoChat_HtmlChat', 'pluginActivated'));
add_action('admin_notices', array('HTML5_VideoChat_HtmlChat', 'display_notice'));
$htmlChat = new HTML5_VideoChat_HtmlChat();