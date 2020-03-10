<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

require APPPATH . '/libraries/MY_Model.php';

class Dashboard_send_mail extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index($email='') { 
       
          
        //$this->load->view('welcome_message');
         if ($this->session->userdata('session_data'))
            $data = $this->session->userdata('session_data');
        if(!empty($this->input->post('email'))) {
        $data['emails'] = $this->input->post('email');
        }
       // echo'<pre>'; print_r($data) ; exit;
        $this->load->view('admin/Dashboard_send_mail',$data);
    }

    function send_email() {
		
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('errmsg', strip_tags(validation_errors()));
					redirect('admin/Dashboard_send_mail/index');
					exit();
            }

        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $data['base_url'] = base_url();
        $data['site_url'] = base_url();
        $data['site_name'] = project_name;
        if (isset($data['message'])) {
            $data['message'] = $data['message'];
        }
		
		$message1="<!DOCTYPE html>
<html>
<head>
<title>Email Template deddabox</title>
<!--

    An email present from your friends at Litmus (@litmusapp)

    Email is surprisingly hard. While this has been thoroughly tested, your mileage may vary.
    It's highly recommended that you test using a service like Litmus (http://litmus.com) and your own devices.

    Enjoy!

 -->
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='X-UA-Compatible' content='IE=edge' />
<style type='text/css'>
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
	/* Prevent WebKit and Windows mobile changing default text sizes */
    table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
    img{-ms-interpolation-mode: bicubic;} 
	/* Allow smoother rendering of resized image in Internet Explorer */

    /* RESET STYLES */
    img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
    table{border-collapse: collapse !important;}
    body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* MOBILE STYLES */
    @media screen and (max-width: 525px) {

        /* ALLOWS FOR FLUID TABLES */
        .wrapper {
          width: 100% !important;
        	max-width: 100% !important;
        }

        /* ADJUSTS LAYOUT OF LOGO IMAGE */
        .logo img {
          margin: 0 auto !important;
        }

        /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
        .mobile-hide {
          display: none !important;
        }

        .img-max {
          max-width: 100% !important;
          width: 100% !important;
          height: auto !important;
        }

        /* FULL-WIDTH TABLES */
        .responsive-table {
          width: 100% !important;
        }

        /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
        .padding {
          padding: 10px 5% 15px 5% !important;
        }

        .padding-meta {
          padding: 30px 5% 0px 5% !important;
          text-align: center;
        }

        .no-padding {
          padding: 0 !important;
        }

        .section-padding {
          padding: 50px 15px 50px 15px !important;
        }

        /* ADJUST BUTTONS ON MOBILE */
        .mobile-button-container {
            margin: 0 auto;
            width: 100% !important;
        }

        .mobile-button {
            padding: 15px !important;
            border: 0 !important;
            font-size: 16px !important;
            display: block !important;
        }

    }

    /* ANDROID CENTER FIX */
    div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>
</head>
<body style='margin: 0 !important; padding: 0 !important;'>

<!-- HIDDEN PREHEADER TEXT -->
<div style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
    Entice the open with some amazing preheader text. Use a little mystery and get those subscribers to read through...
</div>

