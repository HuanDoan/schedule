<!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Setting</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?=base_url();?>admin">Admin</a></li>
                            <li class="active">Setting</li>
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
                            <h3 class="box-title">Change Banner</h3>
                            <?php if($this->session->err_msg != '' && $this->session->success_msg == ''): ?>
                            <div class="alert alert-danger" role="alert">
                                <span><?=$this->session->err_msg;?></span>
                            </div>
                            <?php endif;?>
                            <?php if($this->session->err_msg == '' && $this->session->success_msg != ''): ?>
                            <div class="alert alert-success" role="alert">
                                <span><?=$this->session->success_msg;?></span>
                            </div>
                            <?php endif;?>
                            <form method="post" class="form-horizontal form-material">
                                <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="file" name="file" id="File" class="form-control form-control-line" required> 
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="button" id="Upload" class="btn btn-success">Upload</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Current Banner</h3>
                            <div class="img-preview">
                                <img src="http://localhost/schedule/assets/web/img/pic1.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Setting bottom notice</h3>
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
            $(document).ready(function(){

            });
        </script>