
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- Begin Page konten -->
    <div class="container-fluid">
      <h1 class="h1 mb-2 text-gray-800">Pasien</h1>
      <p class="text-gray-800">Home > <i class="badge bg-primary text-white">Pasien</i></p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
       
        <div class="card-body">
          <div class="table-responsive">

          <div class="row">
          
            <div class="col-4">
              <label class="label"><i class="fa fa-filter"></i> Filter Status: </label>

              <select class="form-control" id="filter" onchange="filter_status()">
                <option value="all">All</option>
                <?php foreach ($statusList as $s ): ?>
                  
                <option value="<?=$s['_id']?>"><?=$s['nama_status']?></option>
                <?php endforeach ?>

              </select>
            </div>
              
            
            <div class="col-8">
      <button class="btn btn-success float-right" onclick="tambah_pasien();" style="margin-top: 25px;"><i class="fa fa-plus"></i> Tambah</button>
              
            </div>
          </div>
          <br>
            
      

            <table class="table table-stripped table-bordered" id="table_pasien">
              <thead>
                
                  <tr>
                    <th>No. </th>
                
                    <th>Nama</th>
                    <th>NIK </th>
                    <th>Alamat</th>
                    <th>telepon</th>
                    <th>Status</th>
                 
                    <th>Aksi</th>
                  </tr>
            
              </thead>
              
            </table>
          </div>
        </div>
      </div>
    <!-- /.container-fluid -->
    </div>
  <!-- /.container-fluid -->
  </div>
<!-- End of Main konten -->
<!-- Footer -->
</div>
<!-- End of konten Wrapper -->
</div>



 <div class=" modal fade" id="modal_pasien" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal text-right mt-3 mr-3"  data-bs-dismiss="modal"><i class="fa fa-times"></i></div>
                      <div class="container">
                        <div class="modal-header">
                          <h5>Save Pasien</h5>
                        </div>
                        <div class="modal-body">
                         <input type="hidden" name="id_pasien" id="id_pasien">
                         <input type="hidden" name="tipe" id="tipe">
                          

                           <div class="col-md-12">
                              <label class="label">Nama</label>
                              <input type="text" name="nama" id="nama" class="form-control">
                            </div>
                            <br>
                            <div class="col-md-12">
                              <label class="label">NIK <span style="font-size: 11px" class="badge bg-warning text-white">(NIK tidak boleh sama dengan data lainya!)</span></label>
                              <input type="text" name="nik" id="nik" class="form-control">
                            </div>
                            <br>

                            <div class="col-md-12">
                              <label class="label">Alamat</label>
                              <textarea id="alamat" class="form-control"></textarea>
                            </div>
                            <br>
                            <div class="col-md-12">
                              <label class="label">Telepon</label>
                              <input type="text" name="telepon" id="telepon" class="form-control">
                            </div>
                            <br>

                             

                             <div class="col-md-12">
                              <label class="label">Status</label>
                              <select class="form-control" id="id_status">
                                 <?php foreach ($statusList as $sa ): ?>
                                  <option value="<?=$sa['_id']?>"><?=$sa['nama_status']?></option>
                                  <?php endforeach ?>
                              </select>
                            </div>

                            <br>
                        
                        
                
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success" onclick="save_pasien()" id="btn_simpan_payment" >Simpan</button>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
</div>




<!-- End of Footer -->

<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->

<script type="text/javascript">
  
  $(document).ready(function(){
    table_pasien('all');
  });


  function table_pasien(id_status){
    $('#table_pasien').DataTable( {
                'processing': true,
                'serverSide': true,
                'serverMethod': 'GET',
                "ajax": {
                      'url':'<?= base_url('/table_pasien') ?>',
                      'data':{
                         'id_status':id_status,
                        
                      }
                    },
                "columns": [
                    { "data": "no" }, 
                   
                    { "data": "nama" }, 
                    { "data": "nik" }, 
                    { "data": "alamat" }, 
                    { "data": "telepon" }, 
                    { "data": "status" }, 
                 
                 
                    { "data": "aksi" }, 
                ],
                "order": [[1, 'asc']],
                "paging":   true,
                "ordering": true,
                "info":     true,
                "filter": true,
                columnDefs: '',
                select: {
                  style: 'os',
                  selector: 'td:first-child'
                }
              });
  }

  function filter_status(){
    var filter = $("#filter option:selected").val();
     $('#table_pasien').DataTable().destroy();
     table_pasien(filter);
  }




