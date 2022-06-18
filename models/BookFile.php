<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_file".
 *
 * @property int $id
 * @property int|null $book_id
 * @property string|null $file_name
 * @property string|null $file_path
 * @property float|null $file_size
 */
class BookFile extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['book_id'], 'integer'],
            [['file_name'], 'file', 'extensions' => 'pdf'],
            [['file_size'], 'number'],
            [['file_name', 'file_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'file_size' => 'File Size',
        ];
    }
}
