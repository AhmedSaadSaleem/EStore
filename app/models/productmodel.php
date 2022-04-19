<?php

namespace PHPMVC\Models;

class ProductModel extends AbstractModel
{
    public $ProductId;
    public $CategoryId;
    public $Name;
    public $Image;
    public $Quantity;
    public $Price;
    public $Unit;
    public $BarCode;

    protected static $tableName = 'app_products_list';
    
    protected static $tableSchema = array(
        'ProductId'       => self::DATA_TYPE_INT,
        'CategoryId'      => self::DATA_TYPE_INT,
        'Name'            => self::DATA_TYPE_STR,
        'Image'           => self::DATA_TYPE_STR,
        'Quantity'        => self::DATA_TYPE_INT,
        'Price'           => self::DATA_TYPE_DECIMAL,
        'Unit'            => self::DATA_TYPE_INT,
        'BarCode'         => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'ProductId';
}