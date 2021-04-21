<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoint_expert".
 *
 * @property int $id
 * @property int|null $expert_id
 * @property int|null $application_id
 * @property string|null $comment
 * @property int|null $appraisal
 */
class AppointExpert extends \yii\db\ActiveRecord
{
    public $sum_ratings;
    public $fio;
    public $evaluate_work_comment;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoint_expert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expert_id', 'application_id'], 'default', 'value' => null],
            [['expert_id', 'application_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expert_id' => 'Expert ID',
            'application_id' => 'Application ID',
        ];
    }
}
