<?php

namespace PHPMVC\Models;

class UserModel extends AbstractModel
{
    public $UserId;
    public $UserName;
    public $Password;
    public $Email;
    public $PhoneNumber;
    public $JoinDate;
    public $LastLogin;
    public $GroupId;
    public $Status;

    /**
     * @var UserProfileModel
     */
    public $profile;
    public $privileges;

    protected static $tableName = 'app_users';

    protected static $tableSchema = array(
        'UserId'        => self::DATA_TYPE_INT,
        'UserName'      => self::DATA_TYPE_STR,
        'Password'      => self::DATA_TYPE_STR,
        'Email'         => self::DATA_TYPE_STR,
        'PhoneNumber'   => self::DATA_TYPE_STR,
        'JoinDate'      => self::DATA_TYPE_DATE,
        'LastLogin'     => self::DATA_TYPE_STR,
        'GroupId'       => self::DATA_TYPE_INT,
        'Status'        => self::DATA_TYPE_INT
    );

    protected static $primaryKey = 'UserId';
    
    public function cryptPassword($Password)
    {
        $this->Password = crypt($Password, APP_SALT);
    }

    public static function getUsers(UserModel $user)
    {
        return self::get(
            'SELECT au.*, aug.GroupName GroupName From ' . self::$tableName . ' au INNER JOIN ' . UserGroupModel::getModelTableName() . ' aug ON aug.GroupId = au.GroupId WHERE au.UserID != "' . $user->UserId . '"' 
        );
    }

    public static function authenticate($userName, $password, $session)
    {
        $password = crypt($password, APP_SALT);
        $sql = 'SELECT *, (SELECT GroupName FROM ' . UserGroupModel::getModelTableName() . ' WHERE GroupId = ' . self::$tableName . '.GroupId) GroupName FROM ' . self::$tableName . ' WHERE UserName = "' . $userName . '" AND password = "' . $password . '"';
        $foundUser = self::getOne($sql);
        
        if(false !== $foundUser){
            if($foundUser->Status == 2){
                return 2;
            }
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByKey($foundUser->UserId);
            $foundUser->privileges = UserGroupPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId);
            $session->u = $foundUser;
            return 1;
        }
        return false;
    }

    public static function userExists($UserName)
    {
        return self::getBy(['UserName' => $UserName]);
    }

    public static function emailExists($Email)
    {
        return self::getBy(['Email' => $Email]);
    }

    public static function phoneNumberExists($PhoneNumber)
    {
        return self::getBy(['PhoneNumber' => $PhoneNumber]);
    }
}