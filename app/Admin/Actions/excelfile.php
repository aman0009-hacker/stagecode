<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Entity;
use Illuminate\Support\Facades\Log;

class excelfile extends Action
{
    protected $selector = '.excelfile';

    public function handle(Request $request)
    {
        try {
            $excelfile = $request->file('file');
            if (!$excelfile) {
                return $this->response()->error('Please select any file')->refresh();
            }
            $ext = $excelfile->getClientOriginalExtension();
            if ($ext === 'csv') {
                $data = fopen($excelfile, 'r');
                $array = array();
                $transRow = true;
                while (($content = fgetcsv($data, 2000, ',')) !== false) {
                    if (!$transRow) {
                        $array[] = $content;
                    } elseif (strtoupper($content[0]) == strtoupper('Product') && strtoupper($content[1]) == strtoupper('category') && strtoupper($content[2]) == strtoupper('subcategory') && strtoupper($content[3]) == strtoupper('description')) {
                        $transRow = false;
                    } else {
                        return $this->response()->error('Please give the coloumns in following way: Product,category,subcategory,dimension')->refresh();
                    }
                }
                fclose($data);
                foreach ($array as $value) {
                    $catego = category::where('name', $value[1])->exists();
                    if ($catego) {
                        continue;
                    } else {
                        $catall = product::all();
                        foreach ($catall as $single) {
                            if (strtoupper($single->name) == strtoupper($value[0])) {
                                //
                                category::create([
                                    "name" => $value[1],
                                    "category_id" => $single->id
                                ]);
                            }
                        }
                    }
                }
                foreach ($array as $sub) {
                    $catego = entity::where('name', $sub[2])->exists();
                    if ($catego) {
                        continue;
                    } else {
                        $catall = category::all();
                        foreach ($catall as $subid) {
                            if (strtoupper($subid->name) == strtoupper($sub[1])) {
                                if ($sub[3] == "") {
                                    entity::create([
                                        "name" => $sub[2],
                                        "entity_id" => $subid->id,
                                    ]);
                                } else {
                                    entity::create([
                                        "name" => $sub[2],
                                        "description" => $sub[3],
                                        "entity_id" => $subid->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
                return $this->response()->success('Success message...')->refresh();
            } else {
                return $this->response()->error('Only support csv files')->refresh();
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }
    public function form()
    {
        $this->file('file', 'Select the file');
    }
    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-primary excelfile"><svg xmlns="http://www.w3.org/2000/svg" style="width:24px;vertical-align:-2px;"height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-167l80 80c9.4 9.4 24.6 9.4 33.9 0l80-80c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-39 39V184c0-13.3-10.7-24-24-24s-24 10.7-24 24V318.1l-39-39c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9z"/></svg>Import Excel to DB</a>
HTML;
    }
}