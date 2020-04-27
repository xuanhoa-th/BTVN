<?php


class LoginUser
{
    protected $email;
    protected $password;
    protected $phone;
    public function __construct($email,$password,$phone)
    {
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}