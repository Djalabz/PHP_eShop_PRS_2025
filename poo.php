<?php 

// POO en PHP : Programmation orientée objet 

// Les noms des classes sont toujours en PascalCase (!= camelCase)

// 1 - Définition de la classe, c'est le "moule" qui va permettre de créér des objets de type User
// Chaque user crée aura les propriétés définies dans la classe ainsi que les méthodes.
class User {
    // Ici ce sont les propriétes / attributs (en gros ce sont les variables propre à chaque User)
    // On précise devant les variables les portées qui vont déterminer les endroits ou on peut accéder à ces variables
    // public : on accède aux propriétés dans la classe, en dehors de celle-ci et au sein des enfants 
    // proptected : on accède aux propriétés dans la classe, au sein des enfant mais PAS EN DEHORS
    // private : On a accès aux propriétés seulement dans la Classe 
    private $name;
    private $email;
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

// echo $john->email; 


class Animal {
    // Propriétés (variables)
    public $type;
    public $age;
    public $color;


    public function __construct($typeParam, $ageParam, $colorParam) {
        $this->type = $typeParam;
        $this->age = $ageParam;
        $this->color = $colorParam;
    }

    // Méthodes (fonctions)
    public function eat() {
        echo "Le $this->type mange";
    }
}

// Avec new j'instancie la classe cad je crée un objet
$cat = new Animal("chat", 8, "orange");
$dog = new Animal("chien", 10, "noir");

echo "<br>";
echo $cat->color;
echo "<br>";
$cat->eat();



// La classe Mammal (mammifère) a pour parent la classe Animals
class Mammals extends Animal {

} 