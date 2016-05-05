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
 * @property string $created
 * @property string $updated
 *
 * @property Lahan[] $lahans
 * @property Lokasi $parent0
 * @property Lokasi[] $lokasis
 * @property User $user
 * @property Petani[] $petanis
 */
class Pasar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasar';
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
            [['id'], 'integer'],
            [['nama_pasar','latitude','longitude'], 'string'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Pasar',
            'nama_pasar' => 'Nama Pasar',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude'            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
}
