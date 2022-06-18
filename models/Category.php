<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $status
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Book[] $books
 */
class Category extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Kategoriya nomi',
            'status' => 'Holati',
            'created_date' => 'Kiritilgan sana',
            'updated_date' => 'O\'zgartirilgan sana',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return ActiveQuery
     */
    public function getBook(): ActiveQuery
    {
        return $this->hasMany(Book::className(), ['category_id' => 'id']);
    }
}
