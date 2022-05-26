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

	public function add_fine()
	{



		// foreach ($_POST as $variable => $value) {
		// 	// echo
		// 	// "array(
		// 	// 	'field' =>  '" . $variable . "',
		// 	// 	'label' =>  '" . ucwords(str_replace("_", " ", $variable)) . "',
		// 	// 	'rules' =>  'required'
		// 	// ),<br />";
		// 	// echo '$input["' . $variable . '"] = $this->input->post("' . $variable . '");<br />';
		// }

		$validations = array(
			//array('field' => 'school_id', 'label' => 'School Id', 'rules' => 'required'),
			//array('field' => 'school_registration_no', 'label' => 'School Registration No', 'rules' => 'required'),
			array('field' => 'school_name', 'label' => 'School Name', 'rules' => 'required'),
			array('field' => 'district_name', 'label' => 'District Name', 'rules' => 'required'),
			array('field' => 'tehsil_name', 'label' => 'Tehsil Name', 'rules' => 'required'),
			array('field' => 'address', 'label' => 'Address', 'rules' => 'required'),
			array('field' => 'file_number', 'label' => 'File Number', 'rules' => 'required'),
			array('field' => 'fine_type_id', 'label' => 'Fine Category', 'rules' => 'required'),
			array('field' => 'fine_channel_id', 'label' => 'Fine Channel', 'rules' => 'required'),
			array('field' => 'fine_amount', 'label' => 'Amount', 'rules' => 'required'),
			array('field' => 'file_date', 'label' => 'File Date', 'rules' => 'required'),
			array('field' => 'remarks', 'label' => 'Remarks', 'rules' => 'required'),
			array('field' => 'level_id', 'label' => 'School Level', 'rules' => 'required'),
		);
		$this->form_validation->set_rules($validations);

		if ($this->form_validation->run() === TRUE) {
			// $input["school_id"] = $this->input->post("school_id");
			// $input["school_registration_no"] = $this->input->post("school_registration_no");
			// $input["school_name"] = $this->input->post("school_name");
			// $input["district_name"] = $this->input->post("district_name");
			// $input["tehsil_name"] = $this->input->post("tehsil_name");
			// $input["address"] = $this->input->post("address");
			$input["file_number"] = $this->input->post("file_number");
			$input["fine_type_id"] = $this->input->post("fine_type_id");
			$input["fine_channel_id"] = $this->input->post("fine_channel_id");
			$input["fine_amount"] = $this->input->post("fine_amount");
			$input["file_date"] = $this->input->post("file_date");
			$input["remarks"] = $this->input->post("remarks");
			$input['created_by'] = $this->session->userdata('userId');

			$is_registered = (int) $this->input->post('registered');
			$schoolId = (int) $this->input->post('school_id');

			$school_id = "";
			$fined_school_id = "";
			if ($is_registered === 1) {
				$query = "SELECT * FROM fined_schools WHERE school_id = '" . $schoolId . "' LIMIT 1";
				$school = $this->db->query($query)->result();
				if ($school) {
					$school_id = $school[0]->school_id;
					$input['fined_school_id'] = $school[0]->fined_school_id;
				} else {
					// insert school 
					$s_input["school_id"] = $this->input->post("school_id");
					$s_input["school_registration_no"] = $this->input->post("school_registration_no");
					$s_input["school_name"] = $this->input->post("school_name");
					$s_input["district_name"] = $this->input->post("district_name");
					$s_input["tehsil_name"] = $this->input->post("tehsil_name");
					$s_input["address"] = $this->input->post("address");
					$this->db->insert('fined_schools', $s_input);
					$input['fined_school_id']  = $this->db->insert_id();
				}
			} else {
				$s_input["school_id"] = NULL;
				$s_input["school_registration_no"] = NULL;
				$s_input["school_name"] = $this->input->post("school_name");
				$s_input["district_name"] = $this->input->post("district_name");
				$s_input["tehsil_name"] = $this->input->post("tehsil_name");
				$s_input["address"] = $this->input->post("address");
				$s_input["level_id"] = $this->input->post("level_id");
				$this->db->insert('fined_schools', $s_input);
				$input['fined_school_id']  = $this->db->insert_id();
			}



			if ($this->db->insert('fines', $input)) {
				redirect(ADMIN_DIR . "fine_management/index");
			}
		} else {
			//echo validation_errors();
			redirect(ADMIN_DIR . "fine_management/index");
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

			$response['school'] = $school_detail;
			echo json_encode($response);
			exit();
		}
		//$school_id = 1;
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://psra.gkp.pk/schoolReg/api/psra/get_school_detail',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array("school_id" => $school_id),
			CURLOPT_HTTPHEADER => array(
				'x-api-key: n2r5u8x/A?D(G+KbPdSgVkYp3s6v9y$B'
			),
			CURLOPT_FAILONERROR => TRUE
		));
		//var_dump($curl);
		if (curl_errno($curl)) {
			$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			$response['response'] = false;
			$response['message'] = 'Request Error:' . curl_error($curl);
			curl_close($curl);
			echo json_encode($response);
		} else {
			$response = curl_exec($curl);
			curl_close($curl);
			$data = json_decode($response);
			if ($data->response) {
				echo $response;
			} else {
				echo $response;
			}
		}
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



	public function waive_off_fine()
	{

		$where['fine_id'] = (int) $this->input->post('fine_id');

		$this->db->where($where);
		$update['status'] = 3;
		$update['wo_detail'] = $this->input->post('wo_detail');
		$update['waived_off_file_no'] = $this->input->post('waived_off_file_no');
		$update['waived_off_amount'] = $this->input->post('waived_off_amount');
		$update['waived_off_date'] = $this->input->post('waived_off_date');
		if ($this->db->update('fines', $update)) {
			$this->activity_logs('fine', 'waived_off', '3');
			echo 1;
		} else {
			echo 0;
		}
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

	public function add_fine_payment()
	{


		$input['fine_id'] = $fine_id = (int) $this->input->post('fine_id');
		$input['stan_no'] = (int) $this->input->post('stan_no');
		$input['challan_date'] = $this->input->post('challan_date');
		$input['deposit_amount'] = (int) $this->input->post('deposit_amount');
		$input['created_by'] = $this->session->userdata('userId');
		$query = "SELECT fined_school_id FROM fines WHERE fines.fine_id = '" . $fine_id . "'";
		$input['fined_school_id'] = $this->db->query($query)->result()[0]->fined_school_id;
		if ($this->db->insert('fine_payments', $input)) {

			echo 1;
		} else {
			echo 0;
		}
	}
	public function fined_school_list()
	{
		$this->load->view(ADMIN_DIR . "fine_management/fined_school_list", $this->data);
	}

	private function activity_logs($table, $activity, $status)
	{
		$activity_input['table'] = $table;
		$activity_input['activity'] = $activity;
		$activity_input['activity_status'] = $status;
		$activity_input['created_by'] = $this->session->userdata('userId');
		$this->db->insert('activity_logs', $activity_input);
	}
}
