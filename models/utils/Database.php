<?php
class Database {
    private string $host;
    private string $username;
    private string $password;
    private string $database;
    private PDO $conn;

    /**
     * Constructeur de la classe Database.
     *
     * @param string $host     L'hôte de la base de données (par exemple, "localhost").
     * @param string $username Le nom d'utilisateur de la base de données.
     * @param string $password Le mot de passe de la base de données.
     * @param string $database Le nom de la base de données.
     */
    public function __construct(string $host, string $username, string $password, string $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Exécute une requête SQL et retourne les résultats sous forme de tableau associatif.
     *
     * @param string $query La requête SQL à exécuter.
     * @param array $params Les paramètres à lier à la requête (facultatif).
     * @return Exception|PDOException Le résultat de la requête en tant que tableau associatif ou une chaîne d'erreur en cas d'erreur.
     */
    public function executeQuery(string $query, array $params = []): array|PDOException
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Enregistrez l'erreur ou renvoyez un message d'erreur explicite
            return $e;
        }
    }

    // ...
}
