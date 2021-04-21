<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_master_second_stage".
 *
 * @property int $id
 * @property int|null $content_compliance
 * @property int|null $content_depth
 * @property int|null $clear_structure
 * @property int|null $possession_subject
 * @property int|null $competent_use
 * @property int|null $depth_topic_disclosure
 * @property int|null $pedagogical_culture
 * @property int|null $communication_efficiency
 * @property int|null $methodological_value
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class TeacherMasterSecondStage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_master_second_stage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content_compliance', 'content_depth', 'clear_structure', 'possession_subject', 'competent_use',
                'depth_topic_disclosure', 'pedagogical_culture', 'communication_efficiency', 'methodological_value',
                'application_id', 'expert_id'], 'required'],
            [['content_compliance', 'content_depth', 'clear_structure', 'possession_subject', 'competent_use',
                'depth_topic_disclosure', 'pedagogical_culture', 'communication_efficiency', 'methodological_value'], 'default', 'value' => 0],
            [['content_compliance', 'content_depth', 'clear_structure', 'possession_subject', 'competent_use',
                'depth_topic_disclosure', 'pedagogical_culture', 'communication_efficiency', 'methodological_value'], 'integer', 'min' => 0, 'max' => 2],
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
            'content_compliance' => 'Поля',
            'content_depth' => 'Поля',
            'clear_structure' => 'Поля',
            'possession_subject' => 'Поля',
            'competent_use' => 'Поля',
            'depth_topic_disclosure' => 'Поля',
            'pedagogical_culture' => 'Поля',
            'communication_efficiency' => 'Поля',
            'methodological_value' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
