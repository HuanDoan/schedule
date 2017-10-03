<!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Change Password</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Admin</a></li>
                            <li class="active">Change password</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!--row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
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
                            <form method="post" class="form-horizontal form-material" action="<?=base_url();?>admin/change-pass">
                                <div class="form-group">
                                    <label class="col-md-12">Mật khẩu hiện tại</label>
                                    <div class="col-md-12">
                                        <input type="password" name="currpass" placeholder="Current Password" class="form-control form-control-line" required> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Mật khẩu mới</label>
                                    <div class="col-md-12">
                                        <input type="password" name="newpass" placeholder="New Password" class="form-control form-control-line" required> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Nhập lại mật khẩu mới</label>
                                    <div class="col-md-12">
                                        <input type="password" name="reenterpass" placeholder="Re-enter new Password" class="form-control form-control-line" required> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Save</button>
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