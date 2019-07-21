<section class="breadcrumbs">
   <div class="container">
     <ol class="breadcrumb">
       <li><a href="<?=site_url('backend')?>">Home</a></li>
       <li><a href="<?=site_url('backend/category')?>"><?=ucfirst($temp_title)?></a></li>
       <li class="active">Detail</li>
     </ol>
   </div>
 </section>

 <section>
   <div class="container">
     <div class="row">
       <div class="col-lg-4 mx-auto">
         <div class="card">
             <div class="card-header">
               <h5 class="card-title">Detail <?=ucfirst($temp_title)?></h5>
             </div>

               <div class="card-block">
                   <div class="row">
                     <div class="col-md-12">
                        <p>Kategori : <?=$category?></p>
                     </div>
                   </div>
               </div>


             <div class="card-footer">
               <a href="<?=site_url("backend")?>" class="btn btn-sm btn-info"><i class="fa fa-home"></i></a>
               <a href="javascript:history.back()"  class="btn btn-sm btn-default"> kembali</a>
             </div>

           </div>
       </div>
     </div>
   </div>
 </section>
