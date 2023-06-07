<?php

//namespace App\Admin\Grid\Displayers;
namespace App;

use Encore\Admin\Grid\Displayers\AbstractDisplayer;
Use Illuminate\Support\Facades\Config;

class PdfDisplayer extends AbstractDisplayer
{
    public function display($link = null)
    {
        // $fileExtension=pathinfo(basename(asset($this->value), PATHINFO_EXTENSION)) ?? 'not found';
        $url = "";
        $baseNameFile = basename(asset($this->value));
        $ExtensionInfoName = pathinfo($baseNameFile, PATHINFO_EXTENSION);
        if (isset($ExtensionInfoName) && !empty($ExtensionInfoName) && ($ExtensionInfoName == "png" || $ExtensionInfoName == "jpg")) {
           // $url = "http://localhost:8000/" . "uploads/" . basename(asset($this->value));
           $url = Config::get('app.url') . "uploads/" . basename(asset($this->value));
            $label = trans('admin.view');
            return "<a href=\"{$url}\" target=\"_blank\" class=\"btn btn-xs btn-primary\"><i class=\"fa fa-file\"></i> {$baseNameFile}</a>";
        } else {

        }
    }
}


?>