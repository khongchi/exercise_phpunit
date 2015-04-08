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

        $user = new User($repository, 'khongchi', 'originPassword', 'sungbum', 19);

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @dataProvider provideValidIds
     */
    public function testCreateWithValidateId($id)
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
     */
    public function testCreateWithInvalidateId($id)
    {
        $repository = \Mockery::mock('Khongchi\Src\UserRepository', [
            'encryptPassword' => 'encryptedPassword'
        ]);

        try {
            $user = new User($repository, $id, 'originPassword', 'khongchi', 19);
        } catch (\Exception $e) {
            $this->assertTrue(true);
            return;
        }

        $this->assertFalse(true);
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
