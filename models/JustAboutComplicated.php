<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "just_about_complicated".
 *
 * @property int $id
 * @property int|null $availability_presentation
 * @property int|null $scientific_validity
 * @property int|null $culture_speech
 * @property int|null $individuality
 * @property int|null $logic_and_argumentation
 * @property int|null $application_id
 * @property int|null $expert_id
 */
class JustAboutComplicated extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'just_about_complicated';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['availability_presentation', 'scientific_validity', 'culture_speech', 'individuality',
                'logic_and_argumentation', 'application_id', 'expert_id'], 'required'],
            [['availability_presentation', 'scientific_validity', 'culture_speech', 'individuality',
                'logic_and_argumentation', 'application_id', 'expert_id'], 'default', 'value' => null],
            [['availability_presentation', 'scientific_validity', 'culture_speech', 'individuality',
                'logic_and_argumentation'], 'integer', 'min' => 0, 'max' => 4],
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
            'availability_presentation' => 'Поля',
            'scientific_validity' => 'Поля',
            'culture_speech' => 'Поля',
            'individuality' => 'Поля',
            'logic_and_argumentation' => 'Поля',
            'application_id' => 'Application ID',
            'expert_id' => 'Expert ID',
        ];
    }
}
