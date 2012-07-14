<?php
/** 
 * CodeIgniter
 * An open source application development framework for PHP 4.3.2 or newer
 * @package         MaddApp
 * @author          Rabeesh
 * @since           Version 1.0
 * @filesource
 */
class National_model extends Model {
    function National_model() {
        // Call the Model constructor
        parent::Model();
        
        $this->ci = &get_instance();
		$this->city_id = $this->ci->session->userdata('city_id');
		$this->project_id = $this->ci->session->userdata('project_id');
    }
	/**
    *
    * Function to get_city_details
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_city_details()
	{
		return $this->db->query("SELECT id,name FROM City ORDER BY name")->result();	
	}
	/**
    *
    * Function to get_center_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_center_count($city_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM Center WHERE city_id=$city_id")->row()->count;	
	}
	/**
    *
    * Function to get_classes_p
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_classes_p($city_id)
	{
		return $this->db->query("SELECT COUNT(Class.id) AS count
			FROM Class INNER JOIN Level ON Level.id = Class.level_id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%p%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_classes_s
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_classes_s($city_id)
	{
		return $this->db->query("SELECT COUNT(Class.id) AS count
			FROM Class INNER JOIN Level ON Level.id = Class.level_id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%s%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_classes_L1
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_classes_L1($city_id)
	{
		return $this->db->query("SELECT COUNT(Class.id) AS count
			FROM Class INNER JOIN Level ON Level.id = Class.level_id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L1%' AND Center.city_id=$city_id ")->row()->count;
	}
    /**
    *
    * Function to get_classes_L2
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_classes_L2($city_id)
	{
		return $this->db->query("SELECT COUNT(Class.id) AS count
			FROM Class INNER JOIN Level ON Level.id = Class.level_id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L2%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_classes_L3
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_classes_L3($city_id)
	{
		return $this->db->query("SELECT COUNT(Class.id) AS count
			FROM Class INNER JOIN Level ON Level.id = Class.level_id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L3%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_children_P
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_children_P($city_id)
	{
		return $this->db->query("SELECT COUNT(StudentLevel.id) AS count
		 	FROM StudentLevel INNER JOIN Level ON StudentLevel.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%P%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to get_children_S
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_children_S($city_id)
	{
		return $this->db->query("SELECT COUNT(StudentLevel.id) AS count
		 	FROM StudentLevel INNER JOIN Level ON StudentLevel.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%S%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to get_children_L1
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_children_L1($city_id)
	{
		return $this->db->query("SELECT COUNT(StudentLevel.id) AS count
		 	FROM StudentLevel INNER JOIN Level ON StudentLevel.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L1%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to get_children_L2
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_children_L2($city_id)
	{
		return $this->db->query("SELECT COUNT(StudentLevel.id) AS count
		 	FROM StudentLevel INNER JOIN Level ON StudentLevel.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L2%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to get_children_L3
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_children_L3($city_id)
	{
		return $this->db->query("SELECT COUNT(StudentLevel.id) AS count
		 	FROM StudentLevel INNER JOIN Level ON StudentLevel.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L3%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to get_Volunteers_P
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_Volunteers_P($city_id)
	{
		return $this->db->query("SELECT COUNT(UserBatch.id) AS count
		 	FROM UserBatch INNER JOIN Level ON UserBatch.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%P%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_Volunteers_S
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_Volunteers_S($city_id)
	{
		return $this->db->query("SELECT COUNT(UserBatch.id) AS count
		 	FROM UserBatch INNER JOIN Level ON UserBatch.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%S%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_Volunteers_L1
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_Volunteers_L1($city_id)
	{
		return $this->db->query("SELECT COUNT(UserBatch.id) AS count
		 	FROM UserBatch INNER JOIN Level ON UserBatch.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L1%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_Volunteers_L2
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_Volunteers_L2($city_id)
	{
		return $this->db->query("SELECT COUNT(UserBatch.id) AS count
		 	FROM UserBatch INNER JOIN Level ON UserBatch.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L2%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to get_Volunteers_L3
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function get_Volunteers_L3($city_id)
	{
		return $this->db->query("SELECT COUNT(UserBatch.id) AS count
		 	FROM UserBatch INNER JOIN Level ON UserBatch.level_id = Level.id INNER JOIN Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L3%' AND Center.city_id=$city_id ")->row()->count;
	}
	/**
    *
    * Function to class_children_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_children_count($city_id)
	{
		return $this->db->query("SELECT COUNT(Student.id ) AS count FROM Student JOIN Center ON Center.id = Student.center_id WHERE Center.city_id={$city_id}")->row()->count;
	}
	/**
    *
    * Function to class_level_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_level_count($city_id)
	{
		return $this->db->query("SELECT COUNT(Level.id) AS count FROM Level JOIN Center ON Center.id=Level.center_id WHERE Center.city_id={$city_id}")->row()->count;
	}
	/**
    *
    * Function to class_volunteers_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_volunteers_count($city_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM User  WHERE city_id={$city_id} AND user_type ='volunteer'")->row()->count;
	}
	/**
    *
    * Function to class_avg_attendance
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_volunteers_in_letgo($city_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM User WHERE city_id={$city_id} AND user_type='let_go'")->row()->count;
	}
	
	
	/**
    *
    * Function to class_avg_attendance
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_avg_attendance($city_id)
	{
		$class_count = $this->class_class_count($city_id);
		// Sum of all Attendance Percentage / $class_count
	
		return 0;
	}
	/**
    *
    * Function to class_class_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_class_count($city_id)
	{
		return $this->db->query("SELECT COUNT(Class.id ) AS count FROM Class JOIN Level ON Level.id=Class.level_id JOIN 
					Center ON Center.id=Level.center_id WHERE Center.city_id={$city_id}")->row()->count;
	}
	/**
    *
    * Function to class_substitute_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_substitute_count($city_id)
	{
		return $this->db->query("SELECT COUNT(UserClass.id ) AS count FROM UserClass JOIN User ON User.id = UserClass.user_id 
					WHERE User.city_id = {$city_id} AND UserClass.substitute_id !=0")->row()->count;
	}
	/**
    *
    * Function to class_missed_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_missed_count($city_id)
	{
		return $this->db->query("SELECT COUNT(UserClass.id ) AS count FROM UserClass JOIN User ON User.id = UserClass.user_id 
					WHERE User.city_id = {$city_id} AND UserClass.status='absent' AND UserClass.substitute_id=0")->row()->count;
	}
	/**
    *
    * Function to class_cancelled_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_cancelled_count($city_id)
	{
		return $this->db->query("SELECT COUNT(UserClass.id ) AS count FROM UserClass JOIN User ON User.id=UserClass.user_id 
		WHERE User.city_id={$city_id} AND UserClass.status='cancelled'")->row()->count;
	}
	/**
    *
    * Function to class_number_of_level_p
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_number_of_level_p($city_id)
	{
		return $this->db->query("SELECT COUNT(Level.id) AS count FROM Level INNER JOIN  Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%p%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to class_number_of_level_s
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_number_of_level_s($city_id)
	{
		return $this->db->query("SELECT COUNT(Level.id) AS count FROM Level INNER JOIN  Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%S%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to class_number_of_level_l1
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_number_of_level_l1($city_id)
	{
		return $this->db->query("SELECT COUNT(Level.id) AS count FROM Level INNER JOIN  Center ON Center.id = Level.center_id
			WHERE Level.name LIKE '%L1%' AND Center.city_id=$city_id")->row()->count;
	}
	/**
    *
    * Function to class_cct_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_cct_count($city_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM Event  WHERE city_id=$city_id AND type='cct'")->row()->count;
	}
	
	/**
    *
    * Function to class_cct_count
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_tt_count($city_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM Event  WHERE city_id=$city_id AND type='teacher'")->row()->count;

	}
	/**
    *
    * Function to tt_user_events
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function tt_user_events($city_id)
	{
		return $this->db->query("SELECT COUNT(UserEvent.user_id) AS count FROM UserEvent INNER JOIN Event
				ON Event.id=UserEvent.event_id  WHERE Event.city_id=$city_id AND Event.type='teacher'")->row()->count;

	}
	/**
    *
    * Function to class_tt_attendance
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function class_tt_attendance($city_id)
	{
				return $this->db->query("SELECT COUNT(UserEvent.user_id) AS count FROM UserEvent INNER JOIN Event
				ON Event.id=UserEvent.event_id  WHERE Event.city_id=$city_id AND Event.type='teacher' AND UserEvent.present='1'")->row()->count;

	}
	
	/**
    * Function to no_process_training
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function no_process_training($city_id)
	{
			return $this->db->query("SELECT COUNT(id) AS count FROM Event  WHERE city_id=$city_id AND type='process'")->row()->count;
	}
	
	/**
    * Function to process_training_Attendance
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function process_training_user_events($city_id)
	{
		return $this->db->query("SELECT COUNT(UserEvent.user_id) AS count FROM UserEvent INNER JOIN Event
				ON Event.id=UserEvent.event_id  WHERE Event.city_id=$city_id AND Event.type='process'")->row()->count;
	}

    /**
    * Function to process_training_Attendance
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function process_training_Attendance($city_id)
	{
		return $this->db->query("SELECT COUNT(UserEvent.user_id) AS count FROM UserEvent INNER JOIN Event
				ON Event.id=UserEvent.event_id  WHERE Event.city_id=$city_id AND Event.type='process' AND UserEvent.present='1'")->row()->count;
	}
         /**
    * Function to class_volunteers_negative_credit
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_volunteers_negative_credit($city_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM User  WHERE city_id=$city_id AND credit < 0 AND user_type='volunteer'")->row()->count;
	}
         /**
    * Function to class_getClasses
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_getClasses($city_id)
	{
		return $this->db->query("SELECT Class.id FROM Class JOIN Level ON Level.id=Class.level_id JOIN 
				Center ON Center.id=Level.center_id WHERE Center.city_id={$city_id}")->result();  
												
	}
    /**
    * Function to class_getfull_students
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_getfull_students($class_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM StudentClass WHERE class_id={$class_id}")->row()->count;
	}
    /**
    * Function to class_getpresent_students
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function class_getpresent_students($class_id)
	{
		return $this->db->query("SELECT COUNT(id) AS count FROM StudentClass WHERE class_id={$class_id} AND present='1'")->row()->count;             
	}
	/**
	* Function to last_test_p
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
        function last_test_p($city_id)
        {
          return $this->db->query("SELECT Exam_Event.exam_on FROM Exam_Event JOIN Level ON Level.id=Exam_Event.level_id
              WHERE Exam_Event.city_id={$city_id} AND (Level.name LIKE '%P%') ORDER BY exam_on DESC ")->result();  
        }
      /**
    * Function to last_test_s
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
        function last_test_s($city_id)
        {
           return $this->db->query("SELECT Exam_Event.exam_on FROM Exam_Event JOIN Level ON Level.id=Exam_Event.level_id
              WHERE Exam_Event.city_id={$city_id} AND (Level.name LIKE '%S%') ORDER BY exam_on DESC ")->result();    
        }
         /**
    * Function to last_test_l1
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
        function last_test_l1($city_id)
        {
             return $this->db->query("SELECT Exam_Event.exam_on FROM Exam_Event JOIN Level ON Level.id=Exam_Event.level_id
              WHERE Exam_Event.city_id={$city_id} AND (Level.name LIKE '%L1%') ORDER BY exam_on DESC ")->result();  
        }
         /**
    * Function to last_test_l2
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
        function last_test_l2($city_id)
        {
             return $this->db->query("SELECT Exam_Event.exam_on FROM Exam_Event JOIN Level ON Level.id=Exam_Event.level_id
              WHERE Exam_Event.city_id={$city_id} AND (Level.name LIKE '%L2%') ORDER BY exam_on DESC ")->result();  
        }
         /**
    * Function to last_test_l3
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
        function last_test_l3($city_id)
        {
             return $this->db->query("SELECT Exam_Event.exam_on FROM Exam_Event JOIN Level ON Level.id=Exam_Event.level_id
              WHERE Exam_Event.city_id={$city_id} AND (Level.name LIKE '%L3%') ORDER BY exam_on DESC ")->result();  
        }
	
}