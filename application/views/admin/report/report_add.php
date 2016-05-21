<?php
$this->load->view('admin/tinymce_init');
$this->load->view('admin/datepicker');
if (isset($report)) {
    $id = $report['report_id'];
    $DateValue = $report['report_date'];
    $DescriptionValue = $report['report_description'];
    $TroubleValue = $report['report_trouble'];
} else {
    $DateValue = set_value('report_date');
    $DescriptionValue = set_value('report_description');
    $TroubleValue = set_value('report_trouble');
}
?>
<?php echo isset($alert) ? ' ' . $alert : null; ?>
<?php echo validation_errors(); ?>
<div class="col-md-12 col-sm-12 col-xs-12 main post-inherit">
    <div class="x_panel post-inherit">
        <div class="col-lg-12">
            <h3><?php echo $operation ?> Pengguna</h3>
            <br>
        </div>
        <!-- /.col-lg-12 -->

        <?php echo form_open_multipart(current_url()); ?>
        <div class="col-md-12">
            <div class="col-sm-12 col-md-9">
                <?php if (isset($report)): ?>
                    <input type="hidden" name="report_id" value="<?php echo $report['report_id'] ?>" />
                <?php endif; ?>
                <label >Tanggal *</label>
                <input name="report_date" type="text" placeholder="Tanggal" class="datepicker form-control" value="<?php echo (isset($report)) ? $DateValue : date('Y-m-d H:i:s'); ?>"><br>

                <label>Deskripsi Laporan *</label>
                <textarea name="report_description" class="form-control mce-init" rows="5" placeholder="Deskripsi Laporan"><?php echo $DescriptionValue; ?></textarea><br>

                <label>Kendala *</label>
                <textarea name="report_trouble" class="form-control mce-init" rows="5" placeholder="Kendala"><?php echo $TroubleValue; ?></textarea><br>

                <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <div class="form-group">
                    <button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button><br>
                    <a href="<?php echo site_url('admin/report'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a><br>
                    <?php if (isset($report)): ?>
                        <a href="<?php echo site_url('admin/report/delete/' . $report['report_id']); ?>" class="btn btn-danger btn-form"><i class="fa fa-trash"></i> Hapus</a><br>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if (isset($report)): ?>
    <!-- Delete Confirmation -->
    <div class="modal fade" id="confirm-del">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b>Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem, apakah anda yakin?;</p>
                </div>
                <?php echo form_open('admin/report/delete/' . $report['report_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-default" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $report['report_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $report['report_date'] ?>" />
                    <button type="submit" class="btn btn-primary">Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php if ($this->session->flashdata('delete')) { ?>
        <script type = "text/javascript">
            $(window).load(function() {
                $('#confirm-del').modal('show');
            });
        </script>
    <?php }
    ?>
<?php endif; ?>