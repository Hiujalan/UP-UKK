<?= $this->extend('Admin/layout/master') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/vendors/select2.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/vendors/date-picker.css">

<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Tasks</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Tasks</li>
                    <li class="breadcrumb-item active">Apps</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="email-wrap bookmark-wrap">
        <div class="row">
            <div class="col-xl-3 box-col-6">
                <div class="email-left-aside">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-app-sidebar left-bookmark task-sidebar">
                                <div class="media">
                                    <div class="media-size-email"><img class="me-3 rounded-circle" src="<?=base_url()?>/assets/images/user/user.png" alt=""></div>
                                    <div class="media-body">
                                        <h6 class="f-w-600">MARK JENCO</h6>
                                        <p>Markjecno@gmail.com</p>
                                    </div>
                                </div>
                                <ul class="nav main-menu" role="tablist">
                                    <li class="nav-item">
                                        <button class="badge-light-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="me-2" data-feather="check-circle"></i> New Task</button>
                                        <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                                            <div class="row">
                                                                <div class="mb-3 mt-0 col-md-12">
                                                                    <label for="task-title">Task Title</label>
                                                                    <input class="form-control" id="task-title" type="text" required="" autocomplete="off">
                                                                </div>
                                                                <div class="mb-3 mt-0 col-md-12">
                                                                    <label for="sub-task">Sub task</label>
                                                                    <input class="form-control" id="sub-task" type="text" required="" autocomplete="off">
                                                                </div>
                                                                <div class="mb-3 mt-0 col-md-12">
                                                                    <div class="d-flex date-details">
                                                                        <div class="d-inline-block">
                                                                            <label class="d-block mb-0" for="chk-ani">
                                                                                <input class="checkbox_animated" id="chk-ani" type="checkbox">Remind on
                                                                            </label>
                                                                        </div>
                                                                        <div class="d-inline-block">
                                                                            <input class="datepicker-here form-control" type="text" data-language="en" placeholder="Date">
                                                                        </div>
                                                                        <div class="d-inline-block">
                                                                            <select class="form-control">
                                                                                <option>7:00 am</option>
                                                                                <option>7:30 am</option>
                                                                                <option>8:00 am</option>
                                                                                <option>8:30 am</option>
                                                                                <option>9:00 am</option>
                                                                                <option>9:30 am</option>
                                                                                <option>10:00 am</option>
                                                                                <option>10:30 am</option>
                                                                                <option>11:00 am</option>
                                                                                <option>11:30 am</option>
                                                                                <option>12:00 pm</option>
                                                                                <option>12:30 pm</option>
                                                                                <option>1:00 pm</option>
                                                                                <option>2:00 pm</option>
                                                                                <option>3:00 pm</option>
                                                                                <option>4:00 pm</option>
                                                                                <option>5:00 pm</option>
                                                                                <option>6:00 pm</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="d-inline-block">
                                                                            <label class="d-block mb-0" for="chk-ani1">
                                                                                <input class="checkbox_animated" id="chk-ani1" type="checkbox">Notification
                                                                            </label>
                                                                        </div>
                                                                        <div class="d-inline-block">
                                                                            <label class="d-block mb-0" for="chk-ani2">
                                                                                <input class="checkbox_animated" id="chk-ani2" type="checkbox">Mail
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 mt-0 col-md-6">
                                                                    <select class="js-example-basic-single">
                                                                        <option value="task">My Task</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 mt-0 col-md-6">
                                                                    <select class="js-example-disabled-results" id="bm-collection">
                                                                        <option value="general">General</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-12 my-0">
                                                                    <textarea class="form-control" required="" autocomplete="off">  </textarea>
                                                                </div>
                                                            </div>
                                                            <input id="index_var" type="hidden" value="6">
                                                            <button class="btn btn-secondary" id="Bookmark" onclick="submitBookMark()" type="submit">Save</button>
                                                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item"><span class="main-title"> Views</span></li>
                                    <li><a id="pills-created-tab" data-bs-toggle="pill" href="#pills-created" role="tab" aria-controls="pills-created" aria-selected="true"><span class="title"> Created by me</span></a></li>
                                    <li><a class="show" id="pills-todaytask-tab" data-bs-toggle="pill" href="#pills-todaytask" role="tab" aria-controls="pills-todaytask" aria-selected="false"><span class="title"> Today's Tasks</span></a></li>
                                    <li><a class="show" id="pills-delayed-tab" data-bs-toggle="pill" href="#pills-delayed" role="tab" aria-controls="pills-delayed" aria-selected="false"><span class="title"> Delayed Tasks</span></a></li>
                                    <li><a class="show" id="pills-upcoming-tab" data-bs-toggle="pill" href="#pills-upcoming" role="tab" aria-controls="pills-upcoming" aria-selected="false"><span class="title">Upcoming Tasks</span></a></li>
                                    <li><a class="show" id="pills-weekly-tab" data-bs-toggle="pill" href="#pills-weekly" role="tab" aria-controls="pills-weekly" aria-selected="false"><span class="title">This week tasks</span></a></li>
                                    <li><a class="show" id="pills-monthly-tab" data-bs-toggle="pill" href="#pills-monthly" role="tab" aria-controls="pills-monthly" aria-selected="false"><span class="title">This month tasks</span></a></li>
                                    <li><a class="show" id="pills-assigned-tab" data-bs-toggle="pill" href="#pills-assigned" role="tab" aria-controls="pills-assigned" aria-selected="false"><span class="title">Assigned to me</span></a></li>
                                    <li><a class="show" id="pills-tasks-tab" data-bs-toggle="pill" href="#pills-tasks" role="tab" aria-controls="pills-tasks" aria-selected="false"><span class="title">My tasks</span></a></li>
                                    <li>
                                        <hr>
                                    </li>
                                    <li><span class="main-title"> Tags<span class="pull-right"><a href="#" data-bs-toggle="modal" data-bs-target="#createtag"><i data-feather="plus-circle"></i></a></span></span></li>
                                    <li><a class="show" id="pills-notification-tab" data-bs-toggle="pill" href="#pills-notification" role="tab" aria-controls="pills-notification" aria-selected="false"><span class="title"> notification</span></a></li>
                                    <li><a class="show" id="pills-newsletter-tab" data-bs-toggle="pill" href="#pills-newsletter" role="tab" aria-controls="pills-newsletter" aria-selected="false"><span class="title"> Newsletter</span></a></li>
                                    <li><a class="show" id="pills-business-tab" data-bs-toggle="pill" href="#" role="tab" aria-selected="false"><span class="title"> Business</span></a></li>
                                    <li><a class="show" id="pills-holidays-tab" data-bs-toggle="pill" href="#" role="tab" aria-selected="false"><span class="title"> Holidays</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-md-12 box-col-12">
                <div class="email-right-aside bookmark-tabcontent">
                    <div class="card email-body radius-left">
                        <div class="ps-0">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h5 class="mb-0">Created by me</h5><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="taskadd">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Client meeting</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Plan webinar</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Email newsletter</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Publish podcast</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Lunch website</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Client meeting</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Plan webinar</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Email newsletter</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-todaytask" role="tabpanel" aria-labelledby="pills-todaytask-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Today's Tasks</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center">
                                                <div class="row" id="favouriteData"></div>
                                                <div class="no-favourite"><span>No task due today.</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-delayed" role="tabpanel" aria-labelledby="pills-delayed-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Delayed Tasks</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-upcoming" role="tabpanel" aria-labelledby="pills-upcoming-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Upcoming Tasks</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-weekly" role="tabpanel" aria-labelledby="pills-weekly-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">This Week Tasks</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">This Month Tasks</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-assigned" role="tabpanel" aria-labelledby="pills-assigned-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Assigned to me</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="taskadd">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-tasks" role="tabpanel" aria-labelledby="pills-tasks-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">My tasks</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="taskadd">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="task_title_0">Task name</h6>
                                                                <p class="project_name_0">General</p>
                                                            </td>
                                                            <td>
                                                                <p class="task_desc_0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
                                                            </td>
                                                            <td><a class="me-2" href="#"><i data-feather="link"></i></a><a href="#"><i data-feather="more-horizontal"></i></a></td>
                                                            <td><a href="#"><i data-feather="trash-2"></i></a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Notification</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fade tab-pane" id="pills-newsletter" role="tabpanel" aria-labelledby="pills-newsletter-tab">
                                    <div class="card mb-0">
                                        <div class="card-header d-flex">
                                            <h6 class="mb-0">Newsletter</h6><a href="#"><i class="me-2" data-feather="printer"></i>Print</a>
                                        </div>
                                        <div class="card-body">
                                            <div class="details-bookmark text-center"><span>No tasks found.</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade modal-bookmark" id="createtag" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Create Tag</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-bookmark needs-validation" novalidate="">
                                                    <div class="row">
                                                        <div class="mb-3 mt-0 col-md-12">
                                                            <label>Tag Name</label>
                                                            <input class="form-control" type="text" required="" autocomplete="off">
                                                        </div>
                                                        <div class="mt-0 col-md-12">
                                                            <label>Tag color</label>
                                                            <input class="form-color d-block" type="color" value="#563d7c">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-secondary" type="button">Save</button>
                                                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?=base_url()?>/assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="<?=base_url()?>/assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?=base_url()?>/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<script src="<?=base_url()?>/assets/js/select2/select2.full.min.js"></script>
<script src="<?=base_url()?>/assets/js/select2/select2-custom.js"></script>
<script src="<?=base_url()?>/assets/js/form-validation-custom.js"></script>
<script src="<?=base_url()?>/assets/js/task/custom.js"></script>

<?= $this->endSection() ?>