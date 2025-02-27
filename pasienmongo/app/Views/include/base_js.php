<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/dataTables.bootstrap4.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/vendor/chart.js/chart.js"></script>

<script src="assets/js/demo/datatables-demo.js"></script>
<script src="assets/js/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {

		if (page == "dashboard") {
			$("#sidebar_dashboard").addClass('active').css('background-color','rgba(10,10,10,0.2)');


		}else if (page == "terms") {
			$("#sidebar_terms").addClass('active').css('background-color','rgba(10,10,10,0.2)');


		}else if (page == "user") {
			$("#sidebar_user").addClass('active').css('background-color','rgba(10,10,10,0.2)');


		}else if (page == "paket") {
			$("#sidebar_paket").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "fitting") {
			$("#sidebar_fitting").addClass('active').css('background-color','rgba(10,10,10,0.2)');
			

		}else if (page == "akad") {
			$("#sidebar_akad").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "resepsi") {
			$("#sidebar_resepsi").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "ngunduh") {
			$("#sidebar_ngunduh").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "ibu_pengantin") {
			$("#sidebar_ibu_pengantin").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "invoice") {
			$("#sidebar_invoice").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "transaksi") {
			$("#sidebar_transaksi").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "bapak_pengantin") {
			$("#sidebar_bapak_pengantin").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "jaga_kado") {
			$("#sidebar_jaga_kado").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "report") {
			$("#sidebar_report").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}else if (page == "items") {
			$("#sidebar_items").addClass('active').css('background-color','rgba(10,10,10,0.2)');

		}
	});



</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tentang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	
});

	// function jml_notif(){
	// 	 $.ajax({
 //                    url:'fungsi/back_controller.php?route=jml_notif',
 //                    method:'GET',
 //                    dataType:'JSON',
 //                    success:function(json){
 //                    	if (json.counts != 0) {
 //                        $("#jml_notif").text(json.counts);
 //                        }
 //                    }
 //                });
	// }

	// function notif(){
	// 	 $.ajax({
 //                    url:'fungsi/back_controller.php?route=notif',
 //                    method:'GET',
 //                    dataType:'JSON',
 //                    success:function(data){
 //                        $("#notif").html(data.b);
 //                    }
 //                });
	// }


        function logout(){
                $.ajax({
                    url:'fungsi/back_controller.php',
                    data:"route=logout",
                    method:'POST',
                    success:function(){
                        swal({
                                        title: "Berhasil!",
                                        text: "Anda telah logout!",
                                        icon: "success"
                                      });
                        window.location.href = 'index.php';
                    }
                })
            }

</script>