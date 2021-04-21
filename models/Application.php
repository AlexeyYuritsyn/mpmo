<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int|null $nomination
 * @property string|null $video_1
 * @property string|null $essay
 * @property string|null $video_2
 * @property string|null $project_map
 */
class Application extends \yii\db\ActiveRecord
{
    public $path_essay;
    public $path_project_map;
    public $path_competitive_test;
    public $appoint_expert_array;

    public $sum_appraisal;

    public $fio;

    const TEACHER_MASTER = 1;
    const TEACHER_LEADER = 2;
    const TRADE_UNION = 3;

    public static $nominations = [
        self::TEACHER_MASTER =>'Номинация «Учитель – мастер»',
        self::TEACHER_LEADER =>'Номинация «Учитель – лидер»',
        self::TRADE_UNION =>'Номинация «Профессиональный союз»'
    ];


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $roles = [['video_1'], 'required'];
        if($this->getScenario() == 'add_work_round_second')
        {
            $roles = [['path_competitive_test'], 'required','on'=>'add_work_round_second'];
        }

        return [
            $roles,
            [['nomination'], 'default', 'value' => null],
            [['nomination','participant_id','round'], 'integer'],
            [['video_1', 'essay', 'video_2', 'project_map', 'competitive_test'], 'string'],
            [['path_essay', 'path_project_map', 'path_competitive_test'], 'file'],

            [['video_1'], 'custom_function_validation_teacher_master','on'=>'add_work_teacher_master'],
//            [['path_competitive_test'], 'required','on'=>'add_work_round_second'],

            [['video_1'], 'custom_function_validation_teacher_leader','on'=>'add_work_teacher_leader'],
            [['video_1'], 'custom_function_validation_trade_union','on'=>'add_work_trade_union'],
            [['in_archive'], 'boolean'],
            [['update_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomination' => 'Номинация',
            'video_1' => 'Видеоролик',
            'essay' => 'Авторское эссе',
            'video_2' => 'Видеоролик',
            'project_map' => 'Карта проекта',
            'competitive_test' => 'Конкурсное испытание',

            'path_essay' => 'Авторское эссе',
            'path_project_map' => 'Карта проекта',
            'path_competitive_test' => 'Конкурсное испытание',
            'update_date' => 'Дата',
            'fio' => 'ФИО',
            'appoint_expert_array' => 'Назначить эксперта',
            'sum_appraisal' => 'Оценка',
        ];
    }

    function custom_function_validation_teacher_master($attribute)
    {
        if(($attribute == 'video_1') && $this->essay == '')
        {
            $this->addError('path_essay', 'Авторское эссе должна быть загружена');
            $this->essay = null;
        }

        if(($attribute == 'video_1') && $this->video_2 == '')
        {
            $this->addError('video_2', 'Необходимо заполнить «Видеоролик».');
            if($this->isNewRecord)
            {
                $this->essay = null;
            }

        }
    }

    function custom_function_validation_teacher_leader($attribute)
    {
        if(($attribute == 'video_1') && $this->essay == '')
        {
            $this->addError('path_essay', 'Авторское эссе должна быть загружена');
            if($this->isNewRecord)
            {
                $this->essay = null;
            }

        }
    }

    function custom_function_validation_trade_union($attribute)
    {
        if(($attribute == 'video_1') && $this->essay == '')
        {
            $this->addError('path_essay', 'Авторское эссе должна быть загружена');
            $this->essay = null;
            $this->project_map = null;
        }

        if(($attribute == 'video_1') && $this->project_map == '')
        {
            $this->addError('path_essay', 'Авторское эссе должна быть загружена');
            $this->addError('path_project_map', 'Карта проекта должна быть загружена');
            $this->essay = null;
            $this->project_map = null;
        }
    }
}
