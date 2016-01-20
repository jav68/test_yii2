<?php

namespace app\models;

use Yii;
use \yii\data\ActiveDataProvider;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $date
 * @property string $preview
 *
 * @property AuthorsBooksRelation[] $authorsBooksRelations
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date'], 'required'],
            [['date_create', 'date_update', 'date'], 'safe'],
            [['name', 'preview'], 'string', 'max' => 255],
            [['author_ids','relation_ids'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_create' => 'Added',
            'date_update' => 'Date Update',
            'date' => 'Publish date',
            'preview' => 'Preview',
            'author_ids' => 'Authors'
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => \common\components\ManyToManyBehavior::className(),
                'relations' => [
                    'author_ids' => 'authors',
                    'relation_ids' => 'relations'
                ],
            ],
        ];
}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelations()
    {
        return $this->hasMany(AuthorsBooksRelation::className(), ['id_book' => 'id']);
    }

    /**
     * @return $this
     */
    public function getAuthors(){
        return $this->hasMany(Authors::className(), ['id' => 'id_author'])
            ->viaTable(AuthorsBooksRelation::tableName(), ['id_book' => 'id']);
    }

    /**
     * @param $arr
     * @return string
     */
    public function strAuthors($arr) {

        $str = '';
        foreach($arr as $name) {
            $str .= $name->firstname. " ". $name->lastname .',';
        }

        return substr($str,0,-1);

    }

    /**
     * @param string $keyField
     * @param string $valueField
     * @param bool $asArray
     * @return mixed
     */
    public static function listAll($keyField = 'id', $valueField = 'name', $asArray = true)
    {
        $query = static::find();

        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);

    }
}
