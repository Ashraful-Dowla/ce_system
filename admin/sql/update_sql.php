<?php
session_start();
include('../includes/db/connection_db.php');


//================== *Update Subject Starts* ============================//


if(isset($_POST['update_subject'])) 
{
	$id=$_POST['id'];
	$subject_id=$_POST['subject_id'];
	$subject_name=$_POST['subject_name'];
    $semester = $_POST['semester'];

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

	$sql = "UPDATE subject SET subject_id='$subject_id',semester = $semester, subject_name='$subject_name' WHERE id=$id";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Subject Updated Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../subject/subject_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../subject/update_subject.php?id='.$id.'');
	}	

}

	else
	{			
		
			$_SESSION['alert_type'] = "danger";
			header('location: ../subject/update_subject.php?id='.$id.'');
	}	

}


//================== *Update Subject Ends* ============================//





//================== *Update Session Starts* ============================//


if(isset($_POST['update_session'])) 
{
	$id=$_POST['id'];
	$session_name=$_POST['session_name'];
	$year=$_POST['year'];


	$check_name = "SELECT session_name from session where session_name = '$session_name'";


	$result1 = $conn->query($check_name);
	if($result1->num_rows > 0){

		$_SESSION['err_session'] = "Session name already exist!";
	}



	if ($result1->num_rows == 0  ) {

	$sql = "UPDATE session SET session_name='$session_name', year='$year' WHERE id=$id";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Session Updated Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../session/session_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../session/update_session.php?id='.$id.'');
	}	

}
else
	{			
			$_SESSION['alert_type'] = "danger";
			header('location: ../session/update_session.php?id='.$id.'');
	}	

}




//================== *Update Session Ends* ============================//


//================== *Update department Starts* ============================//

if(isset($_POST['update_department'])) 
{
	$id=$_POST['id'];
	$department_name=$_POST['department_name'];

	$if_exist = "SELECT department_name from department where department_name = '$department_name'";

    $result1 = $conn->query($if_exist);

    if($result1->num_rows > 0){
    	$_SESSION['check'] = "Already exist";
        }

	if($result1->num_rows == 0){
	$sql = "UPDATE department SET department_name='$department_name' WHERE id=$id";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Department Updated Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../department/department_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../department/update_department.php?id='.$id.'');
	}	

}
else
	{			
		
			$_SESSION['alert_type'] = "danger";
			header('location: ../department/update_department.php?id='.$id.'');
	}	

}
//================== *Update department Ends* ============================//





//================== *Activate Teacher/Student Starts* ============================//

if(isset($_GET['status']) && isset($_GET['id']) && isset($_GET['type'])) 
{
	$id=$_GET['id'];
	$status=$_GET['status'];
	$type=$_GET['type'];

  //check if student or teacher
  if ($type == 2) {
		$member_type = "teacher";
	}
	elseif($type == 3){
		$member_type = "student";
	}


	if ($status == 0) {
			$auth = 1;  //To activate 
			$status = 1;
	}
	elseif($status == 1) {
			$auth = 0;  //To deactivate 
			$status = 0;
	}
	elseif($status == 2) {
			$auth = 2;  //To reject 
			$status = 0;
	}


	$sql = "UPDATE registration SET authentication=$auth WHERE member_id='$id'";

	$query = $conn->query($sql);

	if($query === TRUE){

		if($auth == 1){
			//CHECK IF EXISTS ON TEACHER/Student TABLE
			$exist_data = "SELECT * from ".$member_type." where ".$member_type."_id ='$id' and status = 1"; 
			$check = $conn->query($exist_data);

					if ($check->num_rows == 0) {
						//If not exists on teacher/student table than get data from registration and insert into// 
							$sql2 = "INSERT into ".$member_type."(".$member_type."_id,name,status,created_at) VALUES ('$id',(SELECT name from registration where member_id='$id' and authentication=1),1,now())"; 
							// $sql2 = "UPDATE ".$member_type." set status=" .$status. " where ".$member_type."_id ='$id' ";
							//table name and member id changed according to user type sent from teacher/student list//
			
							if ($conn->query($sql2) === TRUE) 
							{
								$_SESSION['alert'] = "Activated Successfully!";
								$_SESSION['alert_type'] = "success";
								header('location: ../'.$member_type.'/'.$member_type.'_list.php');
							}

					}
					else{
						$_SESSION['alert'] = "Activated Successfully!";
						$_SESSION['alert_type'] = "success";
						header('location: ../'.$member_type.'/'.$member_type.'_list.php');
					}
		
		} elseif($auth == 0){

			$_SESSION['alert'] = "Deactivated Account Successfully!";
			$_SESSION['alert_type'] = "success";
			header('location: ../'.$member_type.'/'.$member_type.'_list.php');

		} elseif($auth == 2){

			$_SESSION['alert'] = "Account is rejected!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../'.$member_type.'/'.$member_type.'_list.php');
		}

	}
	else
	{			
		$_SESSION['alert'] = "Error Occured!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../'.$member_type.'/'.$member_type.'_list.php');
	}	

}

