<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script>
	function get_school_add_fine_form() {
		$.ajax({
				method: "POST",
				url: "<?php echo site_url(ADMIN_DIR . "fine_management/get_school_add_fine_form"); ?>",
				data: {},
			})
			.done(function(respose) {
				$('#view_school_detail_body').html(respose);
			});
		$('#view_school_detail').modal('toggle');
	}

	function add_school_model() {
		$('#view_school_detail').modal('toggle');
	}

	function get_add_fine_payment_form(fined_school_id) {
		$.ajax({
				method: "POST",
				url: "<?php echo site_url(ADMIN_DIR . "fine_management/get_add_fine_payment_form"); ?>",
				data: {
					fined_school_id: fined_school_id
				},
			})
			.done(function(respose) {
				$('#view_school_detail_body').html(respose);
			});
		$('#view_school_detail').modal('show');
	}

	function add_school_in_fine_list() {
		var registered = $('#registered').val();
		var school_id = $('#school_id').val();
		var school_registration_no = $('#school_registration_no').val();
		var school_name = $('#school_name').val();
		var tehsil_name = $('#tehsil_name').val();
		var district_name = $('#district_name').val();
		var address = $('#address').val();
		var school_contact_no = $('#school_contact_no').val();
		var level_id = $('#level_id').val();
		$.ajax({
				method: "POST",
				url: "<?php echo site_url(ADMIN_DIR . "fine_management/add_school_in_fine_list"); ?>",
				data: {
					registered: registered,
					school_id: school_id,
					school_registration_no: school_registration_no,
					school_name: school_name,
					district_name: district_name,
					tehsil_name: tehsil_name,
					address: address,
					school_contact_no: school_contact_no,
					level_id: level_id
				},
			})
			.done(function(response) {

				var obj = JSON.parse(response);
				console.log(obj.msg);

				if (obj.error == true) {
					$('#add_school_in_list_error').html(obj.msg);
				} else {
					location.reload();
					//$('#add_school_in_list_error').html(obj.msg);
					//get_ajax_datatable();

				}
			});

	}
</script>

