<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\UtilService;

class RegistrationController 
{
    private $passwordEncoder;
    private $us;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UtilService $us){
        $this->passwordEncoder = $passwordEncoder;
        $this->us = $us;
    }

    public function __invoke(User $data):User{
        if($this->us->checkPassword($data->getPassword()) == 0){
            $password = $this->passwordEncoder->encodePassword(
                $data,
                $data->getPassword()
            );
            $data->setPassword($password);
        }
        return $data;
    }
}
