<?php

namespace PHPMVC\Controllers;

use PHPMVC\Lib\Messenger;
use PHPMVC\Models\PrivilegeModel;
use PHPMVC\Models\UserGroupPrivilegeModel;

class PrivilegesController extends AbstractController
{
    private $_createActionRoles = 
    [
        'PrivilegeTitle'     => 'req|alphanum|between(3,30)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.default');
        $this->_data['privileges'] = PrivilegeModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.create');
        $this->language->load('privileges.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $privilege = new PrivilegeModel();
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);

            if($privilege->save()){
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/privileges');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params['0']);

        $privilege = PrivilegeModel::getByKey($id);

        if($privilege === false){
            $this->redirect('/privileges');
        } else {
            $this->_data['privilege'] = $privilege;
        }

        $this->language->load('template.common');
        $this->language->load('privileges.labels');
        $this->language->load('privileges.edit');
        $this->language->load('privileges.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $privilege->PrivilegeTitle = $this->filterString($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterString($_POST['Privilege']);

            if($privilege->save()){
                $this->messenger->add($this->language->get('message_edit_success'));
                $this->redirect('/privileges');
            } else {
                $this->messenger->add($this->language->get('message_edit_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params['0']);

        $privilege = PrivilegeModel::getByKey($id);

        if($privilege === false){
            $this->redirect('/privileges');
        } 
        
        $this->language->load('privileges.messages');

        $groupPrivileges = UserGroupPrivilegeModel::getBy(['PrivilegeId' => $privilege->PrivilegeId]);

        if($groupPrivileges !== false){
            foreach($groupPrivileges as $groupPrivilege){
                $groupPrivilege->delete();
            }
        }

        if($privilege->delete()){
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/privileges');
    }
}