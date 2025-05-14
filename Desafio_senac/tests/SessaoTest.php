<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../vendor/autoload.php';

final class SessaoTest extends TestCase
{
    private $sessao;
    
    protected function setUp(): void
    {
        // Garantir que não há sessão ativa antes de cada teste
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        
        // Iniciar a sessão com um ID de teste para evitar conflitos
        $this->sessao = new Sessao();
    }
    
    protected function tearDown(): void
    {
        // Limpar a sessão após cada teste
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
    
    public function testIniciarSessao(): void
    {
        // Encerrar a sessão atual para testar iniciarSessao
        $this->sessao->encerrarSessao();
        
        // Testar com parâmetros personalizados
        $cookieParams = [
            'secure' => true,
            'httponly' => true
        ];
        
        $this->sessao->iniciarSessao($cookieParams);
        $this->assertEquals(PHP_SESSION_ACTIVE, session_status());
    }
    
    public function testIniciarSessaoJaIniciada(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Sessão já iniciada');
        
        // Tentar iniciar uma sessão quando já existe uma
        $this->sessao->iniciarSessao();
    }
    
    public function testEncerrarSessao(): void
    {
        $this->sessao->encerrarSessao();
        $this->assertEquals(PHP_SESSION_NONE, session_status());
    }
    
    public function testEncerrarSessaoNaoIniciada(): void
    {
        // Encerrar a sessão primeiro
        $this->sessao->encerrarSessao();
        
        // Tentar encerrar novamente deve lançar exceção
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Sessão não iniciada');
        $this->sessao->encerrarSessao();
    }
    
    public function testFlashMessages(): void
    {
        // Adicionar mensagens flash
        $this->sessao->setFlashMessage('Mensagem 1');
        $this->sessao->setFlashMessage('Mensagem 2');
        
        // Verificar se as mensagens foram recuperadas corretamente
        $messages = $this->sessao->getFlashMessages();
        $this->assertCount(2, $messages);
        $this->assertEquals('Mensagem 1', $messages[0]);
        $this->assertEquals('Mensagem 2', $messages[1]);
        
        // Verificar se as mensagens foram removidas após leitura
        $messagesAfter = $this->sessao->getFlashMessages();
        $this->assertEmpty($messagesAfter);
    }
}