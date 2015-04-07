<?php
namespace Khongchi\Tests;

use Khongchi\Src\Encryptor;
use Khongchi\Src\User;
use Khongchi\Src\UserRepository;

class UserRepositoryTest extends \PHPUnit_Framework_TestCase {

    protected $repository;

    public function testTrue()
    {
        $this->assertTrue(true);
    }

    public function testCreate()
    {
        $encryptor = \Mockery::mock('Khongchi\Src\Encryptor');

        $repository = new UserRepository($encryptor);

        $this->assertInstanceOf(UserRepository::class, $repository);
    }

    public function testInsert()
    {
        $encryptor = \Mockery::mock('Khongchi\Src\Encryptor');

        $repository = new UserRepository($encryptor);

        $user = \Mockery::mock('Khongchi\Src\User', [
            'getId' => 1,
        ]);

        $repository->insert($user);

        $searchedUser = $repository->get($user->getId());

        $this->assertEquals($user, $searchedUser);

        return $repository;
    }

    /**
     * testInsertDuplicated
     *
     * @return void
     * @expectedException \Exception
     */
    public function testInsertDuplicated()
    {
        $user = \Mockery::mock('Khongchi\Src\User', [
            'getId' => 1,
        ]);

        $this->repository->insert($user);
        $this->repository->insert($user);
    }

    /**
     * testGet
     *
     * @return void
     * @depends testInsert
     */
    public function testGet($repository)
    {
        $searchedUser = $repository->get(1);

        $this->assertEquals(1, $searchedUser->getId());
    }

    public function testEncrypt()
    {
        $encryptor = \Mockery::mock('Khongchi\Src\Encryptor', [
            'encrypt' => 'encryptedText'
        ]);

        $repository = new UserRepository($encryptor);

        $e = $repository->encryptPassword('password');

        $this->assertEquals('encryptedText', $e);
    }

    protected function setUp()
    {
        $encryptor = \Mockery::mock('Khongchi\Src\Encryptor');

        $this->repository = new UserRepository($encryptor);

        parent::setUp();
    }

    protected function tearDown()
    {
        \Mockery::close();
        parent::tearDown();
    }
}
