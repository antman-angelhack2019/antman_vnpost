<?php

use App\Auth\Md5PasswordHasher;
use Cake\Datasource\ConnectionManager;
use Migrations\AbstractSeed;

class AdminsSeed extends AbstractSeed {

    public function run() {
        $connection = ConnectionManager::get('default');
        $connection->execute('TRUNCATE TABLE admins');

        $admins = [
            [
                'username' => 'super_admin',
            ],
        ];

        $password = '12345678';

        foreach($admins as $admin) {
            $table = $this->table('admins');
            $table->insert([
                'username' => $admin['username'],
                'password'  => (new Md5PasswordHasher())->hash($password)
            ])->save();
        }

    }
}
