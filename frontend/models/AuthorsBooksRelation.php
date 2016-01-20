<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors_books_relation".
 *
 * @property integer $id
 * @property integer $id_author
 * @property integer $id_book
 *
 * @property Authors $idAuthor
 * @property Books $idBook
 */
class AuthorsBooksRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors_books_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_author', 'id_book'], 'required'],
            [['id_author', 'id_book'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_author' => 'Id Author',
            'id_book' => 'Id Book',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'id_author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'id_book']);
    }
}