//================== *Activate Teacher/Student Ends* ============================//






//================== *Update Teacher Start* ============================//

if(isset($_POST['update_teacher'])) 
{
$login_id = $_POST['login_id'];
$teacher_f_id = $_POST['teacher_f_id'];
$teacher_id=$_POST['teacher_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$username=$_POST['username'];
$department=$_POST['department'];
$password=md5($_POST['password']);


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

if($_POST['password'] != ''){
		//check if password length is 8 or more
	if (strlen($_POST['password']) >= 8) {
		
		$login = "UPDATE login set username= '$username',password='$password' where id =$login_id";
	}
	else{
		$_SESSION['alert'] = "Password Must be atleast 8 characters!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../teacher/update_teacher.php?id='.$teacher_id.'');
		exit;
	}
	
}
else{
	$login = "UPDATE login set username= '$username' where id=$login_id";
}

if ($conn->query($login) === TRUE) 
{
		// $last_id = $conn->insert_id;
		//FOR REGISTRATION FORM//
		$reg = "UPDATE registration set name='$name',department='$department',member_id='$teacher_id' where login_id=$login_id";

		//FOR teacher table
		$teacher = "UPDATE teacher set name='$name',teacher_id='$teacher_id' where id=$teacher_f_id";


		if ($conn->query($reg) === TRUE && $conn->query($teacher) === TRUE) 
		{
			$_SESSION['alert'] = "Update Successful!";
			$_SESSION['alert_type'] = "success";
			header('location: ../teacher/teacher_list.php');
		}
		else
		{
				$_SESSION['alert'] = "Update Error Occured!";
				$_SESSION['alert_type'] = "danger";
				header('location: ../teacher/update_teacher.php?id='.$teacher_id.'');
				
		}	
} 

else
{
		$_SESSION['alert'] = "Update Error Occured!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../teacher/update_teacher.php?id='.$teacher_id.'');
		
}	

}
else
{
		$_SESSION['alert_type'] = "danger";
		header('location: ../teacher/update_teacher.php?id='.$teacher_id.'');
		
}	

}

//================== *Update Teacher Ends* ============================//




//================== *Update assign teacher Starts* ============================//

elseif(isset($_POST['update_assign_teacher'])) 
{

	$subjects = $_POST['subject'];
	$session = $_POST['session'];
	$section = $_POST['section'];
	$teacher = $_POST['teacher'];
	$id = $_POST['id'];

	// $subject = implode(",",$subjects);  

$validation = "SELECT * FROM assign_teacher where session_id = '$session' and section_id = '$section' and subject_id = '$subjects'";

	$result = $conn->query($validation);

	if($result->num_rows == 0){

		$sql = "UPDATE assign_teacher set session_id='$session',subject_id='$subjects',section_id=$section where id=$id";

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
				// echo mysqli_error($conn);
				header('location: ../teacher/update_assign_teacher.php?id='.$id.'');
		}	

	}
		else
		{			
				$_SESSION['alert'] = "Already Assigned!";
				$_SESSION['alert_type'] = "danger";
				// echo mysqli_error($conn);
				header('location: ../teacher/update_assign_teacher.php?id='.$id.'');
		}	

	}



//================== *Update assign teacher Ends* ============================//







//================== *Update student Start* ============================//

