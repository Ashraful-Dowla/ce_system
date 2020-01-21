<?php
session_start();
include('../includes/db/connection_db.php');
	
//================== *Registration Starts* ============================//

if (isset($_POST['signup'])) 
{
	$user_type=$_POST['user_type'];
	$member_id=$_POST['member_id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$username=$_POST['username'];
	$semester=$_POST['semester'];
	$section=$_POST['section'];
	$user_type=$_POST['user_type'];
	$department=$_POST['department'];
	$password=md5($_POST['password']);

	// if ($user_type == 2) {     //for teacher
	// 	$table_name = "teacher"; //table name
	// 	$id = "teacher_id";      //same as $member_id for column_name
	// }
	// elseif($user_type == 3){   //for student
	// 	$table_name = "student"; //table name
	// 	$id = "student_id";      //same as $member_id for column_name
	// }

	// 	// For TEACHER or STUDENT details table
	// 	$details = "INSERT INTO ".$table_name." (name,".$id.",created_at) VALUES ('$name','$department','$member_id',now())";  

	//FOR LOGIN FORM//
if (strlen($_POST['password']) >= 8) {

$if_student_id_exist = "SELECT member_id from registration where member_id = '$member_id'";
$if_email_exist = "SELECT email from registration where email = '$email'";
$if_username_exist = "SELECT username from login where username = '$username'";
	
$result1 = $conn->query($if_student_id_exist);
if($result1->num_rows > 0){
	$_SESSION['err_id'] = "This ID Already Exists";
}
$result2 = $conn->query($if_email_exist);
if($result2->num_rows > 0){
	$_SESSION['err_email'] = "Email Already Exists";
}
$result3 = $conn->query($if_username_exist);
if($result3->num_rows > 0){
	$_SESSION['err_username'] = "Username Already Exists";
}


if ($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) {


	$login = "INSERT INTO login(username,password,user_type,created_at) VALUES ('$username','$password',$user_type,now())";

	if ($conn->query($login) === TRUE) 
	{
			$last_id = $conn->insert_id;
			//FOR REGISTRATION FORM//
			$reg = "INSERT INTO registration(semester,name,email,section,department,member_id,login_id,created_at) VALUES ('$semester','$name','$email','$section','$department','$member_id',$last_id,now())";


			if ($conn->query($reg) === TRUE) 
			{
				$_SESSION['alert'] = "Registration Successful!";
				$_SESSION['alert_type'] = "success";
				header('location: ../../login.php');
			}
	} 

	else
	{
			$_SESSION['alert'] = "Registration Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../../registration.php');
			
	}	

	}

	else
	{
			
			$_SESSION['alert_type'] = "danger";
			header('location: ../../registration.php');
			
	}	
}
else {
	$_SESSION['alert'] = "Password Must be atleast 8 characters!";
	$_SESSION['alert_type'] = "danger";
header('location: ../../registration.php');
}

}


//================== *Registration Ends* ============================//



//================== *Add Subject Starts* ============================//

elseif(isset($_POST['add_subject'])) 
{
	$subject_id=$_POST['subject_id'];
	$subject_name=$_POST['subject_name'];
	$semester=$_POST['semester'];

	$check_id = "SELECT subject_id from subject  where subject_id = '$subject_id'";
    $check_name = "SELECT subject_name from subject  where subject_name = '$subject_name'";

	$result1 = $conn->query($check_id);
	if($result1->num_rows > 0){

		$_SESSION['err_subject_id'] = "Subject id already exist!";
	}
$result2 = $conn->query($check_name);
	if($result2->num_rows > 0){

		$_SESSION['err_subject_name'] = "Subject name already exist!";
	}


	if ($result1->num_rows == 0 && $result2->num_rows == 0 ) {

	$sql = "INSERT INTO subject(subject_id,semester,subject_name,created_at) VALUES ('$subject_id',$semester,'$subject_name',now())";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "New Subject Added Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../subject/subject_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../subject/add_subject.php');
	}	

}

	else
	{			
			$_SESSION['old_sub_id'] = $subject_id;
			$_SESSION['old_sub_name'] = $subject_name;
			$_SESSION['alert_type'] = "danger";
			header('location: ../subject/add_subject.php');
	}	
}

