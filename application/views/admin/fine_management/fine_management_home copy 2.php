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
</script>

<div id="view_school_detail" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="view_school_detail_body">
			<div class="modal-body">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Add School</h4>
				</div>
				<table class="table">
					<tr>
						<td colspan="2">
							Fine on <input onclick="$('#level_id').prop('value','');$('.registered').show();$('.r_only').prop('value','');$('.r_only').prop('readonly',true);$('#school_id').prop('required',true);$('#school_id').prop('required',true);" type="radio" name="registered" value="1" /> Registered
							<input onclick="$('#level_id').prop('value','');$('.registered').hide();$('#school_id').prop('value','');$('.r_only').prop('value','');$('.r_only').prop('readonly',false);$('#school_id').prop('required',false);$('#school_id').prop('required',false);" checked type="radio" name="registered" value="0" /> Unregistered School ?

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
<!-- /PAGE HEADER -->


<!-- PAGE MAIN CONTENT -->
<div class="row">
	<div class="col-md-4">
		<div style="border:1px solid #9FC8E8; border-radius: 10px; min-height: 10px; background-color: white; padding:10px">

			<h4>School Detail</h4>
			<form class="for m-inline" action="<?php echo site_url(ADMIN_DIR . "fine_management/add_fine"); ?>" id="add_fine" method="post" enctype="multipart/form-data">

				<table class="table">
					<tr>
						<td colspan="2">
							Fine on <input onclick="$('#level_id').prop('value','');$('.registered').show();$('.r_only').prop('value','');$('.r_only').prop('readonly',true);$('#school_id').prop('required',true);$('#school_id').prop('required',true);" type="radio" name="registered" value="1" /> Registered
							<input onclick="$('#level_id').prop('value','');$('.registered').hide();$('#school_id').prop('value','');$('.r_only').prop('value','');$('.r_only').prop('readonly',false);$('#school_id').prop('required',false);$('#school_id').prop('required',false);" checked type="radio" name="registered" value="0" /> Unregistered School ?

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
				</table>
		</div>
	</div>


	<div class="col-md-8">
		<div style="border:1px solid #9FC8E8; border-radius: 10px; min-height: 10px; background-color: white; padding:10px">
			<h4>Fine Detail</h4>
			<div class="row">
				<div class="col-md-5">

					<table class="table">


						<tr>
							<td style="width: 450px;">File Number</td>
							<td><input required type="text" value="<?php echo set_value("file_number"); ?>" name="file_number" placeholder="File Number" id="file_number" />
								<?php echo form_error("file_number", "<p class=\"text-danger\">", "</p>"); ?>
							</td>
						</tr>
						<tr>
							<td>Letter Number</td>
							<td><input required type="text" value="<?php echo set_value("letter_no"); ?>" name="letter_no" placeholder="Letter Number" id="letter_name" />
								<?php echo form_error("file_number", "<p class=\"text-danger\">", "</p>"); ?>
							</td>
						</tr>
						<tr>
							<td>
								letter Date
							</td>
							<td>
								<input required type="date" value="<?php echo set_value("file_date"); ?>" name="file_date" placeholder="" id="file_date" />
								<?php echo form_error("file_date", "<p class=\"text-danger\">", "</p>"); ?>
							</td>
						</tr>
						<tr>
							<td>
								Fine Types
							</td>
							<td>
								<select required class="select2" id="fine_type_id" name="fine_type_id" style="width: 100%;">
									<option value="">Select Fine Type</option>
									<?php
									$query = "SELECT * FROM `fine_types`";
									$fine_types = $this->db->query($query)->result();
									foreach ($fine_types as $fine_type) { ?>
										<option <?php if ($fine_type->fine_type_id == set_value("fine_type_id")) { ?> selected <?php } ?> value="<?php echo $fine_type->fine_type_id; ?>"><?php echo $fine_type->fine_title; ?></option>
									<?php } ?>
								</select>
								<?php echo form_error("fine_type_id", "<p class=\"text-danger\">", "</p>"); ?>
							</td>
						</tr>
						<tr>
							<td>Channel</td>
							<td><?php
								$query = "SELECT * FROM `fine_channels`";
								$fine_channels = $this->db->query($query)->result();
								foreach ($fine_channels as $fine_channel) { ?>
									<input <?php if ($fine_channel->fine_channel_id == set_value("fine_channel_id")) { ?> checked <?php } ?> required type="radio" name="fine_channel_id" id="fine_channel_id" value="<?php echo $fine_channel->fine_channel_id; ?>" />
									<?php echo $fine_channel->fine_channel_title; ?> <br />
								<?php } ?>

								<?php echo form_error("fine_channel_id", "<p class=\"text-danger\">", "</p>"); ?>
							</td>
						</tr>
						<tr>
							<td>
								Amount </td>
							<td>
								<input required onkeyup="inWords()" type="number" value="<?php echo set_value("fine_amount"); ?>" name="fine_amount" placeholder="Example 2000 etc." id="amount" />
								<?php echo form_error("fine_amount", "<p class=\"text-danger\">", "</p>"); ?>

							</td>
						</tr>


					</table>
					<div style="text-transform: capitalize;  text-align:left">

						<small style="color: red;"> In Words: </small> <small style="color: green;" id="number_to_words"></small>
					</div>
				</div>
				<div class="col-md-7">

					<label class="control-label" for="numberOfClassroom">Fine Detail</label>
					<br />
					<textarea required placeholder="Fine Detail" cols="" rows="11" name="remarks" style="width: 100%;" id="remarks"><?php echo set_value("remarks"); ?></textarea>
					<?php echo form_error("remarks", "<p class=\"text-danger\">", "</p>"); ?>
					<table class="table">
						<tr>
							<td>
								Fine File: <input type="file" name="fine_file" id="fine_file" style="display: inline;" />
								<?php echo form_error("fine_file", "<p class=\"text-danger\">", "</p>"); ?>

							</td>
							<td>
								<input class="btn btn-success btn-sm" style="margin-top: 10px;" type="submit" value="Add Fine" name="Add Fine">

							</td>
						</tr>
					</table>


				</div>
			</div>
		</div>
	</div>
	</form>

