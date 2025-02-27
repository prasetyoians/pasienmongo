<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ADMIN JEV</title>
    <!-- css -->
    <?php include "include/base_css.php" ?>
    <style type="text/css">
      input[type=checkbox] {
            transform: scale(2.0);
              accent-color: #e74c3c;

        }
    </style>
  </head>
  <body id="page-top">
    <!-- navbar -->
    <?php include "include/base_nav.php" ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <h1 class="h3 mb-2 text-gray-800">Terms And Condition</h1>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
       
        <div class="card-body">
          <div class="table-responsive">
      <button class="btn btn-success float-right" onclick="tambah_terms();"><i class="fa fa-plus"></i> Tambah</button>
      <br>
      <br>

            <table class="table table-stripped table-bordered" id="table_terms">
              <thead>
                
                  <tr>
                    <th>No. </th>
                
                    <th style="width: 800px;">Keterangan</th>
                 
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
<!-- End of Main Content -->
<!-- Footer -->
  <?php include "include/base_footer.php" ?>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<script type="text/javascript">
  var page ="terms";
</script>
<!-- js -->
  <?php include "include/base_js.php" ?>
</body>
</html>



 <div class=" modal fade" id="modal_terms" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal text-right mt-3 mr-3"  data-bs-dismiss="modal"><i class="fa fa-times"></i></div>
                      <div class="container">
                        <div class="modal-header">
                          <h5>Save Terms And Condition</h5>
                        </div>
                        <div class="modal-body">
                         <input type="hidden" name="id_terms_and_condition" id="id_terms_and_condition">
                         <input type="hidden" name="tipe" id="tipe">
                       
                           
                            <div class="col-md-12">
                              <label class="label">Keterangan</label>
                              <textarea class="form-control" id="keterangan" style="height: 300px;"></textarea>
                            </div>
                        
                        
                
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-success btn-block" onclick="save_terms()" id="btn_simpan_payment" >Simpan</button>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
</div>






<script type="text/javascript">
  $(document).ready(function(){
    table_terms();
  });


  function table_terms(){

        $('#table_terms').DataTable( {
                'processing': true,
                'serverSide': true,
                'serverMethod': 'GET',
                "ajax": {
                      'url':'fungsi/back_controller.php',
                      'data':{
                        'route':'table_terms',
                        
                      }
                    },
                "columns": [
                    { "data": "no" }, 
                   
                    { "data": "keterangan" }, 
                 
                 
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


function tambah_terms(){
  $("#modal_terms").modal('toggle');
  $("#tipe").val(0);
}

function save_terms(){
  var keterangan = $("#keterangan").val();
  var tipe = $("#tipe").val();
  var id_terms_and_condition = $("#id_terms_and_condition").val();

    var route ="save_terms";
 
  if (keterangan != "" ) {

    $.ajax({
          url:"fungsi/back_controller.php",
          data:"route="+route+"&id_terms_and_condition="+id_terms_and_condition+"&tipe="+tipe+"&keterangan="+keterangan,
          method:"POST",
          dataType:"JSON",
          success:function(json){
              swal({
                  title: "Berhasil!",
                  text: "Save Terms and Condition berhasil!",
                  icon: "success"
              });

                  $('#table_terms').DataTable().destroy();
                     table_terms();

                     $("#modal_terms").modal('toggle');
                     $("#keterangan").val("");
           
          }
    });

   }else{
              swal({
                  title: "Peringatan!",
                  text: "ada input yang masih kosong!",
                  icon: "warning"
              });
    }
}


function edit_terms(id_terms_and_condition){
    var route ="edit_terms";

 $.ajax({
          url:"fungsi/back_controller.php",
          data:"route="+route+"&id_terms_and_condition="+id_terms_and_condition,
          method:"GET",
          dataType:"JSON",
          success:function(json){
                     $("#modal_terms").modal('toggle');
                     $("#tipe").val(1);
                     $("#keterangan").val(json.keterangan);
                     $("#id_terms_and_condition").val(id_terms_and_condition);
           
          }
    });
}


function delete_terms(id_terms_and_condition){

           
    swal({
            title: 'Apa kamu yakin untuk menghapus terms and condition?',
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
          url:"fungsi/back_controller.php",
          data:"route=delete_terms&id_terms_and_condition="+id_terms_and_condition,
          method:"POST",
          dataType:"JSON",
          success:function(json){
              
                swal({
                      title: "Delete terms and condition berhasil!",
                     text: "aksi hapus berhasil!",
                     icon: "success"
                     });


                 $('#table_terms').DataTable().destroy();
                     table_terms();

             
                    }
                  })


                } else {
                               swal.close();
                             }
                       });
}

</script>