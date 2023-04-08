<?php
$conn = mysqli_connect("localhost", "root", "", "db_ecommerce");
?>
<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	if(isset($_POST['send'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$image = $_POST['image'];
		$date = date('Y-m-d');

					$sql = "INSERT INTO contactus  (name, email, subject, message, date) VALUES ($name, $email, $subject, $message, $date)";
                    $result = mysqli_query($conn, $sql);

                    $message = "
                    <body style='background-color: #b0c1c1'>
						<H1>Mercogene</H1>
						<p>Email: ".$_POST['email']."</p>
						<p>From: ".$_POST['name']."</p>
                        <p>Message: ".$_POST['message']."</p>
                    </body>
					";

					//Load phpmailer
		    		require 'vendor/autoload.php';

		    		$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'smtp.gmail.com';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'acevalencia13@gmail.com';     
				        $mail->Password = 'bwidlnolmpuqxahc';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'ssl';                           
				        $mail->Port = 465;                                   

				        $mail->setFrom('acevalencia13@gmail.com');
				        
				        //Recipients
				        $mail->addAddress('acevalencia13@gmail.com');              
				        $mail->addReplyTo($email);
				       
				        //Content
				        $mail->isHTML(true);                            
				        $mail->Subject = $subject;
				        $mail->Body    = $message;

				        $mail->send();

				        header('location: contact.php#Message Sent');

				    }
				    catch (Exception $e) {
				        header('location: contact.php#cant send message');
				    }
				}
?>
