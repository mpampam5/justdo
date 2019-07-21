<section class="breadcrumbs">
   <div class="container">
     <ol class="breadcrumb">
       <li><a href="<?=site_url('backend')?>">Home</a></li>
       <li><a href="<?=site_url('backend/page')?>"><?=ucfirst($temp_title)?></a></li>
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
                       <table class="table table-bordered">

													<tr>
                             <th>Title</th>
                             <td><?=$title?></td>
                          </tr>

													<tr>
                             <th>Slug</th>
                             <td><?=$slug?></td>
                          </tr>

													<tr>
                             <th>Deskripsi</th>
                             <td><?=$deskripsi?></td>
                          </tr>

													<tr>
                             <th>Image</th>
                             <td><?=$image?></td>
                          </tr>

													<tr>
                             <th>Created At</th>
                             <td><?=$created_at?></td>
                          </tr>

													<tr>
                             <th>Update At</th>
                             <td><?=$update_at?></td>
                          </tr>

												</table>
                     </div>
                   </div>
               </div>


             <div class="card-footer">
               <a href="<?=site_url("backend")?>" class="btn btn-sm btn-info"><i class="fa fa-home"></i></a>
               <a href="<?=site_url('backend/'.$this->uri->segment(2))?>"  class="btn btn-sm btn-default"> kembali</a>
             </div>

           </div>
       </div>
     </div>
   </div>
 </section>
