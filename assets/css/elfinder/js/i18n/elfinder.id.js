/**
 * Indonesian translation
 * @author Suyadi <1441177004009@student.unsika.ac.id>
 * @version 2015-07-27
 */
if (elFinder && elFinder.prototype && typeof(elFinder.prototype.i18) == 'object') {
    elFinder.prototype.i18.id = {
        translator : 'Suyadi &lt;1441177004009@student.unsika.ac.id&gt;',
        language   : 'Bahasa Indonesia',
        direction  : 'ltr',
        dateFormat : 'j F, Y H:i',
        fancyDateFormat : '$1 H:i',
        messages   : {

            /********************************** errors **********************************/
            'error'                : 'Kesalahan',
            'errUnknown'           : 'Kesalahan tak dikenal.',
            'errUnknownCmd'        : 'Perintah tak dikenal.',
            'errJqui'              : 'Konfigurasi jQuery UI tidak valid. Komponen pemilih, penyeret dan penaruh harus disertakan.',
            'errNode'              : 'elFinder membutuhkan pembuatan elemen DOM.',
            'errURL'               : 'Konfigurasi elFinder tidak valid! opsi URL belum diatur.',
            'errAccess'            : 'Akses ditolak.',
            'errConnect'           : 'Tidak dapat tersambung ke backend.',
            'errAbort'             : 'Koneksi dibatalkan.',
            'errTimeout'           : 'Waktu koneksi habis.',
            'errNotFound'          : 'Backend tidak ditemukan.',
            'errResponse'          : 'Respon backend tidak valid.',
            'errConf'              : 'Konfigurasi elFinder tidak valid.',
            'errJSON'              : 'Modul PHP JSON belum terpasang.',
            'errNoVolumes'         : 'Tidak tersedia ruang kosong.',
            'errCmdParams'         : 'Parameter perintah "$1" tidak valid.',
            'errDataNotJSON'       : 'Data bukan merupakan JSON.',
            'errDataEmpty'         : 'Data masih kosong.',
            'errCmdReq'            : 'Permintaan ke backend membutuhkan nama perintah.',
            'errOpen'              : 'Tidak dapat membuka "$1".',
            'errNotFolder'         : 'Obyek ini bukan folder.',
            'errNotFile'           : 'Obyek ini bukan berkas.',
            'errRead'              : 'Tidak dapat membaca "$1".',
            'errWrite'             : 'Tidak dapat menulis ke "$1".',
            'errPerm'              : 'Ijin ditolak.',
            'errLocked'            : '"$1" ini terkunci dan tak dapat dipidahkan, diubah atau dihapus.',
            'errExists'            : 'Berkas bernama "$1" sudah ada.',
            'errInvName'           : 'Nama berkas tidak valid.',
            'errFolderNotFound'    : 'Folder tidak ditemukan.',
            'errFileNotFound'      : 'Berkas tidak ditemukan.',
            'errTrgFolderNotFound' : 'Folder tujuan "$1" tidak ditemukan.',
            'errPopup'             : 'Peramban anda mencegah untuk membuka jendela munculan. Untuk dapat membuka berkas ini ubah pengaturan pada peramban anda.',
            'errMkdir'             : 'Tidak dapat membuat folder "$1".',
            'errMkfile'            : 'Tidak dapat membuat berkas "$1".',
            'errRename'            : 'Tidak dapat mengubah nama "$1".',
            'errCopyFrom'          : 'Tidak diizinkan menyalin berkas dari volume "$1".',
            'errCopyTo'            : 'tidak diizinkan menyalin berkas ke volume "$1".',
            'errUpload'            : 'Kesalahan saat mengunggah.',
            'errUploadFile'        : 'Tidak dapat mengunggah "$1".',
            'errUploadNoFiles'     : 'Tak ada berkas untuk diunggah.', 
            'errUploadTotalSize'   : 'Data melampaui ukuran yang diperbolehkan.',
            'errUploadFileSize'    : 'Berkas melampaui ukuran yang diperbolehkan.',
            'errUploadMime'        : 'Jenis berkas ini tidak diijinkan.', 
            'errUploadTransfer'    : 'Kesalahan transfer "$1".', 
            'errNotReplace'        : 'Obyek "$1" sudah ada di lokasi ini dan tidak dapat ditimpa oleh obyek jenis lain.', // new
            'errReplace'           : 'Tidak dapat menimpa "$1".',
            'errSave'              : 'Tidak dapat menyimpan "$1".',
            'errCopy'              : 'Tidak dapat menyalin "$1".',
            'errMove'              : 'Tidak dapat memindahkan "$1".',
            'errCopyInItself'      : 'Tidak dapat menyalin "$1" ke dirinya sendiri.',
            'errRm'                : 'Tidak dapat menghapus "$1".',
            'errRmSrc'             : 'Tidak dapat menghapus sumber berkas.',
            'errExtract'           : 'Tidak dapat mengekstrak berkas dari "$1".',
            'errArchive'           : 'Tidak dapat membuat arsip.',
            'errArcType'           : 'Jenis arsip tidak didukung.',
            'errNoArchive'         : 'Berkas ini bukan arsip atau arsip jenis ini tidak didukung.',
            'errCmdNoSupport'      : 'Backend tidak mendukung perintah ini.',
            'errReplByChild'       : 'Folder ???$1??? tidak dapat ditimpa dengan berkas didalamnya.',
            'errArcSymlinks'       : 'Untuk keamanan tak diijinkan mengekstrak arsip berisi symlink atau jenis berkas yang tak diijinkan.', // edited 24.06.2012
            'errArcMaxSize'        : 'Arsip ini melampaui ukuran yang diijinkan.',
            'errResize'            : 'Tidak dapat mengubah ukuran "$1".',
            'errResizeDegree'      : 'Derajat putaran tidak valid.',
            'errResizeRotate'      : 'Citra tidak diputar.',
            'errResizeSize'        : 'Ukuran citra tidak valid.',
            'errResizeNoChange'    : 'Ukuran citra tidak diubah.',
            'errUsupportType'      : 'Jenis berkas tidak didukung.',
            'errNotUTF8Content'    : 'Berkas "$1" tidak dalam format UTF-8 dan tidak dapat disunting.',
            'errNetMount'          : 'Tidak dapat membaca susunan "$1".',
            'errNetMountNoDriver'  : 'Protokol tidak didukung.',
            'errNetMountFailed'    : 'Tidak dapat membaca susunannya.',
            'errNetMountHostReq'   : 'Host harus ada.',
            'errSessionExpires'    : 'Sesi anda telah kadaluwarsa karena lama tidak aktif.',
            'errCreatingTempDir'   : 'Tidak dapat membuat direktori sementara: "$1"',
            'errFtpDownloadFile'   : 'Tidak dapat mengunduh berkas dari FTP: "$1"',
            'errFtpUploadFile'     : 'Tidak dapat mengunggah berkas dari FTP: "$1"',
            'errFtpMkdir'          : 'Tidak dapat membuat remot direktori dari FTP: "$1"',
            'errArchiveExec'       : 'Kesalahan saat mengarsipkan berkas: "$1"',
            'errExtractExec'       : 'Kesalahan saat mengekstrak berkas: "$1"',

            /******************************* commands names ********************************/
            'cmdarchive'   : 'Buat arsip',
            'cmdback'      : 'Kembali',
            'cmdcopy'      : 'Salin',
            'cmdcut'       : 'Potong',
            'cmddownload'  : 'Unduh',
            'cmdduplicate' : 'Gandakan',
            'cmdedit'      : 'Sunting berkas',
            'cmdextract'   : 'Ekstrak berkas dari arsip',
            'cmdforward'   : 'Maju',
            'cmdgetfile'   : 'Pilih berkas',
            'cmdhelp'      : 'Tentang software ini',
            'cmdhome'      : 'Rumah',
            'cmdinfo'      : 'Dapatkan info',
            'cmdmkdir'     : 'Buat folder',
            'cmdmkfile'    : 'Buat berkas teks',
            'cmdopen'      : 'Buka',
            'cmdpaste'     : 'Tempel',
            'cmdquicklook' : 'Pratinjau',
            'cmdreload'    : 'Muat-ulang',
            'cmdrename'    : 'Ganti nama',
            'cmdrm'        : 'Hapus',
            'cmdsearch'    : 'Cari berkas',
            'cmdup'        : 'Ke direktori utama',
            'cmdupload'    : 'Unggah berkas',
            'cmdview'      : 'Lihat',
            'cmdresize'    : 'Ubah ukuran & Putar',
            'cmdsort'      : 'Urutkan',
            'cmdnetmount'  : 'Baca-susun volume jaringan', // added 18.04.2012

            /*********************************** buttons ***********************************/ 
            'btnClose'  : 'Tutup',
            'btnSave'   : 'Simpan',
            'btnRm'     : 'Buang',
            'btnApply'  : 'Terapkan',
            'btnCancel' : 'Batal',
            'btnNo'     : 'Tidak',
            'btnYes'    : 'Ya',
            'btnMount'  : 'Baca susunan',
            /******************************** notifications ********************************/
            'ntfopen'     : 'Buka folder',
            'ntffile'     : 'Buka berkas',
            'ntfreload'   : 'Muat-ulang isi folder',
            'ntfmkdir'    : 'Membuat direktori',
            'ntfmkfile'   : 'Membuat berkas',
            'ntfrm'       : 'Menghapus berkas',
            'ntfcopy'     : 'Salin berkas',
            'ntfmove'     : 'Pindahkan berkas',
            'ntfprepare'  : 'Persiapan menyalin berkas',
            'ntfrename'   : 'Ubah nama berkas',
            'ntfupload'   : 'Unggah berkas',
            'ntfdownload' : 'Mengunduh berkas',
            'ntfsave'     : 'Simpan berkas',
            'ntfarchive'  : 'Membuat arsip',
            'ntfextract'  : 'Mengekstrak berkas dari arsip',
            'ntfsearch'   : 'Mencari berkas',
            'ntfresize'   : 'Mengubah ukuran citra',
            'ntfsmth'     : 'Melakukan sesuatu',
            'ntfloadimg'  : 'Memuat citra',
            'ntfnetmount' : 'Membaca susunan volume jaringan',
            'ntfdim'      : 'Mendapatkan dimensi citra',

            /************************************ dates **********************************/
            'dateUnknown' : 'tak diketahui',
            'Today'       : 'Hari ini',
            'Yesterday'   : 'Kemarin',
            'msJan'       : 'Jan',
            'msFeb'       : 'Peb',
            'msMar'       : 'Mar',
            'msApr'       : 'Apr',
            'msMay'       : 'Mei',
            'msJun'       : 'Jun',
            'msJul'       : 'Jul',
            'msAug'       : 'Agt',
            'msSep'       : 'Sep',
            'msOct'       : 'Okt',
            'msNov'       : 'Nop',
            'msDec'       : 'Des',
            'January'     : 'Januari',
            'February'    : 'Pebruari',
            'March'       : 'Maret',
            'April'       : 'April',
            'May'         : 'Mei',
            'June'        : 'Juni',
            'July'        : 'Juli',
            'August'      : 'Agustus',
            'September'   : 'September',
            'October'     : 'Oktober',
            'November'    : 'Nopember',
            'December'    : 'Desember',
            'Sunday'      : 'Minggu',
            'Monday'      : 'Senin',
            'Tuesday'     : 'Selasa',
            'Wednesday'   : 'Rabu',
            'Thursday'    : 'Kamis',
            'Friday'      : 'Jum \'at',
            'Saturday'    : 'Sabtu',
            'Sun'         : 'Min', 
            'Mon'         : 'Sen', 
            'Tue'         : 'Sel', 
            'Wed'         : 'Rab', 
            'Thu'         : 'Kam', 
            'Fri'         : 'Jum', 
            'Sat'         : 'Sab',

            /******************************** sort variants ********************************/
            'sortname'          : 'menurut nama', 
            'sortkind'          : 'menurut jenis', 
            'sortsize'          : 'menurut ukuran',
            'sortdate'          : 'menurut tanggal',
            'sortFoldersFirst'  : 'Utamakan folder',

            /********************************** messages **********************************/
            'confirmReq'      : 'Diperlukan konfirmasi',
            'confirmRm'       : 'Anda yakin akan menghapus berkas?<br/>Ini tidak dapat kembalikan!',
            'confirmRepl'     : 'Timpa berkas lama dengan yang baru?',
            'apllyAll'        : 'Terapkan ke semua',
            'name'            : 'Nama',
            'size'            : 'Ukuran',
            'perms'           : 'Perijinan',
            'modify'          : 'Diubah',
            'kind'            : 'Jenis',
            'read'            : 'baca',
            'write'           : 'tulis',
            'noaccess'        : 'tidak ada akses',
            'and'             : 'dan',
            'unknown'         : 'tak diketahui',
            'selectall'       : 'Pilih semua berkas',
            'selectfiles'     : 'Pilih berkas',
            'selectffile'     : 'Pilih berkas pertama',
            'selectlfile'     : 'Pilih berkas terakhir',
            'viewlist'        : 'Tampilan daftar',
            'viewicons'       : 'Tampilan ikon',
            'places'          : 'Lokasi',
            'calc'            : 'Hitung', 
            'path'            : 'Alamat',
            'aliasfor'        : 'Nama lain untuk',
            'locked'          : 'Dikunci',
            'dim'             : 'Dimensi',
            'files'           : 'Berkas',
            'folders'         : 'Folder',
            'items'           : 'Pokok',
            'yes'             : 'ya',
            'no'              : 'tidak',
            'link'            : 'Tautan',
            'searcresult'     : 'Hasil pencarian',  
            'selected'        : 'Pokok terpilih',
            'about'           : 'Tentang',
            'shortcuts'       : 'Pintasan',
            'help'            : 'Bantuan',
            'webfm'           : 'Pengelola berkas web',
            'ver'             : 'Versi',
            'protocolver'     : 'versi protokol',
            'homepage'        : 'Rumah proyek',
            'docs'            : 'Dokumentasi',
            'github'          : 'Ambil kami di Github',
            'twitter'         : 'Ikuti kami di twitter',
            'facebook'        : 'Gabung dengan kami di facebook',
            'team'            : 'Tim',
            'chiefdev'        : 'kepala pengembang',
            'developer'       : 'pengembang',
            'contributor'     : 'kontributor',
            'maintainer'      : 'pengurus',
            'translator'      : 'penerjemah',
            'icons'           : 'Ikon',
            'dontforget'      : 'dan jangan lupa pakai handukmu',
            'shortcutsof'     : 'Pintasan dimatikan',
            'dropFiles'       : 'Seret berkas anda kesini',
            'or'              : 'atau',
            'selectForUpload' : 'Pilih berkas untuk diunggah',
            'moveFiles'       : 'Pindahkan berkas',
            'copyFiles'       : 'Salin berkas',
            'rmFromPlaces'    : 'Hapus dari lokasi',
            'aspectRatio'     : 'Aspek rasio',
            'scale'           : 'Skala',
            'width'           : 'Lebar',
            'height'          : 'Tinggi',
            'resize'          : 'Ubah ukuran',
            'crop'            : 'Potong',
            'rotate'          : 'Putar',
            'rotate-cw'       : 'Putar 90 derajat ke kanan', 
            'rotate-ccw'      : 'Putar 90 derajat ke kiri',
            'degree'          : '??',
            'netMountDialogTitle' : 'Baca susunan volume jaringan',
            'protocol'            : 'Protokol',
            'host'                : 'Host',
            'port'                : 'Port',
            'user'                : 'Pengguna',
            'pass'                : 'Sandi',

            /********************************** mimetypes **********************************/
            'kindUnknown'     : 'Tak diketahui',
            'kindFolder'      : 'Folder',
            'kindAlias'       : 'Nama lain',
            'kindAliasBroken' : 'Nama lain rusak',
            // applications
            'kindApp'         : 'Aplikasi',
            'kindPostscript'  : 'Dokumen postscript',
            'kindMsOffice'    : 'Dokumen Ms. Office',
            'kindMsWord'      : 'Dokumen Ms. Word',
            'kindMsExcel'     : 'Dokumen Ms. Excel',
            'kindMsPP'        : 'Dokumen Ms. Powerpoint',
            'kindOO'          : 'Dokumen Open Office',
            'kindAppFlash'    : 'Aplikasi Flash',
            'kindPDF'         : 'Portable Document Format (PDF)',
            'kindTorrent'     : 'Berkas Bittorrent',
            'kind7z'          : 'Arsip 7z',
            'kindTAR'         : 'Arsip TAR',
            'kindGZIP'        : 'Arsip GZIP',
            'kindBZIP'        : 'Arsip BZIP',
            'kindXZ'          : 'Arsip XZ',
            'kindZIP'         : 'Arsip ZIP',
            'kindRAR'         : 'Arsip RAR',
            'kindJAR'         : 'Berkas Java JAR',
            'kindTTF'         : 'Huruf True Type',
            'kindOTF'         : 'Huruf Open Type',
            'kindRPM'         : 'Paket RPM',
            // texts
            'kindText'        : 'Dokumen teks',
            'kindTextPlain'   : 'Berkas teks biasa',
            'kindPHP'         : 'Kode-sumber PHP',
            'kindCSS'         : 'Cascading style sheet',
            'kindHTML'        : 'Dokumen HTML',
            'kindJS'          : 'Kode-sumber Javascript',
            'kindRTF'         : 'Berkas Rich Text',
            'kindC'           : 'Kode-sumber C',
            'kindCHeader'     : 'Kode-sumber header C',
            'kindCPP'         : 'Kode-sumber C++',
            'kindCPPHeader'   : 'Kode-sumber header C++',
            'kindShell'       : 'Berkas shell Unix',
            'kindPython'      : 'Kode-sumber Python',
            'kindJava'        : 'Kode-sumber Java',
            'kindRuby'        : 'Kode-sumber Ruby',
            'kindPerl'        : 'Kode-sumber Perl',
            'kindSQL'         : 'Kode-sumber SQL',
            'kindXML'         : 'Dokumen XML',
            'kindAWK'         : 'Kode-sumber AWK',
            'kindCSV'         : 'Dokumen CSV',
            'kindDOCBOOK'     : 'Dokumen Docbook XML',
            // images
            'kindImage'       : 'Citra',
            'kindBMP'         : 'Citra BMP',
            'kindJPEG'        : 'Citra JPEG',
            'kindGIF'         : 'Citra GIF',
            'kindPNG'         : 'Citra PNG',
            'kindTIFF'        : 'Citra TIFF',
            'kindTGA'         : 'Citra TGA',
            'kindPSD'         : 'Citra Adobe Photoshop',
            'kindXBITMAP'     : 'Citra X bitmap',
            'kindPXM'         : 'Citra Pixelmator',
            // media
            'kindAudio'       : 'Berkas audio',
            'kindAudioMPEG'   : 'Berkas audio MPEG',
            'kindAudioMPEG4'  : 'Berkas audio MPEG-4',
            'kindAudioMIDI'   : 'Berkas audio MIDI',
            'kindAudioOGG'    : 'Berkas audio Ogg Vorbis',
            'kindAudioWAV'    : 'Berkas audio WAV',
            'AudioPlaylist'   : 'Berkas daftar putar MP3',
            'kindVideo'       : 'Berkas video',
            'kindVideoDV'     : 'Berkas video DV',
            'kindVideoMPEG'   : 'Berkas video MPEG',
            'kindVideoMPEG4'  : 'Berkas video MPEG-4',
            'kindVideoAVI'    : 'Berkas video AVI',
            'kindVideoMOV'    : 'Berkas video Quick Time',
            'kindVideoWM'     : 'Berkas video Windows Media',
            'kindVideoFlash'  : 'Berkas video Flash',
            'kindVideoMKV'    : 'Berkas video Matroska',
            'kindVideoOGG'    : 'Berkas video Ogg'
        }
    };
}
