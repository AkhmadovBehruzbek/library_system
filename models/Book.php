<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $pages_count
 * @property string|null $published_date
 * @property string|null $image
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Banner[] $banners
 * @property BookAuthor[] $bookAuthors
 * @property Category $category
 * @property Downloads[] $downloads
 * @property Readings[] $readings
 * @property Reviews[] $reviews
 * @property Views[] $views
 * @property int $status [smallint(6)]
 */
class Book extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['category_id', 'published_date', 'pages_count', 'name'], 'required'],
            [['category_id', 'pages_count'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['description'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'category_id' => 'Kategoriya',
            'name' => 'Kiton nomi',
            'description' => 'Kitob haqida',
            'pages_count' => 'Sahifalar soni',
            'published_date' => 'Nashr qilingan yili',
            'image' => 'Rasmi',
            'created_date' => 'Kiritilgan sana',
            'updated_date' => 'Tahrirlangan sana',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors(): ActiveQuery
    {
        return $this->hasOne(BookAuthor::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[BookFile]].
     *
     * @return ActiveQuery
     */
    public function getBookFile(): ActiveQuery
    {
        return $this->hasOne(BookFile::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Downloads]].
     *
     * @return ActiveQuery
     */
    public function getDownloads(): ActiveQuery
    {
        return $this->hasOne(Downloads::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Readings]].
     *
     * @return ActiveQuery
     */
    public function getReadings(): ActiveQuery
    {
        return $this->hasMany(Readings::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return ActiveQuery
     */
    public function getReviews(): ActiveQuery
    {
        return $this->hasMany(Reviews::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Views]].
     *
     * @return ActiveQuery
     */
    public function getViews(): ActiveQuery
    {
        return $this->hasOne(Views::className(), ['book_id' => 'id']);
    }
}
