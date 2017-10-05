<!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Video setting</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?=base_url();?>admin">Admin</a></li>
                            <li class="active">Video setting</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!--row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Setting</h3>
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
                            <form method="post" class="form-horizontal form-material" action="<?=base_url();?>admin/video-setting">
                                <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="text" name="linkyoutube" id="Link" placeholder="Link Youtube" class="form-control form-control-line" required> 
                                        <input type="text" class="hidden" name="codeLink" id="CodeLink">
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
                    <div class="col-md-6 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Preview</h3>
                            <div class="video-wrap">
                                <iframe src="https://www.youtube.com/embed/<?= isset($codeLink) ? $codeLink : '' ?>?autoplay=1" frameborder="0" allowfullscreen class="video" id="Video"></iframe>
                            </div>
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
            $('#Link').keyup(function(){
                var $this = $(this);
                var val   = $this.val();
                var stringPos = val.indexOf('?v=');
                var link  = val.slice(stringPos+3, val.length);
                $('#Video').attr('src', 'https://www.youtube.com/embed/'+link+'?autoplay=1');
                $('#CodeLink').val(link);
            });
        </script>