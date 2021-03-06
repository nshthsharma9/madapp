<?php
class Review extends Controller {
	private $message;
	private $all_cycles = array('Select...', 'Cycle 1', 'Cycle 2', 'Cycle 3', 'Cycle 4', 'Cycle 5');
	
	function Review() {
		parent::Controller();
		$this->load->model('Users_model','user_model');
		$this->load->model('city_model');
		$this->load->model('Review_Parameter_model','review_model');
		
		$this->load->helper('url');
		$this->load->helper('misc');
		
		$this->load->library('session');
        $this->load->library('user_auth');
        
        $this->user_id = $this->user_auth->logged_in();        
		if(!$this->user_id) {
			redirect('auth/login');
		}
        $this->user_details = $this->user_auth->getUser();
        $this->cycle = get_cycle();
	}

	function select_people() {
		$this->user_auth->check_permission('review_fellows');
		$city_id = $this->session->userdata('city_id');

		$current_user = $this->user_model->get_info($this->user_id);
		$all_verticals = $this->city_model->get_all_verticals();
		$all_regions = $this->city_model->get_all_regions();
		$all_verticals[0] = 'None';

		//$fellows = $this->user_model->get_fellows_or_above($city_id);
		//$fellows = $this->user_model->get_subordinates($this->user_id);
		$fellows = $this->user_model->get_all_below($current_user->group_type, $current_user->vertical_id, $current_user->region_id, $city_id);

		$this->load->view('review/select_people', array('fellows'=>$fellows, 'all_regions'=> $all_regions, 'all_verticals'=>$all_verticals));
	}

	function review_fellow($user_id, $cycle = 0, $option='', $check_permission = true) {
		if($check_permission) $this->user_auth->check_permission('review_fellows');
		if($this->input->post('cycle')) $this->cycle = $this->input->post('cycle');

		$city_id = $this->session->userdata('city_id');

		if(!$cycle) $cycle = $this->cycle;
		if(!is_numeric($user_id)) $user_id = base64_decode($user_id);
		else die("Error: Contact Administrator. ");
		// :TODO: Check if the current user has permission to review the said fellow.

		$parameter_reviews	= $this->review_model->get_reviews($user_id, $cycle, 'parameter');
		$milestone_reviews	= $this->review_model->get_reviews($user_id, $cycle, 'milestone');
		$survey_reviews		= $this->review_model->get_reviews($user_id, $cycle, 'survey');

        // $topics = $this->review_model->get_topics();
        // $scores = $this->review_model->get_scores($user_id);
        // if($option == 'no360') $scores = false; //Turn off 360 View

		$user = $this->user_model->get_user($user_id);
		$this->load->view('review/review_fellow', array('parameter_reviews' => $parameter_reviews, 
														'milestone_reviews' => $milestone_reviews,
														'survey_reviews'	=> $survey_reviews,
														'user_id'=>$user_id, 'user' => $user,
														'cycle'=>$cycle,	'all_cycles'=>$this->all_cycles, 'auth'=>$this->user_auth));
	}

	function my_reivew_sheet() {
		$this->user_auth->check_permission('review_data_my');
		$user_id = $this->session->userdata('user_id');
		$this->review_fellow(base64_encode($user_id), 0, '', false);
	}

	function ajax_get_comment($parameter_id) {
		$comment = $this->review_model->get_comment($parameter_id);
		print $comment;
	}

	function ajax_save_comment($parameter_id, $comment) {
		$this->review_model->set_comment($parameter_id, $comment);
		print '{"success":true}';
	}

	function ajax_save_value($parameter_id, $value) {
		$this->review_model->save_value($parameter_id, $value);
		print '{"success":true}';	
	}
	
	function milestone_select_people() {
		$this->user_auth->check_permission('milestone_list');
		$current_user = $this->user_details->id;
		$people = $this->user_model->get_subordinates($current_user);

		if($this->input->post('action') == 'Search') {
			$highest_group = $this->user_model->get_highest_group($current_user);

			$search_for_groups = array();
			if($highest_group == 'executive') $search_for_groups = array('executive','national','fellow','strat');
			elseif($highest_group == 'national') $search_for_groups = array('fellow','strat');
			elseif($highest_group == 'strat') $search_for_groups = array('fellow');

			$people = $this->user_model->search_users(array(
				'user_group_type' => $search_for_groups,
				'city_id' => 0,
				'user_type' => 'volunteer',
				'name' => $this->input->post('name')));
		}

		$this->load->view('review/milestone_select_people', array('people'=>$people));
	}

	function list_milestones($user_id, $cycle=0) {
		$this->user_auth->check_permission('milestone_list');

		$milestones = $this->review_model->get_all_milestones($user_id, $cycle);
		$user_details=$this->user_model->user_details($user_id);
		$this->load->view('review/list_milestones', array('milestones' => $milestones,'user_details'=>$user_details, 'user_id'=>$user_id, 'all_cycles' => $this->all_cycles));
	}

	function edit_milestone($milestone_id) {
		$this->user_auth->check_permission('milestone_create');

		$milestone = $this->review_model->get_milestone($milestone_id);
		$this->load->view('review/edit_milestone', array('milestone' => $milestone, 'all_cycles' => $this->all_cycles));
	}

