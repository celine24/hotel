<?php
class HotelManager
{
  private $_db; // Instance de PDO
  
  //constructeur
  public function __construct($db)
  {
    $this->setDb($db);
  }
  
  //pour sélectionner un hotel
  public function get($id)
  {
    // Si le paramètre est un entier, on veut récupérer l'hotel avec son identifiant
	if (is_int($id)) 
	{
      // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage
	  $q = $this->_db->query('SELECT id, name, adress, postcode, city_id, description, picture FROM hotels WHERE id=' .$id);
	  $result = $q->fetch(PDO::FETCH_ASSOC);
	  
	  return new Hotel($result);
	}
  }
  
  //pour obtenir la liste des hotels
  public function getList($nom)
  {
    // Retourne la liste des personnages dont le nom n'est pas $nom
	$persos = [];
    
    $q = $this->_db->prepare('SELECT id, nom, degats FROM personnage WHERE nom <> :nom ORDER BY nom');
    $q->execute([':nom' => $nom]);
    
    // Le résultat sera un tableau d'instances de Personnage
	while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($donnees);
    }
    
    return $persos;
  }
  
  //ceci est un setter pour pouvoir modifier l'attribut $_db. La création d'un constructeur est aussi indispensable si nous voulons assigner à cet attribut un objet PDO dès l'instanciation du manager.
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}