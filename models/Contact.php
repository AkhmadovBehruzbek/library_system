<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string|null $full_name
 * @property string|null $email
 * @property string|null $description
 * @property string $created_date
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['description'], 'string'],
            [['created_date'], 'safe'],
            [['full_name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'full_name' => 'F.I.O',
            'email' => 'Email',
            'description' => 'Xabar',
            'created_date' => 'Yuborilgan sana',
        ];
    }
}
