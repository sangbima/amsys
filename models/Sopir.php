<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "sopir".
 *
 * @property string $id
 * @property string $nama
 * @property string $no_sim
 * @property string $alamat
 * @property string $keterangan
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 */
class Sopir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sopir';
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
            [['id', 'user_id'], 'integer'],
            [['keterangan'], 'string'],
            [['created', 'updated'], 'safe'],
            [['nama'], 'string', 'max' => 100],
            [['no_sim'], 'string', 'max' => 45],
            [['alamat'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['no_sim'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'no_sim' => 'No Sim',
            'alamat' => 'Alamat',
            'keterangan' => 'Keterangan',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'Userid',
        ];
    }
}
