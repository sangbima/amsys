<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "route".
 *
 * @property string $name
 * @property string $alias
 * @property string $type
 * @property integer $status
 */
class Route extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias', 'type'], 'required'],
            [['status'], 'integer'],
            [['name', 'alias', 'type'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'alias' => 'Alias',
            'type' => 'Type',
            'status' => 'Status',
        ];
    }
}
