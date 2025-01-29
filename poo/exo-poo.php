<?php 

// EXO POO

// 1) Créer une classe User avec les propriétés suivantes : 

//      - username / string / public
//      - email / string / private 
//      - age / int / public 
//      - password / string / private 
//      - loggedIn / boolean / public et aura pour valeur initiale false
// 
// 
// 2) Il y aura dans cette classe un constructor pour toutes les propriétés qui 'n'ont pas de valeurs par défaut 

// 3) On aura également une méthode public dans cette classe login() et qui viendra vérifie la valeur de la propriété
// loggedIn Si cette prop est égale à false alors on login le user en la passant à true et en affichant un message du 
// type "XXXX est maintenant login". Si la prop est déjà égale à true on affiche juste un message qui dira 
// "XXXX est déjà connecté"

// 4) Dans cette meme logique coder la fonction logout, meme principe que login mais avec logout

// BONUS : Trouver un moyen d'accéder au et de modifier l'email en dehors de la classe sans changer sa portée (private)


class User {

    // Déclaration de mes propriétés 
    public string $username;
    private string $email;
    public int $age;
    private string $password;
    public bool $loggedIn = false;

    // Fonction de type constructor 
    public function __construct(string $username, string $email, int $age, string $password) {
        $this->username = $username;
        $this->email = $email;
        $this->age = $age;
        $this->password = $password;
    }

    public function login() : string {
        if ($this->loggedIn) {
            return  "$this->username est déjà connecté";

        } else {
            $this->loggedIn = true; 
            return "$this->username est maintenant connecté";
        }
    }

    public function logout() : string {
        if ($this->loggedIn) {

            $this->loggedIn = false;
            return  "$this->username est maintenant logout";

        } else {

            return "$this->username est déjà logout";
        }
    }

    // Cette fonction est ce que l'on appelle un getter cad une fonction 
    // qui permet d'accéder et afficher une propriété de portée private 
    public function getEmail() : string {
        return $this->email;
    }

    // Cette fonction est de type Setter cad elle permet de changer la valeur 
    // d'une propriété de portée private en dehors de la classe
    public function setEmail($newEmail) : void {
        $this->email = $newEmail;
    }
}

// Je crée un nouveau user John (qui est donc un objet)
$john = new User("John", "john@wanadoo.fr", 40, "12345"); 

// J'appelle la méthode login définie dans la classe User
echo $john->login();
echo "<br>";
echo $john->loggedIn;


?>