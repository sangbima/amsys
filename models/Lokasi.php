<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lokasi".
 *
 * @property string $kode
 * @property string $nama
 * @property string $level
 * @property string $parent
 * @property integer $user_id
 * @property integer $latitude
 * @property integer $longitude
 * @property string $created
 * @property string $updated
 *
 * @property Lahan[] $lahans
 * @property Lokasi $parent0
 * @property Lokasi[] $lokasis
 * @property User $user
 * @property Petani[] $petanis
 */
class Lokasi extends \yii\db\ActiveRecord
{
    public $provinsi;
    public $kabkota;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lokasi';
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
            [['kode', 'nama', 'level'], 'required'],
            [['level'], 'string'],
            [['user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['kode', 'parent'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'unique'],
            [['latitude', 'longitude'], 'number'],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Lokasi::className(), 'targetAttribute' => ['parent' => 'kode']],
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
            'nama' => 'Nama',
            'level' => 'Level',
            'parent' => 'Parent',
            'user_id' => 'User ID',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'created' => 'Created',
            'updated' => 'Updated',
            'provinsi' => 'Provinsi',
            'kabkota' => 'Kabupaten/Kota'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLahans()
    {
        return $this->hasMany(Lahan::className(), ['lokasi_kode' => 'kode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        // return $this->hasOne(Lokasi::className(), ['kode' => 'parent']);
        return $this->hasOne(self::className(),
            ['kode' => 'parent'])->from(self::tableName() . ' AS parent');
    }

    public function getParentNama()
    {
        //return $this->parent['code'];
        $model = $this->parent0;
        return $model ? $model->nama:'';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokasis()
    {
        return $this->hasMany(Lokasi::className(), ['parent' => 'kode']);
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
    public function getPetanis()
    {
        return $this->hasMany(Petani::className(), ['lokasi_kode' => 'kode']);
    }
}
