<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluate_work".
 *
 * @property int $id
 * @property int|null $expert_id
 * @property int|null $application_id
 * @property int|null $appraisal
 * @property string|null $comment
 */
class EvaluateWork extends \yii\db\ActiveRecord
{

    public $fio;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'evaluate_work';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expert_id', 'application_id', 'comment'], 'required'],
            [['expert_id', 'application_id'], 'integer'],
            [['comment'], 'string'],
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
            'comment' => 'Комментарий',
        ];
    }
}