<div id="view_school_detail" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="view_school_detail_body">
			<div class="modal-body">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Add School</h4>
				</div>
				<div id="add_school_in_list_error"></div>
				<table class="table">
					<tr>
						<td colspan="2">
							Fine on <input id="registered" onclick="$('#level_id').prop('value','');$('.registered').show();$('.r_only').prop('value','');$('.r_only').prop('readonly',true);$('#school_id').prop('required',true);$('#school_id').prop('required',true);" type="radio" name="registered" value="1" /> Registered
							<input id="registered" onclick="$('#level_id').prop('value','');$('.registered').hide();$('#school_id').prop('value','');$('.r_only').prop('value','');$('.r_only').prop('readonly',false);$('#school_id').prop('required',false);$('#school_id').prop('required',false);" checked type="radio" name="registered" value="0" /> Unregistered School ?

						</td>
					</tr>

					<tr class="registered" style="display: none;">
						<td width="130">
							School Id </td>
						<td>
							<input type="number" value="" name="school_id" placeholder="School Id" id="school_id" />
							<div id="school_status"></div>
						</td>
					</tr>
					<tr class="registered" style="display: none;">
						<td>
							Registration No </td>
						<td>
							<input class="r_only" type="number" value="" name="school_registration_no" placeholder="School Registration No" id="school_registration_no" />
						</td>
					</tr>
					<tr>
						<td>
							School Name </td>
						<td>
							<input class="r_only" style="width: 100%;" required type="text" value="" name="school_name" placeholder="School Name" id="school_name" />
							<?php echo form_error("school_name", "<p class=\"text-danger\">", "</p>"); ?>
						</td>
					</tr>
					<tr>
						<td>
							District Name
						</td>
						<td>
							<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
							<script>
								$(function() {
									var availableTags = [
										<?php $query = "SELECT districtTitle FROM districts";
										$districts = $this->db->query($query)->result();
										foreach ($districts as $district) {
										?> "<?php echo $district->districtTitle; ?>",

										<?php } ?>
									];
									$("#district_name").autocomplete({
										source: availableTags
									});
								});
							</script>


							<input class="r_only" required type="text" value="" name="district_name" placeholder="District Name" id="district_name" />
							<?php echo form_error("district_name", "<p class=\"text-danger\">", "</p>"); ?>
						</td>
					</tr>
					<tr>
						<td>
							Tehsil Name
						</td>
						<td>
							<input class="r_only" required type="text" value="" name="tehsil_name" placeholder="Teshil Name" id="tehsil_name" />
							<?php echo form_error("tehsil_name", "<p class=\"text-danger\">", "</p>"); ?>
						</td>
					</tr>
					<tr>
						<td>
							Address
						</td>
						<td>
							<input class="r_only" style="width: 100%;" required type="text" value="" name="address" placeholder="Address" id="address" />
							<?php echo form_error("address", "<p class=\"text-danger\">", "</p>"); ?>
						</td>
					</tr>
					<tr>
						<td>
							Contact No.
						</td>
						<td>
							<input class="r_only" style="width: 100%;" required type="text" value="" name="contact_number" placeholder="Contact Number" id="contact_number" />
							<?php echo form_error("contact_number", "<p class=\"text-danger\">", "</p>"); ?>
						</td>
					</tr>

					<tr>
						<td>School Level</td>
						<td><select class="r_only_select" name="level_id" id="level_id" required>
								<option value="">Select Level</option>
								<?php $query = "SELECT * FROM levels";
								$levels = $this->db->query($query)->result();
								foreach ($levels as $level) {
								?>
									<option value="<?php echo $level->levelofInstituteId; ?>"><?php echo $level->levelofInstituteTitle; ?></option>
								<?php } ?>
							</select>
							<?php echo form_error("level_id", "<p class=\"text-danger\">", "</p>"); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<button onclick="add_school_in_fine_list()" class="btn btn-success">Add School</button>
						</td>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="page-header">
			<!-- STYLER -->

			<!-- /STYLER -->
			<!-- BREADCRUMBS -->
			<ul class="breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo site_url($this->session->userdata(ADMIN_DIR . "role_homepage_uri")); ?>">Home</a>
				</li>
				<li><?php echo $title; ?></li>
			</ul>
			<!-- /BREADCRUMBS -->
			<div class='row'>

				<div class='col-md-6'>
					<div class='clearfix'>
						<h3 class='content-title pull-left'><?php echo $title; ?></h3>
					</div>
					<div class='description'><?php echo $title; ?></div>
				</div>

				<div class='col-md-6'>
					<div class='pull-right' id="fine_summary">

					</div>
				</div>

			</div>


		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box border blue" id="messenger">
			<div class="box-title">
				<h4><i class="fa fa-list"></i>Fined School List</h4>
				<div class="tools">



				</div>
			</div>
			<div class="box-body">

				<div class="table-responsive">


					<table id="ajax_fine_list" class="table table-bordered table-striped" style="font-size: 10px !important;">
						<thead>

							<tr>
								<!-- <th>#</th> -->
								<th>School ID</th>
								<th>Reg No.</th>
								<th>School Name</th>
								<th>District</th>
								<th>Tehsil</th>
								<th>Address</th>
								<th>Frequency</th>
								<th>Total Fine</th>
								<th>Waived Off</th>
								<th>Total Paid</th>
								<th>Total Remaining</th>
								<th>View</th>
							</tr>
						</thead>
					</table>
				</div>


			</div>

		</div>
	</div>
	<!-- /MESSENGER -->
</div>

