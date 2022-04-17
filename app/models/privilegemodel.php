<?php

namespace PHPMVC\Models;

class PrivilegeModel extends abstractModel
{

    public $PrivilegeId;
    public $PrivilegeTitle;
    public $Privilege;

    protected static $tableName = 'app_users_privileges';
    
    protected static $tableSchema = array(
        'PrivilegeId'       => self::DATA_TYPE_INT,
        'PrivilegeTitle'    => self::DATA_TYPE_STR,
        'Privilege'         => self::DATA_TYPE_STR,
    );

    protected static $primaryKey = 'PrivilegeId';
}