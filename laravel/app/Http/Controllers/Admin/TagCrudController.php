<?php namespace App\Http\Controllers\Admin;


use App\Http\Requests\TagCrudRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class TagCrudController extends CrudController {

  use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

  public function setup() 
  {
      $this->crud->setModel("App\Models\Tag");
      $this->crud->setRoute("admin/tag");
      $this->crud->setEntityNameStrings('tag', 'tags');
  }

  public function setupListOperation()
  {
      $this->crud->setColumns(['name']);
  }

  public function setupCreateOperation()
  {
      $this->crud->setValidation(TagCrudRequest::class);

      $this->crud->addField([
        'name' => 'name',
        'type' => 'text',
        'label' => "Tag name"
      ]);
      
  }

  public function setupUpdateOperation()
  {
      $this->setupCreateOperation();
  }

}