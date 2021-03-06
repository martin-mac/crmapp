<?php

namespace app\models\customer;

use yii\db\ActiveRecord;

class CustomerRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            ['id', 'number'],
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            ['birth_date', 'date', 'format' => 'php:Y-m-d'],
            ['notes', 'safe']
        ];
    }
	
    public function behaviors()
    {
        return [
            'timestamp' => \yii\behaviors\TimestampBehavior::className(),
            'blame' => \yii\behaviors\BlameableBehavior::className()
        ];
    }
	
    public function getPhones()
    {
        return $this->hasMany(PhoneRecord::className(), ['customer_id' => 'id']);
    }

    public function getAddresses()
    {
        return $this->hasMany(AddressRecord::className(), ['customer_id' => 'id']);
    }

    public function getEmails()
    {
        return $this->hasMany(EmailRecord::className(), ['customer_id' => 'id']);
    }
}
