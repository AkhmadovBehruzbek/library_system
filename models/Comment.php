<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int|null $book_id
 * @property string|null $full_name
 * @property string|null $email
 * @property string|null $description
 * @property string $created_date
 *
 * @property Book $book
 * @property int $status [smallint(6)]
 */
class Comment extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id'], 'integer'],
            [['created_date'], 'safe'],
            [['full_name', 'email', 'description'], 'string', 'max' => 255],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Kitob nomi',
            'full_name' => 'F.I.O',
            'email' => 'Elektron Pochta',
            'description' => 'Fikr',
            'created_date' => 'Kiritilgan sana',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }
}