function tambah_pasien(){
  $("#modal_pasien").modal('toggle');
  $("#tipe").val(0);
  $("#id_pasien").val("");
}



function save_pasien(){
  var nama = $("#nama").val();
  var nik = $("#nik").val();
  var alamat = $("#alamat").val();
  var telepon = $("#telepon").val();
  var id_status = $("#id_status option:selected").val();
  var tipe = $("#tipe").val();
  var id_pasien = $("#id_pasien").val();

 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') // Ambil token dari meta tag
                }
            });



    $.ajax({
          url:"<?= base_url('/save_pasien') ?>",
          data:"nama="+nama+"&alamat="+alamat+"&telepon="+telepon+"&nik="+nik+"&id_status="+id_status+"&tipe="+tipe+"&id_pasien="+id_pasien,
          method:"POST",
          dataType:"JSON",
          success:function(json){
            if (json.validate == 1) {
                if (json.ceknik == 1) {

                  swal({
                      title: "Berhasil!",
                      text: "Save pasien berhasil!",
                      icon: "success"
                  });

                       var filter = $("#filter option:selected").val();
                       $('#table_pasien').DataTable().destroy();
                       table_pasien(filter);

                         $("#modal_pasien").modal('toggle');
                         $("#nama").val("");
                         $("#nik").val("");
                         $("#alamat").val("");
                         $("#telepon").val("");
                        $('meta[name="csrf_token"]').attr('content',json.csrf_hash);  
                }else{
                  swal({
                      title: "Peringatan!",
                      text: "NIK telah dipakai, masukan NIK lainya!",
                      icon: "warning"
                  });
                        $('meta[name="csrf_token"]').attr('content',json.csrf_hash);  

                }

              }else{
                swal({
                    title: "Peringatan!",
                    text: "Ada input yang belum tersi!",
                    icon: "warning"
                });
                      $('meta[name="csrf_token"]').attr('content',json.csrf_hash);           

              }
          }
    });

   
}


function edit_pasien(id_pasien){
    

 $.ajax({
          url:"<?= base_url('/get_pasien_id/') ?>"+id_pasien,
         
          method:"GET",
          dataType:"JSON",
          success:function(json){
                     $("#modal_pasien").modal('toggle');
                     $("#tipe").val(1);
                     $("#nama").val(json.data.nama);
                     $("#alamat").val(json.data.alamat);
                     $("#telepon").val(json.data.telepon);
                     $("#nik").val(json.data.nik);
                     $("#id_status").val(json.data.id_status);
                     $("#id_pasien").val(id_pasien);
           
          }
    });
}


function delete_pasien(id_pasien){

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') // Ambil token dari meta tag
                }
            });
    swal({
            title: 'Apa kamu yakin untuk menghapus pasien?',
            text: "Data tidak akan bisa dikembalikan lagi ",
            type: 'warning',
            icon:"warning",
            buttons:{
              confirm: {
                text : 'Yes!',
                className : 'btn btn-success'
              },
              cancel: {
                visible: true,
                className: 'btn btn-danger'
              }
            }
          }).then((Delete) => {
            if (Delete) {

        $.ajax({
          url:"<?= base_url('/delete_pasien/') ?>"+id_pasien,
          method:"DELETE",
          dataType:"JSON",
          success:function(json){
              
                swal({
                      title: "Delete pasien!",
                     text: "aksi hapus berhasil!",
                     icon: "success"
                     });


                 var filter = $("#filter option:selected").val();
                 $('#table_pasien').DataTable().destroy();
                 table_pasien(filter);

                     $('meta[name="csrf_token"]').attr('content',json.csrf_hash); 
             
                    }
                  })


                } else {
                               swal.close();
                             }
                       });
}


</script>
<?= $this->endSection() ?>