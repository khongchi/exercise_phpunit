<?php
namespace Khongchi\Tests;


use Khongchi\Src\User;
use Khongchi\Src\UserRepository;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        $user = new User($repository, 'khongchi', 'originPassword', 'sungbum', 19);

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @dataProvider provideValidIds
     */
    public function testConstructWithValidateId($id)
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        $user = new User($repository, $id, 'originPassword', 'khongchi', 19);
    }

    public function provideValidIds()
    {
        return [
            ['khongchi'],
            ['khongchi12'],
            ['khon12gchi'],
            ['khong_chi'],
        ];
    }

    /**
     * @dataProvider provideInvalidIds
     * @expectedException \Exception
     */
    public function testConstructWithInvalidateId($id)
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        new User($repository, $id, 'originPassword', 'khongchi', 19);
    }

    public function provideInvalidIds()
    {
        return [
            [':khongchi'],
            ['1khongchi'],
            ['_khongchi'],
            ['kho::ngchi'],
            ['Khongchi'],
        ];
    }

}
