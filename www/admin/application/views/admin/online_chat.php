

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--        <style>
      .chathead{
          background-color:#3f51b5;
      }
      .chathead p{
          color:#fff;
          margin-top:10px;
          font-size: 20px;
      }
      .onlinepara{
          font-size: 17px !important;
      }
      .chathead i{
          color: #FFCF35;
      }
      .chatbody{
          height:82%;
          background-color:#eee;
          overflow:scroll;
      }
      .chatfooter{
          background-color:#303e9f;
      }
      .chatfooter input{
          margin-top:20px;
          margin-bottom:20px;
          height:30px;
      }
      .chatfooter p{
          margin-top:20px;
          margin-bottom:20px;
      }
      .chatfooter button{
          background-color: white;
          border: none;
          padding: 5px 20px;
      }
      .chatbody img{
          margin-top:15px;
      }
      .chat{
          padding: 15px;
          background-color: green;
          margin: 20px 20px 20px 20px;
          color: #fff;
      }
      .chatrow{
          margin:15px !important;
          border-bottom:1px solid #303e9f;   
      }
      .contacthead{
          background-color:#162996;
      }
      .contacthead p{
          color:#fff;
          margin-top:10px;
          font-size: 20px;
      }
      .contactbody{
          height:92%;
          background-color:#eee;
          overflow:scroll;
      }
      .contactsection{
          padding:20px;
          font-size: 17px;
      }
      .contactrow{
          margin:15px !important;
          border-bottom:1px solid #303e9f; 
      }
      .contactrow img{
          margin-bottom: 15px;
      }
      .chatrow img{
          margin-bottom: 15px;
      }
      .contactrow p{
          text-overflow: ellipsis !important;
          white-space: nowrap;
          overflow: hidden;
      } 
  </style>-->
        <style>
            @media (min-width: 767px){ body{
                                           overflow:hidden;
                                       }
                                       .chathead{
                                           position:absolute;
                                           z-index:999;
                                           background-color:#0aa959;
                                       }
                                       .chathead p{
                                           color:#fff;
                                           margin-top:10px;
                                           font-size: 20px;
                                       }
                                       .onlinepara{
                                           font-size: 17px !important;
                                       }
                                       .chathead i{
                                           color: #FFCF35;
                                       }
                                       .chatbody{
                                           height:84%;
                                           margin-top:4%;
                                           background-color:#fff;
                                           overflow-y:scroll;
                                           background: url('<?php echo base_url(); ?>assets/images/p.png') !important;
                                           background-size:100% 100%;
                                       }
                                       .chatfooter{
                                           background-color:#0aa959;
                                       }
                                       .chatfooter input{
                                           margin-top: 15px;
                                           margin-bottom: 15px;
                                           padding-left:15px;
                                           padding-right:15px;
                                           height: 30px;
                                           border-radius: 10px;
                                           border: none;
                                           box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.45);
                                       }
                                       .chatfooter p{
                                           margin-top:17px;
                                           margin-bottom:17px;
                                           font-size:12px;
                                       }
                                       .chatfooter button{
                                           background-color: #f58634;
                                           border: none;
                                           padding: 7px 17px;
                                           border-radius: 8px;
                                           color:#fff;
                                           letter-spacing:1px;
                                       }
                                       .chatfooter i{
                                           color:#fff;
                                       }
                                       .chatbody img{
                                           margin-top:15px;
                                       }
                                       .chatrow{
                                           margin:15px !important;
                                           border-bottom: 1px solid rgba(10, 169, 89, 0.21);
                                       }
                                       .chatrow p{

                                       }
                                       .contacthead{
                                           position:absolute;
                                           z-index:999;
                                           background-color:#0e874a;
                                       }
                                       .contacthead p{
                                           color:#fff;
                                           margin-top:10px;
                                           font-size: 20px;

                                       }
                                       .contactbody{
                                           height:92%;
                                           margin-top:14%;
                                           background-color:#fff;
                                           overflow-y:scroll;
                                       }
                                       .contactsection{
                                           padding: 10px;
                                           font-size: 17px;
                                           margin-top: 15px;
                                       }
                                       .contactrow:hover{
                                           background-color:#e5e5e5;
                                       }
                                       .contactrow{
                                           border-bottom:1px solid #eef3f6;
                                       }
                                       .contactrow img{
                                           margin-bottom: 5px;
                                           width:70%;
                                           margin-top:8px;
                                       }
                                       .chatrow img{
                                           margin-bottom: 15px;
                                       }
                                       .contactrow p{
                                           text-overflow: ellipsis !important;
                                           white-space: nowrap;
                                           overflow: hidden;
                                           color:#3f51b5;
                                       }
                                       .chatcontent{
                                           background-color: #bfbfbf;
                                           padding: 15px;
                                           float: right;
                                           color: #666;
                                           border-radius: 15px;
                                           margin-top:10px;
                                           margin-bottom:10px;
                                       }
                                       .timespan{
                                           margin-bottom: 15px;
                                       }
                                       /* Track */
                                       ::-webkit-scrollbar-track {
                                           -webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.3); 
                                           -webkit-border-radius: 10px;
                                           border-radius: 10px;
                                       }

                                       /* Handle */
                                       ::-webkit-scrollbar-thumb {
                                           -webkit-border-radius: 10px;
                                           border-radius: 10px;
                                           background: #666666; 
                                           -webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.5); 
                                       }
                                       ::-webkit-scrollbar-thumb:window-inactive {
                                           background: #666666; 
                                       }
                                       #delete{
                                           font-weight: 600;
                                           background-color: #f58634;
                                           padding: 5px 20px;
                                           text-transform: uppercase;
                                           font-size: 11px;
                                           border-radius: 5px;
                                           color:#fff;
                                       }
                                       .onlinepara{
                                           margin-top:15px;
                                       }
                                       .onlinepara i{
                                           color:#fff;
                                       }
                                       a:hover{
                                           text-underline:none !important;
                                       }
                                       .main{
                                           background-color:#9caaf7;
                                       }
                                       .footerdisabled{
                                           background-color:#e8eeee !important;
                                       }
                                       .contactbody .active{
                                           background-color:#e5e5e5;
                                       }

            }
        </style>
    </head>
    <script>
        $(document).ready(function () {
            $('.chatbody').scrollTop(99999);
        });
    </script>
    <!--    <script>
    var scrolled = false;
    function updateScroll(){
        if(!scrolled){
            var element = document.getElementById("#chatbody");
            element.scrollTop = element.scrollHeight;
        }
    }
    
    $("#chatbody").on('scroll', function(){
        scrolled=true;
    });
            </script>-->
    <body>
        <div class="">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 col-xs-12 contacthead">
                        <div class="col-md-12 col-xs-12"><p>Chats</p></div>
                    </div></div>
                <div class="row">
                    <div class="col-md-12 col-xs-12 contactbody">



                        <?php
                        if (!empty($val)):
                            //echo "<pre>";         
                            // print_r($val);exit();
                            foreach ($val as $vl) {
                                foreach ($register_user as $register_user_row) {
                                    $image_record = $this->Articles_model->get_image_list($register_user_row->id);
                                    // echo '<pre>';print_r( $image_record); exit; 
                                    $vl_id = str_replace('-', '', $vl['id']);
                                    //echo "<br>";
                                    if ($vl_id == $register_user_row->id) {
                                        // echo "hi";
                                        ?>
                                        <a target="_self" href="javascript:;" class="msgcontainer visible" id="android" value="<?php echo $register_user_row->id; ?>" rel="<?php echo $vl['article_id']; ?>">
                                            <div class="row contactrow">
                                                <div class="col-md-4 col-xs-4">
                                                    <?php
                                                    if (!empty($image_record->raw_name)):
                                                        $src = base_url('assets/uploads/profile_image') . "/" . $image_record->raw_name . $image_record->file_ext;
                                                    else:
                                                        $src = base_url('assets/uploads/profile_image/noimage.png');
                                                    endif
                                                    ?>
                                                    <img src="<?php echo$src; ?>" class="img-responsive img-circle"/>
                                                </div>
                                                <div class="col-md-8 col-xs-8">
                                                    <div class="contactsection"><p><?php echo ucfirst($register_user_row->username); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }
                                }
                            }
                        endif;
                        ?>     

                    </div></div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 col-xs-12 chathead">
                        <div class="col-md-8 col-xs-8"><p><?php echo ($sendername) ? ucfirst($sendername) : 'Welcome'; ?> </p></div>
                        <div class="col-md-4 col-xs-4"><div class="pull-right onlinepara"><a href="#" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></p></div>

                        </div></div>
                </div>

                <?php
                //echo "<pre>";
                //print_r($chat_message_data);
                //echo sizeof($chat_message_data['user']);exit();

                if (!empty($chat_message_data)):
                    ?>
                    <div class="row">
                        <div  class="col-md-12 col-xs-12 chatbody">


                            <?php
                            foreach ($chat_message_data as $chat_message_data_row) {
                                $i = 1;
                                foreach ($chat_message_data_row as $keyd => $row) {
                                    // echo "<pre>"; print_r($row);exit();
                                    // if ("-" . $row->user == $sender_id){
                                    $countss +=count($keyd);
                                    $lastuser = $row->user;

                                    //}

                                    $i++;
                                }
                            }
                            if ("-" . $lastuser == $sender_id) {
                                $counts = $countss;
                            } else {
                                $counts = '';
                            }
                            //echo "<pre>"; print_r($sender_id);exit();
                            foreach ($chat_message_data as $chat_message_data_row) {
                                // echo "<pre>"; print_r($chat_message_data_row);exit();
                                $i = 1;
                                foreach ($chat_message_data_row as $keyd => $row) {
                                    if ($i != $counts) {
                                        //echo "<pre>"; print_r($row);exit();
                                        //echo "<pre>";
                                        // print_r($chat_message_data_row);exit();
                                        //echo count($keyd);exiit();
                                        if ("-" . $row->user == $sender_id) :
                                            @$username = $sendername;
                                            @$image_path = $sender_image;
                                            ?>
                                            <div class="row chatrow">
                                                <div class="col-md-1 col-xs-1">
                                                    <img src="<?php echo $image_path; ?>" class="img-responsive img-circle"/>
                                                </div>
                                                <div class="col-md-11 col-xs-11" id="<?php echo $row->user; ?>">
                    <!--                                                <p><span class="pull-left"><?php echo ucfirst($username); ?></span></p>-->

                                                    <span class="row"><div class="clearfix"></div><span class="chatcontent pull-left checks" value="<?php echo $keyd; ?>" rel="<?php echo $key2; ?>"><?php echo ucfirst($row->message); ?></span></span>
                                                    <?php
                                                    $epoch = $row->time / 1000;
                                                    $dates = date('d/m/Y h:i', $epoch);
                                                    $datetime = explode(" ", $dates);
                                                    //echo date('y/m/d H:iA', $epoch);
                                                    ?>
                                                    <p><span class="pull-left"><?php echo $datetime[1]; ?></span><span class="pull-right timespan"><?php echo $datetime[0]; ?></span></p>
                                                </div>
                                            </div>
                                            <?php
                                        endif;
                                        //place here

                                        if ($row->user == substr($reciever_id, 1)) :
                                            //echo "hi";exit();
                                            @$username = $recievername;
                                            @$image_path = $reciever_image;
                                            ?>
                                            <div class="row chatrow">


                                                <div class="col-md-11 col-xs-11" id="<?php echo $row->user; ?>">
                    <!--                                                        <p><span class="pull-right"><?php echo ucfirst($username); ?></span></p>-->
                                                    <span class="row"><div class="clearfix"></div><span class="chatcontent checks" value="<?php echo $keyd; ?>" rel="<?php echo $key1; ?>">     <?php echo ucfirst($row->message); ?></span></span>
                                                    <?php
                                                    $epoch = $row->time / 1000;
                                                    $dates = date('d/m/Y h:i', $epoch);
                                                    $datetime = explode(" ", $dates);
                                                    //echo date('y/m/d H:iA', $epoch);
                                                    ?>
                                                    <p><span class="pull-left"><?php echo $datetime[0]; ?></span><span class="pull-right timespan"><?php echo $datetime[1]; ?></span></p>

                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                    <img src="<?php echo $image_path; ?>" class="img-responsive img-circle"/>
                                                </div>
                                            </div>
                <?php endif;
                ?>





                <?php
            } $i++;
        }
    }
    ?>  
                            <div id='messagesDiv' class="message" style="display:none;"></div>
                            <input type="hidden" id="keyid" name="keyid" value="<?php echo $key3; ?>">
                            <input type="hidden" id="messagekey" name="messagekey" value="">

                        </div>
                    </div>

                    <form id="message-form" action="javascript:;">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 chatfooter">

                                <div class="col-md-10 col-xs-10 text-center"><input type="text" class="col-md-12 col-xs-12" id="message" placeholder="enter here"/></div>
                                <input class="mdl-textfield__input" type="hidden" id="key" value="<?php echo $key; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="key1" value="<?php echo $key1; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="key2" value="<?php echo $key2; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="currentuser" value="<?php echo $reciever_id; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="senderid" value="<?php echo $sender_id; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="recieverid" value="<?php echo $reciever_id; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="sendername" value="<?php echo $sendername; ?>">
                                <input class="mdl-textfield__input" type="hidden" id="recievername" value="<?php echo $recievername; ?>">

                                <div class="col-md-2 col-xs-2 mdl-button__ripple-container sends text-center"><p>
                                        <button  style="display:none;" id="send_button"><i class="fa fa-send"></i> SEND</button></p></div>
                            </div>
                        </div>
                    </form>
