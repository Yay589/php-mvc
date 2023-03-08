<?php
//but controler :charger le model et la vue
//namespace App;
abstract class Controller
{
    /**
     * Permet de charger un modèle
     *
     * @param string $model
     * @return void
     */
    public function loadModel(string $model){
        echo "hey";
        // On va chercher le fichier correspondant au modèle souhaité
        require_once('../models/' . $model . '.php'); //Root une cte(lgn 2 dans index.php)//chage la def de la classe article $model="Article"

        // On crée une instance de ce modèle. Ainsi "Post" sera accessible par $this->Post
        $this->$model = new $model();
    }
    /**
     * Afficher une vue
     *
     * @param string $vue
     * @param array $data
     * @return void
     */
    public function render(string $vue, array $data = []) //data les donner a passer a la vue. $vue:nom de la vue
    {
        ////echo "<h1>*****render*******</h1>";
        //var dump($data)
        // Récupère les données et les extrait sous forme de variables
        if (! empty($data))extract($data); ///extraite, le tableau de donné s'appelera article.

        // On démarre le buffer de sortie
        ob_start();
        // Crée le chemin et inclut le fichier de vue => charge le vue. Attention: tout ce qui est avant requireonce peut être accessible à l'objet chargé !!!!!!!
        require_once('../views/' . strtolower(get_class($this)) . '/' . $vue . '.php'); //$this designe le controler articles qui a été instancié
        // On stocke le contenu dans $content
        $content = ob_get_clean();

        // On fabrique le "template"
        require_once(ROOT . 'views/layouts/default.php');
    }
}
/*
$m= new Controller();
$m->loadModel("Article");
var_dump($m->Article->getAll());
*/
?>
