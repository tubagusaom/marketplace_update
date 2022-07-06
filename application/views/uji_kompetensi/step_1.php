

<style>
    @import url('https://fonts.googleapis.com/css?family=Anton');
    body {
        background: #FFFFFF;/*#29AB87;*/
        /*background-image: url("http://www.chrislanejones.com/wp-content/uploads/2017/03/bigstock-Beautiful-Waterfall-On-Guadelo-114611036.jpg");*/
    }

    h1 {
        font-family: 'Anton', sans-serif;
        color: #29AB87;
    }

    .input-group {
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .panel {
        margin-top: 10px;
        background-color: rgba(255, 255, 255, .9)!important;
        border: solid 2px #ccc;
    }

    .panel-heading {
        background-color: #CCCCCC!important; /*#8AFFDF!important;*/
    }

    #accordion_search_bar {
        border: solid 2px #ccc;
    }

    .btn-default {
        border: solid 1.5px #ccc;
    }

    .fa-search {
        font-size: 1.3em;
    }

    .fa-paw {
        font-size: 1.4em;
        color: #6B7F7A;
    }
</style>

<div class="col-lg-12">

    <div class="row">

       

                <div class="row">
                 <div class="col-lg-12">
                        <!-- searching -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>

                <div class="row">
                    <div class="col-lg-12 col-xs-12">

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	
                            <?php
			    if($data_skema): //cek data ada/tidak ada.
                            foreach ($data_skema as $key => $value) {
                                $id_heading = "heading_" . $key;
                                $id_collapse = "collapse_" . $key;
                                $id_container = "collapse" . $key . "_container";
                                if ($key == 0) {
                                    $in = 'in';
                                } else {
                                    $in = '';
                                }
                                ?>
                                <div class="panel panel-default" id="<?= $id_container; ?>">
                                    <div class="panel-heading" role="tab" id="<?= $id_heading ?>">
                                        <h4 class="panel-title">
                                            <a role="button"
                                               data-toggle="collapse"
                                               data-parent="#accordion"
                                               href="#<?= $id_collapse ?>"
                                               aria-expanded="true"
                                               aria-controls="<?= $id_collapse ?>">
                                                <i class="fa fa-plus-circle fa-fw" aria-hidden="true"></i> &nbsp; <?= ($key + 1) . '. ' . strtoupper($value->skema) ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?= $id_collapse ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?= $id_heading ?>">
                                        <div class="panel-body">
                                            <?= $value->description ?>

                                            <br />
                                            <a data-toggle="tooltip" data-placement="bottom" title="Serba-serbi mengenai skema <?php echo $value->skema; ?>" href='<?php echo $value->link_download; ?>' target="_blank" class="btn-sm btn-primary "  >DOWNLOAD SKEMA</a>
                                            <a data-toggle="tooltip" data-placement="right" title="Pilih skema ini dan ke tahapan selanjutnya" href='#' class="nextBtn btn-sm btn-success" onclick='pilih_skema(<?php echo $value->id; ?>)' >DAFTAR SKEMA</a>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>
				<?php else: ?>
				 <span class="text-center ml-4"> &nbsp; &nbsp; <i class="fa fa-info-circle"></i> Maaf skema dengan kata kunci <strike><?= $this->input->get('keyword') ?></strike> tidak dapat ditemukan !</span>
				<?php endif; ?>
                        </div>

                    </div>


                </div>
                <!-- Row -->
            </div>
            <!-- Col -->
        </section>

    </div>

</div>
<!-- Container -->


<script type="text/javascript">
    $('.collapse').not(':first').collapse(); // Collapse all but the first row on the page.

    $('#accordion_search_bar').keyup(function(){
        searchTerm = $(this).val();
        console.log(searchTerm);
        return false;
    });
// This section makes the search work.
    (function () {
        var searchTerm, panelContainerId;
        $('#accordion_search_bar').on('change keyup', function () {
            searchTerm = $(this).val();
            $('#accordion > .panel').each(function () {
                panelContainerId = '#' + $(this).attr('id');

                // Makes search to be case insesitive
                $.extend($.expr[':'], {
                    'contains': function (elem, i, match, array) {
                        return (elem.textContent || elem.innerText || '').toLowerCase()
                                .indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

                // END Makes search to be case insesitive

                // Show and Hide Triggers
                $(panelContainerId + ':not(:contains(' + searchTerm + '))').hide(); //Hide the rows that done contain the search query.
                $(panelContainerId + ':contains(' + searchTerm + ')').show(); //Show the rows that do!

            });
        });
    }());
// End Show and Hide Triggers

// END This section makes the search work.
</script>
