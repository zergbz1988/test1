<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fio
 * @property int $country_id
 * @property string $phone
 *
 * @property Country $country
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['fio'], 'string', 'max' => 60],
            ['phone', 'filter', 'filter' => function ($value) {
                return str_replace(['(', ')', ' ', '-', '+'], '', $value);
            }],
            [['phone'], 'string', 'min' => 11],
            [['phone'], 'string', 'max' => 11],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'country_id' => 'Country ID',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserQuery(get_called_class());
    }

    public function fields()
    {
        return [
            'id',
            'fio',
            'phone',
            'country' => function ($model) {
                return ['id' => $model->country->id, 'title' => $model->country->title];
            },
            'countries' => function ($model) {
                return Country::find()->all();
            }
        ];
    }
}
