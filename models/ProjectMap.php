<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_map".
 *
 * @property int $id
 * @property int|null $relevance_project
 * @property int|null $social_significance
 * @property int|null $originality_idea
 * @property int|null $matching_tasks
 * @property int|null $project_viability
 * @property int|null $financial_efficiency
 * @property int|null $availability_quality
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class ProjectMap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_map';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['relevance_project', 'social_significance', 'originality_idea', 'matching_tasks', 'project_viability', 'financial_efficiency',
                'availability_quality','application_id', 'expert_id'], 'required'],
            [['relevance_project', 'social_significance', 'originality_idea', 'matching_tasks', 'project_viability', 'financial_efficiency',
                'availability_quality'], 'default', 'value' => 0],
            [['relevance_project', 'social_significance', 'originality_idea', 'matching_tasks', 'project_viability',
                'financial_efficiency', 'availability_quality'], 'integer', 'min' => 0, 'max' => 4],
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
            'relevance_project' => 'Поля',
            'social_significance' => 'Поля',
            'originality_idea' => 'Поля',
            'matching_tasks' => 'Поля',
            'project_viability' => 'Поля',
            'financial_efficiency' => 'Поля',
            'availability_quality' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
