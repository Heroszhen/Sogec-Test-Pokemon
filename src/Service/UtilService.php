<?php

namespace App\Service;

class UtilService{

    public function checkPassword(string $password):int{
        if(strlen($password) < 8)return 1;
        if(!preg_match('@[A-Z]@', $password))return 2;
        if(!preg_match('@[a-z]@', $password))return 3;
        $checked = 4;
        $tab = [",",";",":","?",".","/","@","#","\"","\'","{","}","[","]","-","_","(",")","$","*","%","=","+"];
        foreach($tab as $value){
            if(str_contains($password, $value)){
                $checked = 0;
                break;
            }
        }
        return $checked;
    }
}