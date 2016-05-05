<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "helper_nomor".
 *
 * @property string $parameter
 * @property integer $value
 */
class HelperNomor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'helper_nomor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameter'], 'required'],
            [['value'], 'integer'],
            [['parameter'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parameter' => 'Parameter',
            'value' => 'Value',
        ];
    }
}
