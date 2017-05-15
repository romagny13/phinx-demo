<?php

use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    public function up(){
        $table = $this->table('posts');
        $table
            //->addColumn('id', 'integer', ['identity' => true]) // not required
            ->addColumn('title','string')
            ->addColumn('content','text', ['null' => true])
            ->addTimestamps() // created_at (default current_timestamp) + updated_at
            ->create();
    }
}
