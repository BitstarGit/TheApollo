<?php
require_once('./assets/init.php');
$provider = "";
$wowondersite = "Wowonder";
$types = array(
  
	'Google',
    'Facebook',
    'Twitter',
    'Vkontakte'
	
);


if (isset($_GET['provider']) && in_array($_GET['provider'], $types)) {
    $provider = secure($_GET['provider']);
	
}

require_once('./assets/import/social-login/config.php');
require_once('./assets/import/social-login/autoload.php');

use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;


if (isset($_GET['provider']) && in_array($_GET['provider'], $types)) {
    try{
        $hybridauth   = new Hybridauth($config);
        $authProvider = $hybridauth->authenticate($provider);
        $tokens = $authProvider->getAccessToken();
        $user_profile = $authProvider->getUserProfile();
		$user_profile->displayName;
		
        if ($user_profile && isset($user_profile->identifier)) {
            $name = $user_profile->firstName . ' ' . $user_profile->lastName;
            if ($provider == 'Google') {
                $notfound_email     = 'go_';
                $notfound_email_com = '@google.com';
            } else if ($provider == 'Facebook') {
                $notfound_email     = 'fa_';
                $notfound_email_com = '@facebook.com';
            } else if ($provider == 'Twitter') {
                $notfound_email     = 'tw_';
                $notfound_email_com = '@twitter.com';
            }
			else if ($provider == 'Vkontakte') {
                $notfound_email     = 'vk_';
                $notfound_email_com = '@vk.com';
            }
            $user_name  = $notfound_email . $user_profile->identifier;
            $user_email = $user_name . $notfound_email_com;
            if (!empty($user_profile->email)) {
                $user_email = $user_profile->email;
            }
            if (UserEmailExists($user_email) === true) {
            	$db->where('email', $user_email);
                $login = $db->getOne(T_USERS);
                createUserSession($login->id);
                header("Location: $site_url");
                exit();
            } else {
                $str          = md5(microtime());
                $id           = substr($str, 0, 9);
                $password     = substr(md5(time()), 0, 9);
                $user_uniq_id = (empty($db->where('username', $id)->getValue(T_USERS, 'id'))) ? $id : 'u_' . $id;
                $social_url   = substr($user_profile->profileURL, strrpos($user_profile->profileURL, '/') + 1);
                $re_data      = array(
                    'username' => secure($user_uniq_id, 0),
                    'email' => secure($user_email, 0),
                    'password' => secure(sha1($password), 0),
                    'email_code' => secure(sha1($user_uniq_id), 0),
                    'first_name' => secure($name),
                    'src' => secure($provider),
                    'active' => '1'
                );
                $re_data['language'] = $ask->config->language;
                if (!empty($_SESSION['lang'])) {
                    if (in_array($_SESSION['lang'], $langs)) {
                        $re_data['language'] = $_SESSION['lang'];
                    }
                }
				
                if ($provider == 'Google') {
                    $re_data['about']  = secure($user_profile->description);
                    $re_data['google'] = secure($social_url);
                }
                if ($provider == 'Facebook') {
                    $fa_social_url       = @explode('/', $user_profile->profileURL);
                    $re_data['facebook'] = secure($fa_social_url[4]);
                    $re_data['gender'] = 'male';
                    if (!empty($user_profile->gender)) {
                        if ($user_profile->gender == 'male') {
                            $re_data['gender'] = 'male';
                        } else if ($user_profile->gender == 'female') {
                            $re_data['gender'] = 'female';
                        }
                    }
                }
                if ($provider == 'Twitter') {
                    $re_data['twitter'] = secure($social_url);
                }
	
				if ($provider == 'Vkontakte') {
                    $re_data['about'] = Secure($user_profile->description);
                    $re_data["id"]    = Secure($social_url);
                 
                }


				
                $insert_id = $db->insert(T_USERS, $re_data);
                if ($insert_id) {
	                $session_id          = sha1(rand(11111, 99999)) . time() . md5(microtime());
                $insert_data         = array(
                    'user_id' => $login->id,
                    'session_id' => $session_id,
                    'time' => time()
                );
                $insert              = $db->insert(T_SESSIONS, $insert_data);
	                header("Location: $site_url");
	                exit();
                } 
            }
        }
		
	} catch (Exception $e) {
        exit($e->getMessage());
        switch ($e->getCode()) {
            case 0:
                echo "Unspecified error.";
                break;
            case 1:
                echo "Hybridauth configuration error.";
                break;
            case 2:
                echo "Provider not properly configured.";
                break;
            case 3:
                echo "Unknown or disabled provider.";
                break;
            case 4:
                echo "Missing provider application credentials.";
                break;
            case 5:
                echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
                break;
            case 6:
                echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                break;
            case 7:
                echo "User not connected to the provider.";
                break;
            case 8:
                echo "Provider does not support this feature.";
                break;
        }
        echo " an error found while processing your request!";
        echo " <b><a href='" . UrlLink('') . "'>Try again<a></b>";
    }
}
    

		if (isset($_GET['code']) && !empty($_GET['code'])) {
		try {
    $app_id        = $ask->config->wowonder_app_ID;
    $app_secret    = $ask->config->wowonder_app_key;
    $wowonder_url  = $ask->config->wowonder_domain_uri;
    $code          = $_GET['code'];
    $url           = $wowonder_url . "/authorize?app_id={$app_id}&app_secret={$app_secret}&code={$code}";
    $get           = file_get_contents($url);
    $wo_json_reply = json_decode($get, true);
    $access_token  = '';
			
			
    if (is_array($wo_json_reply) && isset($wo_json_reply['access_token'])) {
        $access_token    = $wo_json_reply['access_token'];
        $type            = "get_user_data";
        $url             = $wowonder_url . "/api_request?access_token={$access_token}&type={$type}";
	
        $user_data_json  = file_get_contents($url);
        $user_data_array = json_decode($user_data_json, true);
        if (is_array($user_data_array) && !empty($user_data_array) && isset($user_data_array['user_data'])) {
            $user_data  = $user_data_array['user_data'];
            $user_email = $user_data['email'];
            if (UserEmailExists($user_email) === true) {
                $db->where('email', $user_email);
                $login               = $db->getOne(T_USERS);
                $session_id          = sha1(rand(11111, 99999)) . time() . md5(microtime());
                $insert_data         = array(
                    'user_id' => $login->id,
                    'session_id' => $session_id,
                    'time' => time()
                );
                $insert              = $db->insert(T_SESSIONS, $insert_data);
                $_SESSION['user_id'] = $session_id;
                setcookie("user_id", $session_id, time() + (10 * 365 * 24 * 60 * 60), "/");
                header("Location: $site_url");
                exit();
            } else {
                $str          = md5(microtime());
                $id           = substr($str, 0, 9);
                $user_uniq_id = (empty($db->where('username', $id)->getValue(T_USERS, 'id'))) ? $id : 'u_' . $id;
                $first_name   = (isset($user_data['first_name'])) ? Secure($user_data['first_name'], 0) : '';
                $last_name    = (isset($user_data['last_name'])) ? Secure($user_data['last_name'], 0) : '';
                $gender       = (isset($user_data['gender'])) ? Secure($user_data['gender'], 0) : 'male';
                $username     = (Secure($user_data['username']));
                $provider     = ($wowonder_url . "/{$username}");
                $re_data      = array(
                    'username' => Secure($user_uniq_id, 0),
                    'email' => Secure($user_email, 0),
                    'password' => Secure(sha1($user_email), 0),
                    'email_code' => Secure(md5($user_uniq_id), 0),
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'gender' => Secure($gender),
                    'active' => '1'
                );
              
                $insert_id = $db->insert(T_USERS, $re_data);
                if ($insert_id) {
                    $session_id          = sha1(rand(11111, 99999)) . time() . md5(microtime());
                    $insert_data         = array(
                        'user_id' => $insert_id,
                        'session_id' => $session_id,
                        'time' => time()
                    );
                    $insert              = $db->insert(T_SESSIONS, $insert_data);
                    $_SESSION['user_id'] = $session_id;
                    setcookie("user_id", $session_id, time() + (10 * 365 * 24 * 60 * 60), "/");
                    header("Location: $site_url");
                    exit();
                }
            }
        }
    }
} catch (Exception $e) {
        exit($e->getMessage());
        switch ($e->getCode()) {
            case 0:
                echo "Unspecified error.";
                break;
            case 1:
                echo "Hybridauth configuration error.";
                break;
            case 2:
                echo "Provider not properly configured.";
                break;
            case 3:
                echo "Unknown or disabled provider.";
                break;
            case 4:
                echo "Missing provider application credentials.";
                break;
            case 5:
                echo "Authentication failed The user has canceled the authentication or the provider refused the connection.";
                break;
            case 6:
                echo "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                break;
            case 7:
                echo "User not connected to the provider.";
                break;
            case 8:
                echo "Provider does not support this feature.";
                break;
        }
        echo " an error found while processing your request!";
        echo " <b><a href='" . UrlLink('') . "'>Try again<a></b>";
    }
	
	
}
 
 
	


{
    header("Location: " . UrlLink(''));
    exit();
}