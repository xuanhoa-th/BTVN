<?php


class LoginUserManager
{
    protected $listUser = [];
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
    public function add($userss){

        $login = $this->getDataJson();
        $data = [
            "email" => $userss-> getEmail(),
            "password" => $userss->getPassword(),
            "phone" => $userss->getPhone()
        ];
        array_push($login ,$data);
        $this->saveDataToFile($login);
    }
    public function getLoginUserss(){
        $arrayData = $this->getDataJson();
        foreach ($arrayData as $obj){
            $loginUser = new LoginUser($obj->email,$obj->password,$obj->phone);
            array_push($this->listUser,$loginUser);
        }
        return $this->listUser;
    }
    public function getDataJson(){
            $dataJson = file_get_contents($this->filePath);
            return json_decode($dataJson);
    }
    public function saveDataToFile($data){
        $dataJson = json_encode($data); // chuyen tu mamng ve json
        file_put_contents($this->filePath, $dataJson);
    }
}