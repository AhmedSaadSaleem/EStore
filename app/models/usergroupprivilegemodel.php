<?php

namespace PHPMVC\Models;

class UserGroupPrivilegeModel extends AbstractModel
{
    public $Id;
    public $GroupId;
    public $PrivilegeId;

    protected static $tableName = 'app_users_groups_privileges';
    
    protected static $tableSchema = array(
        'Id'            => self::DATA_TYPE_INT,
        'GroupId'       => self::DATA_TYPE_INT,
        'PrivilegeId'   => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'Id';

    public static function getGroupPrivileges(UserGroupModel $group)
    {
        $groupPrivileges = self::getBy(['GroupId' => $group->GroupId]);
        $extractedPrivilegesIds = [];
        
        if($groupPrivileges !== false){
            foreach($groupPrivileges as $privilege){
                $extractedPrivilegesIds[] = $privilege->PrivilegeId;
            }
        }
        return $extractedPrivilegesIds;
    }

    public static function getPrivilegesForGroup($groupId)
    {
        $sql = 'SELECT augp.*, aup.Privilege FROM ' . self::$tableName . ' augp '; 
        $sql .= 'INNER JOIN app_users_privileges aup ON aup.PrivilegeId = augp.PrivilegeId WHERE GroupId = "' . $groupId . '"';
        $privileges = self::get($sql);
        $extractedUrls = [];
        if(false != $privileges){
            foreach($privileges as $privilege){
                $extractedUrls[] = $privilege->Privilege;
            }
        }
        return $extractedUrls;
    }
}