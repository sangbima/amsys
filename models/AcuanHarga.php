<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "acuan_harga".
 *
 * @property string $id
 * @property string $komoditas_kode
 * @property string $harga
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 *
 * @property Komoditas $komoditasKode
 * @property User $user
 */
class AcuanHarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acuan_harga';
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated',
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['komoditas_kode', 'harga'], 'required'],
            [['harga'], 'number'],
            [['user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['komoditas_kode'], 'string', 'max' => 50],
            [['komoditas_kode'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['komoditas_kode' => 'kode']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'komoditas_kode' => 'Varietas',
            'harga' => 'Harga/Kg',
            'user_id' => 'User ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomoditasKode()
    {
        return $this->hasOne(Komoditas::className(), ['kode' => 'komoditas_kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
