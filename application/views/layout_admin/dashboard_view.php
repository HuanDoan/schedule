
        

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Schedule</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Schedule</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3>Kế hoạch mới</h3>
                            <form method="post" class="form-horizontal form-material" id="newSchedule" action="<?=base_url()?>admin/schedule">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label class="col-xs-12">Ngày</label>
                                            <div class="col-xs-12">
                                                <input type="text" class="form-control" required name="date" id="inpDate" placeholder="01/01/2017">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-10 job-container">
                                        <div class="row jobwrap">
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <label class="col-xs-12">Công việc</label>
                                                    <div class="col-xs-12">
                                                        <input type="text" class="form-control" required name="job" id="inpJob" placeholder="Công việc">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label class="col-xs-12">Staff</label>
                                                    <div class="col-xs-12">
                                                        <select class="form-control" id="sltJob">
                                                            <?php foreach($staff as $r) : ?>
                                                            <option value="<?=$r->ID?>"><?=$r->StaffName?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="btnSaveJob" class="btn btn-success">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Job list</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="jobTable">
                                    <thead>
                                        <tr>
                                            <td width="200">Ngày</td>
                                            <td>Công việc</td>
                                            <td>Staff</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
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
            $('#inpDate').datepicker();

            var AJAX_PATH_URL = '<?=base_url()?>admin/schedule/ajax';

            $(document).ready(function(){
                fetchTable();

                $('#btnSaveJob').click(function(e){
                    e.preventDefault();
                    var date    = $('#inpDate').val();
                    var job     = $('#inpJob').val();
                    var staffID = $('#sltJob').val();
                    if (date == '' || date == null) {
                        confirm('Bạn chưa nhập ngày!');
                        $('#inpDate').focus();
                        return;
                    }
                    if (job == '' || job == null) {
                        confirm('Bạn chưa nhập công việc!');
                        $('#inpJob').focus();
                        return;
                    }
                    $.post(AJAX_PATH_URL,
                        {
                            option  : 'insertJob',
                            job     : job,
                            date    : date,
                            staffID : staffID
                        },
                        function(data, success){
                            data = $.parseJSON(data);
                            alert(data['msg']);
                            fetchTable();
                        }
                    );
                });
            

                function fetchTable(){
                    var html = '';
                    var span = '<span style="display: none;">';
                    var endspan = '</span>';

                    $.post(AJAX_PATH_URL,
                        {
                            option: 'fetchTable'
                        },
                        function(data){
                            for (var i = 0; i < data.length; i++) {
                                var action = '<td width="70" style="text-align:center;" data-value="'+data[i].ID+'"><button class="btn btn-danger">Delete</button></td>';
                                html += '<tr>';
                                html += '<td>'+parseDate(data[i].Date)+'</td><td>'+data[i].Content+span+data[i].ID+endspan+'</td><td>'+data[i].StaffName+span+data[i].ID+endspan+'</td>'+action;
                                html += '</tr>';
                            }
                            $('#jobTable tbody').html(html).promise().done(function(){
                                var $rows = $('#jobTable tbody tr');
                                var items = [],
                                    itemtext = [],
                                    currGroupStartIdx = 0;
                                $rows.each(function(i) {
                                    var $this = $(this);
                                    var itemCell = $(this).find('td:eq(0)')
                                    var item = itemCell.text();
                                    itemCell.remove();
                                    if ($.inArray(item, itemtext) === -1) {
                                        itemtext.push(item);
                                        items.push([i, item]);
                                        groupRowSpan = 1;
                                        currGroupStartIdx = i;
                                        $this.data('rowspan', 1)
                                    } else {
                                        var rowspan = $rows.eq(currGroupStartIdx).data('rowspan') + 1;
                                        $rows.eq(currGroupStartIdx).data('rowspan', rowspan);
                                    }

                                });



                                $.each(items, function(i) {
                                    var $row = $rows.eq(this[0]);
                                    var rowspan = $row.data('rowspan');
                                    $row.prepend('<td rowspan="' + rowspan + '">' + this[1] + '</td>');
                                });
                            });
                            $('.btn-danger').each(function(){
                                var _this = $(this);
                                _this.click(function(){
                                    deleteJob(_this);
                                });
                            });
                        }
                    );
                }



                function deleteJob(obj){
                    var id = $(obj).parents('td').attr('data-value');
                    if (confirm('Bạn muốn xóa công việc này?')) {
                        $.post(AJAX_PATH_URL,
                            {
                                option: 'deleteJob',
                                id: id
                            },
                            function(data){
                                alert(data.msg);
                                fetchTable();
                            }
                        );
                    }
                    else{
                        return false;
                    }
                }

                function parseDate(date){
                    var d = date.split("-");
                    d = d[2]+"/"+d[1]+"/"+d[0];
                    return d;
                }

            });
        </script>
    
