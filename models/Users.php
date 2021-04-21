<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property int $role
 */
class Users extends \yii\db\ActiveRecord
{

    public $fio;
    public $new_password;
    public $repeat_password;

    public $path_image;

    const ROLE_ADMIN = '1';
    const ROLE_EXPERT = '2';
    const ROLE_PARTICIPANT = '3';

    public static $roles = [
        self::ROLE_ADMIN =>'Администратор',
        self::ROLE_EXPERT =>'Эксперт',
        self::ROLE_PARTICIPANT =>'Участник'
    ];

    public static $roles_register = [
        self::ROLE_PARTICIPANT =>'Участник',
        self::ROLE_EXPERT =>'Эксперт'
    ];

    public static $yes_or_no = [
        false =>'Нет',
        true =>'Да'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }


    public static $subject = [
        '1' => 'Алгебра',
        '2' => 'Английский язык',
        '3' => 'Астрономия',
        '4' => 'Биология',
        '5' => 'География',
        '6' => 'Геометрия',
        '7' => 'Граждановедение',
        '8' => 'Естествознание',
        '9' => 'Изобразительное искусство',
        '10' => 'Информатика',
        '11' => 'Испанский язык',
        '12' => 'История',
        '13' => 'Китайский язык',
        '14' => 'Литература',
        '15' => 'Математика',
        '16' => 'Мировая художественная культура',
        '17' => 'Музыка',
        '18' => 'Немецкий язык',
        '19' => 'Обучение грамоте',
        '20' => 'Обществоведение',
        '21' => 'Обществознание',
        '22' => 'Окружающий мир',
        '23' => 'Основы безопасности жизнедеятельности',
        '24' => 'Основы религиозных культур и светской этики',
        '25' => 'Природоведение',
        '26' => 'Родной язык',
        '27' => 'Русский язык',
        '28' => 'Технология',
        '29' => 'Труд',
        '30' => 'Физика',
        '31' => 'Физическая культура',
        '32' => 'Французский язык',
        '33' => 'Химия',
        '34' => 'Черчение',
        '35' => 'Чистописание',
        '36' => 'Чтение',
        '37' => 'Экология',
        '38' => 'Экономика',
        '39' => 'Другое',
    ];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'role', 'second_name', 'first_name', 'third_name'], 'required'],
            [['id', 'role', 'age', 'school', 'subject_taught', 'hours_in_week', 'additional_load', 'nomination'], 'integer'],

