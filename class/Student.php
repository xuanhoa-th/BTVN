<?php


class Student
{
    protected $name;
    protected $email;
    protected $phone;
    protected $image;

    public function __construct($name, $email, $phone,$image)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->image  = $image;

    }


    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }


    public function getPhone()
    {
        return $this->phone;
    }

    public function getInfo()
    {
        return $this->name . "-" . $this->phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}