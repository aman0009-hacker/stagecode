<?php

namespace App\Admin\Controllers;

use App\Models\Comments;
use App\Models\Attachment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Carbon\Carbon;
use Encore\Admin\Show;
use App\Admin\Actions\ReportPost;
use App\PdfDisplayer;
use App\Admin\Actions\Download;
use App\Admin\Actions\BatchReplicate;
use App\Models\User;
use App\Admin\Button\CustomButton;
use Encore\Admin\Grid\Tools as GridTools;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;
use Encore\Admin\Admin;

// use App\Admin\Actions\ReportPost;


class AttachmentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    public function index(Content $content)
    {
        $currentRowId = session('current_row_id');
        $name = User::find($currentRowId)->name;
        $lastname = User::find($currentRowId)->last_name;
        $fullname = $name . " " . $lastname . " " ?? '';
        return $content
            ->header($fullname . 'Document Information')
            ->body($this->grid());
        //->view('admin.custom-page');
    }

    protected function renderForm()
    {
        // Create your custom form HTML or use a form view
        return view('admin.custom-page');
    }

    protected $title = 'Attachment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $currentAdminId = \Encore\Admin\Facades\Admin::user()->id;
        // $currentAdminRole=\Encore\Admin\Facades\Admin::user()->roles;
        $currentAdminRole = "admin";
        $currentAdminUserName = \Encore\Admin\Facades\Admin::user()->username;
        $currentRowId = session('current_row_id');
        $grid = new Grid(new Attachment());
        $grid->column('user.name', __('User Name'));
        // $grid->column('filename', __('Filename'))->displayUsing(PdfDisplayer::class);
        $grid->column('filename', __('Filename'))->display(function ($value) {
            return $this->getFileNameAttribute($value);
        })->displayUsing(PdfDisplayer::class);
        $grid->column('file_type', __('Document type'));
        $grid->column('updated_at', __('Updated at'))->display(function ($value) {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        });
        // $grid->column('fileno', __('Document No'));
        $grid->column('fileno', __('Document No'))->display(function ($value) {
            return $this->getFileNoAttribute($value);
        });
        $grid->model()->where('user_id', $currentRowId);
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });
        $grid->tools(function ($tools) {
            $tools->append('<a class="btn btn-default" href="/admin/auth/user"><i class="fa fa-arrow-left"></i> Back</a>');
            $tools->append(new BatchReplicate());

        });
        $grid->disableFilter();

        $html = <<<HTML
        <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <meta http-equiv="refresh" content="7"> -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- <link rel="stylesheet" href="{{asset('css/chatbox.css'}}"> -->
        </head>
     
        <section>
        <form id="commentForm">
         <input type="hidden" name="adminid" id="adminid"             value="$currentAdminId"              />
         <input type="hidden" name="userid" id="userid"             value="$currentRowId"                   />
         <input type="hidden" name="adminrole" id="adminrole"      value="$currentAdminRole"               />
         <input type="hidden" name="adminusername" id="adminusername"     value="$currentAdminUserName"     />
        <div class="container px-5 my-5">
            <div class="chat-wrapper" style="margin-bottom:30px;background-color:#ffffff">
                <div class="row">
                    <div class="col-12 border-bottom">
                        <h3>Reply</h3>
                    </div>
                    <hr class="mt-2">
                    <div class="col-12 border-bottom">
                        <div class="my-4 row">
                            <label for="textAreaMsg" class="col-sm-2 col-form-label" id="msgTxt">Message</label>
                            <textarea class="col-sm-9 form-control" id="textAreaMsg" rows="3" name="textAreaMsg" required style="border-radius:5px"></textarea>
                          </div>
                    </div>
                    <hr class="mt-2">
                    <!-- <div class="mt-4"> -->
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="text-right" style="margin-top:10px">
                        <button type="button" class="btn btn-info me-3" id="btnClear">Clear</button>
                        <input class="btn btn-primary" type="submit" value="Submit" id="btnSubmit"/>
                    </div>
                     </div>
                     </div>
                    </div>
                    <div class="col-12 scroll-chat mt-4" style="margin-top:5px">
                      <p class="note-text"></p>
                        <div class="msg-grp">
                  
                        <p>
                            Reply has placed here:- 
                            <div id="submitDiv" >
                            </div>
                        </p>
                        </div>
                    </div>
                 </div>
            </div>
       </div>
       </form>
       <!-- <script src="/js/chatReply.js"></script> -->
       <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

     </section> 
 
     HTML;
        Admin::html($html);
        $jsFilePath = public_path('js/chatReply.js');
        $jsContent = file_get_contents($jsFilePath);
        Admin::script($jsContent);
        //$grid->refresh();
        $grid->disableExport();
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
        $show = new Show(Attachment::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('filename', __('Filename'));
        $show->field('path', __('Path'));
        $show->field('mime_type', __('Mime type'));
        $show->field('file_type', __('File type'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('fileno', __('Fileno'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Attachment());
        $form->text('filename', __('Filename'));
        $form->text('path', __('Path'));
        $form->text('mime_type', __('Mime type'));
        $form->text('file_type', __('File type'));
        // $form->number('user_id', __('User id'));
        $form->text('fileno', __('Fileno'));
        $form->footer(function ($footer) {
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();

        });
        return $form;
    }
}