//================== *Add Subject Ends* ============================//

	


//================== *Add Session Starts* ============================//

elseif(isset($_POST['add_session'])) 
{
	$session_title=$_POST['session_name'];
	$year=$_POST['year'];

	$check_name = "SELECT session_name from session where session_name = '$session_title'";


	$result1 = $conn->query($check_name);
	if($result1->num_rows > 0){

		$_SESSION['err_session'] = "Session name already exist!";
	}



	if ($result1->num_rows == 0  ) {

		$sql = "INSERT INTO session (session_name,year,created_at) VALUES ('$session_title','$year',now())";

		if ($conn->query($sql) === TRUE) 
		{
			$_SESSION['alert'] = "New Session Added Successfully!";
			$_SESSION['alert_type'] = "success";
			header('location: ../session/session_list.php');
		}
	
		else
		{			
				$_SESSION['alert'] = "Error Occured!";
				$_SESSION['alert_type'] = "success";
				header('location: ../session/add_session.php');
		}	

	}
	else{

				$_SESSION['old_session'] = $session_title;
				$_SESSION['alert_type'] = "danger";
				header('location: ../session/add_session.php');
	}


}

//================== *Add Session Ends* ============================//




//================== *Add Semester Starts* ============================//

elseif(isset($_POST['add_semester']))
{
	$semester_name=$_POST['semester_name'];
	$semester_no=$_POST['semester_no'];

	$check_name = "SELECT semester_name from semester where semester_name = '$semester_name'";
    $check_no = "SELECT semester_no from semester where semester_no = '$semester_no'";

	$result1 = $conn->query($check_name);
	if($result1->num_rows > 0){

		$_SESSION['err_semester_name'] = "Semester name already exist!";
	}
$result2 = $conn->query($check_no);
	if($result2->num_rows > 0){

		$_SESSION['err_semester_no'] = "Semester no already exist!";
	}


	if ($result1->num_rows == 0 && $result2->num_rows == 0 ) {

		$sql = "INSERT INTO semester (semester_no,semester_name,created_at) VALUES ('$semester_no','$semester_name',now())";

		if ($conn->query($sql) === TRUE)
		{
			$_SESSION['alert'] = "New Semester Added Successfully!";
			$_SESSION['alert_type'] = "success";
			header('location: ../semester/semester_list.php');
		}

		else
		{
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../semester/add_semester.php');
		}
	}


	else
	{
		$_SESSION['old_semester_no'] = $semester_no;
		$_SESSION['old_semester'] = $semester_name;
		$_SESSION['alert_type'] = "danger";
		header('location: ../semester/add_semester.php');
	}

}

//================== *Add Semester Ends* ============================//



//================== *Add Department Starts* ============================//

elseif(isset($_POST['add_department'])) 
{

	$department_name=$_POST['department_name'];

	$if_exist = "SELECT department_name from department where department_name = '$department_name'";

    $result1 = $conn->query($if_exist);

    if($result1->num_rows > 0){
    	$_SESSION['check'] = "Already exist";
        }

	if($result1->num_rows == 0){

	$sql = "INSERT INTO department(department_name,created_at) VALUES ('$department_name',now())";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "New Department Added Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../department/department_list.php');
	}
	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../department/add_department.php');
	}	
}
else
	{	
		    $_SESSION['old_department'] = $department_name;
			$_SESSION['alert_type'] = "danger";
			header('location: ../department/add_department.php');
	}	
}

//================== *Add Department Ends* ============================//




//================== *assign teacher Starts* ============================//

