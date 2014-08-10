<?php
/**
 * Базовый запрос
 * 
 */
abstract class BaseRequest
{
    /**
     * Логин для авторизации
     * Type: xsd:string
     * 
     * @var string
     */
    public $login = null;

    /**
     * Пароль для авторизации
     * Type: xsd:string
     * 
     * @var string
     */
    public $password = null;

    /**
     * 
     * @param string $login 
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * 
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * 
     * @param string $password 
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}

