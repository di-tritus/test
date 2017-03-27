<?php

use yii\db\Migration;

class m170327_153430_add_colums_url_book_to_book extends Migration
{
    public function up()
    {
        $this->addColumn('books', 'url_book', $this->string());
    }

    public function down()
    {
        echo "m170327_153430_add_colums_url_book_to_book cannot be reverted.\n";

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
