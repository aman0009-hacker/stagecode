<?php


namespace App;

use Encore\Admin\Actions\RowAction;

class ApproveByAdminAction extends RowAction
{
    public function render()
    {
    return <<<HTML
    <form class="my-custom-action" action="/admin/auth/handle-action" method="POST">
        <input type="hidden" name="id" value="{$this->getKey()}">
        <button type="submit">Approved</button>
    </form>
    HTML;
    }
    public function action()
    {
       return $this->response()->success('Action handled successfully!')->refresh();
    }

    public function handle()
    {
      return $this->response()->success('Action handled successfully!')->refresh();
    }
}


?>