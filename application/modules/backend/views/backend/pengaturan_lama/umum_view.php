<table class="table  table-borderless">
<tr>
    <th width="200">Title</th>
    <td>: <?=$title?></td>
</tr>

<tr>
    <th>Domain</th>
    <td class="text-info">: <?=$domain?></td>
</tr>

<tr>
    <th>Telepon</th>
    <td>: <?=$telepon?></td>
</tr>

<tr>
    <th>Alamat</th>
    <td>: <?=$alamat?></td>
</tr>
</table>

<hr>

<a href="<?=site_url("backend/pengaturan/umum_form")?>" id="editumum" class="m-t-10 badge badge-warning"><i class="fa fa-pencil-square-o"></i> Edit</a>


<script type="text/javascript">
$(document).on("click","#editumum",function(e) {
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-lg')
                      .removeClass('modal-sm')
                      .addClass('modal-md');
    $('#modalContent').load($(this).attr('href'));
    $("#modalTitle").text('Form Pengaturan Umum');
    $("#modalGue").modal('show');
})
</script>
