<?php
//   print_r($chat_message_data);exit();
if (!empty($chat_message_data)):
    ?>
    <div class="row">
        <div  class="col-md-12 col-xs-12 chatbody">

            <div id='messagesDiv' class="message">
                <?php
                foreach ($chat_message_data as $chat_message_data_row) {
                    foreach ($chat_message_data_row as $keyd => $row) {
                        //echo "<pre>";
                        // print_r($chat_message_data_row);exit();
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
                                    <span class="row"><div class="clearfix"></div><span class="chatcontent pull-left checks" value="<?php echo $keyd; ?>" rel="<?php echo $key2; ?>"><input type="checkbox" class=""  value="<?php echo $keyd; ?>" rel="<?php echo $key2; ?>"><?php echo ucfirst($row->message); ?></span></span>
                                    <p><span class="pull-left">12.10 AM</span><span class="pull-right timespan">24th june 2017</span></p>
                                </div>
                            </div>
                            <?php
                        endif;
                        //place here
                        if ($row->user == $reciever_id) :
                            //echo "hi";exit();
                            @$username = $recievername;
                            @$image_path = $reciever_image;
                            ?>
                            <div class="row chatrow">


                                <div class="col-md-11 col-xs-11" id="<?php echo $row->user; ?>">
                                    <p><span class="pull-right"><?php echo ucfirst($username); ?></span></p>
                                    <span class="row"><div class="clearfix"></div><span class="chatcontent checks" value="<?php echo $keyd; ?>" rel="<?php echo $key2; ?>"><input type="checkbox" class=""  value="<?php echo $keyd; ?>" rel="<?php echo $key2; ?>"><?php echo ucfirst($row->message); ?></span></span>
                                    <p><span class="pull-left">24th june 2017</span><span class="pull-right timespan">12.10 AM</span></p>

                                </div>
                                <div class="col-md-1 col-xs-1">
                                    <img src="<?php echo $image_path; ?>" class="img-responsive img-circle"/>
                                </div>
                            </div>
                        <?php endif;
                        ?>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <form id="message-form" action="javascript:;">
        <div class="row">
            <div class="col-md-12 col-xs-12 chatfooter">

                <div class="col-md-10 col-xs-10"><input type="text" class="col-md-12 col-xs-12" id="message" placeholder="enter here"/></div>
                <input class="mdl-textfield__input" type="hidden" id="key" value="<?php echo $key; ?>">
                <input class="mdl-textfield__input" type="hidden" id="key1" value="<?php echo $key1; ?>">
                <input class="mdl-textfield__input" type="hidden" id="currentuser" value="<?php echo $reciever_id; ?>">
                <input class="mdl-textfield__input" type="hidden" id="senderid" value="<?php echo $sender_id; ?>">
                <input class="mdl-textfield__input" type="hidden" id="recieverid" value="<?php echo $reciever_id; ?>">
                <input class="mdl-textfield__input" type="hidden" id="sendername" value="<?php echo $sendername; ?>">
                <input class="mdl-textfield__input" type="hidden" id="recievername" value="<?php echo $recievername; ?>">

                <div class="col-md-2 col-xs-2 mdl-button__ripple-container sends"><p class="pull-right"> <button><i class="fa fa-send"></i> SEND</button></p></div>
            </div>
        </div>
    </form>
    <?php
else:
    ?>
    <div class="row">
        <div  class="col-md-12 col-xs-12 chatbody">
            <div id='messagesDiv' class="message">
                <div class="row">
                    <div class="col-md-12 col-xs-12 chatbody">


                        <div class="row chatrow">

                            <div class="col-md-10 col-xs-10">
                                <div class="chat">Messages....
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <input type="hidden" id="keyid" name="keyid" value="<?php echo $key2; ?>">
            <input type="hidden" id="messagekey" name="messagekey" value="">

        </div>
    </div>
    <form id="message-form" action="javascript:;">
        <div class="row">
            <div class="col-md-12 col-xs-12 chatfooter">

                <div class="col-md-10 col-xs-10"><input type="text" class="col-md-12 col-xs-12" id="message" placeholder="enter here"/></div>
                <input class="mdl-textfield__input" type="hidden" id="key" value="<?php echo $key; ?>">
                <input class="mdl-textfield__input" type="hidden" id="key1" value="<?php echo $key1; ?>">
                <input class="mdl-textfield__input" type="hidden" id="currentuser" value="<?php echo $reciever_id; ?>">
                <input class="mdl-textfield__input" type="hidden" id="senderid" value="<?php echo $sender_id; ?>">
                <input class="mdl-textfield__input" type="hidden" id="recieverid" value="<?php echo $reciever_id; ?>">
                <input class="mdl-textfield__input" type="hidden" id="sendername" value="<?php echo $sendername; ?>">
                <input class="mdl-textfield__input" type="hidden" id="recievername" value="<?php echo $recievername; ?>">

                <div class="col-md-2 col-xs-2 mdl-button__ripple-container sends"><p class="pull-right">

                        <button><i class="fa fa-send"></i> SEND</button></p></div>
            </div>
        </div>
    </form>
<?php endif; ?>



