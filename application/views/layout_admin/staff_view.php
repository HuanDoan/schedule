<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Staff Manager</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Staff Manager</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Add new staff</h3>
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
                            <form method="post" class="form-horizontal form-material" action="<?=base_url();?>admin/staff">
                                <div class="form-group">
                                    <label class="col-md-12">Tên nhân viên</label>
                                    <div class="col-md-12">
                                        <input type="text" name="StaffName" id="StaffName" placeholder="Staff name" class="form-control form-control-line" required> 
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


                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Danh sách</h3>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên nhân viên</th>
                                            <th width="160">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Table">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Design by <a href="https://www.facebook.com/doanhuulehuan">Ziczac Solution</a> </footer>
        </div>

        <script>
            var AJAX_PATH_URL = '<?=base_url();?>admin/staff/ajax';
            $(document).ready(function(){
                fetchList();
            });

            function fetchList(){
                
                $.post(AJAX_PATH_URL,
                    {
                        option: 'fetchList'
                    },
                    function(data){
                        var html = '';
                        for(var i = 0; i < data.length; i++){
                            html += '<tr data-value="'+data[i].ID+'"><td>'+(i*1+1)+'</td><td id="name'+data[i].ID+'"><span>'+data[i].StaffName+'</td><td><button type="button" class="btn btn-info" onclick="edit(this)">Edit</button> <button type="button" class="btn btn-danger" onclick="del(this)">Delete</button></td></tr>';
                        }
                        $('#Table').html(html);
                    }
                );
            }

            function edit(obj){
                var id = $(obj).parents('tr').attr('data-value');
                var spanName = $(obj).parents('tr').find('td#name'+id+' span');
                var parent = spanName.parent();
                var name = spanName.text();
                parent.html('<input type="text" class="form-control form-control-line" value="'+name+'">');
                parent.find('input').focus();
                parent.find('input').select();
                parent.find('input').focusout(function(){
                    var newname = parent.find('input').val();
                    if (newname !== '') {
                        $.post(AJAX_PATH_URL,
                            {
                                option: 'edit',
                                id: id,
                                newname: newname
                            }, function(data){
                                if (data == 'success') {
                                    confirm('Sửa đổi thành công!');
                                    parent.html('<span>'+newname+'</span>');
                                }
                                else{
                                    confirm(data);
                                }
                            }
                        );
                    }
                    else{
                        confirm('Tên nhân viên không được để trống!'); 
                    }
                });
            }

            function del(obj){
                var id = $(obj).parents('tr').attr('data-value');
                if (confirm('Chắc chắn xóa nhân viên này?')) {
                    $.post(AJAX_PATH_URL,
                        {
                            option: 'delete',
                            id: id
                        }, function(data){
                            if (data == 'success') {
                                confirm('Xóa thành công!');
                                fetchList();
                            }
                            else{
                                confirm(data);
                            }
                        }
                    );
                }
            }
        </script>