<?php elseif (!empty($chat_user_data)): ?>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 chatbody">
                            <div class="row chatrow">
                                <div class="col-md-10 col-xs-10">
                                    <div class="chat">No chatbox selected
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12 col-xs-12 chatfooter footerdisabled">
                                <div class="col-md-10 col-xs-10"><input type="text" class="col-md-12 col-xs-12" placeholder="Disabled" disabled /></div>
                                <div class="col-md-2 col-xs-2"><p class="text-center"><button class="btn disabled"><i class="fa fa-send"></i> SEND</button></p></div>
                            </div>
                        </div>
<?php else: ?>  
                        <div class="row">
                            <div class="col-md-12 col-xs-12 chatbody">

                                <div id='messagesDiv' class="message" style="display:none;">
                                    <div class="row chatrow">

                                        <div class="col-md-10 col-xs-10">
                                            <div class="chat">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="keyid" name="keyid" value="<?php echo $key3; ?>">
                            <input type="hidden" id="messagekey" name="messagekey" value="">
                            <form id="message-form" action="javascript:;">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 chatfooter">

                                        <div class="col-md-10 col-xs-10 text-center"><input type="text" class="col-md-12 col-xs-12" id="message" placeholder="enter here"/></div>
                                        <input class="mdl-textfield__input" type="hidden" id="key" value="<?php echo $key; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="key1" value="<?php echo $key1; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="key2" value="<?php echo $key2; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="currentuser" value="<?php echo $reciever_id; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="senderid" value="<?php echo $sender_id; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="recieverid" value="<?php echo $reciever_id; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="recieverid1" value="<?php echo $reciever_id1; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="sendername" value="<?php echo $sendername; ?>">
                                        <input class="mdl-textfield__input" type="hidden" id="recievername" value="<?php echo $recievername; ?>">

                                        <div class="col-md-2 col-xs-2 mdl-button__ripple-container sends text-center"><p>
                                                <button  style="display:none;" id="send_button"><i class="fa fa-send"></i> SEND</button></p></div>
                                    </div>
                                </div>
                            </form>
                        </div>
