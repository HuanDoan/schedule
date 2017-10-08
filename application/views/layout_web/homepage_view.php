<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="slider">
                <img style="width: 100%; height: 183px" class="item" src="<?=$BannerLink?>" alt="pic">
            </div>
        </div>
    </div>
    <div class="row content">
        <div class="col-xs-12 col-md-8">
            <div class="bg-white">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="title_t">
                            <h3>KẾ HOẠCH</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="style_table">
                            <table class="table table-bordered table-hover">
                                <thead>
                                        <td width="200" class="text-center">Ngày</td>
                                        <td class="text-center">Công việc</td>
                                        <td class="text-center">Staff</td>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col_right">
            <div class="video">
                <iframe width="100%" height="395" src="https://www.youtube.com/embed/<?=$VideoLink?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="bg-white noti">
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                            <div class="noti_titile">
                                <h3>THÔNG BÁO MỚI</h3>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-lg-12">
                        <div class="noti_text">
                            <?=$NotiContent?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="bg-white footer_body">
                <div class="marquee"><h3><?=$Marquee?></h3></div>
            </div>
        </div>
    </div>
</div>

<script>
    var AJAX_PATH_URL = '<?=base_url()?>admin/schedule/ajax';

    $(document).ready(function(){
        fetchTable();
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
                    html += '<tr>';
                    html += '<td>'+parseDate(data[i].Date)+'</td><td>'+data[i].Content+span+data[i].ID+endspan+'</td><td>'+data[i].StaffName+span+data[i].ID+endspan+'</td>';
                    html += '</tr>';
                }
                $('table tbody').html(html).promise().done(function(){
                    var $rows = $('table tbody tr');
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
            }
        );
    }

    function parseDate(date){
        var d = date.split("-");
        d = d[2]+"/"+d[1]+"/"+d[0];
        return d;
    }
</script>