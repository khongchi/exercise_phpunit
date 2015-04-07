<?php
namespace Khongchi\Tests;


use Khongchi\Src\User;
use Khongchi\Src\UserRepository;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        $user = new User($repository, 1, 'originPassword', 'khongchi', 19);

        $this->assertInstanceOf(User::class, $user);
    }

    public function testIsAdult()
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        $user = new User($repository, 1, 'originPassword', 'khongchi', 19);

        $this->assertFalse($user->isAdult());

        $userTwo = new User($repository, 1, 'originPassword', 'khongchi', 30);

        $this->assertTrue($userTwo->isAdult());
    }

    public function provideValidUsers()
    {
        return [
            [1, 'p1', 'khongchi', 19],
            [2, 'p1', 'khongchi', 19],
            [3, 'p1', 'khongchi', 19],
            [4, 'p1', 'khongchi', 19],
            [5, 'p1', 'khongchi', 19],
        ];
    }

    /**
     * testCreateWithProvider
     *
     * @dataProvider provideValidUsers
     */
    public function testCreateWithValidProvider($id, $pw, $name, $age, $desc = '')
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        $user = new User($repository, $id, $pw, $name, $age, $desc);

        $this->assertInstanceOf(User::class, $user);
    }

}
