<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_tags}}`.
 */
class m220619_063440_create_book_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_tags}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'tag' => $this->string(),
        ]);

        $this->addForeignKey('book_book_tags_fk', '{{%book_tags}}', 'book_id', '{{%book}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_tags}}');
    }
}
