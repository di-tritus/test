<?php

use yii\db\Migration;

class m170326_175150_add_columns_to_books extends Migration
{
    public function up()
    {
        $this->addColumn('books', 'url', $this->string());
        $this->addColumn('books', 'description', $this->text());
    }

    public function down()
    {
        echo "m170326_175150_add_columns_to_books cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