elseif(isset($_POST['assign_teacher'])) 
{

	$subjects = $_POST['subject'];
	$session = $_POST['session'];
	$teacher = $_POST['teacher'];
	$section = $_POST['section'];

	// $subject = implode(",",$subjects);  

	//CHECK IF ALREADY ASSIGNED FOR THIS SESSION

	// var_dump($_POST);
	// exit;
	$validation = "SELECT * FROM assign_teacher where session_id=$session and section_id = $section and subject_id = $subjects";

	$result = $conn->query($validation);
	if($result->num_rows > 0){
             $_SESSION['alert'] = "Already Assigned!";
	}

	if($result->num_rows == 0){

		$sql = "INSERT INTO assign_teacher(teacher_id,session_id,subject_id,section_id,created_at) VALUES ('$teacher','$session','$subjects','$section',now())";

		if ($conn->query($sql) === TRUE) 
		{
			$_SESSION['alert'] = "Subjects Assigned Successfully!";
			$_SESSION['alert_type'] = "success";
			header('location: ../teacher/assign_teacher_list.php');
		}

		else
		{			
				$_SESSION['alert'] = "Error Occured!";
				$_SESSION['alert_type'] = "danger";
				header('location: ../teacher/assign_teacher.php');
		}	

	}
	else{

			$_SESSION['alert_type'] = "danger";
			header('location: ../teacher/assign_teacher_list.php');

	}	

}


//================== *assign teacher Ends* ============================//




