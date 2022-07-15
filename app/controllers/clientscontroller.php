<?php

namespace PHPMVC\Controllers;

use PHPMVC\Lib\Messenger;
use PHPMVC\Models\clientModel;

class ClientsController extends AbstractController
{
    private $_createActionRoles = 
    [
        'Name'          => 'req|alpha|between(3,40)',
        'Email'         => 'req|email',
        'PhoneNumber'   => 'req|alphanum|max(15)',
        'Address'       => 'req|address|max(50)'
    ];

    public function defaultAction(): void
    {
        $this->language->load('template.common');
        $this->language->load('clients.default');
        $this->_data['clients'] = ClientModel::getAll();
        $this->_view();
    }

    public function createAction(): void
    {
        $this->language->load('template.common');
        $this->language->load('clients.create');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validation.errors');
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $client = new ClientModel();
            $client->Name = $this->filterString($_POST['Name']);
            $client->Email = $this->filterString($_POST['Email']);
            $client->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $client->Address = $this->filterString($_POST['Address']);

            // if (clientModel::clientExists($client->clientName)){
            //     $this->messenger->add($this->language->get('message_client_exists'), Messenger::APP_MESSAGE_ERROR);
            //     $this->redirect('/Clients/create');
            // } elseif (clientModel::emailExists($client->Email)){
            //     $this->messenger->add($this->language->get('message_email_exists'), Messenger::APP_MESSAGE_ERROR);
            //     $this->redirect('/Clients/create');
            // } elseif (clientModel::phoneNumberExists($client->PhoneNumber)){
            //     $this->messenger->add($this->language->get('message_phone_number_exists'), Messenger::APP_MESSAGE_ERROR);
            //     $this->redirect('/Clients/create');
            // }

            if ($client->save()){
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/clients');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function editAction(): void
    {
        $id = $this->filterInt($this->_params[0]);

        $client = clientModel::getByKey($id);
        
        if($client === false){
            $this->redirect('/clients');
        }

        $this->_data['client'] = $client;

        $this->language->load('template.common');
        $this->language->load('clients.edit');
        $this->language->load('clients.labels');
        $this->language->load('clients.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
           
            $client->Name = $this->filterString($_POST['Name']);
            $client->Email = $this->filterString($_POST['Email']);
            $client->PhoneNumber = $this->filterString($_POST['PhoneNumber']);
            $client->Address = $this->filterString($_POST['Address']);

            if($client->save()){
                $this->messenger->add($this->language->get('message_edit_success'));
                $this->redirect('/clients');
            } else {
                $this->messenger->add($this->language->get('message_edit_failed'), Messenger::APP_MESSAGE_ERROR);
            }
        }

        $this->_view();
    }

    public function deleteAction(): void
    {
        $id = $this->filterInt($this->_params[0]);

        $client = clientModel::getByKey($id);

        if($client === false){
            $this->redirect('/clients');
        }

        $this->language->load('clients.messages');

        if ($client->delete()){
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed', Messenger::APP_MESSAGE_ERROR), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/clients');
    }
}