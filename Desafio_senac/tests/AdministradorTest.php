<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

// Incluir as classes necessárias
require_once __DIR__ . '/../classes/Usuario.php';
require_once __DIR__ . '/../classes/Administrador.php';

final class AdministradorTest extends TestCase
{
    private $admin;
    
    protected function setUp(): void
    {
        $senhaHash = password_hash("Senha123", PASSWORD_DEFAULT);
        $this->admin = new Administrador(
            1,
            "Admin Teste",
            "admin@example.com",
            $senhaHash,
            "pt-br",
            "claro",
            2,
            ['criar', 'ler', 'atualizar']
        );
    }
    
    public function testConstrutorCriaAdminCorretamente(): void
    {
        $this->assertSame(1, $this->admin->getId());
        $this->assertSame("Admin Teste", $this->admin->getNome());
        $this->assertSame("admin@example.com", $this->admin->getEmail());
        $this->assertSame("pt-br", $this->admin->getIdioma());
        $this->assertSame("claro", $this->admin->getTema());
        $this->assertSame(2, $this->admin->getNivelAcesso());
        $this->assertSame(['criar', 'ler', 'atualizar'], $this->admin->getPermissoes());
    }
    
    public function testSetNivelAcessoComValorValido(): void
    {
        $this->admin->setNivelAcesso(3);
        $this->assertSame(3, $this->admin->getNivelAcesso());
    }
    
    public function testSetNivelAcessoComValorInvalido(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->admin->setNivelAcesso(4); // Deve lançar exceção, pois o nível deve ser entre 1 e 3
    }
    
    public function testSetPermissoesComValoresValidos(): void
    {
        $novasPermissoes = ['ler', 'atualizar', 'deletar'];
        $this->admin->setPermissoes($novasPermissoes);
        $this->assertSame($novasPermissoes, $this->admin->getPermissoes());
    }
    
    public function testSetPermissoesComValorInvalido(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->admin->setPermissoes(['ler', 'permissao_invalida']);
    }
    
    public function testTemPermissao(): void
    {
        $this->assertTrue($this->admin->temPermissao('criar'));
        $this->assertTrue($this->admin->temPermissao('ler'));
        $this->assertTrue($this->admin->temPermissao('atualizar'));
        $this->assertFalse($this->admin->temPermissao('deletar'));
    }
    
    public function testPromoverUsuarioComNivelInsuficiente(): void
    {
        $this->expectException(Exception::class);
        $usuario = new Usuario(2, "Usuário Teste", "usuario@example.com", "hash", "pt-br", "claro");
        $this->admin->promoverUsuario($usuario, 2); // Deve falhar pois o admin é nível 2
    }
    
    public function testPromoverUsuarioComNivelSuficiente(): void
    {
        $this->admin->setNivelAcesso(3); // Promover admin para nível 3
        $usuario = new Usuario(2, "Usuário Teste", "usuario@example.com", "hash", "pt-br", "claro");
        
        // Não deve lançar exceção
        $this->admin->promoverUsuario($usuario, 2);
        $this->assertTrue(true); // Se chegou aqui, o teste passou
    }
}