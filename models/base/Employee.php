<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property int $id
 * @property string $lastname Фамилия
 * @property string $username Имя
 * @property string $middlename Отчество
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastname', 'username', 'middlename'], 'required'],
            [['lastname', 'username', 'middlename'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'lastname' => Yii::t('app', 'Фамилия'),
            'username' => Yii::t('app', 'Имя'),
            'middlename' => Yii::t('app', 'Отчество'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\EmployeeQuery(get_called_class());
    }
}