if (isset($_POST['update_student'])) 
{
$login_id = $_POST['login_id'];
$student_f_id = $_POST['student_f_id'];
$student_id=$_POST['student_id'];
$name=$_POST['name'];
$email=$_POST['email'];
$semester=$_POST['semester'];
$username=$_POST['username'];
$department=$_POST['department'];
$section=$_POST['section'];
$password=md5($_POST['password']);



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

if($_POST['password'] != ''){
	
	//check if password length is 8 or more
	if (strlen($_POST['password']) >= 8) {
		
		$login = "UPDATE login set username= '$username',password='$password' where id =$login_id";
	}
	else{
		$_SESSION['err_pass'] = "Password Must be atleast 8 characters!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../student/update_student.php?id='.$student_id.'');
		exit;
	}
}
else{
	$login = "UPDATE login set username= '$username' where id=$login_id";
}

if ($conn->query($login) === TRUE) 
{
		// $last_id = $conn->insert_id;
		//FOR REGISTRATION FORM//
		$reg = "UPDATE registration set name='$name',semester='$semester',section='$section',department='$department',member_id='$student_id' where login_id=$login_id";

		//FOR teacher table
		$student = "UPDATE student set name='$name',student_id='$student_id' where id=$student_f_id";


		if ($conn->query($reg) === TRUE && $conn->query($student) === TRUE) 
		{
			$_SESSION['alert'] = "Update Successful!";
			$_SESSION['alert_type'] = "success";
			header('location: ../student/student_list.php');
		}
		else
		{

			$_SESSION['alert'] = "Update Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../student/update_student.php?id='.$student_id.'');
				
		}	
} 

else
{
		$_SESSION['alert'] = "Update Error Occured!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../student/update_student.php?id='.$student_id.'');
		
}	

}
else
{
		$_SESSION['alert_type'] = "danger";
		header('location: ../student/update_student.php?id='.$student_id.'');
		
}	

}

//================== *Update student Ends* ============================//




//================== *Update section Starts* ============================//

if(isset($_POST['update_section'])) 
{
	$id=$_POST['id'];
	$section_name=$_POST['section_name'];

	$check_exist = "SELECT section_name from section where section_name = '$section_name'";

	$result = $conn->query($check_exist);
	if($result->num_rows > 0){
        	$_SESSION['err_section'] = "Section Already exist!";
	}

	if($result->num_rows == 0){

	$sql = "UPDATE section SET section_name='$section_name' WHERE id=$id";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "section Updated Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../section/section_list.php');
	}
	else
	{			
		$_SESSION['alert'] = "Error Occured!";
		$_SESSION['alert_type'] = "danger";
		header('location: ../section/update_section.php?id='.$id.'');
	}	

}
else
	{			
		$_SESSION['alert_type'] = "danger";
		header('location: ../section/update_section.php?id='.$id.'');
	}	

}


//================== *Update section Ends* ============================//







//================== *Update Semester Starts* ============================//

elseif(isset($_POST['update_semester']))
{
    $semester_name=$_POST['semester_name'];
    $id=$_POST['id'];

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

    $sql = "UPDATE semester SET semester_name='$semester_name' WHERE id=$id";

    //$sql = "INSERT INTO semester (semester_no,semester_name,year,created_at) VALUES ('$semester_no','$semester_name',now())";

    if ($conn->query($sql) === TRUE)
    {
				$_SESSION['alert'] = "Updated Successfully!";
				$_SESSION['alert_type'] = "success";
				
        header('location: ../semester/semester_list.php');
    }

    else
    {
				$_SESSION['alert'] = "Error Occured!";
				$_SESSION['alert_type'] = "danger";
        header('location: ../semester/update_semester.php?id='.$id.'');
    }

}
else
    {
			
		$_SESSION['alert_type'] = "danger";
        header('location: ../semester/update_semester.php?id='.$id.'');
    }

}

//================== *Update Semester Ends* ============================//















//================== *Update No of class starts* ============================//




elseif(isset($_POST['update_no_of_class'])) 
{
	$total_class_number=$_POST['total_class_number'];

	$id=$_POST['id'];

	$sql = "UPDATE assign_class SET number_of_class='$total_class_number' WHERE id=$id";
	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Number Of Class updated Successfully!";
		$_SESSION['alert_type'] = "success";
		header('location: ../class/assigned_subject_list.php');
	}

	else
	{			
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../class/update_class.php?id='.$id.'');
	}	

	
}




//================== *Update No of class ends* ============================//

//================== *status of class starts* ============================//

elseif(isset($_GET['class_status']) && isset($_GET['id'])) 
{

if ($_GET['class_status'] == 'cancel') 
{
	$status = 0;
	$msg = 'Successfully Canceled!';
}
elseif($_GET['class_status'] == 'accept'){
	$status = 2;
	$msg = 'Successfully Accepted!';
}

	$id=$_GET['id'];
	$sql = "UPDATE assign_teacher SET status=$status WHERE id=$id";
	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "$msg";
		$_SESSION['alert_type'] = "success";
		header('location: ../class/assigned_subject_list.php');
	}

	else
	{			
		$_SESSION['alert'] = "Error Occured";
		$_SESSION['alert_type'] = "danger";
		header('location: ../class/assigned_subject_list.php');
	}	


	
}


//================== *status of class ends* ============================//
		
//================== *update course outline starts* ============================//

