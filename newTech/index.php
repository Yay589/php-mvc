<?php
//Pour vérifier les retour d'erreurs :tail /var/log/apache2/error.log

//mvc.fr/index.php?a=10&b=20

session_start();
/*
$_SESSION['counter']++;
echo $_SESSION['counter'];//compteur d'actualisation
$arr=['Fraise' => 5, 'Orange'=> 4 ];
$_SESSION['panier']=$arr;
echo 'prix Fraises :';
echo $_SESSION['panier']['Fraise'];
*/

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
require_once(ROOT . 'app/Controller.php');
require_once(ROOT . 'app/Model.php');
//var_dump($_GET);

/*$a=$_GET['a']; //la valeur de a et b est donné dans la requette url
echo $a;*/

//ce qu'on veut : http://mvc.fr/index.phh/articles/show/1  :show, edit(pour modif), detele sont des methodes 

echo $_GET['p'];

$params = explode("/", $_GET['p']);
//var_dump($params);


if ($params[0] != "") {
    // =>> regle pour reécrire l'url qui se touve dans .htacces(activer avec : sudo a2enmod rewrite et redémarer !)
    $controller = ucfirst($params[0]);
    echo "<h1>controller= $controller</h1>";
    $action = (isset($params[1])) ? $params[1] : "index";
    echo "<h1>action= $action</h1>";
    require_once(ROOT . 'controllers/' . $controller . '.php');
    $controller = new $controller();
    if (method_exists($controller, $action)) {
        unset($params[0]);
        unset($params[1]);
        call_user_func_array([$controller, $action], $params);
        echo "hello";
        $controller->$action();
    } else {
        http_response_code(40);
        echo "la page demandée n'existe pas";
    }
}


session_destroy();
?>
