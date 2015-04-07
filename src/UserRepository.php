<?php
namespace Khongchi\Src;

class UserRepository
{

    protected $users = [];

    protected $encryptor;

    public function __construct(Encryptor $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    public function insert(User $user)
    {
        $id = $user->getId();
        if (isset($this->users[$id])) {
            throw new \Exception('User already exists');
        }
        $this->users[$id] = $user;
    }

    public function get($id)
    {
        if (isset($this->users[$id])) {
            return $this->users[$id];
        } else {
            return null;
        }
    }

    public function delete($id)
    {
        if (isset($this->users[$id])) {
            unset($this->users[$id]);
            return 1;
        } else {
            return 0;
        }
    }

    public function encryptPassword($password)
    {
        return $this->encryptor->encrypt($password);
    }
}
