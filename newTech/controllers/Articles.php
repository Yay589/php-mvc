<?php
//use App\Controller;
//require_once("../app/Controller.php");

class Articles extends Controller
{   
    public function index()
    {
        echo "<h1>Bienvenu sur l'acceuil</h1>";
        $this->loadModel('Article');
        echo "hello2";
        $articles = $this->Article->getAll(); //comptien toutes les données
        var_dump($articles);//pour le débogage//a la base:"var_dump($articles);"
        //sous forme d'un tableu assiciatif ['keys'=>valeur]
        $this->render('index', ['articles' => $articles]); //le controleeur dispose d'une varible articles 

    }
    public function searchBySlug($slug){
        $this->loadModel("Article");
        $article=$this->Article->findBySlug($slug);
        var_dump($article);
        $this->render('slug', ['article' => $article]);
    }
}

/*
$m = new Articles();
var_dump($m->index());
*/
?>