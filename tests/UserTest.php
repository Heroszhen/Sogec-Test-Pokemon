<?php

namespace Test\Controllers;
use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Service\UtilService;

class UserTest extends TestCase
{
    private $us;
    
    protected function setUp():void {
        $this->us = new UtilService();
    } 

    public function testEmail()
    {
        $user = new User();
        $user->setEmail("aaa");
        $this->assertFalse($this->us->checkPassword($user->getEmail()) == 0);

        $user->setEmail("Aa123456789;");
        $this->assertTrue($this->us->checkPassword($user->getEmail()) == 0);

        $email = "aaa@gmail.com";
        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
    }

}
