<?php
namespace Khongchi\Src;

use Mockery\CountValidator\Exception;

class User
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $password;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $description;

    /**
     * @var UserRepository
     */
    public $repository;

    /**
     * @var int
     */
    private $age;

    public function __construct($repository, $id, $password, $name, $age, $description = '')
    {
        $this->repository = $repository;

        if ($this->validateId($id) === false) {
            throw new \Exception('invalid id!!');
        }

        $this->id          = $id;
        $this->password    = $repository->encryptPassword($password);
        $this->name        = $name;
        $this->age         = $age;
        $this->description = $description;
    }

    protected function validateId($id)
    {
        if (preg_match('/^[a-z][a-z0-9_-]*$/', $id)) {
            return true;
        }

        return false;
    }
}
