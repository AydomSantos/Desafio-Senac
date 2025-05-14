<?php
class Administrador extends Usuario {
    private $nivelAcesso;
    private $permissoes;

    public function __construct(
        $id,
        $nome,
        $email,
        $senhaHash,
        $idioma,
        $tema,
        $nivelAcesso = 1,
        $permissoes = []
    ) {
        parent::__construct($id, $nome, $email, $senhaHash, $idioma, $tema);
        $this->setNivelAcesso($nivelAcesso);
        $this->setPermissoes($permissoes);
    }

    // --- Getters ---
    public function getNivelAcesso(): int {
        return $this->nivelAcesso;
    }

    public function getPermissoes(): array {
        return $this->permissoes;
    }

    // --- Setters ---
    public function setNivelAcesso(int $nivel): void {
        if ($nivel < 1 || $nivel > 3) {
            throw new InvalidArgumentException("Nível de acesso deve ser entre 1 e 3");
        }
        $this->nivelAcesso = $nivel;
    }

    public function setPermissoes(array $permissoes): void {
        $permissoesValidas = ['criar', 'ler', 'atualizar', 'deletar', 'gerenciar_usuarios'];
        foreach ($permissoes as $permissao) {
            if (!in_array($permissao, $permissoesValidas)) {
                throw new InvalidArgumentException("Permissão inválida: " . $permissao);
            }
        }
        $this->permissoes = $permissoes;
    }

    // --- Métodos específicos do Administrador ---
    public function temPermissao(string $permissao): bool {
        return in_array($permissao, $this->permissoes);
    }

    public function promoverUsuario(Usuario $usuario, int $nivel): void {
        if ($this->nivelAcesso < 3) {
            throw new Exception("Apenas administradores de nível 3 podem promover usuários");
        }
        // Lógica para promover usuário
    }

    public function exibirPerfil(): void {
        parent::exibirPerfil();
        echo "Nível de Acesso: " . $this->nivelAcesso . "<br>";
        echo "Permissões: " . implode(", ", $this->permissoes) . "<br>";
    }
}