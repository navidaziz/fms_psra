<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fine_management extends Admin_Controller
{

	/**
	 * constructor method
	 */
	public function __construct()
	{

		parent::__construct();
	}

	public function index()
	{

		$this->data["title"] = "Fine Management";
		$this->data["view"] = ADMIN_DIR . "fine_management/fine_management_home";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}

	public function get_school_add_fine_form()
	{

		$this->load->view(ADMIN_DIR . "fine_management/school_add_fine_form", $this->data);
	}

	public function file_upload_check()
	{
		$allowed = array('pdf');
		$filename = $_FILES['fine_file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed)) {
			$this->form_validation->set_message('file_upload_check', 'FMS only accept .pdf format. Please select a valid file format.');

			return FALSE;
		}
	}

	public function add_fine()
	{


		$validations = array(
			// $this->session->set_flashdata("msg_error", 'Error in adding fine');
			// array('field' => 'school_id', 'label' => 'School Id', 'rules' => 'required'),
			// array('field' => 'school_registration_no', 'label' => 'School Registration No', 'rules' => 'required'),
			// array('field' => 'school_name', 'label' => 'School Name', 'rules' => 'required'),
			// array('field' => 'district_name', 'label' => 'District Name', 'rules' => 'required'),
			// array('field' => 'tehsil_name', 'label' => 'Tehsil Name', 'rules' => 'required'),
			// array('field' => 'address', 'label' => 'Address', 'rules' => 'required'),
			// array('field' => 'level_id', 'label' => 'School Level', 'rules' => 'required'),
			array('field' => 'file_number', 'label' => 'File Number', 'rules' => 'required'),
			array('field' => 'letter_no', 'label' => 'Letter Number', 'rules' => 'required'),
			array('field' => 'fine_type_id', 'label' => 'Fine Category', 'rules' => 'required'),
			array('field' => 'fine_channel_id', 'label' => 'Fine Channel', 'rules' => 'required'),
			array('field' => 'fine_amount', 'label' => 'Amount', 'rules' => 'required'),
			array('field' => 'file_date', 'label' => 'File Date', 'rules' => 'required'),
			array('field' => 'remarks', 'label' => 'Remarks', 'rules' => 'required'),
			array('field' => 'fine_file', 'label' => 'File Attachment', 'rules' => 'callback_file_upload_check'),
		);
		$this->form_validation->set_rules($validations);
		$input = array();

		$input['fined_school_id'] = $fined_school_id =  (int) $this->input->post('fined_school_id');
		if ($this->form_validation->run() === TRUE) {

			$input["file_number"] = $this->input->post("file_number");
			$input["fine_type_id"] = $this->input->post("fine_type_id");
			$input["fine_channel_id"] = $this->input->post("fine_channel_id");
			$input["fine_amount"] = $this->input->post("fine_amount");
			$input["original_fine_amount"] = $this->input->post("fine_amount");

			$input["file_date"] = $this->input->post("file_date");
			$input["remarks"] = $this->input->post("remarks");
			$input["letter_no"] = $this->input->post("letter_no");
			$input['created_by'] = $this->session->userdata('userId');




			if ($this->upload_file("fine_file", NULL, FALSE, $input['fined_school_id'])) {

				$input['fine_file']  = $this->data["upload_data"]["dir"] . $this->data["upload_data"]["file_name"];
			} else {

				$this->session->set_flashdata("msg_error", "Error in file upload" . $this->upload->display_errors());
				redirect(ADMIN_DIR . "fine_management/view_fine_detail/$fined_school_id");
				exit();
			}



			if ($this->db->insert('fines', $input)) {

				$this->session->set_flashdata('msg_success', 'Fine added successfully');
				redirect(ADMIN_DIR . "fine_management/view_fine_detail/$fined_school_id");
			}
		} else {
			//$this->session->set_flashdata("msg_error", validation_errors());
			// redirect(ADMIN_DIR . "fine_management/index");
			$this->view_fine_detail($fined_school_id);
			//redirect(ADMIN_DIR . "fine_management/view_fine_detail/$fined_school_id");
		}
	}

	public function get_school_detail()
	{

		$school_id = (int) $this->input->post('school_id');
		// check $school is is already in school fined table or not 
		$query = "SELECT * FROM fined_schools WHERE school_id = '" . $school_id . "' LIMIT 1";
		$school = $this->db->query($query)->result();
		if ($school) {
			$response['response'] = true;
			$response['message'] = "School already in school fined table.";
			$school_detail[0]['registrationNumber'] = $school[0]->school_registration_no;
			$school_detail[0]['schoolName'] = $school[0]->school_name;
			$school_detail[0]['districtTitle'] = $school[0]->district_name;
			$school_detail[0]['tehsilTitle'] = $school[0]->tehsil_name;
			$school_detail[0]['address'] = $school[0]->address;
			$school_detail[0]['level_id'] = $school[0]->level_id;
			$school_detail[0]['contact_number'] = $school[0]->contact_number;

			$response['school'] = $school_detail;
			echo json_encode($response);
			exit();
		}

		if ($this->input->post("school_id")) {
			$school_id = (int) $this->input->post("school_id");
			$query = "SELECT `s`.`schoolId`, 
						   `s`.`registrationNumber`,
						   `s`.`schoolName`,
						   d.districtTitle,
						   t.tehsilTitle,
						   s.address,
						   `s`.`telePhoneNumber` as contact_number,
						  ( select s_s.level_of_school_id  from school as s_s 
						  where s_s.schools_id=s.schoolId and s_s.status=1 
						  order by s_s.session_year_id DESC LIMIT 1) as level_id
					 FROM schools as s
					 INNER JOIN district as d ON (d.districtId = s.district_id)
					 INNER JOIN tehsils as t ON (t.tehsilId = s.tehsil_id)
					 WHERE schoolId  = '" . $school_id . "'
					 AND `s`.`registrationNumber` > 0
					 ";
			$registration_db = $this->load->database('registration_db', TRUE);
			$school = $registration_db->query($query)->result();
			if ($school) {
				$response['response'] = true;
				$response['school'] = $school;
				$response['message'] = '';
				echo json_encode($response);
			} else {
				$response['response'] = true;
				$response['school'] = false;
				$response['message'] = 'School ID not found';
				echo json_encode($response);
			}
		} else {
			$response['response'] = true;
			$response['school'] = false;
			$response['message'] = 'School ID Required';
			echo json_encode($response);
		}


		//$school_id = 1;
		// $curl = curl_init();

		// curl_setopt_array($curl, array(
		// 	CURLOPT_URL => 'http://psra.gkp.pk/schoolReg/api/psra/get_school_detail',
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_ENCODING => '',
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 0,
		// 	CURLOPT_FOLLOWLOCATION => true,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => 'POST',
		// 	CURLOPT_POSTFIELDS => array("school_id" => $school_id),
		// 	CURLOPT_HTTPHEADER => array(
		// 		'x-api-key: n2r5u8x/A?D(G+KbPdSgVkYp3s6v9y$B'
		// 	),
		// 	CURLOPT_FAILONERROR => TRUE
		// ));
		// //var_dump($curl);
		// if (curl_errno($curl)) {
		// 	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// 	curl_close($curl);
		// 	$response['response'] = false;
		// 	$response['message'] = 'Request Error:' . curl_error($curl);
		// 	curl_close($curl);
		// 	echo json_encode($response);
		// } else {
		// 	$response = array();
		// 	$response = curl_exec($curl);
		// 	curl_close($curl);
		// 	echo $response;
		// }
	}

	public function fined_summary()
	{
		$this->load->view(ADMIN_DIR . "fine_management/fined_summary", $this->data);
	}

	public function get_add_fine_payment_form()
	{
		$this->data['fined_school_id'] = $fined_school_id = (int) $this->input->post("fined_school_id");

		$query = "SELECT fs.fined_school_id, fs.school_id, fs.school_name, fs.district_name, fs.tehsil_name, fs.address ,
		SUM(IF(f.status=1,1,0)) as density,
		SUM(IF(f.status=1,f.fine_amount,0)) as total_fine,
		SUM(IF(f.status=3,1,0)) as w_offed,
		(SELECT SUM(fy.deposit_amount) FROM fine_payments as fy WHERE fy.is_deleted=0 AND fy.fined_school_id = fs.fined_school_id ) as paid_amount
        FROM fines as f
		INNER JOIN fined_schools fs ON (fs.fined_school_id = f.fined_school_id)
								WHERE fs.fined_school_id = '" . $fined_school_id . "'
								GROUP BY f.fined_school_id
								";
		$this->data['fine_summary'] = $this->db->query($query)->result()[0];
		$query = "SELECT f.*, ft.fine_title , fc.fine_channel_title,
		(SELECT SUM(deposit_amount) FROM fine_payments WHERE fine_id = f.fine_id and is_deleted = 0)  as total_payment 
		 FROM `fines` as f
		INNER JOIN fine_types ft ON (ft.fine_type_id = f.fine_type_id)
		INNER JOIN fine_channels fc ON (fc.fine_channel_id = f.fine_channel_id) 
		          WHERE f.fined_school_id = '" . $fined_school_id . "'";
		$this->data['fines'] = $this->db->query($query)->result();

		$this->load->view(ADMIN_DIR . "fine_management/get_add_fine_payment_form", $this->data);
	}
	public function view_fine_detail($fined_school_id)
	{

		$this->data['fined_school_id'] =  $fined_school_id = (int) $fined_school_id;

		$query = "SELECT * FROM `fine_school_list` as fs
								WHERE fs.fined_school_id = '" . $fined_school_id . "'";
		$this->data['fine_summary'] = $this->db->query($query)->result()[0];

		$query = "SELECT f.*, ft.fine_title , fc.fine_channel_title,
		(SELECT SUM(deposit_amount) FROM fine_payments WHERE fine_id = f.fine_id and is_deleted = 0)  as total_payment 
		 FROM `fines` as f
		INNER JOIN fine_types ft ON (ft.fine_type_id = f.fine_type_id)
		INNER JOIN fine_channels fc ON (fc.fine_channel_id = f.fine_channel_id) 
		          WHERE f.fined_school_id = '" . $fined_school_id . "'";
		$this->data['fines'] = $this->db->query($query)->result();

		$this->data["title"] = "School Fined History";
		$this->data["view"] = ADMIN_DIR . "fine_management/school_fine_detail";
		$this->load->view(ADMIN_DIR . "layout", $this->data);
	}

	public function wo_attachment_check()
	{
		$allowed = array('pdf');
		if (!isset($_FILES['waived_off_file']) || $_FILES['waived_off_file']['error'] == 4) {
			$this->form_validation->set_message('wo_attachment_check', 'Notification File is required for waive off');

			return FALSE;
		}
		$filename = $_FILES['waived_off_file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed)) {
			$this->form_validation->set_message('wo_attachment_check', 'FMS only accept .pdf format. Please select a valid file format.');

			return FALSE;
		}
	}

	public function valid_amount()
	{


		$fine_id = (int) $this->input->post('fine_id');

		$waived_off_amount = (float) $this->input->post('waived_off_amount');
		if ($waived_off_amount <= 0) {
			$this->form_validation->set_message('valid_amount', 'Please enter valid amount.');
			return FALSE;
		}

		$query = "select fine_amount from fines where fine_id = '" . $fine_id . "'";
		if ($this->db->query($query)->result()) {
			$fine_amount = $this->db->query($query)->result()[0]->fine_amount;
			if ($waived_off_amount > $fine_amount) {
				$this->form_validation->set_message('valid_amount', 'Waived off amount should be less than fine amount.');
				return FALSE;
			}
		} else {

			$this->form_validation->set_message('valid_amount', 'Invalid fine id.');
			return FALSE;
		}
	}


	public function waive_off_fine()
	{

		$validations = array(
			array('field' => 'fine_id', 'label' => 'Fine Id', 'rules' => 'required'),
			array('field' => 'waived_off_file_no', 'label' => 'Notification No', 'rules' => 'required'),
			array('field' => 'waived_off_date', 'label' => 'Notification Date', 'rules' => 'required'),
			array('field' => 'waived_off_amount', 'label' => 'Waive Off Amount', 'rules' => 'callback_valid_amount'),
			array('field' => 'wo_detail', 'label' => 'Waive off Detail', 'rules' => 'required'),
			array('field' => 'waived_off_file', 'label' => 'Notification Attachment', 'rules' => 'callback_wo_attachment_check'),
		);
		$this->form_validation->set_rules($validations);

		$input['fine_id'] = $fine_id = (int) $this->input->post('fine_id');
		$query = "select fine_amount,fined_school_id from fines where fine_id = '" . $fine_id . "'";
		$fine_amount = $this->db->query($query)->result()[0]->fine_amount;
		$fined_school_id = $this->db->query($query)->result()[0]->fined_school_id;
		$input['fined_school_id'] = $fined_school_id;
		if ($this->form_validation->run() === TRUE) {
			if ($this->upload_file("waived_off_file", NULL, FALSE, $input['fined_school_id'])) {




				$input['fine_amount'] = $fine_amount;
				$input['waived_off_amount'] = $waived_off_amount = (float) $this->input->post('waived_off_amount');
				$input['fine_remained'] = $fine_remained = $fine_amount - $waived_off_amount;

				$input['waived_off_file_no'] = $this->input->post('waived_off_file_no');
				$input['waived_off_date'] = $this->input->post('waived_off_date');
				$input['wo_detail'] = $this->input->post('wo_detail');
				$input['waived_off_file']  = $this->data["upload_data"]["dir"] . $this->data["upload_data"]["file_name"];
				$input['created_by'] = $this->session->userdata('userId');

				if ($this->db->insert('fine_waived_off', $input)) {

					$where['fine_id'] = (int) $this->input->post('fine_id');
					$this->db->where($where);

					$update['fine_amount'] = $fine_remained;
					$query = "select SUM(waived_off_amount) AS waived_off_amount  from fine_waived_off where fine_id = '" . $fine_id . "' and is_deleted = 0";
					$waived_off_amount = $this->db->query($query)->result()[0]->waived_off_amount;
					$update['waived_off_amount'] = $waived_off_amount;

					if ($this->db->update('fines', $update)) {

						$response['error'] = false;
						$response['msg'] = "Fine waived off successfully";
					} else {
						$response['error'] = true;
						$response['msg'] = "Error while update fine after waive off";
					}
				} else {
					$response['error'] = true;
					$response['msg'] = "Error while inserting waiving off";
				}
			} else {
				$response['error'] = true;
				$response['msg'] = $this->upload->display_errors();
			}
		} else {
			$response['error'] = true;
			$response['msg'] = validation_errors();
		}
		echo  json_encode($response);
	}
	public function remove_waive_off()
	{

		$where['fine_id'] = (int) $this->input->post('fine_id');

		$this->db->where($where);
		$update['status'] = 1;
		$update['wo_detail'] = '';
		$update['waived_off_file_no'] = '';
		$update['waived_off_amount'] = '';
		$update['waived_off_date'] = '';
		if ($this->db->update('fines', $update)) {
			$this->activity_logs('fine', 'remove_waived_off', '1');
			echo 1;
		} else {
			echo 0;
		}
	}

	public function delete_fine()
	{

		$where['fine_id'] = (int) $this->input->post('fine_id');
		$this->db->where($where);
		$status['status'] = 0;
		if ($this->db->update('fines', $status)) {
			$this->activity_logs('fine', 'delete_fine', '0');
			echo 1;
		} else {
			echo 0;
		}
	}

	public function retore_fine()
	{

		$where['fine_id'] = (int) $this->input->post('fine_id');
		$this->db->where($where);
		$status['status'] = 1;
		if ($this->db->update('fines', $status)) {
			$this->activity_logs('fine', 'restore_fine', '1');
			echo 1;
		} else {
			echo 0;
		}
	}

	public function delete_fine_payment()
	{

		$where['fine_id'] = (int) $this->input->post('fine_id');
		$where['fine_payment_id'] = (int) $this->input->post('fine_payment_id');
		$this->db->where($where);
		$status['is_deleted'] = 1;
		if ($this->db->update('fine_payments', $status)) {
			$this->activity_logs('fine_payment', 'delete_payment', '1');
			echo 1;
		} else {
			echo 0;
		}
	}

	public function delete_waived_off()
	{

		$where_fwo['fine_id'] = $fine_id =  (int) $this->input->post('fine_id');
		$where_fwo['fine_waived_off_id'] = $fine_waived_off_id =  (int) $this->input->post('fine_waived_off_id');
		$where_fwo['is_deleted'] = 0;
		$this->db->where($where_fwo);
		$status['is_deleted'] = 1;
		if ($this->db->update('fine_waived_off', $status)) {

			$query = "select waived_off_amount from fine_waived_off where fine_id = '" . $fine_id . "' and  fine_waived_off_id = '" . $fine_waived_off_id . "'";
			$waived_off_amount = $this->db->query($query)->result()[0]->waived_off_amount;

			$query = "select fine_amount, waived_off_amount from fines where fine_id = '" . $fine_id . "'";
			$fine = $this->db->query($query)->result()[0];

			$where = array();
			$where['fine_id'] = $fine_id =  (int) $this->input->post('fine_id');
			$update = array();
			$update['waived_off_amount'] = $fine->waived_off_amount - $waived_off_amount;
			$update['fine_amount'] =  $fine->fine_amount + $waived_off_amount;
			$this->db->where($where);
			if ($this->db->update('fines', $update)) {
				$this->activity_logs('waived_off', 'delete', '1');
				echo 1;
			} else {
				$where = array();
				$where['fine_id'] = (int) $this->input->post('fine_id');
				$where['fine_waived_off_id'] = (int) $this->input->post('fine_waived_off_id');
				$this->db->where($where);
				$status['is_deleted'] = 1;
				if ($this->db->update('fine_waived_off', $status)) {
					echo 0;
				}
			}
		} else {
			echo 0;
		}
	}

	public function check_stan_number()
	{


		$stan_no = (float) $this->input->post('stan_no');
		if ($stan_no == "") {
			$this->form_validation->set_message('check_stan_number', 'Bank STAN No. Required');
			return FALSE;
		}

		$query = "select COUNT(*) as total from fine_payments where stan_no = '" . $stan_no . "' and is_deleted =0";
		if ($this->db->query($query)->result()) {
			$stan_count = $this->db->query($query)->result()[0]->total;
			if ($stan_count > 0) {
				$this->form_validation->set_message('check_stan_number', 'STAN No. ' . $stan_no . ' already used. please check and try again with valid STAN.');
				return FALSE;
			}
		}
	}


	public function add_fine_payment()
	{

		$validations = array(
			array('field' => 'fine_id', 'label' => 'Fine Id', 'rules' => 'required'),
			array('field' => 'stan_no', 'label' => 'Bank STAN No.', 'rules' => 'callback_check_stan_number'),
			array('field' => 'challan_date', 'label' => 'Bank Challan Date', 'rules' => 'required'),
			array('field' => 'deposit_amount', 'label' => 'Deposit Amount', 'rules' => 'required')
		);
		$this->form_validation->set_rules($validations);

		if ($this->form_validation->run() === TRUE) {

			$input['fine_id'] = $fine_id = (int) $this->input->post('fine_id');
			$input['stan_no'] = (int) $this->input->post('stan_no');
			$input['challan_date'] = $this->input->post('challan_date');
			$input['deposit_amount'] = (int) $this->input->post('deposit_amount');
			$input['created_by'] = $this->session->userdata('userId');
			$query = "SELECT fined_school_id FROM fines WHERE fines.fine_id = '" . $fine_id . "'";
			$input['fined_school_id'] = $this->db->query($query)->result()[0]->fined_school_id;
			if ($this->db->insert('fine_payments', $input)) {

				$response['error'] = false;
				$response['msg'] = "Payment Add successfully.";
			} else {
				$response['error'] = true;
				$response['msg'] = "Error while adding payment detail.";
			}
		} else {

			$response['error'] = true;
			$response['msg'] = validation_errors();
		}
		echo  json_encode($response);
	}
	public function fined_school_list()
	{
		$this->load->view(ADMIN_DIR . "fine_management/fined_school_list", $this->data);
	}
	public function ajax_fined_school_list()
	{


		$draw = $this->input->post('draw');
		$row = $this->input->post('start');
		$rowperpage = $this->input->post('length'); // Rows display per page

		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		//$columnName = $_POST['columns'][3]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		//$columnSortOrder = "asc";

		$searchValue = $this->db->escape($_POST['search']['value']);
		$searchValue = str_replace("'", "", $searchValue);

		## Search 
		$searchQuery = " ";
		if ($searchValue != '') {
			$searchQuery = " and (school_id like '%" . $searchValue . "%' or 
        school_name like '%" . $searchValue . "%' or 
        district_name like'%" . $searchValue . "%' ) ";
		}

		## Total number of record with out filtering
		$query = "select COUNT(*) as total from fine_school_list where status =1";
		$totalRecords = $this->db->query($query)->result()[0]->total;

		## Total number of record with filtering
		$query = "select COUNT(*) as total from fine_school_list where status =1 " . $searchQuery;
		$totalRecordwithFilter = $this->db->query($query)->result()[0]->total;

		//
		## Fetch records
		$empQuery = "select * from fine_school_list WHERE status =1 
		            " . $searchQuery . " order by " . $columnName . " 
					" . $columnSortOrder . "  limit " . $row . "," . $rowperpage;
		$fined_schools = $this->db->query($empQuery)->result();
		$data = array();
		$count = 1;
		foreach ($fined_schools as $fined_school) {
			$data[] = array(
				//"s_no" => $count++,
				"school_id" => $fined_school->school_id,
				"school_registration_no" => $fined_school->school_registration_no,
				"school_name" => $fined_school->school_name,
				"district_name" => $fined_school->district_name,
				"tehsil_name" => $fined_school->tehsil_name,
				"address" => $fined_school->address,
				"frequency" => $fined_school->frequency,
				"total_fine" => $fined_school->total_fine,
				"total_waived_off" => $fined_school->total_waived_off,
				"total_fine_paid" => $fined_school->total_fine_paid,
				"total_fine_remaining" => $fined_school->total_fine_remaining,
				"action" => '<a class="btn-sm btn-primary" style="margin:0px; padding:5px" href="' . site_url(ADMIN_DIR . "fine_management/view_fine_detail/" . $fined_school->fined_school_id) . '">
                View
            </a>',

			);
		}

		## Response
		$response = array(
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		echo json_encode($response);
	}


	private function activity_logs($table, $activity, $status)
	{
		$activity_input['table'] = $table;
		$activity_input['activity'] = $activity;
		$activity_input['activity_status'] = $status;
		$activity_input['created_by'] = $this->session->userdata('userId');
		$this->db->insert('activity_logs', $activity_input);
	}

	public function check_school_id()
	{
		if ($this->input->post('school_id')) {
			$school_id = $this->input->post('school_id');
			$query = "SELECT COUNT(*) as total FROM fined_schools WHERE school_id = '" . $school_id . "'";
			$result = $this->db->query($query)->row()->total;
			if ($result > 0) {
				$this->form_validation->set_message('check_school_id', 'School Already In School List');
				return FALSE;
			}
		}
	}


	public function add_school_in_fine_list()
	{
		$validations = array(
			array('field' => 'school_id', 'label' => 'School Id', 'rules' => 'callback_check_school_id'),
			array('field' => 'school_name', 'label' => 'School Name', 'rules' => 'required'),
			array('field' => 'district_name', 'label' => 'District Name', 'rules' => 'required'),
			array('field' => 'tehsil_name', 'label' => 'Tehsil Name', 'rules' => 'required'),
			array('field' => 'address', 'label' => 'Address', 'rules' => 'required'),
			array('field' => 'level_id', 'label' => 'School Level', 'rules' => 'required')

		);
		$this->form_validation->set_rules($validations);

		if ($this->form_validation->run() === TRUE) {

			$input['school_id'] = (int) $this->input->post('school_id');
			$input['school_registration_no'] = $this->input->post('school_registration_no');
			$input['school_name'] = $this->input->post('school_name');
			$input['district_name'] = $this->input->post('district_name');
			$input['tehsil_name'] = $this->input->post('tehsil_name');
			$input['address'] = $this->input->post('address');
			$input['level_id'] = $this->input->post('level_id');
			$input['created_by'] = $this->session->userdata('userId');
			$input['school_registration_no'] = $this->input->post('school_registration_no');
			if ($this->db->insert('fined_schools', $input)) {

				$response['error'] = false;
				$response['msg'] = "School Add successfully.";
			} else {
				$response['error'] = true;
				$response['msg'] = "Error while adding school detail.";
			}
		} else {

			$response['error'] = true;
			$response['msg'] = validation_errors();
		}
		echo  json_encode($response);
	}
}
