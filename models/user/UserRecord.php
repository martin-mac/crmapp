<?php

namespace app\models\user;

use Yii;
use yii\web\IdentityInterface;
#use app\models\user\AuthAssignment;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 */
class UserRecord extends \yii\db\ActiveRecord implements IdentityInterface
{
	public $type;
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
            [['username', 'password', 'auth_key'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['username'], 'unique'],
			[['type'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'last Name',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function beforeSave($insert)
    {
        $return = parent::beforeSave($insert);

        if ($this->isAttributeChanged('password'))
            $this->password = Yii::$app->security->generatePasswordHash($this->password);

        if ($this->isNewRecord)
            $this->auth_key = Yii::$app->security->generateRandomKey($length = 255);

        return $return;
    }
	
	public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('You can only login by username/password pair for now.');
    }
	public function getFullName()
    {
      #Array_filter restituisce i campi non nulli/vuoti o false che poi con implode
	  #vengono legati con uno spazio.
		return implode(' ',
            array_filter(
                $this->getAttributes(
                    ['first_name', 'last_name'])));
    }
    public function getAuthoritation()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }
}
