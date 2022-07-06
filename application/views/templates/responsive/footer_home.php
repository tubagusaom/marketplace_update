<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2017 &copy; Design By
        <a target="_blank" href="http://indonesia-kompeten.com">MBS</a> &nbsp;|&nbsp;
        <a href="lspkeuangansyariah.com" title="LSP<?= $aplikasi->singkatan_unit ?>" target="_blank"><?= $aplikasi->singkatan_unit ?></a>
        &nbsp;|&nbsp;
        <a href="#" title="<?= $aplikasi->singkatan_unit ?>" target="_blank"><?= $aplikasi->sms_center ?></a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>

</div>
</div>
<script src="<?= base_url() ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>

<script src="<?= base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<script>
    var base_url = "<?= base_url(); ?>";
    $(document).ready(function ()
    {
        $('#clickmewow').click(function ()
        {
            $('#radio1003').attr('checked', 'checked');
        });
        // Autocomplete Typeahead
        var dataMenu = [{"name": "Home", "url": "home"}, {"name": "Biodata", "url": "profil/index"}, {"name": "Pekerjaan", "url": "profil/pekerjaan"}, {"name": "Pasfoto", "url": "profil/foto"}, {"name": "Riwayat Sertifikasi", "url": "sertifikasi/view"}, {"name": "Proses Sertifikasi", "url": "sertifikasi/proses"}, {"name": "Jadwal Uji Kompetensi", "url": "jadwal/index"}, {"name": "Pendaftaran", "url": "jadwal/registrasi"}, {"name": "Upload Bukti Pendukung", "url": "bukti_pendukung/upload"}, {"name": "Arsip Bukti Pendukung", "url": "bukti_pendukung/index"}, {"name": "Konfirmasi Pembayaran", "url": "pembayaran/konfirmasi"}, {"name": "Invoice", "url": "pembayaran/invoice"}, {"name": "Kontak", "url": "bantuan/kontak"}, {"name": "Panduan", "url": "knowledge_base/view"}
        ];
        var $input = $(".typeaheadMenu");
        $input.typeahead({
            source: dataMenu,
            displayText: function (item) {
                return item.name
            },
            updater: function (item) {
                /* navigate to the selected item */
                window.location.href = base_url + item.url;
            }
        });

        $.get(base_url + "pembayaran/get_invoice", function (data) {
            var $inputInvoice = $("#invoice_no");
            $inputInvoice.typeahead({source: data});
        }, 'json');
        // End autocomplete typeahead
    })
</script>
</body>

</html>
