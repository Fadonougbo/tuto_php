<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MessageTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table("messages")
        ->addColumn("message","text")
        ->addTimestamps() 
        ->create();

        $this->table("users")
        ->addColumn("name","string",["limit"=>255])
        ->addColumn("password","string",["limit"=>255])
        ->create();

        $this->table("users_messages")
        ->addColumn("user_id","integer")
        ->addColumn("message_id","integer")
        ->create();

        $this->table("users_messages")
        ->addForeignKey("user_id","users")
        ->addForeignKey('message_id',"messages")
        ->update();
    }


}
