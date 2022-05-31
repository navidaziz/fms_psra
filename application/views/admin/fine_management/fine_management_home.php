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
	<div class="modal-dialog" role="document" style="width: 100%;">
		<div class="modal-content" id="view_school_detail_body">


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
			<?php if (validation_errors()) {
				echo validation_errors();
			} ?>
			<h4>School Detail</h4>
			<form class="for m-inline" action="<?php echo site_url(ADMIN_DIR . "fine_management/add_fine"); ?>" id="add_fine" method="post">

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
						</td>
					</tr>
					<tr>
						<td>
							Tehsil Name
						</td>
						<td>
							<input class="r_only" required type="text" value="" name="tehsil_name" placeholder="Teshil Name" id="tehsil_name" />
						</td>
					</tr>
					<tr>
						<td>
							Address
						</td>
						<td>
							<input class="r_only" style="width: 100%;" required type="text" value="" name="address" placeholder="Address" id="address" />
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
							</select></td>
					</tr>
				</table>
		</div>
	</div>


	<div class="col-md-8">
		<div style="border:1px solid #9FC8E8; border-radius: 10px; min-height: 10px; background-color: white; padding:10px">
			<h4>Fine Detail</h4>
			<div class="row">
				<div class="col-md-4">

					<table class="table">


						<tr>
							<td>File Number</td>
							<td><input required type="text" value="" name="file_number" placeholder="Letter / File Number" id="file_number" />
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
										<option value="<?php echo $fine_type->fine_type_id; ?>"><?php echo $fine_type->fine_title; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Complaint Channel</td>
							<td><?php
								$query = "SELECT * FROM `fine_channels`";
								$fine_channels = $this->db->query($query)->result();
								foreach ($fine_channels as $fine_channel) { ?>
									<input required type="radio" name="fine_channel_id" id="fine_channel_id" value="<?php echo $fine_channel->fine_channel_id; ?>" />
									<?php echo $fine_channel->fine_channel_title; ?> <br />
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>
								Amount </td>
							<td>
								<input required onkeyup="inWords()" type="number" value="" name="fine_amount" placeholder="Example 2000 etc." id="amount" />
								<div style="text-transform: capitalize;  text-align:left">
									<small style="color: red;"> In Words: </small> <small style="color: green;" id="number_to_words"></small>
								</div>
							</td>
						<tr>
							<td>
								<label class="control-label" for="File Date">Date</label>
							</td>
							<td>
								<input required type="date" value="" name="file_date" placeholder="" id="file_date" />
							</td>
						</tr>
					</table>
				</div>
				<div class="col-md-8">

					<label class="control-label" for="numberOfClassroom">Fine Detail</label>
					<br />
					<textarea required placeholder="Fine Detail" cols="" rows="11" name="remarks" style="width: 100%;" id="remarks"></textarea>

					<div style="text-align: center;">
						<input class="btn btn-success btn-sm" style="margin-top: 10px;" type="submit" value="Add Fine" name="Add Fine">


					</div>

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

				<div class="table-responsive" id="fine_school_list">





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