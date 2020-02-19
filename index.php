<?php
// session_start();
error_reporting(E_ALL & ~E_NOTICE);

include 'get_setting.php';

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

/* Global constants */
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('APP_PATH', dirname(ROOT_PATH).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR);
define('ASSETS_PATH', ROOT_PATH.DIRECTORY_SEPARATOR);

// Register Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Register Swiftmailer
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

// Register URL Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register Validator
$app->register(new Silex\Provider\ValidatorServiceProvider());

// $app->before(function (Request $request) {
//     $url = $_SERVER['REQUEST_URI'];
//     $str_url = '';
//     if($url != '/sitondi/'){
//         $exp1 = explode('/', $url);
//         $str_url = $exp1[2];
//     }

// });
// $app["twig"]->addGlobal("url_redirect_language", $str_url);
$youtube_ids = 'rIyEN_rimz4';
$app["twig"]->addGlobal("youtube_id", $youtube_ids);

$app['set_category_refALl'] = $set_CategoryRef;
$app["twig"]->addGlobal("set_category_refALl", $set_CategoryRef);

$app['set_References'] = $set_References;
$app["twig"]->addGlobal("set_References", $set_References);

// $app->before(function (Request $request) use ($app) {
    //     if (!isset($_GET['lang'])) {
    //         return $app->redirect($app['url_generator']->generate('homepage').'?lang=en');
    //     }

    //     $app['twig']->addGlobal('lang_active', $_GET['lang']);

    //     $urls = $_SERVER['REQUEST_URI'];
    //     $urls = substr($urls, 0, -8);
    //     $app['twig']->addGlobal('current_page_name', $urls);

    //     // call text dual language
    //     $lang_message = array();
    //     if (isset($_GET['lang'])) {
    //         if ($_GET['lang'] == 'id') {
    //             $lang_message = include('lang/id/app.php');
    //         } else {
    //             $lang_message = include('lang/en/app.php');
    //         }
    //     }

    //     $app["twig"]->addGlobal("lang_message", $lang_message);
    // });

// ------------------ Homepage ------------------------
$app->get('/', function () use ($app) {
	return $app['twig']->render('page/home.twig', array(
        'layout' => 'layouts/column1.twig',
        // 'benefits' => $app['data_benefits'],
    ));
})
->bind('homepage');

// ------------------ About ------------------
$app->get('/about', function () use ($app) {

    return $app['twig']->render('page/about.twig', array(
        'layout' => 'layouts/inside.twig',
    ));
})
->bind('about');

// ------------------ Machine ------------------
$app->get('/machine', function () use ($app) {

    return $app['twig']->render('page/machine.twig', array(
        'layout' => 'layouts/inside.twig',
    ));
})
->bind('machine');

// ------------------ About ------------------
$app->get('/machine_detail', function () use ($app) {

    return $app['twig']->render('page/machine_detail.twig', array(
        'layout' => 'layouts/inside.twig',
    ));
})
->bind('machine_detail');

// ------------------ contact ---------------------------------
$app->match('/contact', function (Request $request) use ($app) {

    $data = $request->get('Contact');
    if ($data == null) {
        $data = array(
            'name'=>'',
            'company'=>'',
            'email'=>'',
            'phone'=>'',
            'address'=>'',
            'message'=>'',
        );
    }

    if ($_POST) {
        
        $constraint = new Assert\Collection( array(
            'name' => new Assert\NotBlank(),
            'company' => new Assert\Length(array('max'=>2000)),
            'email' => array(new Assert\Email(), new Assert\NotBlank()),
            'phone' => new Assert\Length(array('max'=>2000)),
            // 'address' => new Assert\Length(array('max'=>2000)),
            'message' => new Assert\Length(array('max'=>2000)),
        ) );

        $errors = $app['validator']->validateValue($data, $constraint);
        $errorMessage = array();

         if (!isset($_POST['g-recaptcha-response'])) {
            $errorMessage[] = 'Please Check Captcha for sending contact form!';
        }
        
        $secret_key = "6LdcbVEUAAAAAF6pXw_VvjyEktZxIUgaFntD6DzT";
        $url= "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR'];

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if($response->success==false)
        {
            $errorMessage[] = 'Please Check Captcha for sending contact form!';
        }
        // else {

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $errorMessage[] = $error->getPropertyPath().' '.$error->getMessage();
            }
        }

        if (count($errorMessage) == 0) {
            // $app['swiftmailer.options'] = array(
            //         'host' => 'mail.puspetindo.com',
            //         'port' => '587',
            //         'username' => 'no-reply@puspetindo.com',
            //         'password' => 'V?#gNBE&IW6s',
            //         'encryption' => null,
            //         'auth_mode' => login
            //     );

            $pesan = \Swift_Message::newInstance()
                ->setSubject('Hi, Contact Website PT. Puspetindo')
                ->setFrom(array('no-reply@puspetindo.com'))
                ->setTo( array('info@puspetindo.com', $data['email']) )
                ->setBcc( array('deoryzpandu@gmail.com', 'ibnu@markdesign.net') )
                ->setReplyTo(array('info@puspetindo.com'))
                ->setBody($app['twig']->render('page/mail.twig', array(
                    'data' => $data,
                )), 'text/html');

            $app['mailer']->send($pesan);

            return $app->redirect($app['url_generator']->generate('contact').'?msg=success&lang=en');
        }

        // }
        // else captcha
    }

    return $app['twig']->render('page/contactus.twig', array(
        'layout' => 'layouts/inside.twig',
        'error' => $errorMessage,
        'data' => $data,
        'msg' =>$_GET['msg'],
    ));
})
->bind('contact');


// ------------------ newsletter ------------------
$app->post('/newsletter', function (Request $request) use ($app) {
    
    $data = $request->get('Newsl');
    if ($data == null) {
        $data = array(
            'name' => '',
            'email' => '',
        );
    }

   $pesan = \Swift_Message::newInstance()
                ->setSubject('Hi, Newsletter Website PT. Banyuwangi Cannery Indonesia')
                ->setFrom(array('no-reply@pasificharvest.com'))
                ->setTo( array('info@pasificharvest.com', $data['email']) )
                ->setBcc( array('deoryzpandu@gmail.com', 'ibnudrift@gmail.com') )
                ->setReplyTo(array('no-reply@pasificharvest.com'))
                ->setBody($app['twig']->render('page/reserve_mail.twig', array(
                    'data' => $data,
                )), 'text/html');

    $app['mailer']->send($pesan);

    return $app->redirect($app['url_generator']->generate('homepage').'?msg=success_reseve');
})
->bind('newsletter');


$app['debug'] = true;

$app->run();