//            [['teaching_experience','total_work_experience'], 'integer', 'max' => 100],
            [['email', 'password', 'second_name', 'first_name', 'third_name', 'phone', 'position', 'which_of_relatives', 'union_card_number',
                'specialty','team_name','fio_captain','teaching_experience','total_work_experience'], 'string', 'max' => 255],
            [['image','full_name_university','abbreviated_name_university','hobby','credo','purpose_participation',
                'composition_team',], 'string'],

            [['new_password','repeat_password'],'custom_function_validation_chang_password','on'=>'change_password_user'],
            [['password','repeat_password'],'custom_function_validation_registration_user','on'=>'registration_user'],
            [['email'],'custom_function_validation_nomination_for_participant'],

            [['phone','age','school','position','subject_taught','hours_in_week','additional_load','total_work_experience','teaching_experience',
                'have_mentor','relatives_in_education','union_member','council_young_teachers','your_district_young_educators_council',
                'metropolitan_association_young_teachers','full_name_university','abbreviated_name_university','specialty','hobby','credo',
                'purpose_participation','i_agree_data_processing'],'required','on'=>'change_profile'],

            [['path_image'], 'file'],

            [['image','relatives_in_education','union_member','i_agree_data_processing'],'custom_function_validation_change_profile','on'=>'change_profile'],

            ['email', 'match', 'pattern' => '/(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,6})$/i', 'message' => 'Вы записали не корректный email'],
            [['email'], 'unique'],
            [['in_archive','have_mentor','relatives_in_education','union_member','council_young_teachers',
                'your_district_young_educators_council','metropolitan_association_young_teachers','i_agree_data_processing','second_round'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'role' => 'Роль',
            'in_archive' => 'Удалить пользователя',
            'fio' => 'ФИО',
            'second_name' => 'Фамилия',
            'first_name' => 'Имя',
            'third_name' => 'Отчество',
            'new_password' => 'Новый пароль',
            'repeat_password' => 'Повторите пароль',
            'phone' => 'Телефон',
            'age' => 'Возраст',
            'school' => 'Школа',
            'position' => 'Должность',
            'subject_taught' => 'Преподаваемый предмет',
            'hours_in_week' => 'Количество часов в неделю',
            'additional_load' => 'Дополнительная нагрузка',
            'total_work_experience' => 'Общий стаж работы',
            'teaching_experience' => 'Педагогический стаж работы',
            'have_mentor' => 'Есть ли у Вас наставник?',
            'relatives_in_education' => 'Работают (работали) Ваши родственники в системе образования?',
            'which_of_relatives' => 'Кто из родственников?',
            'union_member' => 'Являетесь ли членом Профсоюза?',
            'union_card_number' => 'Номер профсоюзного билета',
            'council_young_teachers' => 'Есть ли в Вашей организации Совет молодых педагогов?',
            'your_district_young_educators_council' => 'Принимаете ли Вы участие в мероприятиях проводимых Советом молодых педагогов вашего округа?',
            'metropolitan_association_young_teachers' => 'Принимаете ли Вы участие в мероприятиях проводимых Столичной ассоциацией молодых педагогов?',
            'full_name_university' => 'Полное название учебного заведения',
            'abbreviated_name_university' => 'Сокращенное название учебного заведения',
            'specialty' => 'Специальность по диплому',
            'hobby' => 'Ваше хобби',
            'credo' => 'Педагогическое кредо',
            'purpose_participation' => 'Цель участия в конкурсе',
            'team_name' => 'Название команды',
            'fio_captain' => 'ФИО капитана команды',
            'composition_team' => 'Состав команды',
            'i_agree_data_processing' => 'Согласен на обработку персональных данных',
            'path_image' => 'Фотография',
            'second_round' => 'Прошел во второй этап',
            'nomination' => 'Номинация при регистрации',
        ];
    }

    function custom_function_validation_chang_password($attribute)
    {
        if(($attribute == 'repeat_password' || $attribute == 'new_password') && $this->new_password != $this->repeat_password)
        {
            $this->addError($attribute, 'Пароли не совпадают');
        }
    }

    function custom_function_validation_registration_user($attribute)
    {
        if(($attribute == 'repeat_password' || $attribute == 'password') && $this->password != $this->repeat_password)
        {
            $this->addError($attribute, 'Пароли не совпадают');
        }
    }

    function custom_function_validation_nomination_for_participant($attribute)
    {
        if($this->role == self::ROLE_PARTICIPANT && (int)$this->nomination == 0)
        {
            $this->addError('nomination', 'Вы должны выбрать номинацию при регистрации');
        }
    }

    function custom_function_validation_change_profile($attribute)
    {
        if(($attribute == 'image') && $this->image == '/')
        {
            $this->addError('path_image', 'Фотография должна быть загружена');
            $this->image = null;
        }

        if(($attribute == 'relatives_in_education') && $this->which_of_relatives == '' && $this->relatives_in_education == true)
        {
            $this->addError('which_of_relatives', 'Необходимо заполнить «Кто из родственников?».');
        }

        if(($attribute == 'union_member') && $this->union_card_number == '' && $this->union_member == true)
        {
            $this->addError('union_card_number', 'Необходимо заполнить «Номер профсоюзного билета».');
        }

        if(($attribute == 'i_agree_data_processing') && $this->i_agree_data_processing == false)
        {
            $this->addError('i_agree_data_processing', 'Необходимо дать согласие на обработку персональных данных');
        }
    }
}