	function new_milestone($user_id) {
		$this->user_auth->check_permission('milestone_create');

		$this->load->view('review/edit_milestone', array('user_id'=>$user_id, 'all_cycles' => $this->all_cycles));
	}

	function save_milestone() {
		$this->user_auth->check_permission('milestone_create');

		$milestone_id = $this->input->post('milestone_id');
		$data = array(
			'name'			=> $this->input->post('name'),
			'status'		=> $this->input->post('status'),
			'due_on' 		=> $this->input->post('due_on'),
			'done_on' 		=> $this->input->post('done_on'),
			'user_id' 		=> $this->input->post('user_id'),
			'created_by_user_id' => $this->user_id
		);
		$data['cycle'] = $this->review_model->find_cycle($data['due_on']);

		if($milestone_id) {
			$this->review_model->edit_milestone($milestone_id, $data);
			$this->session->set_flashdata('success', 'Milestone edited.');
		} else {
			$milestone_id = $this->review_model->create_milestone($data);
			$this->session->set_flashdata('success', 'Milestone created.');
		}

		redirect('review/edit_milestone/'.$milestone_id);
	}

	function delete_milestone($milestone_id) {
		$user_id = $this->review_model->delete_milestone($milestone_id);

		$this->session->set_flashdata('success', 'Milestone deleted.');
		redirect('review/list_milestones/'.$user_id);	
	}

	function list_timeframes($user_id) {
		$timeframes = $this->review_model->get_timeframes_with_milestone($user_id);
		$this->load->view('review/list_timeframes', array('user_id'=>$user_id, 'timeframes'=>$timeframes, 'all_cycles' => $this->all_cycles));
	}

	/// Shows the milestones of the current user. No edit possible.
	function my_milestones() {
		$this->user_auth->check_permission('milestone_my');

		$overdue_milestones = $this->review_model->get_overdue_milestones($this->user_id, $this->cycle);
		$current_milestones = $this->review_model->get_all_milestones($this->user_id, $this->cycle);

		$this->load->view('review/my_milestones', 
			array('overdue_milestones' => $overdue_milestones, 'current_milestones' => $current_milestones));
	}

	/// Mark a milestone as done.
	function do_milestone($milestone_id, $status, $done_on) {
		$this->user_auth->check_permission('milestone_do');

		$this->review_model->do_milestone($milestone_id, $status, date('Y-m-d', strtotime($done_on)));
		print '{"success":true, "milestone_id":'.$milestone_id.',"error":false}';
	}
	///////////////////////////////////////////////////////////////////// Aggrigator ///////////////////////////////////////////


