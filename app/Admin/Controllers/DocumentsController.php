<?php

namespace App\Admin\Controllers;


use App\Admin\Actions\Download;
use App\Models\Document;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\PdfDisplayer;
use App\Admin\Actions\Rejected;
use App\Admin\Actions\Data;
use Illuminate\Support\Facades\DB;

class DocumentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Document';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Document());
        $grid->column('id', __('Name'))->display(function ($data) {
            $queryName = DB::table('users')->join('documents', 'users.id', '=', 'documents.id')->where('documents.id', $data)
                ->select('users.name', 'users.last_name')->first();
            $fullname = $queryName->name;
            return $fullname;
        });
        $grid->column('userid', __('UserId'));
        $grid->column('gstcard', __('GstCardNo'));
        $grid->column('msmecard', __('MsmeCardNo'));
        $grid->column('itrcard', __('ItrCardNo'));
        $grid->column('aadharcard', __('AadharCardNo'));
        $grid->column('pancard', __('PanCardNo'));
        $grid->column('utilitycard', __('UtilityCardNo'));
        $grid->column('gstcardpath', __('GstFile'))->displayUsing(PdfDisplayer::class);
        $grid->column('msmecardpath', __('MsmeFile'))->displayUsing(PdfDisplayer::class);
        $grid->column('itrcardpath', __('ItrFile'))->displayUsing(PdfDisplayer::class);
        $grid->column('aadharcardpath', __('AadharFile'))->displayUsing(PdfDisplayer::class);
        $grid->column('pancardpath', __('PanFile'))->displayUsing(PdfDisplayer::class);
        $grid->column('utilitycardpath', __('UtilityFile'))->displayUsing(PdfDisplayer::class);
        $grid->column('approved', __('Status'))->display(function ($data) {
            if (isset($data) && $data === 1) {
                return "Approved";
            } else if (isset($data) && $data === 0) {
                return "New";
            } else if (isset($data) && $data === 2) {
                return "Rejected";
            }
        });
        $grid->export(function ($export) {
<<<<<<< HEAD

=======
>>>>>>> 49f5bd67f9bee1eeb58dc0cb88fbd6ce2df470ea
            $export->except(['gstcardpath', 'msmecardpath', 'itrcardpath', 'aadharcardpath', 'pancardpath', 'utilitycardpath']);
        });
        $grid->actions(function ($actions) {
            $actions->add(new Download);
            $actions->add(new Data);
            $actions->add(new Rejected);
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Document::findOrFail($id));
        $show->field('userid', __('Userid'));
        $show->field('gstcard', __('GstCardNo'));
        $show->field('msmecard', __('MsmeCardNo'));
        $show->field('itrcard', __('ItrCardNo'));
        $show->field('aadharcard', __('AadharCardNo'));
        $show->field('pancard', __('PanCardNo'));
        $show->field('utilitycard', __('UtilityCardNo'));
        $show->field('gstcardpath', __('GstFile'));
        $show->field('msmecardpath', __('MsmeFile'));
        $show->field('itrcardpath', __('ItrFile'));
        $show->field('aadharcardpath', __('AadharFile'));
        $show->field('pancardpath', __('PanFile'));
        $show->field('utilitycardpath', __('UtilityFile'));
        $show->field('approved', __('Approved'));
        $show->field('comment', __('Comment'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Document());
        $form->number('userid', __('Userid'))->rules('required');
        $form->text('gstcard', __('GstCardNo'));
        $form->text('msmecard', __('MsmeCardNo'));
        $form->text('itrcard', __('ItrCardNo'));
        $form->text('aadharcard', __('AadharCardNo'));
        $form->text('pancard', __('PanCardNo'));
        $form->text('utilitycard', __('UtilityCardNo'));
        $form->file('gstcardpath', __('GstFile'));
        $form->file('msmecardpath', __('MsmeFile'));
        $form->file('itrcardpath', __('ItrFile'));
        $form->file('aadharcardpath', __('AadharFile'))->rules('required|regex:/^[a-zA-Z]+$/');
        $form->file('pancardpath', __('PanFile'))->rules('required');
        $form->file('utilitycardpath', __('UtilityFile'));
        $form->text('comment', __('Comment'));
        $form->number('approved', __('Approved'));
        return $form;
    }
}