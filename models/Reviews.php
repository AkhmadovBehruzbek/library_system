<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "reviews".
 *
 * @property int|null $book_id
 * @property string|null $full_name
 * @property string|null $description
 * @property string $created_date
 *
 * @property Book $book
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['book_id'], 'integer'],
            [['created_date'], 'safe'],
            [['full_name', 'description'], 'string', 'max' => 255],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'book_id' => 'Book ID',
            'full_name' => 'Full Name',
            'description' => 'Description',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return ActiveQuery
     */
    public function getBook(): ActiveQuery
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }
}
