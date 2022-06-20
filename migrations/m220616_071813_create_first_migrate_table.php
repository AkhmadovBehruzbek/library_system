<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%first_migrate}}`.
 */
class m220616_071813_create_first_migrate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'role' => $this->smallInteger(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->string(),
            'pages_count' => $this->integer(),
            'published_date' => $this->integer(),
            'image' => $this->string(),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'full_name' => $this->string(),
        ]);

        $this->createTable('{{%downloads}}', [
            'book_id' => $this->integer(),
            'number' => $this->bigInteger(),
        ]);

        $this->createTable('{{%views}}', [
            'book_id' => $this->integer(),
            'number' => $this->bigInteger(),
        ]);

        $this->createTable('{{%readings}}', [
            'book_id' => $this->integer(),
            'number' => $this->bigInteger(),
        ]);

        $this->createTable('{{%book_file}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'file_name' => $this->string(),
            'file_path' => $this->string(),
            'file_size' => $this->float(),
        ]);

        /** Foreign key */
        $this->addForeignKey('category_book_fk', '{{%book}}', 'category_id', '{{%category}}', 'id');
        $this->addForeignKey('book_book_author_fk', '{{%book_author}}', 'book_id', '{{%book}}', 'id');
        $this->addForeignKey('book_downloads_fk', '{{%downloads}}', 'book_id', '{{%book}}', 'id');
        $this->addForeignKey('book_views_fk', '{{%views}}', 'book_id', '{{%book}}', 'id');
        $this->addForeignKey('book_readings_fk', '{{%readings}}', 'book_id', '{{%book}}', 'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%first_migrate}}');
    }
}
