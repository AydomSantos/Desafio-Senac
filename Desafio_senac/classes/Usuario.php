<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senhaHash;
    private $idioma;
    private $tema;

    public function __construct($id, $nome, $email, $senhaHash, $idioma, $tema)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->setEmail($email);
        $this->setSenhaHash($senhaHash);
        $this->idioma = $idioma;
        $this->tema = $tema;
    }

    // --- Getters ---
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        try{
            return $this->nome;
        }catch(Exception $e){
            echo "Erro ao obter o nome: " . $e->getMessage();
        }
    }

    public function getEmail()
    {
        try{
            return $this->email;
        }catch(Exception $e){
            echo "Erro ao obter o email: " . $e->getMessage();
        }
    }

    public function getSenhaHash()
    {
        try{
            return $this->senhaHash;
        }catch(Exception $e){
            echo "Erro ao obter a senha: " . $e->getMessage();
        }
    }

    public function getIdioma()
    {
        try{
            return $this->idioma;
        }catch(Exception $e){
            echo "Erro ao obter o idioma: " . $e->getMessage();
        }
    }

    public function getTema()
    {
        try{
            return $this->tema;
        }catch(Exception $e){
            echo "Erro ao obter o tema: " . $e->getMessage();
        }
    }

    // --- Setters ---
    public function setId($id)
    {
        if($this->id !== null && $this->id !== $id){
            throw new Exception("O ID do usuário não pode ser alterado.");
        }
        $this->id = $id;
    }

    public function setNome($nome)
    {
         if (empty(trim($nome))) {
            throw new InvalidArgumentException("O nome não pode ser vazio.");
        }
        $this->nome = $nome;
    }

    public function setEmail($email)
    {
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("O email informado é inválido.");
        }
        $this->email = $email;
    }

    public function setSenhaHash($senhaHash)
    {
        if (empty(trim($senhaHash))) {
            throw new InvalidArgumentException("A senha não pode ser vazia.");
        }
        $this->senhaHash = $senhaHash;
    }

    public function setIdioma($idioma){
        if(empty(trim($idioma))){
            throw new InvalidArgumentException("O idioma não pode ser vazio.");
        }
        $this->idioma = $idioma;
    }

    public function setTema($tema){
        $temasValidos = ["claro", "escuro"];
        if(!in_array($tema, $temasValidos)){
            throw new InvalidArgumentException("O tema informado é inválido.");
        }
        $this->tema = $tema;
    }

    // Metodos de Comportamento
    public function autenticar($senha){
        return password_verify($senha, $this->senhaHash);
    }

    public function exibirPerfil(){
        echo "Nome: " . $this->nome . "<br>";
        echo "Email: " . $this->email . "<br>";
        echo "Idioma: " . $this->idioma . "<br>";
        echo "Tema: " . $this->tema . "<br>";
    }

    public function atualizarPreferencias(array $preferencias){
        $atualizado = false;
        if(isset($preferencias['tema'])){
            $this->setTema($preferencias['tema']);
            $atualizado = true;
        }

        if(isset($preferencias['idioma'])){
            $this->setIdioma($preferencias['idioma']);
            $atualizado = true;
        }

        return $atualizado;
    }
}
?>