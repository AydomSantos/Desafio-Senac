<?php
class Sessao {
    private const FLASH_KEY = 'flash_messages';

    private array $cookieParams = [
        'expires' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => false,
        'samesite' => 'Lax',
    ];
    public function __construct($cookieParams = []) {
       $this->cookieParams = array_merge($this->cookieParams, $cookieParams);
       if(session_status() === PHP_SESSION_NONE){
        session_set_cookie_params($this->cookieParams);
        session_start();
       }else{
        throw new Exception('Sessão já iniciada');
       }
    }

    public function iniciarSessao($cookieParams = []){
        $this->cookieParams = array_merge($this->cookieParams, $cookieParams);
        if(session_status() === PHP_SESSION_NONE){
            session_set_cookie_params($this->cookieParams);
            session_start();
        }else{
            throw new Exception('Sessão já iniciada');
        }
    }

    public function encerrarSessao(){
        if(session_status() === PHP_SESSION_ACTIVE){
            session_unset();
            session_destroy();
        }else{
            throw new Exception('Sessão não iniciada');
        }
    }

    public function setFlashMessage($message){
        $_SESSION[self::FLASH_KEY][] = $message;
    }

    public function getFlashMessages(){
        $messages = $_SESSION[self::FLASH_KEY] ?? [];
        unset($_SESSION[self::FLASH_KEY]);
        return $messages;
    }

    
}
?>