<?php endif; ?>
                    <input type="hidden" id="articlesid" name="articleid" value="<?php echo $articlesid; ?>">


                </div>
                </body>
                </html>
                <script src="https://onetoonechat-1ab20.firebaseapp.com/scripts/jquery-1.12.4.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/js/moment.js"></script>


<!--<script src="./Users List_files/firebase.js.download"></script>


<script src="<?php echo base_url() ?>assets/firebase/scripts/main.js"></script>
<script src="./Users List_files/main_user.js.download"></script>-->
<!--<script src="https://zawsmiles.firebaseio.com/__/firebase/3.8.0/firebase.js"></script>
<script src="https://zawsmiles.firebaseio.com/__/firebase/init.js"></script>-->
                <script src="https://www.gstatic.com/firebasejs/4.1.2/firebase.js"></script>

                <script>
        $(document).ready(function () {
            $("#delete").hide();
            $('.chatbody').scrollTop(99999);
            $('input').keyup(function () {
                if ($.trim(this.value).length > 0)
                    $("#send_button").show();


                else
                    $("#send_button").hide();


            });
            $(document).on("click", "#delete", function () {

                var value = $('#messagekey').val();
                var id = $('#keyid').val();
                var results = value.split(',');
                var database = firebase.database();
                var lnth = value.length;
                // alert(value);
                //          console.log(this.messagesRef);
                this.messagesRef = database.ref("messages/" + id);
                for (var i = 0; i < results.length; i++) {
                    this.messagesRef.child(results[i]).remove();
                }

                window.location.reload();


            });
            $(document).on("click", ".checks", function () {
                // $(".checks").click(function () { 
                $(this).toggleClass('checked');
                var id = $(this).attr('rel');
                //               if ($(".checked").length){ 
                //                   var values  = $(this).attr('value');
                //                   $("#messagekey").val(values);
                //                    alert($(".checked").length);
                //                    
                //               }
                var values = $('.checked.checks').map(function () {  //alert($(this).attr('value'));
                    return $(this).attr('value');
                }).get();
                $("#messagekey").val(values);

                //                // alert(values);
            });

            $(".msgcontainer").click(function () {
                var id = $(this).attr('value');
                var article = $(this).attr('rel');
                window.location.href = 'http://54.251.120.210/zawSMiLES/index.php/admin/Online_chat/chat/' + '-' + id + '/' + article;
                // window.open('http://54.251.120.210/zawSMiLES/index.php/admin/Online_chat/chat/' + '-' + id + '/' + article);
            });


            //Firbase code starts here
            var config = {
                apiKey: "AIzaSyA3WAleq1s4-cHbw2uTxLQ7_kcJmzhrgVI",
                authDomain: "zawsmiles.firebaseapp.com",
                databaseURL: "https://zawsmiles.firebaseio.com",
                projectId: "zawsmiles",
                storageBucket: "zawsmiles.appspot.com",
                messagingSenderId: "832066911353"
            };
            firebase.initializeApp(config);
            // const dbRefObjects = firebase.database().ref("messages");
            //                    // dbRefObject.on('value', snap => console.log(snap.val()));
            //                    dbRefObjects.onChildAdded('value', function (snapshot) {
            //                         var message1s = snapshot.val();
            //                        var message1_sorts = Object.values(message1s);
            //                        console.log(message1s);
            //                    });
            //                    


            var keyss1 = $('#key1').val();
            var keyss2 = $('#key2').val();
            //alert(keyss1);

            var image_path = "<?php echo $reciever_image; ?>";
            var sender_image_path = "<?php echo $sender_image; ?>"
            var i = 1;
            //const preObject = document.getElementById('object');
            //var message1 = snapshot.val();
            const dbRefObject = firebase.database().ref("messages").child(keyss1);
                    //const dbRefList = dbRefObject.child(keyss1);
                    // dbRefObject.on('value', snap => console.log(snap.val()));
                    dbRefObject.on('value', function (snapshot) {

                        var message1 = snapshot.val();

                        var message1_sort = Object.values(message1);
                        var messagekey = Object.keys(message1);
                        //console.log(message1);
                        var count = Object.keys(message1).length;
                        var nums = count - 1;
                        var senderid = $('#senderid').val();
                        var senderid1 = "-" + $('#senderid').val();
                        //alert(senderid);myString.substr(1)
                        var reciever_id = $('#recieverid').val();
                        //alert(message1_sort[nums].user);
                        var user_id = "-" + "<?php echo $this->ion_auth->user()->row()->id; ?>";
                        var url_refresh = "<?php echo site_url() ?>admin/online_chat/chat/" + senderid + "/" + reciever_id;
                        var i = 0;
                        //alert(reciever_id);
                        if ("-" + message1_sort[nums].user == senderid)
                        {
                            console.log("sender");
                            var timestamp = message1_sort[nums].time;
                            //var date = new Date(timestamp*1000);
                            //var dateString = new moment(timestamp,'yyyyMMddHHmmssfff').toDate()
                            var dateString = moment.unix(timestamp / 1000).format("D/M/Y");
                            //var timeString = moment.unix(timestamp / 1000).format("hh:MM");
                            var date = new Date(timestamp);
                            var hours = date.getHours(); // minutes part from the timestamp
                            var minutes = date.getMinutes(); // seconds part from the timestamp
                            var seconds = date.getSeconds(); // will display time in 10:30:23 format
                            var timeString = hours + ':' + minutes;
                            /// var time = "<?php //echo date('H:iA',"+ + message1_sort[nums].time/1000 + ");            ?>";
                            //console.log("time");
                            // var name = sendername;
                            $('#messagesDiv').show();
                            $('#messagesDiv').append('<div class="row chatrow"><div class="col-md-1 col-xs-1"><img src="' + sender_image_path + '" class="img-responsive img-circle"/></div><div class="col-md-11 col-xs-11" id="' + senderid + '"><span class="row"><div class="clearfix"></div><span class="chatcontent pull-left checks" value="' + messagekey[nums] + '" rel="' + keyss1 + ' ">' + message1_sort[nums].message + '</span></span><p><span class="pull-left">' + timeString + '</span><span class="pull-right timespan">' + dateString + '</span></p></div></div>');

                            // $('#messagesDiv').append('<div class="row chatrow"><div class="col-md-11 col-xs-11" id="' + senderid + '"><span class="row"> <div class="clearfix"></div><span class="chatcontent checks"><input type="checkbox" class="checks">' + message1_sort[nums].message + '</span></span><p><span class="pull-left">24th June 2017</span><span class="pull-right timespan">12.10AM</span></p></div><div class="col-md-1 col-xs-1"> <img src="' + sender_image_path + '" style="width:auto;height:70px;" class="img-responsive"/></div></div> ');
                            $('.chatbody').scrollTop(99999);
                        }
                        console.log(message1_sort[nums].user);
//                        if (message1_sort[nums].user == reciever_id)
//                        {
//                            console.log(i);
//                            //var time = "<?php //echo date('H:iA',"+ + message1_sort[nums].time/1000 + ");            ?>";
                        console.log(time);
                        var name = recievername;
                        $('#messagesDiv').append('<div class="row chatrow"><div class="col-md-11 col-xs-11" id="' + reciever_id + '"><span class="row"> <div class="clearfix"></div><span class="chatcontent checks" value="' + messagekey[nums] + '" rel="' + keyss1 + ' ">' + message1_sort[nums].message + '</span></span><p><span class="pull-left">24th June 2017</span><span class="pull-right timespan">12.10AM</span></p></div><div class="col-md-1 col-xs-1"> <img src="' + image_path + '" style="width:auto;height:70px;" class="img-responsive"/></div></div> ');
//                            $('.chatbody').scrollTop(99999);
//                            // var  reciever_id = reciever_id+'r';
//                            i++;
//                        }

                        // $('.chatbody').load(url_refresh)

                    }
                    );


            $(document).on("click", ".chatcontent", function () {

                $(this).toggleClass("main");
                $('.chatcontent').css("color", "#000");
                $(this).children('input').addClass('checked');
                if ($(".chatcontent").hasClass("main")) {
                    //  alert('ranjan');
                    $("#delete").show();
                }
                else {
                    $("#delete").hide();
                }

            });



            $(".sends").click(function () {
                // alert('Haoo');
                var msg = $('#message').val()

                if (msg.length > 1){
                var image_path = "<?php echo $reciever_image; ?>";
                        var reciever_id = "<?php echo $reciever_id; ?>";
                        var reciever_id1 = "<?php echo $reciever_id1; ?>";
                        var recievername = "<?php echo $recievername; ?>";
                        const Firebase = firebase;
                        var timestamp = Firebase.database.ServerValue.TIMESTAMP;
                var text = $('#message').val();
                var keyss = $('#key').val();
                var keyss1 = $('#key1').val();

                var currentuser = $('#currentuser').val();
                var senderid = $('#senderid').val();
                var recieverid = $('#recieverid').val();
                var sendername = $('#sendername').val();
                var recievername = $('#recievername').val();
                var articlesid = $('#articlesid').val();
                var database = firebase.database();
                this.messagesRef = database.ref("messages");
                //place here top
                var myKeyVals = {id: senderid, message: text, receiver_usename: recievername, receiver_profileimg: image_path, receiver_userid: reciever_id1, receiver_artical_id: articlesid}
                $.ajax({
                    type: "POST",
                    url: "http://54.251.120.210/zawSMiLES/index.php/admin/Online_chat/push_notification",
                    data: myKeyVals,
                    success: function (msg) {

                    }});
                var text = $('#message').val();
                var currentuser = <?php echo $this->ion_auth->user()->row()->id; ?>

                this.messagesRef.child(keyss).push({
                    message: text, user: currentuser, time: timestamp
                })
                this.messagesRef.child(keyss1).push({
                    message: text, user: currentuser, time: timestamp
                })

                $('#message').val(' ');

                //place here 
                var keyss1 = $('#key1').val();
                var keyss2 = $('#key2').val();
                //alert(keyss1);

                var image_path = "<?php echo $reciever_image; ?>";
                var sender_image_path = "<?php echo $sender_image; ?>"
                var i = 1;
                //const preObject = document.getElementById('object');
                //var message1 = snapshot.val();
                const dbRefObject = firebase.database().ref("messages").child(keyss1);
                        //const dbRefList = dbRefObject.child(keyss1);
                        // dbRefObject.on('value', snap => console.log(snap.val()));
                        dbRefObject.once('value', function (snapshot) {

                            var message1 = snapshot.val();

                            var message1_sort = Object.values(message1);
                            var messagekey = Object.keys(message1);

                            // console.log(Object.keys(message1));
                            var count = Object.keys(message1).length;

                            var nums = count - 1;
                            // console.log(messagekey[nums]);
                            var senderid = $('#senderid').val();
                            var senderid1 = "-" + $('#senderid').val();
                            //alert(senderid);myString.substr(1)
                            var reciever_id = $('#recieverid').val();
                            //alert(message1_sort[nums].user);
                            var user_id = "-" + "<?php echo $this->ion_auth->user()->row()->id; ?>";

                            var i = 0;
                            //alert(reciever_id);
                            if ("-" + message1_sort[nums].user == senderid)
                            {
                                console.log("sender");
                                /// var time = "<?php //echo date('H:iA',"+ + message1_sort[nums].time/1000 + ");            ?>";
                                //console.log("time");
                                // var name = sendername;
                                //$('#messagesDiv').append('<div class="row chatrow"><div class="col-md-1 col-xs-1"><img src="' + sender_image_path + '" class="img-responsive img-circle"/></div><div class="col-md-11 col-xs-11" id="' + senderid + '"><span class="row"><div class="clearfix"></div><span class="chatcontent pull-left checks" value="" rel="">' + message1_sort[nums].message + '</span></span><p><span class="pull-left">10 AM</span><span class="pull-right timespan">12/10/2017</span></p></div></div>');

                                // $('#messagesDiv').append('<div class="row chatrow"><div class="col-md-11 col-xs-11" id="' + senderid + '"><span class="row"> <div class="clearfix"></div><span class="chatcontent checks"><input type="checkbox" class="checks">' + message1_sort[nums].message + '</span></span><p><span class="pull-left">24th June 2017</span><span class="pull-right timespan">12.10AM</span></p></div><div class="col-md-1 col-xs-1"> <img src="' + sender_image_path + '" style="width:auto;height:70px;" class="img-responsive"/></div></div> ');
                                $('.chatbody').scrollTop(99999);
                            }
                            console.log(message1_sort[nums].user);
                            if ('-' + message1_sort[nums].user == reciever_id)
                            {
                                console.log(i);
                                //var time = "<?php //echo date('H:iA',"+ + message1_sort[nums].time/1000 + ");            ?>";
                                //console.log(time);
                                // var name = recievername;
                                var timestamp = message1_sort[nums].time;
                                //var date = new Date(timestamp*1000);
                                //var dateString = new moment(timestamp,'yyyyMMddHHmmssfff').toDate()
                                var dateString = moment.unix(timestamp / 1000).format("D/M/Y");
                                // var timeString = moment.unix(timestamp/1000).format("hh:MM");
                                // var tts =new Date(timestamp/1000).toString("hh:mm tt");
                                //alert(dateString); alert(tts);
                                var date = new Date(timestamp);
                                var hours = date.getHours(); // minutes part from the timestamp
                                var minutes = date.getMinutes(); // seconds part from the timestamp
                                var seconds = date.getSeconds(); // will display time in 10:30:23 format
                                var timeString = hours + ':' + minutes;
//alert(formattedTime);
                                $('#messagesDiv').show();
                                $('#messagesDiv').append('<div class="row chatrow"><div class="col-md-11 col-xs-11" id="' + reciever_id + '" ><span class="row"> <div class="clearfix"></div><span class="chatcontent checks" value="' + messagekey[nums] + '" rel="' + keyss1 + '">' + message1_sort[nums].message + '</span></span><p><span class="pull-left">' + dateString + '</span><span class="pull-right timespan">' + timeString + '</span></p></div><div class="col-md-1 col-xs-1"> <img src="' + image_path + '" style="" class="img-responsive img-circle"/></div></div> ');
                                $('.chatbody').scrollTop(99999);
                                // var  reciever_id = reciever_id+'r';
                                i++;
                            }



                        }
                        );
            }

            });
                    $(".chat").hover(
                    function () {
                        $(".checks").show();
                    });



        });
                </script>

                <!--
                <script>
                    // Initialize Firebase
                    var config = {
                        apiKey: "AIzaSyA3WAleq1s4-cHbw2uTxLQ7_kcJmzhrgVI",
                        authDomain: "zawsmiles.firebaseapp.com",
                        databaseURL: "https://zawsmiles.firebaseio.com",
                        projectId: "zawsmiles",
                        storageBucket: "zawsmiles.appspot.com",
                        messagingSenderId: "832066911353"
                    };
                    firebase.initializeApp(config);
                
                
                
                    var keyss1 = $('#key1').val();
                
                
                    //const preObject = document.getElementById('object');
                    const dbRefObject = firebase.database().ref("messages").child(keyss1);
                            // dbRefObject.on('value', snap => console.log(snap.val()));
                            dbRefObject.on('value', function (snapshot) {
                
                                var message1 = snapshot.val();
                                var message1_sort = Object.values(message1);
                                //console.log(message1);
                                var count = Object.keys(message1).length;
                                var nums = count - 1;
                
                                var senderid = $('#senderid').val();
                                //alert(senderid);
                                var reciever_id = $('#recieverid').val();
                
                                var myKeyVals = {id: senderid, message: message1_sort[nums].message}
                                $.ajax({
                                    type: "POST",
                                    url: "http://54.251.120.210/zawSMiLES_dev/index.php/admin/Online_chat/push_notification",
                                    data: myKeyVals,
                                    success: function (msg) {
                
                                    }});
                
                
                
                //                for (var i = 1; i < count; i++) {
                
                                $('#messagesDiv').append('<div class="row chatrow"><div class="col-md-11 col-xs-11" id="' + reciever_id + '"><span class="row"> <div class="clearfix"></div><span class="chatcontent">' + message1_sort[nums].message + '</span></span><p class="pull-right">24th june 2017</p><p><span class="pull-left">24th June 2017</span><span class="pull-right timespan">12.10AM</span></p></div><div class="col-md-1 col-xs-1"> <img src="" style="width:auto;height:70px;" class="img-responsive"/></div></div> ');
                
                                //        <div class="message"></div><div class="name"></div></div>
                                // $('<div/>').text(message1_sort[i].message).prepend($('<em class="mesgname"/>').text(name + ': ')).appendTo($('#messagesDiv'));
                                //$("#messagesDiv").append(html);
                                // $('#messagesDiv')[0].scrollTop = $('#messagesDiv')[0].scrollHeight;
                
                //            }
                
                
                            }
                            );
                
                </script>
                
                <script>
                    $(".msgcontainer").click(function () {
                        var id = $(this).attr('value');
                        var article = $(this).attr('rel');
                        window.open('http://54.251.120.210/zawSMiLES_dev/index.php/admin/Online_chat/chat/' + '-' + id + '/' + article);
                    });</script>
                
                <script>
                    $(".sends").click(function () {
                        // alert('Haoo');
                
                        var image_path = "<?php echo $reciever_image; ?>";
                        var reciever_id = "<?php echo $reciever_id; ?>";
                        var recievername = "<?php echo $recievername; ?>";
                                const Firebase = firebase;
                                var timestamp = Firebase.database.ServerValue.TIMESTAMP;
                        var text = $('#message').val();
                        var keyss = $('#key').val();
                        var keyss1 = $('#key1').val();
                        var currentuser = $('#currentuser').val();
                        var senderid = $('#senderid').val();
                        var recieverid = $('#recieverid').val();
                        var sendername = $('#sendername').val();
                        var recievername = $('#recievername').val();
                        var database = firebase.database();
                        this.messagesRef = database.ref("messages");
                        //place here top
                        var myKeyVals = {id: senderid, message: text}
                        $.ajax({
                            type: "POST",
                            url: "http://54.251.120.210/zawSMiLES_dev/index.php/admin/Online_chat/push_notification",
                            data: myKeyVals,
                            success: function (msg) {
                
                            }});
                        var text = $('#message').val();
                        var currentuser = $('#currentuser').val();
                
                        this.messagesRef.child(keyss).push({
                            message: text, user: currentuser, time: timestamp
                        })
                        this.messagesRef.child(keyss1).push({
                            message: text, user: currentuser, time: timestamp
                        })
                
                        $('#message').val(' ');
                
                        //place here 
                    });
                
                </script>
                <script>
                    $(".chat").hover(
                            function () {
                                $(".checks").show();
                            });
                
                    $(".checks").click(function () {
                        $(this).toggleClass('checked');
                        var id = $(this).attr('rel');
                        var values = $('input:checkbox:checked.checks').map(function () {
                            return this.value;
                        }).get();
                        $("#messagekey").val(values);
                
                        // alert(values);
                    });
                    $("#delete").click(function () {
                
                        var value = $('#messagekey').val();
                        var id = $('#keyid').val();
                        var results = value.split(',');
                        var database = firebase.database();
                        var lnth = value.length;
                        // alert(value);
                //          console.log(this.messagesRef);
                        this.messagesRef = database.ref("messages/" + id);
                        for (var i = 0; i < results.length; i++) {
                            this.messagesRef.child(results[i]).remove();
                        }
                
                        window.location.reload();
                
                
                    });
                </script>-->
















                <!--<!DOCTYPE html>
                 saved from url=(0031)http://localhost:5000/user.html 
