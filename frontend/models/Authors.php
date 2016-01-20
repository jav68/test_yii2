<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property AuthorsBooksRelation[] $authorsBooksRelations
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorsBooksRelations()
    {
        return $this->hasMany(AuthorsBooksRelation::className(), ['id_author' => 'id']);
    }

    /**
     * @return array
     */
    public static function listAll()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),
            'id',
            function ($element) {
                return $element['firstname'] . ' '. $element['lastname'];
            }
        );
    }
}
