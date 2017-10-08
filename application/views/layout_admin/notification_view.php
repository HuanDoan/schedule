<!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Notification</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?=base_url();?>admin">Admin</a></li>
                            <li class="active">Nofication</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!--row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Thông báo</h3>
                            <?=$Content?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Thông báo mới</h3>
                            <form method="post" class="form-horizontal form-material">
                                <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <textarea name="noti" id="Noti" style="width: 100%;" rows="12"></textarea> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="Savebtn" type="button" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Design by <a href="https://www.facebook.com/doanhuulehuan">Ziczac Solution</a> </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
        <script>
            CKEDITOR.replace( 'Noti' );

            var AJAX_URL_PATH = '<?=base_url()?>admin/notification/ajax';

            $(document).ready(function(){
                $('#Savebtn').click(function(e){
                    e.preventDefault();
                    var data = CKEDITOR.instances.Noti.getData();

                    if (data == '' || data == null) {
                        confirm('Vui lòng nhập nội dung!');
                    }
                    else{
                        $.post(AJAX_URL_PATH,{
                            option  : 'insertNoti',
                            data    : data
                        },
                        function(data, success){
                            data = $.parseJSON(data);
                            alert(data['msg']);
                            window.location.href=window.location.href;
                        });
                    }
                });
            });
        </script>