<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property string|null $subject
 * @property string|null $body
 * @property int|null $type
 */
class Notifications extends \yii\db\ActiveRecord
{
    const REGISTRATION_ON_SITE = 1;
    const PASSED_TO_SECOND_STAGE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['type'], 'default', 'value' => null],
            [['type'], 'integer'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'body' => 'Body',
            'type' => 'Type',
        ];
    }
}