<script>
	function fined_school_list() {
		$.ajax({
				method: "POST",
				url: "<?php echo site_url(ADMIN_DIR . "fine_management/fined_school_list"); ?>",
				data: {},
			})
			.done(function(respose) {
				$('#fine_school_list').html(respose);
			});
	}

	function fined_summary() {
		$.ajax({
				method: "POST",
				url: "<?php echo site_url(ADMIN_DIR . "fine_management/fined_summary"); ?>",
				data: {},
			})
			.done(function(respose) {
				$('#fine_summary').html(respose);
			});
	}

	$(document).ready(function() {
		fined_school_list();
		fined_summary();
	});


	var input = document.getElementById("school_id");
	input.addEventListener("keydown", function(e) {
		if (e.key === "Enter") {
			$('#school_status').html('Please Wait .....');
			school_id = e.target.value;
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(ADMIN_DIR . "fine_management/get_school_detail"); ?>",
				data: {
					school_id: school_id
				}
			}).done(function(response) {
				var data = jQuery.parseJSON(response);
				console.log(data);
				if (data.response) {
					if (data.school) {
						$('#school_registration_no').val(data.school[0].registrationNumber);
						//$('#school_registration_no').prop('readonly', true);
						$('#school_name').val(data.school[0].schoolName);
						//	$('#school_name').prop('readonly', true);
						$('#district_name').val(data.school[0].districtTitle);
						//$('#district_name').prop('readonly', true);
						$('#tehsil_name').val(data.school[0].tehsilTitle);
						//$('#tehsil_name').prop('readonly', true);
						$('#address').val(data.school[0].address);
						//	$('#address').prop('readonly', true);
						$("#level_id").val(data.school[0].level_id);
						$("#contact_number").val(data.school[0].contact_number);
						$('#school_status').html(data.message);
					} else {
						$('#school_status').html(data.message);
						$('#school_registration_no').val("");
						//$('#school_registration_no').prop('readonly', false);
						$('#school_name').val("");
						//$('#school_name').prop('readonly', false);
						$('#district_name').val("");
						//$('#district_name').prop('readonly', false);
						$('#tehsil_name').val("");
						//$('#tehsil_name').prop('readonly', false);
						$('#address').val("");
						//$('#address').prop('readonly', false);
						$('#contact_number').val("");
					}
				}
			});
		}
	});



	var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
	var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];



	function inWords() {

		num = $('#amount').val();
		if ((num = num.toString()).length > 9) return 'overflow';
		n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
		if (!n) return;
		var str = '';
		str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
		str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
		str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
		str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
		str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
		$('#number_to_words').text(str)
	}

	function inWords2(fine_id) {
		$('#inword_div_' + fine_id).show();
		num = $('#deposit_amount_' + fine_id).val();

		if ((num = num.toString()).length > 9) return 'overflow';
		n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
		if (!n) return;
		var str = '';
		str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
		str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
		str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
		str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
		str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
		$('#inword_' + fine_id).text(str);


	}
</script>

<script>
	// $(document).ready(function() {
	//   $('#main_table').DataTable({
	//     "pageLength": 65,
	//     "lengthChange": false,
	//     buttons: [
	//       'copy', 'csv', 'excel', 'pdf', 'print'
	//     ]
	//   });
	// });

	$(document).ready(function() {
		document.title = "Fine List"
		var table = $('#fined_school_list').DataTable({
			"bPaginate": false,
			dom: 'Bfrtip',
			/* buttons: [
			     'print'
			     
			     
			 ],*/

			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 0
			}],
			"order": [
				[1, 'asc']
			]
		});


		table.on('order.dt search.dt', function() {
			table.column(0, {
				search: 'applied',
				order: 'applied'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1;
				table.cell(cell).invalidate('dom');
			});
		}).draw();
	});




	function get_ajax_datatable() {
		$('#ajax_fine_list').DataTable({
			'language': {
				emptyTable: "No record found.<br /><a class='btn btn-primary btn-sm' href='#' onclick=\"add_school_model()\" >Add school in fine school list</a>",
				zeroRecords: "No record found.<br /><a class='btn btn-primary btn-sm' href='#' onclick=\"add_school_model()\" >Add school in fine school list</a>"
			},
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
				'url': '<?php echo site_url(ADMIN_DIR . "fine_management/ajax_fined_school_list"); ?>'
			},
			'columns': [
				// {

				// 	data: 's_no'
				// },
				{
					data: 'school_id'
				},
				{
					data: 'school_registration_no'
				},
				{
					data: 'school_name'
				},
				{
					data: 'district_name'
				},
				{
					data: 'tehsil_name'
				},
				{
					data: 'address'
				},
				{
					data: 'frequency'
				},
				{
					data: 'total_fine'
				},
				{
					data: 'total_waived_off'
				},
				{
					data: 'total_fine_paid'
				},
				{
					data: 'total_fine_remaining'
				},
				{
					data: 'action'
				}

			],
		});
	}

	$(document).ready(function() {
		get_ajax_datatable();

	});
</script>