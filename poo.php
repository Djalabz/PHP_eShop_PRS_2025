<?php 

// POO en PHP : Programmation orientée objet 

// Les noms des classes sont toujours en PascalCase (!= camelCase)


// 1 - Définition de la classe 
class User {
    // Ici ce sont les propriétes / attributs (en gros ce sont les variables propre à chaque User)
    public $name;
    public $email;
    public $age;

    public function __construct($nameParam, $emailParam, $ageParam) {
        $this->name = $nameParam;
        $this->email = $emailParam;
        $this->age = $ageParam;
    }
    
    // Ici ce sont mes méthodes (fonctions) propre à chaque User
    public function sayHello($param) {
        echo "Bonjour " . $param;
    }
}

// 2 - On vient générer des objets à partie de cette classe User. 
// Lorsque l'on génére un objet on parle d'instanciation
$john = new User("John", "email@email.mil", 32);
$Jane = new User("Jane", "lemail", 35);
$tim = new User("Tim", "email", 25);

$john->sayHello("le canard");

