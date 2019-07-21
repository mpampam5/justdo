<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?=ucfirst($temp_title)?></h5>
                            </div>

                            <div class="card-block">
                                <div class="form-group">
                                    <label for="">Pilih Table</label>
                                    <select name="table" id="table" class="form-control">
                                    <option value='0' style="color:gray">-- Pilih Table --</option>
                                        <?php
                                            foreach ($tables as $table) {
                                                echo "<option value='$table'> $table</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            <div id="alert-info"></div>
                            </div>
                        </div>


                        <div id="notif"></div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-block">
                                <div id="load-field">
                                    Silahkan Pilih Table Di Samping.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).on("change","#table", function(e) {
        e.preventDefault();
        var tables =$(this).val();
        $.ajax({
                        url             : "<?=base_url()?>/mpampam_crud/field_json/"+tables,
                        type            : 'POST',
                        dataType        : 'JSON',
                        success:function(json){
                            if (json.success==true) {
                                $("#load-field").hide().fadeIn(1000).html(json.content);
                            }else {
                                $("#alert-info").html(`<div class="alert alert-danger">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                            <strong>Kesalahan!</strong> `+json.alert+`.
                                                        </div> `);
                            }
                        }
                  });
    })
</script>
