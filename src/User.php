<?php
namespace Khongchi\Src;

class User
{
    /**
     * @var int
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

        $this->id          = $id;
        $this->password    = $repository->encryptPassword($password);
        $this->name        = $name;
        $this->age         = $age;
        $this->description = $description;
    }

    public function isAdult()
    {
        return $this->age > 19;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
