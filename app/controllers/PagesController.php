<?php
//namespace App\Controllers;

use App\Core\App;
use app\models\User;

class PagesController
{

    public function home()
    {
        $a = $_GET;
        return view('index');

    }

    public function url_fix() {
        redirect(uri());
        exit();
    }

    public function fbCallback()
    {
        $error = '';

        $conf = App::get('config');
        $fb = new Facebook\Facebook($conf['fb']);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exception\ResponseException $e) {
            // When Graph returns an error
            $error .= 'Graph returned an error: ' . $e->getMessage();
            return view('fbCallback', compact('error'));
        } catch(Facebook\Exception\SDKException $e) {
            // When validation fails or other local issues
            $error .= 'Facebook SDK returned an error: ' . $e->getMessage();
            return view('fbCallback', compact('error'));
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                $error .= "Error: " . $helper->getError() . "\n";
                $error .= "Error Code: " . $helper->getErrorCode() . "\n";
                $error .= "Error Reason: " . $helper->getErrorReason() . "\n";
                $error .= "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                $error .= 'Bad request';
            }
            return view('fbCallback', compact('error'));
        }

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId($conf['fb']['app_id']);
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exception\SDKException $e) {
                $error .= "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                return view('fbCallback', compact('error'));
            }
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,email', $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            $error .= 'Graph returned an error: ' . $e->getMessage();
            return view('fbCallback', compact('error'));;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            $error .= 'Facebook SDK returned an error: ' . $e->getMessage();
            return view('fbCallback', compact('error'));;
        }
        
        $user = $response->getGraphUser();
        
        $userID = $user['id']; // Retrieve user Id
        $userName = $user['name']; // Retrieve user name
        $userEmail = $user['email']; // Retrieve user email

        $user = new User();
        $user_login = $user->userFBLogin($userID);

        if (count($user_login) === 0) {
            $userID = $user->registerFBUser($userID, $userName, $userEmail);
        } else if (count($user_login) === 1) {
            $userID = $user_login[0]->id;
        }

        $_SESSION['is_logged'] = true;
        $_SESSION['username'] = $userName;
        $_SESSION['user_id'] = $userID;
        // User is logged in with a long-lived access token.
        // You can redirect them to a members-only page.
        //header('Location: http://google.bg');
        redirect(uri());

    }

    public function important()
    {

        return view('important');

    }

    public function login()
    {
        if(User::isLogged()) {
            redirect(uri());
             exit();
        }
        return view('login');
    }

    public function signup()
    {

        return view('signup');

    }


    /**
     * @return mixed
     */
    public function departments()
    {
        $departments = App::get('database')->selectAll('departments');

        return view('documents', compact('departments'));

    }

    public function show($id)
    {
        $department = App::get('database')->selectOne('departments', $id);

        return view('documents', compact('department'));

    }

    public function about()
    {

        return view('about');

    }

    public function about_culture()
    {

        return view('about-culture');

    }

    public function contact()
    {
        $company = 'Laracasts';

        return view('contact',compact('company'));

    }

    public function test()
    {

        return view('test');

    }


}