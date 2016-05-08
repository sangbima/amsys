<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "komoditas".
 *
 * @property string $kode
 * @property string $nama
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property string $level
 * @property string $keterangan
 * @property string $parent
 *
 * @property Komoditas $parent0
 * @property Komoditas[] $komoditas
 * @property User $user
 * @property Produksi[] $produksis
 */
class Komoditas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'komoditas';
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
            [['nama'], 'required'],
            [['created', 'updated'], 'safe'],
            [['level', 'keterangan'], 'string'],
            [['kode', 'parent'], 'string', 'max' => 50],
            [['nama'], 'string', 'max' => 100],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Komoditas::className(), 'targetAttribute' => ['parent' => 'kode']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama Varietas',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'User ID',
            'level' => 'Level',
            'keterangan' => 'Keterangan',
            'parent' => 'Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Komoditas::className(), ['kode' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKomoditas()
    {
        return $this->hasMany(Komoditas::className(), ['parent' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduksis()
    {
        return $this->hasMany(Produksi::className(), ['komoditas_kode' => 'kode']);
    }
}