<?php //echo '<pre>'; print_r($val); exit;           ?>
                <html lang="en" class="mdl-js"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                  
                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                  <meta name="description" content="Learn how to use the Firebase platform on the Web">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Users List</title>
                
                   Disable tap highlight on IE 
                  <meta name="msapplication-tap-highlight" content="no">
                
                   Web Application Manifest 
                  <link rel="manifest" href="http://localhost:5000/manifest.json">
                
                   Add to homescreen for Chrome on Android 
                  <meta name="mobile-web-app-capable" content="yes">
                  <meta name="application-name" content="Friendly Chat">
                  <meta name="theme-color" content="#303F9F">
                
                   Add to homescreen for Safari on iOS 
                  <meta name="apple-mobile-web-app-capable" content="yes">
                  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
                  <meta name="apple-mobile-web-app-title" content="Friendly Chat">
                  <meta name="apple-mobile-web-app-status-bar-style" content="#303F9F">
                
                   Tile icon for Win8 
                  <meta name="msapplication-TileColor" content="#3372DF">
                  <meta name="msapplication-navbutton-color" content="#303F9F">
                
                   Material Design Lite 
                  <link rel="stylesheet" href="./Users List_files/icon">
                  <link rel="stylesheet" href="./Users List_files/material.orange-indigo.min.css">
                  <script defer="" src="./Users List_files/material.min.js.download"></script>
                
                   App Styling 
                  <link rel="stylesheet" href="./Users List_files/css">
                  <link rel="stylesheet" href="https://onetoonechat-1ab20.firebaseapp.com/styles/main.css">
                </head>
                <body>
                <div class="mdl-layout__container"><div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-header is-upgraded" data-upgraded=",MaterialLayout">
                
                   Header section containing logo 
                  <header class="mdl-layout__header mdl-color-text--white mdl-color--light-blue-700 is-casting-shadow">
                    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
                      <div class="mdl-layout__header-row mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                        <h3><i class="material-icons">chat_bubble_outline</i> Users List</h3>
                      </div>
                      <div id="user-container">
                        <div id="user-pic" style="background-image: url(&quot;https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg&quot;);"></div>
                        <div id="user-name">xprienz SMILES</div>
                        <button id="sign-out" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--white" data-upgraded=",MaterialButton,MaterialRipple">
                          Sign-out
                        <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                        <button hidden="true" id="sign-in" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--white" data-upgraded=",MaterialButton,MaterialRipple">
                          <i class="material-icons">account_circle</i>Sign-in with Google
                        <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                      </div>
                    </div>
                  </header>
                
                  <main class="mdl-layout__content mdl-color--grey-100">
                    <div id="messages-card-container" class="mdl-cell mdl-cell--12-col mdl-grid">
                
                       Messages container 
                      <div id="messages-card" class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--6-col-tablet mdl-cell--6-col-desktop">
                        <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                          <div id="messages">
                            <span id="message-filler"></span>
