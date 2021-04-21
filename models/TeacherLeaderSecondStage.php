<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_leader_second_stage".
 *
 * @property int $id
 * @property int|null $consistency_results
 * @property int|null $rating_awareness
 * @property int|null $clear_structure
 * @property int|null $management_ownership
 * @property int|null $possession_city_information
 * @property int|null $topic_depth
 * @property int|null $communication_efficiency
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class TeacherLeaderSecondStage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_leader_second_stage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['consistency_results', 'rating_awareness', 'clear_structure', 'management_ownership',
                'possession_city_information', 'topic_depth', 'communication_efficiency','application_id', 'expert_id'], 'required'],
            [['consistency_results', 'rating_awareness', 'clear_structure', 'management_ownership',
                'possession_city_information', 'topic_depth', 'communication_efficiency'], 'default', 'value' => null],
            [['consistency_results', 'rating_awareness', 'clear_structure', 'management_ownership',
                'possession_city_information', 'topic_depth', 'communication_efficiency'], 'integer', 'min' => 0, 'max' => 2],
            [['application_id', 'expert_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'consistency_results' => 'Поля',
            'rating_awareness' => 'Поля',
            'clear_structure' => 'Поля',
            'management_ownership' => 'Поля',
            'possession_city_information' => 'Поля',
            'topic_depth' => 'Поля',
            'communication_efficiency' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
