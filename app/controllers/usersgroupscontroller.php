<?php

namespace PHPMVC\Controllers;

use PHPMVC\Lib\Messenger;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class UsersGroupsController extends AbstractController
{
    private $_createActionRoles = 
    [
        'GroupName' => 'req|alphanum|between(3,30)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.default');
        $this->_data['groups'] = UserGroupModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.create');
        $this->language->load('usersgroups.labels');
        $this->language->load('usersgroups.messages');
        $this->language->load('validation.errors');

        $this->_data['privileges'] = PrivilegeModel::getAll();

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $group = new UserGroupModel();
            $group->GroupName = $this->filterString($_POST['GroupName']);

            if($group->save()){
                
                if(isset($_POST['Privileges']) && is_array($_POST['Privileges'])){
                    foreach($_POST['Privileges'] as $privilegeId){
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/usersgroups');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }
        
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByKey($id);

        if($group === false){
            $this->redirect('/usersgroups');
        }

        $this->language->load('template.common');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');
        $this->language->load('usersgroups.messages');
        $this->language->load('validation.errors');

        $this->_data['group'] = $group;
        $this->_data['privileges'] = PrivilegeModel::getAll();

        $extractedPrivilegesIds = UserGroupPrivilegeModel::getGroupPrivileges($group);
        $this->_data['groupPrivileges'] = $extractedPrivilegesIds;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){

            $group->GroupName = $this->filterString($_POST['GroupName']);
            if($group->save()){

                if(isset($_POST['Privileges']) && is_array($_POST['Privileges'])){

                    $PrivilegesToBeDeleted = array_diff($extractedPrivilegesIds, $_POST['Privileges']);
                    $PrivilegesToBeAdded = array_diff($_POST['Privileges'], $extractedPrivilegesIds);
                
                    // Delete the unwanted privileges
    
                    foreach($PrivilegesToBeDeleted as $deletedPrivilege){
                        $unwantedPrivilege = UserGroupPrivilegeModel::getBy(['GroupId' => $group->GroupId, 'PrivilegeId' => $deletedPrivilege]);
                        array_shift($unwantedPrivilege)->delete();
                    }
    
                    // Add the new privileges
                    
                    foreach($PrivilegesToBeAdded as $privilegeId){
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupId = $group->GroupId;
                        $groupPrivilege->PrivilegeId = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
                $this->messenger->add($this->language->get('message_edit_success'));
                $this->redirect('/usersgroups');
            } else {
                $this->messenger->add($this->language->get('message_edit_failed'), Messenger::APP_MESSAGE_ERROR); 
            }
        }
        
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByKey($id);

        if($group === false){
            $this->redirect('/usersgroups');
        } 

        $this->language->load('usersgroups.messages');

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['GroupId' => $group->GroupId]);
        
        if($groupPrivileges !== false){
            foreach($groupPrivileges as $groupPrivilege){
                $groupPrivilege->delete();
            }
        }

        if($group->delete()){
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/usersgroups');
    }
}