//================== *Add Teacher Start* ============================//
elseif (isset($_POST['add_teacher'])) 
{

$user_type = 2;  //type 2 = teacher 
$teacher_id=$_POST['teacher_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$department=$_POST['department'];
$password=md5($_POST['password']);




//$if_exist = "Select member_id from registration where member_id = '$teacher_id'";
	
//$result = $conn->query($if_exist);
if (strlen($_POST['password']) >= 8) {

$if_teacher_id_exist = "SELECT member_id from registration where member_id = '$teacher_id'";
$if_email_exist = "SELECT email from registration where email = '$email'";
$if_username_exist = "SELECT username from login where username = '$username'";
	
$result1 = $conn->query($if_teacher_id_exist);
if($result1->num_rows > 0){
	$_SESSION['err_teacher_id'] = "Teacher ID Already Exists";
}
$result2 = $conn->query($if_email_exist);
if($result2->num_rows > 0){
	$_SESSION['err_email'] = "Email Already Exists";
}
$result3 = $conn->query($if_username_exist);
if($result3->num_rows > 0){
	$_SESSION['err_username'] = "Username Already Exists";
}


if ($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) {

	$login = "INSERT INTO login(username,password,user_type,created_at) VALUES ('$username','$password',$user_type,now())";

	if ($conn->query($login) === TRUE) 
	{
			$last_id = $conn->insert_id;
			//FOR REGISTRATION FORM//
			$reg = "INSERT INTO registration(name,email,department,member_id,login_id,created_at,authentication) VALUES ('$name','$email','$department','$teacher_id',$last_id,now(),1)";
	
			//FOR teacher table
			$teacher = "INSERT INTO teacher(teacher_id,name,status,created_at) VALUES ('$teacher_id','$name',1,now())";
	
	
			if ($conn->query($reg) === TRUE && $conn->query($teacher) === TRUE) 
			{
				$_SESSION['alert'] = "Registration Successful!";
				$_SESSION['alert_type'] = "success";
				header('location: ../teacher/teacher_list.php');
			}
			else
			{
					$_SESSION['alert'] = "Registration Error Occured!";
					$_SESSION['alert_type'] = "danger";
					header('location: ../teacher/add_teacher.php');
					
			}	
	} 
	


}
else
{
		$_SESSION['old_teacher_id'] = $teacher_id;
		$_SESSION['old_email'] = $email;
		$_SESSION['old_username'] = $username;
		$_SESSION['old_name'] = $name;
		$_SESSION['old_dept'] = $department;
		$_SESSION['alert_type'] = "danger";
		header('location: ../teacher/add_teacher.php');
		
}	
	
}

	else {
	$_SESSION['alert'] = "Password Must be atleast 8 characters!";
	$_SESSION['alert_type'] = "danger";
	header('location: ../teacher/add_teacher.php');	
}

}



//================== *Add Teacher Ends* ============================//










//================== *Add Student Start* =====================//
elseif (isset($_POST['add_student'])) 
{

$user_type = 3;  //type 3 = student 
$student_id=$_POST['student_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$department=$_POST['department'];
$semester=$_POST['semester'];
$section=$_POST['section'];
$password=md5($_POST['password']);

if (strlen($_POST['password']) >= 8) {

$if_student_id_exist = "SELECT member_id from registration where member_id = '$student_id'";
$if_email_exist = "SELECT email from registration where email = '$email'";
$if_username_exist = "SELECT username from login where username = '$username'";
	
$result1 = $conn->query($if_student_id_exist);
if($result1->num_rows > 0){
	$_SESSION['err_student_id'] = "Student ID Already Exists";
}
$result2 = $conn->query($if_email_exist);
if($result2->num_rows > 0){
	$_SESSION['err_email'] = "Email Already Exists";
}
$result3 = $conn->query($if_username_exist);
if($result3->num_rows > 0){
	$_SESSION['err_username'] = "Username Already Exists";
}


if ($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0) {


// $if_student_id_exist = "Select member_id from registration where email = '$email'";
	
// $result = $conn->query($if_student_id_exist);

	$login = "INSERT INTO login(username,password,user_type,created_at) VALUES ('$username','$password',$user_type,now())";

	if ($conn->query($login) === TRUE) 
	{
			$last_id = $conn->insert_id;
			//FOR REGISTRATION FORM//
			$reg = "INSERT INTO registration(semester,name,email,section,department,member_id,login_id,created_at,authentication) VALUES ('$semester','$name','$email','$section','$department','$student_id',$last_id,now(),1)";
	
			//FOR teacher table
			$student = "INSERT INTO student(student_id,name,status,created_at) VALUES ('$student_id','$name',1,now())";
	
	
			if ($conn->query($reg) === TRUE && $conn->query($student) === TRUE) 
			{
				$_SESSION['alert'] = "Registration Successful!";
				$_SESSION['alert_type'] = "success";
				header('location: ../student/student_list.php');
			}
			else
			{
					$_SESSION['alert'] = "Registration Error Occured!";
					$_SESSION['alert_type'] = "danger";
					header('location: ../student/add_student.php');
					// echo mysqli_error($conn);
			}	
	} 
	
		
	
}
else
{

		$_SESSION['old_student_id'] = $student_id;
		$_SESSION['old_email'] = $email;
		$_SESSION['old_username'] = $username;
		$_SESSION['old_name'] = $name;
		$_SESSION['old_dept'] = $department;
		$_SESSION['old_semester'] = $semester;
		$_SESSION['old_section'] = $section;
		$_SESSION['alert_type'] = "danger";
		header('location: ../student/add_student.php');
		
}	
}
	else
			{
					$_SESSION['err_pass'] = "Password Must be atleast 8 characters!";
					$_SESSION['alert_type'] = "danger";
					header('location: ../student/add_student.php');
					// echo mysqli_error($conn);
			}	
	} 
//================== *Add Student Ends* ============================//


//================== *Add section Starts* ============================//

elseif(isset($_POST['add_section'])) 
{
	$section_name=$_POST['section_name'];

	$check_exist = "SELECT section_name from section where section_name = '$section_name' and status = 1";

	$result = $conn->query($check_exist);
	if($result->num_rows > 0){
        	$_SESSION['err_section'] = "Section Already exist!";
	}

	if($result->num_rows == 0){

	$sql = "INSERT INTO section(section_name,created_at) VALUES ('$section_name',now())";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "New section Added Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../section/section_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../section/add_section.php');
	}	

}
	else
	{			
		    $_SESSION['old_section'] = $section_name;
			$_SESSION['alert_type'] = "danger";
			header('location: ../section/add_section.php');
	}	

}


//================== *Add section Ends* ============================//



//================== *Add No of class starts* ============================//




elseif(isset($_POST['add_no_of_class'])) 
{
	$total_class_number=$_POST['total_class_number'];
	$assign_teacher_id=$_POST['assign_teacher_id'];

	$sql = "INSERT INTO assign_class(assign_teacher_id,number_of_class,created_at) VALUES ($assign_teacher_id,$total_class_number,now())";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Number Of Class assigned Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../class/assigned_subject_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../class/assigned_subject_list.php');
	}	


}







//================== *Add No of class ends* ============================//



//================== *Add No of class starts* ============================//




