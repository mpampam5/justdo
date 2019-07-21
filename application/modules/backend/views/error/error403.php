<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto text-center">
                <h1 class="m-t-100">ERROR 403</h1>
                <h4><small class="text-danger">Anda tidak di izinkan mengakses halaman <a href="#" class="text-info"><?=$this->session->flashdata("uri");?></a>.</small></h4>
                <a href="javascript:history.back()" class="btn btn-danger btn-sm"> Kembali Ke Halaman Sebelumnya</a>
                <a href="" class="btn btn-info btn-sm"><i class="fa fa-home"></i></a>
            </div>
        </div>
    </div>
</section>