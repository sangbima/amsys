<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

class AdduserForm extends Model
{

  const STATUS_ACTIVE = 10;
  const STATUS_DELETED = 30;

  public $username;
  public $email;
  public $pass;
  public $newPasswordConfirm;
  public $nama;
  public $status;

  public function rules()
  {

    return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 6, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['nama', 'required'],

            [['pass', 'status'], 'required'],
            [['pass', 'newPasswordConfirm'], 'string', 'min' => 6],
            [['pass', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],
            [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'pass', 'message' => 'Password tidak sama'],
            [['status'], 'integer'],
        ];

  }

  /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'nama' => 'Nama',
            'status' => 'Status',
            'pass' => 'Password',
            'newPasswordConfirm' => 'Ulangi Password'
        ];
    }

  public function adduser()
  {

    if ($this->validate()) {

      $user = new User();
      $user->username = $this->username;
      $user->nama = $this->nama;
      $user->email = $this->email;
      $user->status = $this->status;
      $user->setPassword($this->pass);
      $user->generateAuthKey();

      if ($user->save(false)) {

        return $user;

      }

    }

    return null;

  }

  // public function updateuser($id)
  // {
  //
  //   if ($this->validate()) {
  //
  //     $user = User::find()->where(['id'=>3])->one();
  //     $user->username = $this->username;
  //     $user->nama = $this->nama;
  //     $user->email = $this->email;
  //     $user->status = $this->status;
  //     $user->setPassword($this->pass);
  //     $user->generateAuthKey();
  //
  //     if ($user->save(false)) {
  //
  //       return $user;
  //
  //     }
  //
  //   }
  //
  //   return null;
  //
  // }

  static function getIsNewRecord()
  {
    return true;
  }

}
