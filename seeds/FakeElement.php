<?php

use Faker\Factory;
use Phinx\Seed\AbstractSeed;

class FakeElement extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $faker=Factory::create();

        $users=[];
        $messages=[];
        $users_messages=[];

        for ($i=0; $i <4 ; $i++) { 

            $name=$faker->firstName();
            $password=password_hash("user_$i",PASSWORD_BCRYPT,["cost"=>5]);
            
            $users[]=["name"=>$name,"password"=>$password];
        }

        for ($i=0; $i <20 ; $i++) { 
            
            $messages[]=["message"=>$faker->paragraph()];
        }

        for ($i=0; $i <10 ; $i++) { 

            $user_id=$faker->numberBetween(1,3);

            $message_id=$faker->numberBetween(1,20);
            
            $users_messages[]=["user_id"=>$user_id,"message_id"=>$message_id];
        }

        $this->insert("users",$users);
        $this->insert("messages",$messages);
        $this->insert("users_messages",$users_messages);
    }
}
