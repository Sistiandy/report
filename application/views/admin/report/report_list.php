<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <h3 class="">
            Daftar Laporan
            <a href="<?php echo site_url('admin/report/add'); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a>
        </h3><br>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="gradient">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php
                if (!empty($report)) {
                    foreach ($report as $row) {
                        ?>
                        <tbody>
                            <tr>
                                <td ><?php echo pretty_date($row['report_date'], 'l, d F Y H:i'); ?></td>
                                <td ><?php echo $row['user_full_name']; ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs" href="<?php echo site_url('admin/report/detail/' . $row['report_id']); ?>" ><span class="glyphicon glyphicon-eye-open"></span></a>
                                    <?php if($row['user_user_id'] == $this->session->userdata('user_id')){ ?>
                                    <a class="btn btn-success btn-xs" href="<?php echo site_url('admin/report/edit/' . $row['report_id']); ?>" ><span class="glyphicon glyphicon-edit"></span></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                        <?php
                    }
                } else {
                    ?>
                    <tbody>
                        <tr id="row">
                            <td colspan="3" align="center"><?php echo $this->lang->line('data_empty') ?></td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>   
            </table>
        </div>
        <div >
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>