<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_setup".
 *
 * @property int $id
 * @property bool|null $acceptance_works_for_first_stage
 * @property bool|null $registration
 */
class ProjectSetup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_setup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acceptance_works_for_first_stage', 'registration'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'acceptance_works_for_first_stage' => 'Прием работ для первого этапа',
            'registration' => 'Регистрация участиников',
        ];
    }
}