<?php foreach ($val as $vl) { //echo '<pre>'; print_r($vl); exit;           ?>
                                                                                                                                                                                                                                        <a href="javascript:;" class="msgcontainer visible" id="android" value="<?php echo $vl['id']; ?>" rel="<?php echo $vl['article_id']; ?>">
                                                                                                                                                                                                                                        <div class="message-container visible"><div class="spacing">
                                                                                                                                                                                                                                        <div class="pic"></div></div>
                                                                                                                                                                                                                                        <div class="message "><?php echo $vl['user_name']; ?></div>
                                                                                                                                                                                                                                        <div class="name"><?php echo $vl['mobile_number']; ?></div></div></a>
<?php } ?>    
                                      
                          
                       <form id="message-form" action="#">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                              <input class="mdl-textfield__input" type="text" id="message">
                              <label class="mdl-textfield__label" for="message">Message...</label>
                            </div>
                            <button id ="submit"  type = "submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                              Register
                            </button>
                          </form>
                          <form id="image-form" action="#">
                            <input id="mediaCapture" type="file" accept="image/*,capture=camera">
                            <button id="submitImage" title="Add an image" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--amber-400 mdl-color-text--white">
                              <i class="material-icons">image</i>
                            </button>
                          </form>
                        </div>
                      </div>
                
                      <div id="must-signin-snackbar" class="mdl-js-snackbar mdl-snackbar" data-upgraded=",MaterialSnackbar">
                        <div class="mdl-snackbar__text"></div>
                        <button class="mdl-snackbar__action" type="button" aria-hidden="true"></button>
                      </div>
                
                    </div>
                  </main>
                </div></div>
                
                 Import and configure the Firebase SDK 
                 These scripts are made available when the app is served or deployed on Firebase Hosting 
                 If you do not want to serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup 
                <script src="https://onetoonechat-1ab20.firebaseapp.com/scripts/jquery-1.12.4.min.js"></script>
                
                <script src="./Users List_files/firebase.js.download"></script>
                <script src="./Users List_files/init.js.download"></script>
                
                <script src="scripts/main.js"></script>
                <script src="./Users List_files/main_user.js.download"></script>
                <script>
                    $(".msgcontainer").click(function(){ 
                       var id=$(this).attr('value');
                       var article=$(this).attr('rel');
                        
                
                        window.open('http://54.251.120.210/oosmiles_dev/oosmiles/index.php/admin/Online_chat/history/'+ id +'/' + article);
                //$.post("http://54.251.120.210/oosmiles_dev/oosmiles/index.php/admin/Online_chat/history",{id:id},function(data){ });
                
                //                    $.ajax({
                //                   type: "POST",
                //                   url: "http://54.251.120.210/oosmiles_dev/oosmiles/index.php/admin/Online_chat/history",
                //                   data: { id: id },
                //                   success: function (msg) {
                //                       
                //                   } });
                    
                
                //        var url = 'http://localhost:5000/';
                //     window.open(url);
                });
                
                </script>
                
                
                </body></html>-->