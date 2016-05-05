<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "armada".
 *
 * @property string $id
 * @property string $kode
 * @property string $no_polisi
 * @property string $kapasitas_mesin
 * @property string $kapasitas_angkut
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 */
class Armada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'armada';
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
            [['id', 'no_polisi'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['kapasitas_mesin', 'kapasitas_angkut'], 'number'],
            [['created', 'updated'], 'safe'],
            [['kode', 'no_polisi'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['no_polisi'], 'unique'],
            [['kode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'no_polisi' => 'No Polisi',
            'kapasitas_mesin' => 'Kapasitas Mesin',
            'kapasitas_angkut' => 'Kapasitas Angkut',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'Userid',
        ];
    }
}