elseif(isset($_POST['add_course_outline'])) 
{
	$class_no=$_POST['number_of_class'];
	$course_outline=mysqli_real_escape_string($conn,$_POST['course_outline']);
	$assign_class_id=$_POST['assign_class_id'];


	$sql = "INSERT INTO course_outline(assign_class_id,class_no,course_outline,created_at) VALUES ($assign_class_id,$class_no,'$course_outline',now())";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Class Outline added succesfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../course_outline/assign_course_outline.php?id='.$assign_class_id.'');
	}
	
	else
	{		
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../course_outline/assign_course_outline.php?id='.$assign_class_id.'');
	}	


}


//================== *Add No of class ends* ============================//





//================== *Add No of class starts* ============================//


elseif(isset($_POST['add_course_outline_daily'])) 
{
	$class_no=$_POST['number_of_class'];
	$course_outline=mysqli_real_escape_string($conn,$_POST['course_outline']);
	$assign_class_id=$_POST['assign_class_id'];


	$sql = "INSERT INTO daily_class_lecture(assign_class_id,class_no,course_outline,created_at) VALUES ($assign_class_id,$class_no,'$course_outline',now())";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Class Outline added succesfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../course_outline/daily_class_lecture.php?id='.$assign_class_id.'');
	}

	else
	{		
			mysqli_error($conn);	
			exit;
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../course_outline/daily_class_lecture.php?id='.$assign_class_id.'');
	}	


}


//================== *Add No of class ends* ============================//




//================== *Add Student Review Starts* ============================//

elseif(isset($_POST['add_review'])) 
{
	// print_r($_POST);
	// exit;
	$daily_class_lecture_id = $_POST['daily_class_lecture_id'];
	$comment=mysqli_real_escape_string($conn,$_POST['comment']);
	$student_id=$_POST['student_id'];
	$page_id=$_POST['page_id'];
	$rating=$_POST['rating'];
	$teacher_id=$_POST['teacher_id'];	

	$exist = "SELECT * from class_review where daily_class_lecture_id = $daily_class_lecture_id and student_id='$student_id'";

	$query = $conn->query($exist);


	if ($query->num_rows == 0) {
		
			$sql = "INSERT INTO class_review(daily_class_lecture_id,teacher_id,comment,student_id,created_at,rating) VALUES ($daily_class_lecture_id,'$teacher_id','$comment','$student_id',now(),$rating)";

			if ($conn->query($sql) === TRUE) 
			{
				$_SESSION['alert'] = "Your Review Successfully Added!";
				$_SESSION['alert_type'] = "success";
				header('location: ../review/daily_class_review.php?ast_id='.$page_id.'');
			}
		
			else
			{		

					$_SESSION['alert'] = "Error Occured!";
					$_SESSION['alert_type'] = "danger";
					header('location: ../review/add_new_review.php?ast_id='.$page_id.'&&id='.$daily_class_lecture_id.'');
			}	
	}
	else{
		$_SESSION['alert'] = "Already Reviewd!";
		header('location: ../review/add_new_review.php?ast_id='.$page_id.'&&id='.$daily_class_lecture_id.'');
	}



}

//================== *Add Student Review Ends* ============================//






//================== *Request subject for student Starts* ============================//

elseif(isset($_POST['request_subject'])) 
{
	
	$student_id= $_POST['student_id'];
	$subject = $_POST['subject'];

	$exist = "SELECT * from assign_subject_student where student_id = '$student_id' and subject_id ='$subject'";

	$query = $conn->query($exist);


	if ($query->num_rows == 0) {
		
			$sql = "INSERT INTO assign_subject_student(student_id,subject_id,created_at) VALUES ('$student_id',$subject,now())";

			if ($conn->query($sql) === TRUE) 
			{
				$_SESSION['alert'] = "Your Request Successfully Added!";
				$_SESSION['alert_type'] = "success";
				header('location: ../student/subject_request.php?student_id='.$student_id.'');
			}
		
			else
			{		

					$_SESSION['alert'] = "Error Occured!";
					$_SESSION['alert_type'] = "danger";
					// echo mysqli_error($conn);
					header('location: ../student/subject_request.php?student_id='.$student_id.'');
			}	
	}
	else{
		$_SESSION['alert'] = "Already Requested For This Subject!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../student/subject_request.php?student_id='.$student_id.'');
	}



}

//================== *Request subject for student Ends* ============================//




?>


