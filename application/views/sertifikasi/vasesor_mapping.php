<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable({
        "columnDefs": [
            { "visible": false, "targets": 1 }
        ],
        "order": [[ 1, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
} );
</script>
<style type="text/css">
    tr.group,
tr.group:hover {
    background-color: #ddd !important;
}
</style>
<div class="pageSection container-fluid-full">
	
	<div class="container" style="margin-top: 15px;"></div>
	<div class="bannerPage container">
	<div class="col-md-12 well" style="background-color: #FFFFFF;">
	
	<div class="col-md-12">
		<ol class="breadcrumb well well-sm">
    		<li><a href="<?=base_url()?>">Home</a></li>
    		<li class="active">Cek Status </li>
    	</ol>
    	<table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Skema Sertifikasi</th>
                <th>Nama Asesor</th>
                <th>No Registrasi</th>
                <th>Masa Berlaku</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Skema Sertifikasi</th>
                <th>Nama Asesor</th>
                <th>No Registrasi</th>
                <th>Masa Berlaku</th>
            </tr>
        </tfoot>
        <tbody>
        <?php foreach($data as $key=>$value){
        ?>
        
            <tr>
                <td><?=$value->skema?></td>
                <td><?=$value->users?></td>
                <td><?=$value->no_reg?></td>
                <td><?=$value->masa_berlaku_asesor?></td>
            </tr>
        <?php } ?>   

        </tbody>
    </table>
          
	</div>
</div>
</div>
	</div>
