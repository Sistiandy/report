<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-md-12 main">
            <h3>
                Detail Laporan
                <span class=" pull-right">
                    <a href="<?php echo site_url('admin/report') ?>" class="btn btn-info btn-sm"><span class="fa fa-arrow-left"></span>&nbsp; Kembali</a> 
                    <?php if($report['user_user_id'] == $this->session->userdata('user_id')){ ?>
                    <a href="<?php echo site_url('admin/report/edit/' . $report['report_id']) ?>" class="btn btn-success btn-sm"><span class="fa fa-edit"></span>&nbsp; Edit</a> 
                    <?php } ?>
                </span>
            </h3><br>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><?php echo pretty_date($report['report_date'], 'l, d m Y', FALSE) ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $report['user_full_name'] ?></td>
                    </tr>
                    <tr>
                        <td>Deksripsi</td>
                        <td>:</td>
                        <td><?php echo $report['report_description'] ?></td>
                    </tr>
                    <tr>
                        <td>Kendala</td>
                        <td>:</td>
                        <td><?php echo $report['report_trouble'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Daftar</td>
                        <td>:</td>
                        <td><?php echo pretty_date($report['report_input_date'], 'l, d m Y', FALSE) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
