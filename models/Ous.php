<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "ous".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $short_name
 * @property string $primary_address
 * @property string $email
 * @property string $website
 * @property string $director
 * @property integer $area_id
 * @property integer $type_id
 * @property integer $vid_id
 * @property integer $uprava_id
 * @property integer $number_ou
 * @property integer $id_eo
 * @property integer $arhiv
 *
 * @property EventUsers[] $eventUsers
 * @property Area $area
 * @property Type $type
 * @property Uprava $uprava
 * @property Vid $vid
 * @property SchoolsTopLinks[] $schoolsTopLinks
 * @property IndustryUserData[] $industryUserDatas
 * @property SocialmapRouteInfo[] $socialmapRouteInfos
 * @property Users[] $users
 * @property Places[] $places
 */
class Ous extends \yii\db\ActiveRecord
{

    /**
     * @return CDbConnection the database connection used for this class
     */
    public static function getDb() {
        return \Yii::$app->db2;
    }

    const SQL_QUERY = ' AND short_name NOT LIKE \'Ф%\' AND (number_ou NOT IN (1739) OR number_ou IS NULL) ';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ous';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name'], 'required'],
            [['full_name', 'short_name', 'primary_address', 'email', 'website', 'director'], 'string'],
            [['area_id', 'type_id', 'vid_id', 'uprava_id', 'number_ou', 'id_eo', 'arhiv'], 'integer'],
            [['id_eo'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'short_name' => 'Short Name',
            'primary_address' => 'Primary Address',
            'email' => 'Email',
            'website' => 'Website',
            'director' => 'Director',
            'area_id' => 'Area ID',
            'type_id' => 'Type ID',
            'vid_id' => 'Vid ID',
            'uprava_id' => 'Uprava ID',
            'number_ou' => 'Number Ou',
            'id_eo' => 'Id Eo',
            'arhiv' => 'Arhiv',
        ];
    }

}
