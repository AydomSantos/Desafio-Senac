<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\IgnoreDeprecations;
final class UsuarioTest extends TestCase
{
    private $usuario;
    
    protected function setUp(): void
    {
        $senhaHash = password_hash("Senha123", PASSWORD_DEFAULT);
        $this->usuario = new Usuario(
            1,
            "Teste Usuario",
            "teste@example.com",
            $senhaHash,
            "pt-br",
            "claro"
        );
    }
    
    public function testConstrutorCriaUsuarioCorretamente(): void
    {
        $this->assertSame(1, $this->usuario->getId());
        $this->assertSame("Teste Usuario", $this->usuario->getNome());
        $this->assertSame("teste@example.com", $this->usuario->getEmail());
        $this->assertSame("pt-br", $this->usuario->getIdioma());
        $this->assertSame("claro", $this->usuario->getTema());
    }
    
    public function testAutenticacaoComSenhaCorreta(): void
    {
        $this->assertTrue($this->usuario->autenticar("Senha123"));
    }
    
    public function testAutenticacaoComSenhaIncorreta(): void
    {
        $this->assertFalse($this->usuario->autenticar("SenhaErrada"));
    }
    
    public function testAtualizacaoDePreferencias(): void
    {
        $resultado = $this->usuario->atualizarPreferencias([
            'idioma' => 'en',
            'tema' => 'escuro'
        ]);
        
        $this->assertTrue($resultado);
        $this->assertSame('en', $this->usuario->getIdioma());
        $this->assertSame('escuro', $this->usuario->getTema());
    }
    
    public function testSetEmailComEmailInvalido(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->usuario->setEmail("email-invalido");
    }
    
    public function testSetTemaComTemaInvalido(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->usuario->setTema("tema-invalido");
    }
}