	function aggregate_milestones() {
		$region_id 	= i($_REQUEST, 'region_id', 0);
		$city_id	= i($_REQUEST, 'city_id', 0);
		$vertical_id= i($_REQUEST, 'vertical_id', 0);
		$group_type = i($_REQUEST, 'group_type', 'all');
		$status 	= i($_REQUEST, 'status', '-1');
	
		$data = array();

		$wheres = array('1=1');
		if($region_id) $wheres[] = "C.region_id=$region_id";
		if($vertical_id) $wheres[] = "G.vertical_id=$vertical_id";
		if($city_id) $wheres[] = "U.city_id=$city_id";
		if($group_type != 'all') $wheres[] = "G.type='$group_type'";
		if($group_type == 'all') $wheres[] = "G.type!='volunteer'";
		if($status == '0') $wheres[] = 'M.status="0" and due_on>=now()';
		if($status == '1') $wheres[] = 'M.status="1"';
		if($status == '2') $wheres[] = 'M.status="0" and due_on<=now()';

		$data = array();
		if(isset($_REQUEST['action'])) {
			$data = $this->db->query("SELECT DISTINCT M.id,M.name as milestone,M.status,U.name,due_on,done_on,C.name AS city_name, U.id AS user_id FROM Review_Milestone M
				INNER JOIN User U ON U.id=M.user_id 
				INNER JOIN UserGroup UG ON UG.user_id=U.id INNER JOIN `Group` G ON G.id=UG.group_id
				INNER JOIN City C ON C.id=U.city_id 
				WHERE U.user_type='volunteer' AND ". implode(" AND ", $wheres))->result();
		}

		$all_cities = $this->city_model->get_all(); $all_cities[0] = 'Any';
		$all_verticals = $this->city_model->get_all_verticals(); $all_verticals[0] = 'Any';
		$all_regions = $this->city_model->get_all_regions(); $all_regions[0] = 'Any';
		$all_types = array('all' => 'All', 'executive' => 'Executive', 'national' => 'National', 'strat' => 'Strat', 'fellow' => 'Fellow','volunteer' => 'Volunteer');
		$all_status = array('2' => "Not Completed", '1' => "Completed", '0' => "Pending", '-1' => "Any");
		
		$this->load->view('review/aggregate_milestones',array('data' => $data,
			'all_verticals'=>$all_verticals, 'all_types'=>$all_types, 'all_regions'=> $all_regions, 'all_cities' => $all_cities, 'all_status' => $all_status,
			'region_id' => $region_id, 'vertical_id' => $vertical_id, 'group_type' => $group_type, 'city_id' => $city_id, 'status' => $status,
		));
	}


	/// Aggregates the responses to the happiness index - with filters and options.
	function aggregate() {
		$survey_event_id = $this->db->query("SELECT id as survey_event_id FROM SS_Survey_Event ORDER BY added_on DESC LIMIT 0,1")->row('survey_event_id'); // Default Survey event.
		$survey_event_id = i($_REQUEST, 'survey_event_id', $survey_event_id);
		$region_id 	= i($_REQUEST, 'region_id', 0);
		$city_id	= i($_REQUEST, 'city_id', 0);
		$vertical_id= i($_REQUEST, 'vertical_id', 0);
		$group_type = i($_REQUEST, 'group_type', 'all');
		$data 		= array();
		$total_responders = 0;

		$wheres = array('1=1');
		if($region_id) 				$wheres[] = "C.region_id=$region_id";
		if($vertical_id) 			$wheres[] = "G.vertical_id=$vertical_id";
		if($city_id) 				$wheres[] = "U.city_id=$city_id";
		if($group_type != 'all')	$wheres[] = "G.type='$group_type'";
		if($survey_event_id) 		$wheres[] = "UA.survey_event_id='$survey_event_id'";

		$raw_data = $this->db->query("SELECT DISTINCT UA.user_id, UA.question_id, UA.answer FROM SS_UserAnswer UA 
			INNER JOIN User U ON U.id=UA.user_id 
			INNER JOIN UserGroup UG ON UG.user_id=U.id INNER JOIN `Group` G ON G.id=UG.group_id
			INNER JOIN City C ON C.id=U.city_id 
			WHERE U.status='1' AND U.user_type='volunteer' AND ". implode(" AND ", $wheres))->result();
		$answers = array();

		$total_responders = $this->db->query("SELECT COUNT(DISTINCT UA.user_id) AS count FROM SS_UserAnswer UA 
			INNER JOIN User U ON U.id=UA.user_id 
			INNER JOIN UserGroup UG ON UG.user_id=U.id INNER JOIN `Group` G ON G.id=UG.group_id
			INNER JOIN City C ON C.id=U.city_id 
			WHERE U.status='1' AND U.user_type='volunteer' AND ". implode(" AND ", $wheres))->row('count');

		// Lifted from controllers/parameter.php:ss_calulate()
		foreach ($raw_data as $ans) {
			// If not defined, define the defaults
			if(!isset($answers[$ans->question_id])) $answers[$ans->question_id] = array(0=>0, 1=>0, 3=>0, 5=>0);

			$answers[$ans->question_id][$ans->answer]++;
		}

		foreach ($answers as $question_id => $values) {
			// Find level by aggregating the total and averaging.
			// If there are 5 answers - 1 x Level 1, 2 x Level 3 and 2 x Level 5, we aggregate it - (1 x 1) + (2 x 3) + (2 x 5) = 17
			//	Then we divide by total count : 17/5 = 3.4. Rounds to 3. Thats the level.
			$aggregate = 0;
			$total_answer_count = 0;
			$data[$question_id] = array();

			$total_answer_count = $values[1] + $values[3] + $values[5];

			foreach(array(1,3,5) as $answer_value) {
				$aggregate += $answer_value * $values[$answer_value];
				

				$data[$question_id]['level'][$answer_value] = $values[$answer_value];
				if($total_answer_count) 
					$data[$question_id]['level_percentage'][$answer_value] = round((($values[$answer_value] / $total_answer_count) * 100), 2);
				else $data[$question_id]['level_percentage'][$answer_value] = 0;
			}
			if($total_answer_count) $level = round($aggregate / $total_answer_count, 2);
			else $level = 0;

			$data[$question_id]['aggregate_level'] = $level;
			$data[$question_id]['total_answer_count'] = $total_answer_count;
		}

		// Get the options for the select forms.
		$all_cities = $this->city_model->get_all(); $all_cities[0] = 'Any';
		$all_verticals = $this->city_model->get_all_verticals(); $all_verticals[0] = 'Any';
		$all_regions = $this->city_model->get_all_regions(); $all_regions[0] = 'Any';
		$all_types = array('all' => 'All', 'executive' => 'Executive', 'national' => 'National', 'strat' => 'Strat', 'fellow' => 'Fellow','volunteer' => 'Volunteer');
		$all_questions = $this->review_model->get_all_ss_questions();
		$all_survey_events = $this->review_model->get_all_survey_events(); $all_survey_events[0] = 'Any';

		$this->load->view('review/aggregate', array(
			'data' => $data, 
			'all_questions' => $all_questions, 'all_verticals'=>$all_verticals, 'all_types'=>$all_types, 
			'all_regions'=> $all_regions, 'all_cities' => $all_cities, 'all_survey_events' => $all_survey_events,
			'region_id' => $region_id, 'vertical_id' => $vertical_id, 'group_type' => $group_type, 'city_id' => $city_id, 'survey_event_id' => $survey_event_id,
			'total_responders' => $total_responders,
 			));
	}
}

