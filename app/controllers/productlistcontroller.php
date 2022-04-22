<?php

namespace PHPMVC\Controllers;

use Exception;
use PHPMVC\Lib\FileUpload;
use PHPMVC\Lib\Messenger;
use PHPMVC\Models\ProductCategoryModel;
use PHPMVC\Models\ProductModel;

class ProductListController extends AbstractController
{
    private $_createActionRoles = 
    [
        'Name'           => 'req|alphanum|between(3,50)',
        'CategoryId'     => 'req|num',
        'Quantity'       => 'req|num',
        'BuyPrice'       => 'req|num',
        'SellPrice'      => 'req|num',
        'Unit'           => 'req|num'
    ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.default');
        $this->_data['products'] = ProductModel::getAll();
        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.create');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){

            $uploadError = false;

            $product = new ProductModel();
            $product->Name = $this->filterString($_POST['Name']);
            $product->CategoryId = $this->filterInt($_POST['CategoryId']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
            $product->SellPrice = $this->filterFloat($_POST['SellPrice']);
            $product->Unit = $this->filterInt($_POST['Unit']);



            if(!empty($_FILES['Image']['name'])){
                $uploader = new FileUpload($_FILES['Image']);
                try{
                    $uploader->upload();
                    $product->Image = $uploader->getFileName();
                } catch(Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            
            if($uploadError === false){
                if($product->save()){
                    $this->messenger->add($this->language->get('message_create_success'));
                    $this->redirect('/productlist');
                } else {
                    $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            }
            
        }
        
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $product = ProductModel::getByKey($id);

        if($product === false){
            $this->redirect('/productlist');
        }

        $this->language->load('template.common');
        $this->language->load('productlist.create');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');

        $this->_data['product'] = $product;
        $this->_data['categories'] = ProductCategoryModel::getAll();

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){

            $uploadError = false;

            $product->Name = $this->filterString($_POST['Name']);
            $product->CategoryId = $this->filterInt($_POST['CategoryId']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
            $product->SellPrice = $this->filterFloat($_POST['SellPrice']);
            $product->Unit = $this->filterInt($_POST['Unit']);
            
            if(!empty($_FILES['Image']['name'])){
                if($product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                        unlink(IMAGES_UPLOAD_STORAGE . DS . $product->Image);
                }
                $uploader = new FileUpload($_FILES['Image']);
                try{
                    $uploader->upload();
                    $product->Image = $uploader->getFileName();
                } catch(Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }

            if($uploadError === false){
                if($product->save()){
                    $this->messenger->add($this->language->get('message_edit_success'));
                    $this->redirect('/productlist');
                } else {
                    $this->messenger->add($this->language->get('message_edit_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            }
        }
        
        $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $product = ProductModel::getByKey($id);

        if($product === false){
            $this->redirect('/productlist');
        } 

        $this->language->load('productlist.messages');

        if($product->delete()){
            if($product->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                unlink(IMAGES_UPLOAD_STORAGE . DS . $product->Image);
            } else 
            {
                $this->messenger->add('Sorry the destination folder is not writable', Messenger::APP_MESSAGE_ERROR);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/productlist');
    }
}