elseif(isset($_POST['update_course_outline'])) 
{

	$class_no_id=$_POST['class_no_id'];
	$course_outline=mysqli_real_escape_string($conn,$_POST['course_outline']);
	$sql = "UPDATE course_outline SET course_outline='$course_outline' WHERE id=$class_no_id";
	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Successfully Updated!";
		$_SESSION['alert_type'] = "success";
		header('location: ../course_outline/update_course_outline.php?id='.$class_no_id.'');
	}

	else
	{			
		$_SESSION['alert'] = "Error Occured";
		$_SESSION['alert_type'] = "danger";
		header('location: ../course_outline/update_course_outline.php?id='.$class_no_id.'');
	}	


	
}


//================== *update course outline  ends* ============================//

//================== *update course outline daily starts* ============================//

elseif(isset($_POST['update_course_outline_daily'])) 
{

	$class_no_id=$_POST['class_no_id'];
	$course_outline=mysqli_real_escape_string($conn,$_POST['course_outline']);

	$sql = "UPDATE daily_class_lecture SET course_outline='$course_outline' WHERE id=$class_no_id";
	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Successfully Updated!";
		$_SESSION['alert_type'] = "success";
		header('location: ../course_outline/update_course_outline_daily.php?id='.$class_no_id.'');
	}

	else
	{			
		$_SESSION['alert'] = "Error Occured";
		$_SESSION['alert_type'] = "danger";
		header('location: ../course_outline/update_course_outline_daily.php?id='.$class_no_id.'');
	}	


	
}


//================== *update course outline daily ends* ============================//


//================== *update Student Review Starts* ============================//

elseif(isset($_POST['update_review'])) 
{
	// print_r($_POST);
	// exit;
	$edit_id = $_POST['edit_id'];
	$id = $_POST['daily_class_lecture_id'];
	$comment=mysqli_real_escape_string($conn,$_POST['comment']);
	// $student_id=$_POST['student_id'];
	$page_id=$_POST['page_id'];
	$rating=$_POST['rating'];




	$sql = "UPDATE class_review set comment='$comment',rating='$rating' where id=$edit_id";

	if ($conn->query($sql) === TRUE) 
	{
		$_SESSION['alert'] = "Your Review Successfully Updated!";
		$_SESSION['alert_type'] = "success";
		header('location: ../review/daily_class_review.php?ast_id='.$page_id.'');
	}

	else
	{		echo mysqli_error($conn);
		exit;
			$_SESSION['alert'] = "Error Occured!";
			$_SESSION['alert_type'] = "danger";
			header('location: ../review/update_review.php?ast_id='.$page_id.'&&id='.$id.'&&edit_id='.$edit_id.'');
	}	




}

//================== *update Student Review Ends* ============================//



//================== *Request subject for student EDIT Starts* ============================//

elseif(isset($_POST['request_subject_edit'])) 
{
	$student_id= $_POST['student_id'];
	$subject = $_POST['subject'];
	$prev_subject = $_POST['prev_subject'];

	$exist = "SELECT * from assign_subject_student where student_id = '$student_id' and (subject_id ='$subject' or subject_id ='$prev_subject')";

	$query = $conn->query($exist);

	if ($query->num_rows == 0) {
		
			$sql = "UPDATE assign_subject_student set subject_id = $subject)";

			if ($conn->query($sql) === TRUE) 
			{
				$_SESSION['alert'] = "Your Request Successfully Updated!";
				$_SESSION['alert_type'] = "success";
				header('location: ../student/subject_request.php');
			}
			else
			{		
				$_SESSION['alert'] = "Error Occured!";
				$_SESSION['alert_type'] = "danger";
				// echo mysqli_error($conn);
				header('location: ../student/subject_request.php');
			}	
	}
	else{
			$_SESSION['alert'] = "Already Requested For This Subject!";
			header('location: ../student/subject_request.php?student_id='.$student_id.'');
	}

}

//================== *Request subject for student EDIT Ends* ============================//

 //================== *Accept Request Subject Student Starts* ==========================//


 elseif(isset($_GET['update']))  {
	 if($_GET['update'] == 'subject_assign_student'){

		$id = $_GET['id'];
		$sql = "UPDATE assign_subject_student SET request_status=1 WHERE id=$id";

		if ($conn->query($sql) === TRUE)
		{
				$_SESSION['alert'] = "Assigned Successfully!";
				$_SESSION['alert_type'] = "success";
				header('location: ../subject/assign_subject_student.php');
		}
	
		else
		{
				$_SESSION['alert'] = "Error Occured!";
				$_SESSION['alert_type'] = "danger";
				header('location: ../subject/assign_subject_student.php');
		}

	 }
}

//================== *Accept Request Subject Student Ends* ============================//


?>