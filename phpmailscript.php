<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$user='';
$pass='';
$host='';

$con= mysql_connect($host,$user,$pass);
if(!$con){die ("Unable to connect to database".mysql_error());
}
$db_select=mysql_select_db('database_name',$con);
if(!$db_select){
die("Database selection fail".mysql_error());}



   $db_query= "SELECT * FROM firstpage ORDER BY id DESC LIMIT 1";
   $result= mysql_query($db_query);
   if(!$db_query){
    die("Unable carry out the query".mysql_error());
	}

	$row = mysql_fetch_array($result);
	if ($row['head']=='not sent'){

	$bilsub=$row['subject'];
	$bilsmg=$row['message'];
	$bilhead=$row['head'];
	$id=$row['id'];


			//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Set who the message is to be sent from
		$mail->setFrom('somemail@anyhost.com','Optional_Name');

		//Set who the message is to be sent to
		$mail->addAddress('recievermail@gmail.com');
		//Set the subject line
		$mail->Subject = $bilsub;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body



		$mail->Body = $bilsmg;

		if (!$mail->send()) {
		    echo 'Mailer Error: '. $mail->ErrorInfo;
		} 
		else {
		    echo 'First page mail sent! -->>';

		$update_db_query=mysql_query("UPDATE firstpage SET head='sent' WHERE id='$id' ") or die(mysql_error());

			secondpage();
			smspage();

			}
		}

			else{
			echo "Already sent";
		}






	function secondpage(){
   $db_query= "SELECT * FROM secondpage ORDER BY id DESC LIMIT 1";
   $result= mysql_query($db_query);
   if(!$db_query){
    die("Unable carry out the query".mysql_error());
	}

	$row = mysql_fetch_array($result);
	if ($row['head']=='not sent'){

	$bilsub=$row['subject'];
	$bilsmg=$row['message'];
	$bilhead=$row['head'];
	$id=$row['id'];
			//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Set who the message is to be sent from
		$mail->setFrom('anymail@gma.com','Optional_Name');

		//Set who the message is to be sent to
		$mail->addAddress('Somemail@gmail.com');
		//Set the subject line
		$mail->Subject = $bilsub;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body

		$mail->Body = $bilsmg;

		if (!$mail->send()) {
		    echo 'Mailer Error: '. $mail->ErrorInfo;
		} 
		else {
		    echo 'Secondpage Mail sent! -->>';

		$update_db_query=mysql_query("UPDATE secondpage SET head='sent' WHERE id='$id' ") or die(mysql_error());

			}
		}

			else{
			echo "Already sent";
		}


	}

    function smspage(){
   $db_query= "SELECT * FROM smspage ORDER BY id DESC LIMIT 1";
   $result= mysql_query($db_query);
   if(!$db_query){
    die("Unable carry out the query".mysql_error());
	}
	$row = mysql_fetch_array($result);
	if ($row['head']=='not sent'){

	$bilsub=$row['subject'];
	$bilsmg=$row['message'];
	$bilhead=$row['head'];
	$id=$row['id'];


		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Set who the message is to be sent from
		$mail->setFrom('mail@me.com','Optional_Name');

		//Set who the message is to be sent to
		$mail->addAddress('funmail@xs.com');
		//Set the subject line
		$mail->Subject = $bilsub;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body

		$mail->Body = $bilsmg;

		if (!$mail->send()) {
		    echo 'Mailer Error: '. $mail->ErrorInfo;
		} 
		else {
		    echo 'SmsPage Mail sent! ';

		$update_db_query=mysql_query("UPDATE smspage SET head='sent' WHERE id='$id' ") or die(mysql_error());
			}
		}

			else{
			echo "Already sent";
		}


	}


?>