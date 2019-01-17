<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$fid = trim($_REQUEST['fid']);
$typeid = trim($_REQUEST['typeid']);
$modeid = trim($_REQUEST['modeid']);

$sql = "SELECT *,f.id as fid,c.currency as currencyal,loc.loc_name as locationval,e.id as eid FROM t_event e inner join t_leader l on e.leader=l.id  
inner join t_currency c on e.currency=c.id  
inner join t_location loc on e.location=loc.id  
inner join t_dates d on e.id=d.events_id
inner join t_country country on country.id=loc.loc_country
inner join t_feedbacks f on e.id=f.events_id
where f.id='$fid'
group by f.id order by feedback_datetime";
$sqlstmt = mysql_query($sql);
$row = mysql_fetch_array($sqlstmt);

if ($typeid == 1){
	$toupdate = " feedback_events_accepted='$modeid'";
    $body = "";
    $row2 = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '".$row['provider']."' and handle_feedback_mails=1") ;	
    $to = $row2->email;
    $username = $row2->firstname;
    $language = $row2->language;
    $gender = $row2->gender;
    
    $sqlfield = mysql_query("select * from t_field_names where id=695");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $emailsubject = $rowfield['fieldname_de'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        $emailsubject =$rowfield['fieldname_eng'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        $emailsubject =$rowfield['fieldname_fr'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        $emailsubject =$rowfield['fieldname_it'];
    }
    
    $subject = fixEncodingx($emailsubject);
    $body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
    ".$username.",<br /><br />";
    
    $sqlfield = mysql_query("select * from t_field_names where id=696");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_de']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        //$body .= fixEncodingx($rowfield['fieldname_eng']);
         $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_eng']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        //$body .= fixEncodingx($rowfield['fieldname_fr']);
         $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_fr']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        //$body .= fixEncodingx($rowfield['fieldname_it']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_it']));
    }
    $body .="<br /><br />";
    $body .= fixEncodingx($row['feedback_events']);
    ///////////
    $body .="<br><br>";
    $sqlfield = mysql_query("select * from t_field_names where id=688");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $body .= fixEncodingx($rowfield['fieldname_de']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        $body .= fixEncodingx($rowfield['fieldname_eng']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        $body .= fixEncodingx($rowfield['fieldname_fr']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        $body .= fixEncodingx($rowfield['fieldname_it']);
    }
    $body .="
    </div>";
    echo $body;
    
    $from = "info@spiritwings.ch";
    
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: $from\r\n";
    
    mail($to,$subject,$body,$headers);
    
}elseif ($typeid == 3){
	$toupdate = " feedback_leaders_accepted='$modeid'";
    $body = "";
    $row2 = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."leader WHERE id = '".$row['leader_id']."'") ;	
    $to = $row2->contact_email;
    $username = $row2->firstname;
    $language = $row2->language;
    $gender = $row2->gender;
    
    $sqlfield = mysql_query("select * from t_field_names where id=695");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $emailsubject = $rowfield['fieldname_de'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        $emailsubject =$rowfield['fieldname_eng'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        $emailsubject =$rowfield['fieldname_fr'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        $emailsubject =$rowfield['fieldname_it'];
    }
    
    $subject = fixEncodingx($emailsubject);
    $body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
    ".$username.",<br /><br />";
    
    $sqlfield = mysql_query("select * from t_field_names where id=696");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_de']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        //$body .= fixEncodingx($rowfield['fieldname_eng']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_eng']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        //$body .= fixEncodingx($rowfield['fieldname_fr']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_fr']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        //$body .= fixEncodingx($rowfield['fieldname_it']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_it']));
    }
    $body .="<br /><br />";
    $body .= fixEncodingx($row['feedback_leaders']);
    ///////////
    $body .="<br><br>";
    $sqlfield = mysql_query("select * from t_field_names where id=688");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $body .= fixEncodingx($rowfield['fieldname_de']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        $body .= fixEncodingx($rowfield['fieldname_eng']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        $body .= fixEncodingx($rowfield['fieldname_fr']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        $body .= fixEncodingx($rowfield['fieldname_it']);
    }
    $body .="
    </div>";
    echo $body;
    
    $from = "info@spiritwings.ch";
    
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: $from\r\n";
    
    mail($to,$subject,$body,$headers);
}elseif ($typeid == 2){
	$toupdate = " feedback_locations_accepted='$modeid'";
    $body = "";
    $row2 = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."location WHERE id = '".$row['location_id']."'") ;	
    $to = $row2->loc_contact_email;
    $username = $row2->loc_contact_name;
    $language = $row2->language;
    $gender = $row2->gender;
    
    $sqlfield = mysql_query("select * from t_field_names where id=695");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $emailsubject = $rowfield['fieldname_de'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        $emailsubject =$rowfield['fieldname_eng'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        $emailsubject =$rowfield['fieldname_fr'];
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        $emailsubject =$rowfield['fieldname_it'];
    }
    
    $subject = fixEncodingx($emailsubject);
    if ($username != ""){
    $body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
    ".$username.",<br /><br />";
}else{
	$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
}
    
    $sqlfield = mysql_query("select * from t_field_names where id=696");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_de']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        //$body .= fixEncodingx($rowfield['fieldname_eng']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_eng']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        //$body .= fixEncodingx($rowfield['fieldname_fr']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_fr']));
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        //$body .= fixEncodingx($rowfield['fieldname_it']);
        $body .= fixEncodingx(str_replace('%eventtitle%',$row['title'],$rowfield['fieldname_it']));
    }
    $body .="<br /><br />";
    $body .= fixEncodingx($row['feedback_locations']);
    ///////////
    $body .="<br><br>";
    $sqlfield = mysql_query("select * from t_field_names where id=688");
    $rowfield = mysql_fetch_array($sqlfield);
    if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
        $body .= fixEncodingx($rowfield['fieldname_de']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
        $body .= fixEncodingx($rowfield['fieldname_eng']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
        $body .= fixEncodingx($rowfield['fieldname_fr']);
    }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
        $body .= fixEncodingx($rowfield['fieldname_it']);
    }
    $body .="
    </div>";
    echo $body;
    
    $from = "info@spiritwings.ch";
    
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: $from\r\n";
    
    mail($to,$subject,$body,$headers);
}elseif ($typeid == 4){
	$toupdate = " feedback_spiritwings_accepted='$modeid'";
}
mysql_query("update t_feedbacks set $toupdate where id='$fid'");

/*
[10:20:12 PM] David Schlaepfer: and another addition, this one rated 40$:
- upon accepting a feedback, please let the one, whom it concerns (for the location: the location contact, for the leader: his email, for the event: the providers email) also get the feedback by email, like this:

Liebe (female) or Lieber (male) firstname + " " + lastname <br> (dear first + last)

Sie haben zur Veranstaltung <event title> auf Spiritwings.ch folgendes Feedback erhalten:
(You received the following feedback regarding the event <event title> on spiritwings.ch) <br>

the feedback itself<br>

our footer (wir wünschen weiterhin tolle erfahrungen.. team..)
*/

?>
