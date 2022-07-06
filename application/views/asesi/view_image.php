<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/canvasCrop/css/style.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/canvasCrop/css/canvasCrop.css" />

<style>
    #testform{
        margin-left: 10px;
    }
    .tools{
        margin-top: 20px;
    }
    .tools span{
        float: left;
        display: inline-block;
        padding: 5px 20px;
        background-color: #f40;
        color: #fff;
        cursor: pointer;
        margin-bottom: 5px;
        margin-right: 5px;
    }
    .clearfix {
        *zoom: 1;
    }
    .clearfix:before{
        content: " ";
        display: table;
    }
    .clearfix:after{
        content: " ";
        display: table;
        clear: both;
    }
    .cropPoint{
        position: absolute;
        height: 8px;
        width: 8px;
        background-color: rgba(255,255,255,0.7);
        cursor: pointer;
    }
    .upload-wapper{
        position: relative;
        float: left;
        height: 26px;
        line-height: 26px;
        width: 132px;
        background-color: #f40;
        color: #fff;
        text-align: center;
        overflow: hidden;
        cursor: pointer;
    }
    #upload-file{
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        filter: alpha(opacity=0);
        width: 132px;
        height: 26px;
        cursor: pointer;
    }

    #testform .imageBox{
        width: 450px;
        height: 400px;
    }

    #testform .imageBox .thumbBox{
        padding: 0px;
        margin-left: -200px;
        margin-top: -175px;
        width: 400px;
        height: 350px;
    }

</style>

<script type="text/javascript" src="<?= base_url(); ?>assets/plugins/canvasCrop/js/jquery.canvasCrop.js" ></script>

<?php
switch ($extension) {
    case "pdf":
        echo '<object type="application/pdf" data="' . base_url('repo/asesi/' . $nmfile) . '" width="100%" height="600" style="height: 85vh;">File Not Found / File No Support</object>';
        die();
        break;
    default:
        ?>
        <input type="hidden" value="<?= $nmfile; ?>" id="idImg" />

        <form name="testform" id="testform" action="" method="post" enctype="multipart/form-data">

            <div class="row" style="float:left;width: 55%;">
                <div class="imageBox">
                    <!--<div id="img" ></div>-->
                    <!--<img class="cropImg" id="img" style="display: none;" src="images/avatar.jpg" />-->
                    <div class="mask"></div>
                    <div class="thumbBox"></div>
                    <div class="spinner" style="display: none">Loading...</div>
                </div>
                <div class="tools clearfix">
                    <span id="rotateLeft" >rotateLeft</span>
                    <span id="rotateRight" >rotateRight</span>
                    <span id="zoomIn" >zoomIn</span>
                    <span id="zoomOut" >zoomOut</span>
                    <span id="crop" >Crop</span>

                    <!--
                    <span id="alertInfo" >alert</span>
                    <div class="upload-wapper">
                        Select An Image
                        <input type="file" id="upload-file" value="Upload" />
                    </div>
                    -->

                </div>
            </div>
            <div class="imgLoad" style="float:left;width: 45%;margin-top: 10px;">
            </div>

            <!--
            <div style="margin-top:30px; text-align: center;">
                <button type="submit">Submit</button>
            </div>
            -->

        </form>
        <?php
        break;
}
?>

<script type="text/javascript">
    var base_url = "<?= base_url(); ?>";
    $(function () {
        var rot = 0, ratio = 1;
        var CanvasCrop = $.CanvasCrop({
            cropBox: ".imageBox",
            imgSrc: base_url + "repo/asesi/" + $("#idImg").val(),
            limitOver: 2
        });

        $('#upload-file').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                CanvasCrop = $.CanvasCrop({
                    cropBox: ".imageBox",
                    imgSrc: e.target.result,
                    limitOver: 2
                });
                rot = 0;
                ratio = 1;
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        });

        $("#rotateLeft").on("click", function () {
            rot -= 90;
            rot = rot < 0 ? 270 : rot;
            CanvasCrop.rotate(rot);
        });
        $("#rotateRight").on("click", function () {
            rot += 90;
            rot = rot > 360 ? 90 : rot;
            CanvasCrop.rotate(rot);
        });
        $("#zoomIn").on("click", function () {
            ratio = ratio * 0.9;
            CanvasCrop.scale(ratio);
        });
        $("#zoomOut").on("click", function () {
            ratio = ratio * 1.1;
            CanvasCrop.scale(ratio);
        });
        $("#alertInfo").on("click", function () {
            var canvas = document.getElementById("visbleCanvas");
            var context = canvas.getContext("2d");
            context.clearRect(0, 0, canvas.width, canvas.height);
        });

        $("#crop").on("click", function () {
            var namafile = $("#idImg").val();
            var extFile = namafile.split(".");
            extFile = (extFile[extFile.length - 1]).toLowerCase();
            var fileExt = "";
            switch (extFile) {
                case "jpg":
                case "jpeg":
                    fileExt = "jpeg";
                    break;
                case "png":
                    fileExt = "png";
                    break;
                default:
                    $.messager.alert("Warning", "Maaf file anda tidak didukung !");
                    return false;
                    break;
            }

            var src = CanvasCrop.getDataURL(fileExt);//jpeg
            //$("body").append("<div style='word-break: break-all;'>"+src+"</div>");  
            var items = "<table style='width:100%'><tr>";
            items += "<td width='70%'><img src='" + src + "' valign='left' width='150' /></td>";
            items += "<td width='30%'><a class='btnSelect' data-image = '" + src + "'>Select</a></td>";
            items += "</tr></table>";
            $(".imgLoad").append(items);

            $(".btnSelect").linkbutton({
                onClick: function () {
                    var isi = $(this).attr('data-image');
                    var nmfile = $("#idImg").val();
                    var dt = {namafile: nmfile, isiImg: isi, ekstensi: fileExt}
                    $.post(base_url + "asesi/upload", dt, function (hsl) {
                        hsl = JSON.parse(hsl);
                        //console.log(hsl.success);
                        if (hsl.success == true) {
                            alert(hsl.pesan);
                        } else {
                            alert(hsl.pesan);
                        }
                    });
                }
            });
        });

        console.log("ontouchend" in document);
    });
</script>
