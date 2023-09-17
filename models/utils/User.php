<?php
/**
 * Classe représentant un utilisateur.
 *
 * @version 1.0
 * @license MIT
 */
class User {
    private string $username;
    private string $password;

    /**
     * Constructeur de la classe User.
     *
     * @param string $username Le nom d'utilisateur de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     */
    public function __construct(string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Obtient le nom d'utilisateur de l'utilisateur.
     *
     * @return string Le nom d'utilisateur.
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Définit le nom d'utilisateur de l'utilisateur.
     *
     * @param string $username Le nouveau nom d'utilisateur.
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Obtient le mot de passe de l'utilisateur.
     *
     * @return string Le mot de passe.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Définit le mot de passe de l'utilisateur.
     *
     * @param string $password Le nouveau mot de passe.
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
