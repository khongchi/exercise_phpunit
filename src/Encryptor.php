<?php
namespace Khongchi\Src;

class Encryptor
{
    public function encrypt($password)
    {
        return md5($password);
    }
}
