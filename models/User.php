<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $email;
    public $password;
    public $second_name;
    public $first_name;
    public $third_name;
    public $role;
    public $in_archive;
    public $image;



    public $phone;
    public $age;
    public $school;
    public $position;
    public $subject_taught;
    public $hours_in_week;
    public $additional_load;
    public $total_work_experience;
    public $teaching_experience;
    public $have_mentor;
    public $relatives_in_education;
    public $which_of_relatives;
    public $union_member;
    public $union_card_number;
    public $council_young_teachers;
    public $your_district_young_educators_council;
    public $metropolitan_association_young_teachers;
    public $full_name_university;
    public $abbreviated_name_university;
    public $specialty;
    public $hobby;
    public $credo;
    public $purpose_participation;
    public $team_name;
    public $fio_captain;
    public $composition_team;
    public $i_agree_data_processing;
    public $second_round;
    public $nomination;


    public $authKey;
    public $accessToken;

    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = Users::find()->where(['id'=>$id])->one();
        return isset($user) ? new static($user->getAttributes()) : null;
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }
    /**
     * {@inheritdoc}
     */
    public static function findByEmail($email)
    {
        $user = Users::find()->where(['email'=>$email])->one();

        if($user)
        {
            return new static($user->getAttributes());
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
//    public static function findByUsername($username)
//    {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }
//
//        return null;
//    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return  password_verify($password, $this->password);  //  $this->password === $password;
    }
}
