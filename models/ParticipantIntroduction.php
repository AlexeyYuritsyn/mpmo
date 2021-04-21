<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participant_introduction".
 *
 * @property int $id
 * @property int|null $no_plagiarism
 * @property int|null $clarity_idea
 * @property int|null $originality
 * @property int|null $completeness_and_correctness
 * @property int|null $relevance
 * @property int|null $aesthetic_design
 * @property int|null $ability_present_yourself
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class ParticipantIntroduction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participant_introduction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_plagiarism', 'clarity_idea', 'originality', 'completeness_and_correctness', 'relevance',
                'aesthetic_design', 'ability_present_yourself', 'application_id', 'expert_id'], 'required'],
            [['no_plagiarism', 'clarity_idea', 'originality', 'completeness_and_correctness', 'relevance',
                'aesthetic_design', 'ability_present_yourself'], 'default', 'value' => 0],
            [['no_plagiarism', 'clarity_idea', 'originality', 'completeness_and_correctness', 'relevance',
                'aesthetic_design', 'ability_present_yourself'], 'integer', 'min' => 0, 'max' => 2],
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
            'no_plagiarism' => 'Поля',
            'clarity_idea' => 'Поля',
            'originality' => 'Поля',
            'completeness_and_correctness' => 'Поля',
            'relevance' => 'Поля',
            'aesthetic_design' => 'Поля',
            'ability_present_yourself' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
