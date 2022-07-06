<style type="text/css">
    a {
        text-decoration: none;
    }
    .img-thumbnail {
        margin-left: 75px;
    }
</style>
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url()?>">Home</a></li>
                    <li class="active">FAQ</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>
                    FREQUENTLY ASKED QUESTIONS
                </h1>
                </div>
            </div>
    </div>
</section>

<section class="main-container">

    <div id="mainContent" >
        <div class="headerContent" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="background-color: white;padding-bottom: 20px;width: 96%;margin-left: 15px;padding-left: 2px;padding-right: 2px">

                    <div class="col-md-12 content">
                        <div class="panel-group" id="accordion">
                            <?php
                            $no = 0;
                            foreach ($value as $hsl) {
                                $no++;
                                if ($no == 1) {
                                    echo '
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $hsl->id . '"><b>' . $no . '. ' . $hsl->pertanyaan . '</b></a>
                                </h4>
                            </div>
                            <div id="collapse' . $hsl->id . '" class="panel-collapse collapse out">
                                <div class="panel-body">
                                ' . $hsl->jawaban . '
                                </div>
                            </div>
                            </div>
                            ';
                                } else {
                                    echo '
                            <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $hsl->id . '"><b>' . $no . '. ' . $hsl->pertanyaan . '</b></a>
                                </h4>
                            </div>
                            <div id="collapse' . $hsl->id . '" class="panel-collapse collapse out">
                                <div class="panel-body">
                                ' . $hsl->jawaban . '
                                </div>
                            </div>
                            </div>
                            ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div></div>
    </div> 
</section>