<?php
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class Md5PasswordHasher extends AbstractPasswordHasher {

    public function hash($password): string {
        return md5($password);
    }

    public function check($password, $hashedPassword): bool {
        return $this->hash($password) === $hashedPassword;
}}