<!-- HEADER -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td bgcolor='#ffffff' align='center' style='padding: 15px 15px 5px 15px;' class='section-padding'>
            <!--[if (gte mso 9)|(IE)]>
            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
            <tr>
            <td align='center' valign='top' width='500'>
            <![endif]-->
            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
                <tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                              	<td class='padding' align='center'>
                                    <a href='http://litmus.com' target='_blank'>
                                        <img src='http://54.251.120.210/DedaaBox_dev/assets/images/email_overlay2.jpg'  border='0' alt='Insert alt text here' style='border-bottom: 2px solid #ff3752;display: block; color: #666666;  font-family: Helvetica, arial, sans-serif; font-size: 16px;' class='img-max'>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table style='background-color:#f3f3f3;' width='100%' border='0' cellspacing='0' cellpadding='0'>
                                        <tr>
                                            <td colspan='2' align='left' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 20px;font-weight: 500;padding-left:10px;padding-right:10px;' class='padding'>Hello ,</td>
                                        </tr>
                                        <tr>
                                            <td colspan='2' align='left' style='padding: 5px 10px 0 10px; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;text-align:left;' class='padding'>$message</td>
                                        </tr>
										<tr>
                                            <td colspan='2' align='left' style='border-bottom:1px solid grey;padding: 20px 10px 20px 10px; font-size: 12px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;font-weight: 600;' class='padding'>Best Regards,<br/>
											Team Dedaabox</td>
                                        </tr>
										<!--<tr>
                                            <td colspan='2' align='center' style='padding: 20px 0 10px 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>DOWNLOAD FROM</td>
                                        </tr>
										<tr>
                                            <td align='center' style='border-bottom:1px solid grey;padding: 20px 0 20px 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>
											<img src='http://54.251.120.210/DedaaBox_dev/assets/images/a.png' />
											</td>
											<td align='center' style='border-bottom:1px solid grey;padding: 20px 0 20px 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>
											<img src='http://54.251.120.210/DedaaBox_dev/assets/images/p.png' />
											</td>
                                        </tr>-->
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <tr>
        <td bgcolor='#ffffff' align='center' style='padding: 20px 0px;'>
            <!--[if (gte mso 9)|(IE)]>
            <table align='center' border='0' cellspacing='0' cellpadding='0' width='500'>
            <tr>
            <td align='center' valign='top' width='500'>
            <![endif]-->
            <!-- UNSUBSCRIBE COPY -->
			            <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 500px;' class='responsive-table'>
                <tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                        <tr>
                                            <td colspan='2' align='center' style='padding-bottom: 30px;font-size: 14px;line-height: 18px;font-family: Helvetica, Arial, sans-serif;color: #666666;' >FOLLOW US</span></td>
                                        </tr>
                                        <tr>
                            <td align='center' style='border-right: 1px solid #b9b9b9; padding-right: 10px; font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                <a href='https://in.linkedin.com/company/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/l.png' style='height:30px;' align='center'></a>
								<div>LinkedIn</div>
                            </td>
                            <!--<td align='center' style='border-right: 1px solid #b9b9b9;font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/g.png' style='height:30px;' align='center'></a>
                            </td>
                            <td align='center' style='border-right: 1px solid #b9b9b9;font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/t.png' style='height:30px;' align='center'></a>
                            </td>-->
                            <td align='center' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                                <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/f.png' style='height:30px;' align='center'></a>
								<div>FaceBook</div>
                            </td>
                        </tr>
						<tr>
                            <td colspan='2' style='border-bottom: 1px solid grey;padding-top: 30px;'></td>
                        </tr>
						<tr>
                            <td colspan='2' align='center' style='padding-left:10px;padding-right:10px;padding-top:10px;font-size: 11px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#9c9c9c;'>
                                MAPCO Building, No.100, Junction of Strand Road &amp; Mawtin,<br>Inside Port Compound, Lanmadaw (Seikkan) Township, Yangon, Myanmar.
                            </td>
                        </tr>
						<tr><td  colspan='2'><table><tr>
                            <td align='center' style='font-family: Helvetica, Arial, sans-serif; color: #666666;padding-top: 5px;font-size: 12px;'>
                                <span style='padding-right:2px;'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/email15.png' style='margin:0 5px 0 0 ;'><a href='mailto:hsuhninhtike.ztkfinancial@gmail.com?Subject=Hello%20again' target='_top'> hsuhninhtike.ztkfinancial@gmail.com</a></span>
                                </td>
								<td align='center' style='font-family: Helvetica, Arial, sans-serif; color: #666666;padding-top: 5px;font-size: 12px;'>
                                <span style='padding-right:2px;'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/phone15.png' style='margin:0 5px 0 0 ;'> +95 9970500857</span>
                                </td>
								<td align='center' style='font-family: Helvetica, Arial, sans-serif; color: #666666;padding-top: 5px;font-size: 12px;'>
                                <span style='padding-right:2px;'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/web15.png' style=''><a href='#' style='margin-left:10px;'>http://dedaa.com.mm</a></span></td>
								</tr></table></td>
                        </tr>
										<!--<tr>
                                            <td colspan='2' align='center' style='padding: 20px 0 10px 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>DOWNLOAD FROM</td>
                                        </tr>
										<tr>
                                            <td align='center' style='border-bottom:1px solid grey;padding: 20px 0 20px 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>
											<img src='http://54.251.120.210/DedaaBox_dev/assets/images/a.png' />
											</td>
											<td align='center' style='border-bottom:1px solid grey;padding: 20px 0 20px 0; font-size: 14px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding'>
											<img src='http://54.251.120.210/DedaaBox_dev/assets/images/p.png' />
											</td>
                                        </tr>-->
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='max-width: 500px;' class='responsive-table'>
		     <tr>
                    <td colspan='4' align='center' style='padding-bottom:30px;font-size: 14px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>FOLLOW US
                    </td>
                </tr>
			<tr>
                    <td align='center' style='border-right: 1px solid #b9b9b9;font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                    <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/f.png' style='height:30px;' align='center'/></a>
                    </td>
					 <td align='center' style='border-right: 1px solid #b9b9b9;font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                    <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/g.png' style='height:30px;' align='center'/></a>
                    </td>
					 <td align='center' style='border-right: 1px solid #b9b9b9;font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                    <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/t.png' style='height:30px;' align='center'/></a>
                    </td>
					 <td align='center' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'>
                    <a href='https://facebook.com/dedaabox/'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/l.png' style='height:30px;' align='center'/></a>
                    </td>
                </tr>
				<tr>
				<td colspan='4' style='border-bottom: 1px solid grey;padding-top: 30px;'></td>
				</tr>
                <tr>
                    <td colspan='4' align='center' style='padding-left:10px;padding-right:10px;padding-top:10px;font-size: 11px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#9c9c9c;'>
                        #23-28, Silver Software Tech Park, Rd Number 7,<br/>KIADB Export Promotion Industrial Area, Whitefield,Bengaluru, Karnataka 560066
                    </td>
                </tr>
				<tr>
				<td align='center' colspan='4' style='font-family: Helvetica, Arial, sans-serif; color: #666666;padding-top: 5px;font-size: 12px;'><span style='padding-right:10px;'><img src='e.png' style='height:1%;'>Tel - 99999999</span><a href='#' style='margin-left:10px;'><img src='http://54.251.120.210/DedaaBox_dev/assets/images/w.png' style='height:1%;'> http://dedaa.com.mm/</a></td>
				</tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>-->
            <![endif]-->
        </td>
    </tr>
</table>
</body>
</html>


";
        $from_address = isset($data['from_email']) ? $data['from_email'] : 'dedaaboxzen@gmail.com';
        $from_name = isset($data['from_name']) ? $data['from_name'] : $data['site_name'];
        $reply_to_address = $from_address;
        $reply_to_name = $from_name;
        //$to = $email;

        $this->load->library('Email');
        $this->email->set_mailtype("html");
        $this->email->from($from_address, $from_name);
        $this->email->reply_to($reply_to_address, $reply_to_name);
        //$this->email->bcc('sujeetkumar@biipbyte.com');
        //$this->email->bcc('meghapatil@biipbyte.com');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message1);
        $this->email->send();
        $this->session->set_flashdata('msg', 'Mail Sent Successfully');
        redirect('admin/Dashboard_send_mail/index');
    }

}
