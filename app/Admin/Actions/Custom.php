<?php

namespace App\Admin\Button;

use Encore\Admin\Grid\Tools\AbstractTool;

class CustomButton extends AbstractTool
{
    protected function script()
    {
        // You can include any JavaScript logic here if needed
    }

    public function render()
    {
        $this->script = <<<EOT
            // JavaScript code for your button behavior (if any)
        EOT;

        return "<button class='btn btn-sm btn-primary' data-action='custom-action'>Custom Button</button>";
    }
}