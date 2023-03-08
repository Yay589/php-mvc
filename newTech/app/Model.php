<?php
abstract class Model
{
    // Informations de la base de données
    private $host = "localhost";
    private $db_name = "blog";
    private $username = "root";
    private $password = "orange";
    // Propriété qui contiendra l'instance de la connexion
    protected $_connexion;

    // Propriétés permettant de personnaliser les requêtes
    public $table="posts";
    public $id;

    /**
     * Fonction d'initialisation de la base de données
     *
     * @return void
     */
    public function getConnection()
    {
        // On supprime la connexion précédente
        $this->_connexion = null;

        // On essaie de se connecter à la base
        try {
            $this->_connexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->_connexion->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    /**
     * Méthode permettant d'obtenir un enregistrement de la table choisie en fonction d'un id
     *
     * @return void
     */
    public function read_single()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $post = $query->fetch();

        $list[] =  new Post($post['id'], $post['user_id'], $post['title'], $post['slug'], $post['body'], $post['published']);
        //var_dump($list);
        return $list;
    }

    /**
     * Méthode permettant d'obtenir tous les enregistrements de la table choisie
     *
     * @return void
     */
    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        echo " flag: sql";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function getOne()
    {
        $sql = "SELECT * FROM " . $this->table . "where id=" . $this->id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
/*
$m = new Model();
$m->getConnection();
var_dump($m->getAll());
*/
?>
