<?php

namespace PHPMVC\Controllers;

use Exception;
use PHPMVC\Lib\FileUpload;
use PHPMVC\Lib\Messenger;
use PHPMVC\Models\ProductCategoryModel;

class ProductCategoriesController extends AbstractController
{
    private $_createActionRoles = 
    [
        'Name'     => 'req|alphanum|between(3,30)'
    ];

    public function defaultAction(): void
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.default');
        $this->_data['categories'] = ProductCategoryModel::getAll();
        $this->_view();
    }

    public function createAction(): void
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.create');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $uploadError = false;
            $category = new ProductCategoryModel();
            $category->Name = $this->filterString($_POST['Name']);
            if(!empty($_FILES['Image']['name'])){
                $uploader = new FileUpload($_FILES['Image']);
                try{
                    $uploader->upload();
                    $category->Image = $uploader->getFileName();
                } catch(Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }
            if($uploadError === false){
                if($category->save()){
                    $this->messenger->add($this->language->get('message_create_success'));
                    $this->redirect('/productcategories');
                } else {
                    $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            }
            
        }
        
        $this->_view();
    }

    public function editAction(): void
    {
        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByKey($id);

        if($category === false){
            $this->redirect('/productcategories');
        }

        $this->language->load('template.common');
        $this->language->load('productcategories.edit');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        $this->_data['category'] = $category;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST)){
            $uploadError = false;
            $category->Name = $this->filterString($_POST['Name']);
            if(!empty($_FILES['Image']['name'])){
                if($category->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $category->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                        unlink(IMAGES_UPLOAD_STORAGE . DS . $category->Image);
                }
                $uploader = new FileUpload($_FILES['Image']);
                try{
                    $uploader->upload();
                    $category->Image = $uploader->getFileName();
                } catch(Exception $e) {
                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);
                    $uploadError = true;
                }
            }

            if($uploadError === false){
                if($category->save()){
                    $this->messenger->add($this->language->get('message_edit_success'));
                    $this->redirect('/productcategories');
                } else {
                    $this->messenger->add($this->language->get('message_edit_failed'), Messenger::APP_MESSAGE_ERROR);
                }
            }
        }
        
        $this->_view();
    }

    public function deleteAction(): void
    {
        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByKey($id);

        if($category === false){
            $this->redirect('/productcategories');
        } 

        $this->language->load('productcategories.messages');

        if($category->delete()){
            if($category->Image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $category->Image) && is_writable(IMAGES_UPLOAD_STORAGE)){
                unlink(IMAGES_UPLOAD_STORAGE . DS . $category->Image);
            } else 
            {
                $this->messenger->add('Sorry the destination folder is not writable', Messenger::APP_MESSAGE_ERROR);
            }
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/productcategories');
    }
}