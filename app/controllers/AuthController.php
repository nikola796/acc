<?php

namespace app\controllers;


use App\Core\App;
use app\models\User;
use Connection;
use DateTime;
use StoPasswordReset;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class AuthController
{

    /**
     * USER LOGIN
     */
    public function login()
    {

        if (isset($_SESSION['username']) && $_SESSION['username'] == $_POST['username']) {
            echo 'Logged';
            // redirect('admin/home');
        } else {
            $user = new User();
            $user_login = $user->userLogin();
            $user_access_folders = $user->getUserAccess($user_login[0]->id);

            foreach ($user_access_folders as $uaf) {
                $ua[] = $uaf->folder_id;
            }

            if (count($user_login) == 1) {
                if ($user_login[0]->active == 1) {
                    $_SESSION['is_logged'] = true;
                    $_SESSION['username'] = $user_login[0]->name;
                    $_SESSION['user_id'] = $user_login[0]->id;
                    $_SESSION['department'] = $user_login[0]->department;
                    $_SESSION['section'] = $user_login[0]->section;
                    $_SESSION['role'] = $user_login[0]->role;
                    $_SESSION['access'] = $ua;
                    // var_dump( $_SESSION['is_logged']);
                    //echo '<pre>' . print_r($_SESSION, true) . '</pre>';die();
                    echo 'Logged';
                } else {
                    echo 'Вашият профил е деактивиран. Моля обърнете се към супурвайзор на системата';
                }


            } else {
                echo 'Подадената от Вас комбинация потребител-парола не е открита';
            }
        }


        //redirect(uri());

    }

    /**
     * USER LOGOUT
     */
    public function logout()
    {

        session_destroy();
        redirect(uri());
    }

    /**
     * START SESSION
     */
    public function session_start()
    {
        if (!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] != 1) {
            redirect(uri());
            exit();
        }

    }

    /**
     * FORGOT PASSWORD. PREPARE TOKEN AND SEND MAIL TO USER.
     */
    public function forgot_password()
    {
        $user_email = array('email' => $_POST['email']);
        $user = new User();
        $is_user_pass_exist = $user->check_password($user_email);

        if (isset($is_user_pass_exist[0]['id']) && $is_user_pass_exist[0]['id'] > 0) {
            // Generate a new token with its hash
            StoPasswordReset::generateToken($tokenForLink, $tokenHashForDatabase);

            //echo '<pre>' . print_r($creationDate, true) . '</pre>';die();
            $user->savePasswordResetToDatabase($tokenHashForDatabase, $is_user_pass_exist[0]['id'], $is_user_pass_exist[0]['email']);

            // Send link with the original token
            $emailLink = 'Направена е заявка за промяна на Вашата парола. От линка по-долу може да промените паролата си. 
В случай, че не сте направили заявка игнорирайте това съобщение!
Линк за възстановяване: ' . url() . 'reset_password?' . $tokenForLink;
            $res = $this->send_recover_mail($user_email, $emailLink);
            if (intval($res) > 0) {
                echo 'На посочения от Вас имейл бе изпратен код за възстановяване. Кодът ще е активен през следващите 8 часа!';
            } else {
                echo 'Възникна проблем при възстановяването на Вашата парола. Моля опитайте по-късно.';
            }
        } else {
            echo 'Посочената от Вас поща не е открита!';
        }
    }

    /**
     * RESET USER PASSWORD
     * @param $tok
     * @return mixed
     */
    public function reset_password($tok)
    {

        // Validate the token
        if (!isset($tok) || !StoPasswordReset::isTokenValid($tok)) {
            $response = 'The token is invalid.';
        }

        // Search for the token hash in the database, retrieve UserId and creation date
        $tokenHashFromLink = StoPasswordReset::calculateTokenHash($tok);
        $user = new User();


        if (!$user->loadPasswordResetFromDatabase($tokenHashFromLink, $userId, $creationDate)) {
            $response = 'The token does not exist or has already been used.';
        }

        // Check whether the token has expired
        if (StoPasswordReset::isTokenExpired($creationDate)) {
            $response = 'The token has expired.';
        }

        $user->letUserChangePassword($userId);

        return view('reset_password', compact('response', 'userId'));

    }


    /**
     * SEND PASSWORD RECOVER MAIL TO USER
     * @param $mail
     * @param $text
     * @return int
     */
    private function send_recover_mail($mail, $text)
    {

        require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

// Create the Transport
        $transport = Swift_SmtpTransport::newInstance('10.30.128.15', 25)
            ->setUsername(MAIL_USER)
            ->setPassword(MAIL_PASS);

        /*
        You could alternatively use a different transport such as Sendmail:

        // Sendmail
        $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
        */

// Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

// Create a message

        $message = Swift_Message::newInstance('Възстановяване на парола')
            ->setFrom(array('intranet@customs.bg' => 'Интранет'))
            ->setTo(array($mail['email'], 'vladislav.andreev@customs.bg', 'tsenka.koleva@customs.bg'))
            ->setBody($text);

// Send the message
        $result = $mailer->send($message);
        return $result;
    }

}