<?php if (!empty($_POST)): 
include "include/z_db.php";
$idt= $_POST['c2'];
$idf= $_POST['c3'];
$rate = $_POST['c1'];
$id= $_POST['id'];
$comment = $_POST['comment'];
 mysql_query("INSERT INTO t_feedback (p_id_to, p_id_from, feedback_value, feedback_text)VALUES('$idt', '$idf', '$rate', '$comment')");
?>
<script language="JavaScript"> 
parent.frame1.location.href="Detail1.php?id=<?php echo $id; ?>" ;
</script>  
<?php else: 
/*
$sql="SELECT * FROM t_people WHERE people_id =".$_SESSION['people_id'];
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
var_dump($row); die;
*/
session_start();
//var_dump($_GET); die;
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>feedback</title>
        <link type="text/css" rel="stylesheet" href="css/example.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body BGCOLOR='#6593cf' onload="document.getElementById('5').click();  ">
    <?php include "include/z_db.php"; $post_id = '1'; ?>

        
    <form name="form1" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
        <div class="tuto-cnt">
            <span style="font-weight:bold;font-family:Arial;">Bewertung / Feedback fur <?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></span><br>
            <div class="rate-ex3-cnt">
                <div id="1" class="rate-btn-1 rate-btn"></div>
                <div id="2" class="rate-btn-2 rate-btn"></div>
                <div id="3" class="rate-btn-3 rate-btn"></div>
                <div id="4" class="rate-btn-4 rate-btn"></div>
                <div id="5" class="rate-btn-5 rate-btn"></div>
            </div>
            <p>Die Anzahl der Sterne entsprechen der Bewertung – 5 Sterne sind voreingestellt und die höchstmögliche Bewertung.</p>
            <input type="hidden" id="c1" name="c1" value = 0>
            <input type="hidden" id="c2" name="c2" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" id="c3" name="c3" value="<?php session_start(); echo $_SESSION['people_id']; ?>"><br>
            <span style="font-weight:bold;">Feedback / Bewertung :</span><br>
            <p>Diese Beurteilung kann öffentlich eingesehen werden negatives Feedback empfehlen wir sehr sparsam einzusetzen ggf. erst am nächsten Tag zu schreiben</p>
            <textarea class="commentFeed" name="comment" rows="10" cols="60" id="comment" ></textarea>
            <input class="sendFeed" type="submit" value="Bestätigen">
            <?php $id = $_GET['id']; ?>
            <input class="sendFeed" type="button" value="Abbrechen" onclick="loadTwo('Detail1.php?id=<?php echo $id; ?>')">
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="clearfix"></div>
            <hr>
        </div><!-- /tuto-cnt -->    
    </form>
    <script>
        // rating script
        $(function(){ 
            $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });
                            
            $('.rate-btn').click(function(){    
                var therate = $(this).attr('id');
                oFormObject = document.forms['form1'];
                oFormObject.elements["c1"].value = therate;

                
                var dataRate = 'act=rate&post_id=<?php echo $post_id; ?>&rate='+therate; //
                $('.rate-btn').removeClass('rate-btn-active');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };
           
            });
        });
 </script>
<script language="JavaScript"> 
function loadTwo(iframe1URL) 
{ 
parent.frame1.location.href=iframe1URL ;
} 
</script>
</body>
</html>
<?php endif; ?>