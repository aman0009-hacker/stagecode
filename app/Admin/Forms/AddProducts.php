<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\DB;


class AddProducts extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $csrfToken = $request->cookie('XSRF-TOKEN');
        if ($csrfToken) {
            $validatedData = $request->validate([
                'product' => 'required',
                'category' => 'required',
                'entity' => 'required',
                'size' => 'required',
            ]);
            $productName = $validatedData['product'];
            $categoryName = $validatedData['category'];
            $entityName = $validatedData['entity'];
            $size = $validatedData['size'];

            // Begin the database transaction
            DB::beginTransaction();
            try {
                // Create a new product
                $product = new Product();
                $product->name = $productName;
                $product->save();
                // Create a new category
                $category = new Category();
                $category->name = $categoryName;
                $category->category_id = $product->id;
                $category->save();
                // Create a new entity
                $entity = new Entity();
                $entity->name = $entityName;
                $entity->size = $size;
                $entity->entity_id = $category->id; // Assign the category ID
                $entity->save();
                // Commit the transaction
                DB::commit();
                // Success message
                admin_success('Data saved successfully.');
                return back();
            } catch (\Exception $e) {
                // If an exception occurs, rollback the transaction
                DB::rollback();

                // Error message
                admin_error('Failed to save data.');

                return back();
            }
        }
        return back();
    }

    /**
     * Build the form.
     */
    public function form()
    {
        $this->method('POST');
        $this->text('product')->rules('required');
        $this->text('category')->rules('required');
        $this->text('entity')->rules('required');
        $this->text('size')->rules('required');

    }

    /**
     * Get the form data.
     *
     * @return array
     */
    public function data()
    {
        return [];
    }


}