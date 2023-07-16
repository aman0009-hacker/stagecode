<?php


namespace App;
use Encore\Admin\Grid\Filter\Like;

class CustomLikeFilter extends Like
{
    public function __construct($column, $label = '')
    {
        parent::__construct($column, $label);
    }

    public function condition($inputs)
    {
        $this->query->where($this->column, 'like', '%' . $inputs . '%');
    }
}




?>
