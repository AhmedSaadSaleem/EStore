<?php

namespace PHPMVC\Models;

class ArticleModel extends AbstractModel
{
    public $id;
    public $articleTitle;
    public $articleText;
    public $articleAuthor;
    public $date;

    protected static $tableName = 'app_articles';

    protected static $tableSchema = array(
        'id'            => self::DATA_TYPE_INT,
        'articleTitle'  => self::DATA_TYPE_STR,
        'articleText'   => self::DATA_TYPE_STR,
        'articleAuthor' => self::DATA_TYPE_INT,
        'date'          => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'id';

    public function getAuthor(): string
    {
        $author = UserModel::getByKey($this->articleAuthor);
        $authorName = $author->UserName;
        return $authorName;
    }
}