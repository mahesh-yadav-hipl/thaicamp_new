<?php include('head.php')
?>

<body>
    <div class="se-pre-con"></div>
    <!-- header logo: style can be found in header-->
<?php include('header.php')
?>    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
<?php include('sidebar.php')
?>        <aside class="right-side right-padding">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h2>Activities</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="index-2.html">
                            <i class="fa fa-fw fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li>
                        <a href="events_list.html">Events List</a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <div class="container-fluid">
                <!--main content-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-calendar"></i> Add Activities
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="events_form" action="#" class="form-horizontal">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="title" class="col-md-3 control-label">
                                                        Event Title
                                                        <span class='require'> *</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-fw fa-file-text-o"></i>
                                                            </span>
                                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Image</label>
                                                    <div class="col-md-7 text-center">
                                                        <div class="input-group">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                    <img data-src="holder.js/200x150" src="#" alt="profile">
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                                <div class="select_align">
                                                                    <span class="btn btn-primary btn-file">
                                                                        <span class="fileinput-new">Select image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="...">
                                                                    </span>
                                                                    <a href="#" class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="start">
                                                        Start *
                                                    </label>
                                                    <div class="col-md-3">
                                                        <div class='input-group date' id='datetimepicker6'>
                                                            <input type='text' class="form-control" name="date_start" id="start" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <label class="col-md-1 control-label" for="end">
                                                        End *
                                                    </label>
                                                    <div class="col-md-3">
                                                        <div class='input-group date' id='datetimepicker7'>
                                                            <input type='text' class="form-control" name="date_end" id="end" />
                                                            <span class="input-group-addon">
                                                                <span class="glyphicon glyphicon-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">
                                                        Description
                                                        <span class='require'> *</span>
                                                    </label>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <textarea class="summernote edi-css form-control" name="content"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-7">
                                                        <input type="submit" class="btn btn-primary" value="Add"> &nbsp;
                                                        <input type="button" class="btn btn-danger" value="Cancel"> &nbsp;
                                                        <input type="reset" id="add-news-reset-editable" class="btn btn-default" value="Reset">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <i class="fa fa-fw fa-list"></i> Activites List
                                </h4>
                                <span class="pull-right">
                                    <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                                    <i class="glyphicon glyphicon-remove removepanel"></i>
                                </span>
                            </div>
                            <div class="panel-body">
                                <div class="mart">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/1.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">One Week Yoga Special Training by - John C</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 16 / 09 / 2015 - 21 / 09 / 2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/2.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">Personal Training happy week</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 03 / 09 / 2015 - 09 / 09 / 2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mart">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/3.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">5k Marthon</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 25 / 08 / 2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/4.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">Soul Searching</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 18 / 08 / 2015 - 20 / 08 / 2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mart">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/5.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">XT Series Championship</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 15 / 07 / 2015 - 17 / 07 / 2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/6.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">5k Marthon - Joe S. Esparza</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 05 / 07 / 2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mart">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-2">
                                                    <img src="img/events/7.png" class="img-responsive img-thumbnail img-circle" alt="image not found">
                                                </div>
                                                <div class="col-sm-8 col-lg-10">
                                                    <h4>
                                                        <a href="event_item.html">Free Nutrition Seminor</a>
                                                    </h4>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                                    <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    <ul class="sub-menu">
                                                        <li>
                                                            <i class="fa fa-calendar"></i> 25 / 06 /2015
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--row ends-->
            </div>
            <!-- /.content -->
        </aside>
        <!-- /.right-side -->
    </div>
    <!-- /.right-side -->
    <!-- ./wrapper -->
    <!-- global js -->
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/custom_js/app.js" type="text/javascript"></script>
    <script src="js/custom_js/metisMenu.js" type="text/javascript"></script>
    <script src="vendors/holder/holder.js" type="text/javascript"></script>
    <!-- end of page level js -->
    <!-- begining of page level js -->
    <script src="vendors/summernote/summernote.min.js" type="text/javascript"></script>
    <script src="vendors/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    <script src="vendors/moment/moment.js" type="text/javascript"></script>
    <script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js" type="text/javascript"></script>
    <script src="vendors/sweetalert/dist/sweetalert2.js" type="text/javascript"></script>
    <script src="js/custom_js/events.js"></script>
    <!-- end of page level js -->
</body>


</html>
