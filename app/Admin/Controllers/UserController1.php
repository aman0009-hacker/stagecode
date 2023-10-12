<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';
    //protected $visible = true;

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new User());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('full_name')->display(function () {
            return $this->name . ' ' . $this->last_name;
        });
        $grid->column('email', __('Email'));
        $grid->column('contact_number', __('Contact number'));
        $grid->column('otp', __('Otp'));


        $grid->column('attachment', 'Documents Count')->display(function ($comments) {
            $count = count($comments);
            return $count;
        })->expand(function ($model) {

            $comments = $model->attachment()->take(10)->get()->map(function ($comment) {
                return $comment->only(['id', 'file_type', 'created_at']);
            });

            return new Table(['ID', 'File', 'Release Time'], $comments->toArray());
        });
        $grid->column("approved", __('Status'))->display(function ($value) {
            if (isset($value) && $value === 1) {
                return "Approved";
            } else if (isset($value) && $value === 0) {
                return "New";
            } else if (isset($value) && $value === 2) {
                return "Rejected";
            }
        })->expand(function ($model) {
            $query = DB::table('comments')->where('approved', $model->approved)->get();


            if ($model->approved == 0) {
                return "";
            } else if (isset($query) && count($query) > 0) {

                $table = '<table class="table ms-4">
        <thead>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Updated At</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>';

                foreach ($query as $query) {
                    $table .= '<tr>
                <td>' . $query->comment . '</td>
                <td>' . $query->approved_at . '</td>
                <!-- Add more table cells as needed -->
            </tr>';
                }

                $table .= '</tbody></table>';


                return $table;
            }
        });


        $grid->addColumn('editable_column', 'Editable Column')->editable();

        $grid->disableCreateButton();

        $grid->export(function ($export) {

            $export->except(['approved', 'comments', 'attachment', 'otp']);
        });

        $grid->actions(function ($actions) {

            $actions->add(new Data);

        });


    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('last_name', __('Last name'));
        $show->field('email', __('Email'));
        $show->field('contact_number', __('Contact number'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('otp', __('Otp'));
        $show->field('two_factor_secret', __('Two factor secret'));
        $show->field('otp_generated_at', __('Otp generated at'));
        $show->field('two_factor_recovery_codes', __('Two factor recovery codes'));
        $show->field('two_factor_confirmed_at', __('Two factor confirmed at'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('state', __('State'));
        $show->field('approved', __('Approved'));
        $show->field('approved_at', __('Approved at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->text('last_name', __('Last name'));
        $form->email('email', __('Email'));
        $form->text('contact_number', __('Contact number'));

        $form->radio("approved")->options([0 => 'New', 1 => 'Approved', 2 => 'Rejected'])->default(0);
        $form->text('comment', __('Comment'));

        $form->datetime('approved_at', __('Approved at'));

        $form->saving(function ($form) {
            if (isset($form->approved) && $form->approved == 2) {
                $details = [
                    'email' => 'Mail from PSIEC Admin Panel',
                    'body' => 'Your account has not verified due to issue in your documents' . "  . Kindly resolve the issues as follows:-" . $form->comment
                ];

                \Mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
            } else if (isset($form->approved) && $form->approved == 2) {
                $details = [
                    'email' => 'Mail from PSIEC Admin Panel',
                    'body' => 'Your account has successfully verified' . $form->comment
                ];

                \Mail::to('csanwalit@gmail.com')->send(new \App\Mail\PSIECMail($details));
            }

        });
        return $form;
    }
}