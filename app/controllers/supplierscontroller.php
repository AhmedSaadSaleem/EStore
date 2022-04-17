<?php

namespace PHPMVC\Controllers;

use PHPMVC\Lib\Messenger;
use PHPMVC\Models\SupplierModel;

class SuppliersController extends AbstractController
{
    private $_createActionRoles = 
    [
        'Name'          => 'req|alpha|between(3,40)',
        'Email'         => 'req|email',
        'PhoneNumber'   => 'req|alphanum|max(15)',
        'Address'       => 'req|address|max(50)'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('suppliers.default');
        $this->_data['suppliers'] = SupplierModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('suppliers.create');
        $this->language->load('suppliers.labels');
        $this->language->load('suppliers.messages');
        $this->language->load('validation.errors');
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $supplier = new SupplierModel();
            $supplier->Name = $this->filterString($_POST['Name']);
            $supplier->Email = $this->filterString($_POST['Email']);
            $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $supplier->Address = $this->filterString($_POST['Address']);

            // if (SupplierModel::supplierExists($supplier->supplierName)){
            //     $this->messenger->add($this->language->get('message_supplier_exists'), Messenger::APP_MESSAGE_ERROR);
            //     $this->redirect('/suppliers/create');
            // } elseif (SupplierModel::emailExists($supplier->Email)){
            //     $this->messenger->add($this->language->get('message_email_exists'), Messenger::APP_MESSAGE_ERROR);
            //     $this->redirect('/suppliers/create');
            // } elseif (SupplierModel::phoneNumberExists($supplier->PhoneNumber)){
            //     $this->messenger->add($this->language->get('message_phone_number_exists'), Messenger::APP_MESSAGE_ERROR);
            //     $this->redirect('/suppliers/create');
            // }

            if ($supplier->save()){
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/suppliers');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);

        $supplier = SupplierModel::getByKey($id);
        
        if($supplier === false){
            $this->redirect('/suppliers');
        }

        $this->_data['supplier'] = $supplier;

        $this->language->load('template.common');
        $this->language->load('suppliers.edit');
        $this->language->load('suppliers.labels');
        $this->language->load('suppliers.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
           
            $supplier->Name = $this->filterString($_POST['Name']);
            $supplier->Email = $this->filterString($_POST['Email']);
            $supplier->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $supplier->Address = $this->filterString($_POST['Address']);

            if($supplier->save()){
                $this->messenger->add($this->language->get('message_edit_success'));
                $this->redirect('/suppliers');
            } else {
                $this->messenger->add($this->language->get('message_edit_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);

        $supplier = SupplierModel::getByKey($id);

        if($supplier === false){
            $this->redirect('/suppliers');
        }

        $this->language->load('suppliers.messages');

        if ($supplier->delete()){
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/suppliers');
    }
}