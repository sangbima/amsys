<?php

namespace app\models;
use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\base\NotSupportedException;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\helpers\Security;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    // public $pass;
    // public $newPasswordConfirm;
    // public $status;
    public $new_password, $old_password, $repeat_password;

    public static function tableName()
    {
      return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        /*return [
            TimestampBehavior::className(),
        ];*/

        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function(){ return date('Y-m-d H:i:s'); /* MySql DATETIME */},
            ],
            'autouserid' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
                ],
            ],
        ];
    }

    public function rules()
    {
      return [
        ['status', 'default', 'value' => self::STATUS_ACTIVE],
        [['username', 'email', 'password_hash'], 'string', 'max' => 255],
        [['username', 'nama', 'status'], 'required'],
        [['username', 'email'], 'unique'],
        [['email'], 'email'],
        [['old_password', 'new_password', 'repeat_password'], 'string', 'min' => 6],
        [['repeat_password'], 'compare', 'compareAttribute' => 'new_password'],
        [['old_password', 'new_password', 'repeat_password'], 'required', 'when' => function($model){
          return (!empty($model->new_password));
        }, 'whenClient' => "function (attribute, value) {
          return ($('#user-new_password').val().length>0);
        }"],
        ['username', 'filter', 'filter' => 'trim'],
        ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
        // [['pass', 'newPasswordConfirm'], 'string', 'min' => 6, 'max' => 100],
      ];
    }

    public function scenarios()
    {
      $scenarios = parent::scenarios();
      $scenarios['password'] = ['old_password', 'new_password', 'repeat_password'];
      return $scenarios;
    }

    /**
     * @inheritdoc
     */
     public function attributeLabel()
     {
       return [
        'username' => 'Username',
        // 'pass' => 'Password',
        'password_hash' => 'Password Hash',
        'email' => 'Email',
        'status' => 'Status',
        // 'newPasswordConfirm' => 'Ulangi Password',
       ];
     }

    public function beforeSave($insert)
    {
      if(parent::beforeSave($insert)) {
        if($this->isNewRecord) {
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }
        return true;
      }
      return false;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // return static::findOne(['access_token' => $token]);
        return static::findOne(['auth_key' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generatePasswordResetToken()
    {
      $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
      $this->password_reset_token = null;
    }

    /**
     * get Status Label
     */
    public function getStatusLabel($status)
    {
        if($status == self::STATUS_ACTIVE) return '<span class="label label-primary">Active</span>';
        if($status == self::STATUS_INACTIVE) return '<span class="label label-danger">Active</span>';
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getRoles()
    {
      return $this->hasMany(AuthAssignment::className(), [
        'user_id' => 'id',
      ]);
    }
}
