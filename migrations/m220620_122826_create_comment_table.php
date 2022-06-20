<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m220620_122826_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'full_name' => $this->string(),
            'email' => $this->string(),
            'description' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('book_comment_fk', '{{%comment}}', 'book_id', '{{%book}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
