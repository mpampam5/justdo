<?php
 $str="";

 $str.='<section class="breadcrumbs">
   <div class="container">
     <ol class="breadcrumb">
       <li><a href="<?=site_url(\'backend\')?>">Home</a></li>
       <li><a href="<?=site_url(\'backend/'.strtolower($controller_name).'\')?>"><?=ucfirst($temp_title)?></a></li>
       <li class="active">Detail</li>
     </ol>
   </div>
 </section>

 <section>
   <div class="container">
     <div class="row">
       <div class="col-lg-10 mx-auto">
         <div class="card">
             <div class="card-header">
               <h5 class="card-title">Detail <?=ucfirst($temp_title)?></h5>
             </div>

               <div class="card-block">
                   <div class="row">
                     <div class="col-md-12">
                       <table class="table table-bordered">';

                       foreach ($field_all as $field) {
                           if ($field->primary_key!=1) {
                             $str.="\n\n\t\t\t\t\t\t\t\t\t\t\t\t\t<tr>
                             <th>".ucwords(str_replace("_"," ",$field->name))."</th>
                             <td><?=\$$field->name?></td>
                          </tr>";
                           }
                         }





$str.="\n\n\t\t\t\t\t\t\t\t\t\t\t\t";
$str.='</table>
                     </div>
                   </div>
               </div>


             <div class="card-footer">
               <a href="<?=site_url("backend")?>" class="btn btn-sm btn-info"><i class="fa fa-home"></i></a>
               <a href="<?=site_url(\'backend/\'.$this->uri->segment(2))?>"  class="btn btn-sm btn-default"> kembali</a>
             </div>

           </div>
       </div>
     </div>
   </div>
 </section>
';


$created_file_detail = $str;
