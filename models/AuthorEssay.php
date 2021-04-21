<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author_essay".
 *
 * @property int $id
 * @property int|null $relevance_topic
 * @property int|null $breadth_mind
 * @property int|null $logic_presentation
 * @property int|null $originality_text
 * @property int|null $observance_language
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class AuthorEssay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_essay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['relevance_topic', 'breadth_mind', 'logic_presentation', 'originality_text', 'observance_language', 'application_id', 'expert_id'], 'required'],
            [['relevance_topic', 'breadth_mind', 'logic_presentation', 'originality_text', 'observance_language', 'application_id', 'expert_id'], 'default', 'value' => 0],
            [['relevance_topic', 'breadth_mind', 'logic_presentation', 'originality_text', 'observance_language'], 'integer', 'min' => 0, 'max' => 2],
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
            'relevance_topic' => 'Поля',
            'breadth_mind' => 'Поля',
            'logic_presentation' => 'Поля',
            'originality_text' => 'Поля',
            'observance_language' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