</div>
<br />
<div class="row">
	<div class="col-md-12">
		<div class="box border blue" id="messenger">
			<div class="box-title">
				<h4><i class="fa fa-bell"></i>School Fine List</h4>
				<div class="tools">



				</div>
			</div>
			<div class="box-body">

				<div class="table-responsive">

					<table id="fined_school_list" class="table table-bordered table-striped" style="font-size: 10px !important;">
						<thead>

							<tr>
								<th>#</th>
								<th>School ID</th>
								<th>School Name</th>
								<th>District</th>
								<th>Tehsil</th>
								<th>Address</th>
								<th>Frequency</th>
								<th>Total Fine</th>
								<th>Waived Off</th>
								<th>Total Paid</th>
								<th>Total Remaining</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="fine_school_list">


							<?php
							$count = 1;
							$query = "SELECT fs.fined_school_id, fs.school_id, fs.school_name, fs.district_name, fs.tehsil_name, fs.address ,
								SUM(IF(f.status=1,1,0)) as density,
								SUM(IF(f.status=1,f.fine_amount,0)) as total_fine,
								SUM(IF(f.status=3,1,0)) as w_offed,
								(SELECT SUM(fy.deposit_amount) FROM fine_payments as fy WHERE fy.is_deleted=0 AND fy.fined_school_id = fs.fined_school_id ) as paid_amount
	                            FROM fines as f
								INNER JOIN fined_schools fs ON (fs.fined_school_id = f.fined_school_id)
								GROUP BY f.fined_school_id
								";
							$fines = $this->db->query($query)->result();
							foreach ($fines as $fine) {
							?>
								<tr>
									<td><?php echo $count++; ?></td>
									<td><?php echo $fine->school_id; ?></td>
									<td><?php echo $fine->school_name; ?></td>
									<td><?php echo $fine->district_name; ?></td>
									<td><?php echo $fine->tehsil_name; ?></td>
									<td><?php echo $fine->address; ?></td>
									<td><?php echo $fine->density; ?></td>
									<td><?php echo $fine->total_fine; ?></td>
									<td><?php echo $fine->w_offed; ?></td>
									<td><?php echo $fine->paid_amount; ?></td>
									<td><?php echo $fine->total_fine - $fine->paid_amount; ?></td>
									<td>
										<button onclick="get_add_fine_payment_form('<?php echo $fine->fined_school_id; ?>')" class="btn btn-link btn-sm">
											View
										</button>
										<a href="<?php echo site_url(ADMIN_DIR . "fine_management/view_fine_detail/" . $fine->fined_school_id); ?>">
											View
										</a>
									</td>
								</tr>
							<?php } ?>

						</tbody>
					</table>


					<table id="ajax_fine_list" class="table table-bordered table-striped" style="font-size: 10px !important;">
						<thead>

							<tr>
								<!-- <th>#</th> -->
								<th>School ID</th>
								<th>REG No.</th>
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


	$(document).ready(function() {
		$('#ajax_fine_list').DataTable({
			'language': {
				emptyTable: "No record found.",
				zeroRecords: "No record found.<br /><a class='btn btn-primary btn-sm' href='#' onclick=\"add_school_model()\" >Add school in fine list</a>"
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

	});
</script>