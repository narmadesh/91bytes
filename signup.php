<?php
	class Signup
	{
		private $con;
		public $form_data;
		function __construct($data)
		{
			$this->con = new mysqli("localhost","root","","91bytes");
			if ($this->con->connect_error) {
				die("Connection failed: " . $this->con->connect_error);
			}
			$this->form_data = $data;
		}

		function signup()
		{
			if(empty($this->form_data['name']))
			{
				return json_encode(array('status'=>'error','message'=>'Full Name must be filled'));
			}
			elseif(empty($this->form_data['email']))
			{
				return json_encode(array('status'=>'error','message'=>'Email address must be filled'));
			}
			elseif(empty($this->form_data['password']))
			{
				return json_encode(array('status'=>'error','message'=>'Password must be filled'));
			}
			elseif(!isset($this->form_data['agree']))
			{
				return json_encode(array('status'=>'error','message'=>'Please accept terms and privacy'));
			}
			else
			{
				$sql = "INSERT INTO `users` (name,email,password) VALUES ('".$this->form_data['name']."','".$this->form_data['email']."','".password_hash($this->form_data['name'],PASSWORD_DEFAULT)."')";

				if ($this->con->query($sql) === TRUE)
				{
					return json_encode(array('status'=>'success','message'=>'User created successfully'));
				}
				else
				{
					return json_encode(array('status'=>'error','message'=>'Something went wrong'));
				}
			}
		}
	}

	if(isset($_POST['signup']))
	{
		$signup = new Signup($_POST);
		echo $signup->signup();
	}
?>