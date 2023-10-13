<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class YardMgmt extends Form
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
        $validatedData = $request->validate([
            'product_id' => 'required',
            'category_id' => 'required',
        ]);
        $product_id = $validatedData['product_id'];
        $category_id = $validatedData['category_id'];
        admin_success('Processed successfully.');
        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->select('product_id', 'Product')
            ->options(function () {
                // Retrieve the products from the database
                $products = \App\Models\Product::pluck('name', 'id');
                // Add a placeholder option
                $products->prepend('-- Select Product --', '');
                return $products;
            })
            ->rules('required')->load('category_id', '/admin/load-categories');
        $this->select('category_id', 'Category')->rules('required')->load('entity_id', '/admin/load-entities');
        $this->select('entity_id', 'Entity')->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
        ];
    }
}