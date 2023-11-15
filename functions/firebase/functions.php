<?php
include_once('config.php');
?>
<script>		
var database = firebase.database();
//var storage = firebase.storage();
	
	/************INSERT FUNCTIONS*****************/
	
	function writeUserData(user1, user2, message, type,unseenMsg , username) {
	var currentdate = new Date(); 
	var date =  currentdate.getDate() + "/" + (currentdate.getMonth()+1)  + "/"+ currentdate.getFullYear().toString().substr(-2);
	//var time =  currentdate.getHours() + ":"+ currentdate.getMinutes() + ":"+ currentdate.getSeconds();
		
	var hh = currentdate.getHours();
	var min = currentdate.getMinutes();

	var ampm = (hh>=12)?'pm':'am';
	hh = hh%12;
	hh = hh?hh:12;
	hh = hh<10?'0'+hh:hh;
	min = min<10?'0'+min:min;

	var time = hh+" : "+min+" "+ampm;

	var ref_message=firebase.database().ref('message/');
	var ref_recent=firebase.database().ref('recent/');

	var msg_id=ref_message.push().getKey();

	ref_message.child(user1).child(user2).child(msg_id).set({
	message: message,
	type: type,
	date: date,
	time: time,
	sender_id: user1,
	seen:'false',
	  });

	ref_message.child(user2).child(user1).child(msg_id).set({
	message: message,
	type: type,
	date: date,
	time: time,
	sender_id: user1,
	seen:'false',
	  });

		/******INSEART RECENT USERS*******/
	ref_recent.child(user1).child(user2).set({
	userId: user2,
	unseenMsg:0,
	username: username ,
	  });
		
	ref_recent.child(user2).child(user1).set({
	userId: user1,
	unseenMsg:unseenMsg,
	username: username ,
	  });

}
	/************INSERT FUNCTIONS CLOSE*****************/
</script>