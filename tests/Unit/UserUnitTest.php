<?php

namespace App\Tests\Unit;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    /**
     * @dataProvider fournirValidPasswordATestIsTrue
     */
    public function testIsTrue($validPassword): void
    {
        $user = new User();

        $user->setEmail('isma@gmail.com')
            ->setNom('isma')
            ->setPassword($validPassword);

        //test si 1er argument === 2eme argument sur tous les points , si c est bon c'est true
        $this->assertTrue($user->getEmail() === 'isma@gmail.com');
        $this->assertTrue($user->getNom() === 'isma');

        //test si 1er argument est le meme que le 2eme
        $this->assertSame($validPassword, $user->getPassword());
    }

    //sert a fournir des donnees pour tous nos tests si besoin avec l annotation dataProvider
    public function fournirValidPasswordATestIsTrue(): array
    {
        return [
            ['gege64'],
            ['lalala69'],
            ['caret34']
        ];
    }

    public function testIsFalse(): void
    {
        $user = new User();

        $user->setEmail('isma@gmail.com')
            ->setNom('isma')
            ->setPassword('1234');

        //on teste si c est bien faux ce qu'on a mis comme comparaison
        $this->assertFalse($user->getEmail() === 'mama@gmail.com');
        $this->assertFalse($user->getNom() === 'isa');
        $this->assertFalse($user->getPassword() === '456');
    }

    public function testIsEmpty(): void
    {
        $user = new User();

        //on verfifie si c'est bien vide quand on test sans avoir mis un set(donc une valeur) avant
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getPassword());
    }

    
}
