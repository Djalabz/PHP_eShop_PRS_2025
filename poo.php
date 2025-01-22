<?php 

// POO en PHP : Programmation orientée objet 

// Les noms des classes sont toujours en PascalCase (!= camelCase)

// 1 - Définition de la classe, c'est le "moule" qui va permettre de créér des objets de type User
// Chaque user crée aura les propriétés définies dans la classe ainsi que les méthodes.
class User {
    // Ici ce sont les propriétes / attributs (en gros ce sont les variables propre à chaque User)
    public $name;
    public $email;
    public $age;

    // Avec la fonction de type construct (qui s'éxecute automatiquement lors de l'instanciation de la classe)
    // on explicite les infos à donner en paramètre lors de l'instanciation et on les lie 
    // aux propriétés dèjà présentes dans la classe
    public function __construct($nameParam, $emailParam, $ageParam) {
        // Le $this fait référence à l'objet en cours, dès qu'on utilise une propriété 
        // ou une méthode définie au sein de la classe on mettra devant celle-ci $this
        $this->name = $nameParam;
        $this->email = $emailParam;
        $this->age = $ageParam;
    }
    
    // Ici ce sont mes méthodes (fonctions) propre à chaque User
    public function sayHello($param) {
        echo "Bonjour " . $param . " vous avez " . $this->age;
    }
}

// 2 - On vient générer des objets à partie de cette classe User. 
// Lorsque l'on génére un objet on parle d'instanciation
$john = new User("John", "email@email.mil", 32);
$Jane = new User("Jane", "lemail", 35);
$tim = new User("Tim", "email", 25);

$john->sayHello("le canard");

class Admin extends User {
    // Ici ma classe Admin pourra hériter des propriétés et méthodes de User (si elles sont public ou protected)
}