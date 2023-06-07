<?php


namespace App;

use Encore\Admin\Actions\RowAction;

class ApproveByAdminAction extends RowAction
{
    public function render()
    {
        //$this->row->update(['approved' => true]);
       //return "<a href='#'>Approved</a>";
        // Return the HTML markup for the action item with a form
    return <<<HTML
    <form class="my-custom-action" action="/admin/auth/handle-action" method="POST">
        <input type="hidden" name="id" value="{$this->getKey()}">
        <button type="submit">Approved</button>
    </form>
    HTML;
//     $this->addScript("
//     $('.my-custom-action').click(function (event) {
//         event.preventDefault();

//         // Add your custom logic here
//         console.log('Custom action clicked!');
//     });
// ");
// return "<a href='#' class='my-custom-action'>My Custom Action</a>";
// // Return the HTML markup for the action item

    }
    // public function handle(Request $request)
    // {
    //     // Perform the logic for the action
    //     // Update database records, send notifications, etc.
    //     // Return a response to show a success message
    //     // $this->row->update(['approved' => true]);
    //     // return $this->response()->success('Action handled successfully!')->refresh();
    //     // Retrieve the necessary data from the request (e.g., $id)
    // $id = $request->input('id');

    // // Perform the logic for the action
    // // Update database records, send notifications, etc.

    // // Return a response
    // return response()->json(['success' => true]);
    // }

    public function action()
    {
        // Perform the logic for the action
        // Update database records, send notifications, etc.

        // Redirect back or return a response
        return $this->response()->success('Action handled successfully!')->refresh();
    }

    public function handle()
    {
        // Perform the logic for the action
        // Update database records, send notifications, etc.

        // Redirect back or return a response
        return $this->response()->success('Action handled successfully!')->refresh();
    }
}


?>