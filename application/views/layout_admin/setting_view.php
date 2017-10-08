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
                            <form method="post" class="form-horizontal form-material" id="FileUploadForm">
                                <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="file" name="file" id="File" class="form-control form-control-line" required accept="image/x-png,image/gif,image/jpeg"> 
                                    </div>
                                </div>
                                <div id="ProgressBarWrap" class="progress" style="display: none;">
                                    <div id="ProgressBar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40%</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button id="Upload" class="btn btn-success">Upload</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Current Banner</h3>
                            <div class="img-preview">
                                <img src="<?=$BannerLink?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Setting bottom notice</h3>
                            <form method="post" class="form-horizontal form-material" id="marqueeBottom">
                                <div class="form-group">
                                    
                                    <div class="col-md-12">
                                        <input type="text" name="marquee" id="Marquee" class="form-control form-control-line" required placeholder="<?=$currMarquee?>"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="button" id="SaveMarquee" class="btn btn-success">Save</button>
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
            var AJAX_PATH_URL = '<?=base_url()?>admin/setting/ajax';

            $(document).ready(function(){
                $('#FileUploadForm').submit(function(e){
                        e.preventDefault();
                        $('#ProgressBarWrap').fadeIn();
                        $(this).ajaxSubmit({
                            url             : '<?=base_url()?>admin/setting/ajax',
                            dataType        : 'json',
                            data            : {
                                'option'    : 'uploadBanner'
                            },
                            uploadProgress  : function(event, position, total, percentComplete){
                                if (percentComplete == 100) {
                                    $('#ProgressBar span').html('Processing...');
                                    $('#ProgressBar').css('width', percentComplete+'%');
                                }
                                else{
                                    $('#ProgressBar span').html(percentComplete+'%');
                                    $('#ProgressBar').css('width', percentComplete+'%');
                                }
                            },
                            success         : function(data, status){
                                alert(data.err);
                                window.location.href=window.location.href;
                            } 
                        });
                    
                });


                $('#SaveMarquee').click(function(e){
                    e.preventDefault();
                    var content = $('#Marquee').val();
                    if (content == '' || content == null) {
                        confirm('Bạn chưa nhập nội dung!');
                    }
                    else{
                        $.post(AJAX_PATH_URL,
                            {
                                option: 'marquee',
                                marquee: content
                            },
                            function(data, status){
                                data = $.parseJSON(data);
                                alert(data['err']);
                                window.location.href=window.location.href;
                            }
                        );
                    }
                });
            });
        </script>