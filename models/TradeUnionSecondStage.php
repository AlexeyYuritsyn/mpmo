<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trade_union_second_stage".
 *
 * @property int $id
 * @property int|null $selection_project
 * @property int|null $project_proposal
 * @property int|null $having_idea
 * @property int|null $project_budget
 * @property int|null $use_technology
 * @property int|null $formulated_proposals
 * @property int|null $compliance_regulations
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class TradeUnionSecondStage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trade_union_second_stage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['selection_project', 'project_proposal', 'having_idea', 'project_budget', 'use_technology', 'formulated_proposals',
                'compliance_regulations', 'application_id', 'expert_id'], 'required'],
            [['selection_project', 'project_proposal', 'having_idea', 'project_budget', 'use_technology', 'formulated_proposals',
                'compliance_regulations'], 'default', 'value' => 0],
            [['selection_project', 'project_proposal', 'having_idea', 'project_budget', 'use_technology', 'formulated_proposals',
                'compliance_regulations'], 'integer', 'min' => 0, 'max' => 2],
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
            'selection_project' => 'Поля',
            'project_proposal' => 'Поля',
            'having_idea' => 'Поля',
            'project_budget' => 'Поля',
            'use_technology' => 'Поля',
            'formulated_proposals' => 'Поля',
            'compliance_regulations' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
