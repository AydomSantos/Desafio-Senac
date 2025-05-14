<?php
class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $idioma;
    private $tema;

    function __construct($id, $nome, $senha, $email, $idioma, $tema)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->$email->setEmail($email);
        $this->$senha->setSenha($senha);
        $this->idioma = $idioma;
        $this->tema = $tema;
    }

    function getId()
    {
        return $this->id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getIdioma()
    {
        return $this->idioma;
    }

    function getTema()
    {
        return $this->tema;
    }

    function setNome($nome)
    {
        try {
            if (strlen($nome) < 3) {
                throw new Exception("Nome inválido");
            } else {
                $this->nome = $nome;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    function setEmail($email)
    {
        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email inválido");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    function setSenha($senha)
    {
        try {
            if (strlen($senha) < 6) {
                throw new Exception("Senha inválida");
            } else {
                $this->$senha = $senha;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    function setIdioma($idioma)
    {
        try {
            if ($idioma != "pt" && $idioma != "en") {
                throw new Exception("Idioma inválido");
            } else {
                $this->idioma = $idioma;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    function setTema($tema)
    {
        try {
            if ($tema != "claro" && $tema != "escuro") {
                throw new Exception("Tema inválido");
            } else {
                $this->tema = $tema;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    function exibirPerfil()
    {
        return sprintf(
            "ID: %s<br>Nome: %s<br>Email: %s<br>Idioma: %s<br>Tema: %s",
            $this->id ?? 'N/D',
            htmlspecialchars($this->nome),
            htmlspecialchars($this->email),
            htmlspecialchars($this->idioma),
            htmlspecialchars($this->tema)
        );
    }

    function atualizarPreferencia($preferencia)
    {
        try {
            $atualizar = false;
            if ($preferencia == "idioma") {
                $this->idioma = $_POST['idioma'];
                $atualizar = true;
            } else if ($preferencia == "tema") {
                $this->tema = $_POST['tema'];
                $atualizar = true;
            }
            return $atualizar;
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    function verificarSenha($senhaPura)
    {
        try {
            if (password_verify($senhaPura, $this->senha)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}

?>

