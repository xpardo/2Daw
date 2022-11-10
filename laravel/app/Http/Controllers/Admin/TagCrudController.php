<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\TagCrudRequest;

class TagCrudController extends CrudController {

  use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
  use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

  public function setup() 
  {
      $this->crud->setModel("App\Models\Tag");
      $this->crud->setRoute("admin/tag");
      $this->crud->setEntityNameStrings('tag', 'tags');
  }

  public function setupListOperation()
  {
      $this->crud->setColumns(['name', 'slug']);
  }

  public function setupCreateOperation()
  {
      $this->crud->setValidation(TagCrudRequest::class);

      $this->crud->addField([
        'name' => 'name',
        'type' => 'text',
        'label' => "Tag name"
      ]);
      $this->crud->addField([
        'name' => 'slug',
        'type' => 'text',
        'label' => "URL Segment (slug)"
      ]);
  }

  public function setupUpdateOperation()
  {
      $this->setupCreateOperation();
  }

}