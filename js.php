<!-- JS Page faq.php -->
<script>
function toggleElement(id)
{
    if(document.getElementById(id).style.display == 'none')
    {
        document.getElementById(id).style.display = 'block';
    }
    else
    {
        document.getElementById(id).style.display = 'none';
    }
}
</script>

<!-- JS Page location.php -->
 <script type="text/javascript"> 
function loadTwo(iframe1URL,x,m) 
{ 
	document.getElementById(x).bgColor="lightblue";
	location.href=iframe1URL;
	for (k=0;k<=m;k=k+1)
	{
		if(!(x==k))
		{
			document.getElementById(k).bgColor="White";
		}
	}
}
</script>

<!-- JS Page login.php -->
<script language = "javascript">
function validate(text1,text2,text3,text4)
{
	if (text1==text2 && text3==text4)
 		load('welcome.html');
 	else 
	{
		alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben.');
	}
}
function load(url)
{
	location.href=url;
}
</script>
<script language=JavaScript>
function lostp()
{
	document.getElementById('lostlogin').style.display='none';
	document.getElementById('lostpassword').style.display='block';
}
function lostl()
{
	document.getElementById('lostpassword').style.display='none';
	document.getElementById('lostlogin').style.display='block';
}
</script>

<!-- JS Page nsearch.php -->
<script language=JavaScript> 
function reload(form)
{
var val=form.kinder.options[form.kinder.options.selectedIndex].value;

var type ;
var gender;
for (i=0;i<document.form1.RadioGroup1.length;i++){
if (document.form1.RadioGroup1[i].checked==true){
type =i ;
break ;//exist for loop, as target acquired.
}
}
for (i=0;i<document.form2.radio.length;i++){
if (document.form2.radio[i].checked==true){
gender =i ;
break ;//exist for loop, as target acquired.
}
}

self.location='nsearch.php?kinder=' + val+'&type=' +type+'&gender=' +gender ;
}

function passv( )

{


var type ;
var gender;
for (i=0;i<document.form1.RadioGroup1.length;i++){
if (document.form1.RadioGroup1[i].checked==true){
type =i ;
break ;//exist for loop, as target acquired.
}
}
for (i=0;i<document.form2.radio.length;i++){
if (document.form2.radio[i].checked==true){
gender =i ;
break ;//exist for loop, as target acquired.
}
}
cat = document.form3.kinder.value ;
subcat = document.form3.kinder2.value ;
ke=document.form3.keys.value ;
loc =document.form4.location.value ;
location.href= "nsearch1.php?type=" + type + "&gender=" + gender +"&cat=" + cat +"&subcat=" + subcat +"&ke="+ke+"&loc="+loc+"" ;
}
</script>

<!-- JS Page setting1.php -->
<style type="text/css"> 

.medium { 
   height: 12px; 
   width: 12px; 
} 
.hidden{
	display:none;
}
</style>
<!-- <script type="text/javascript" src="jquery.1.4.1-min.js"></script> -->
<script type="text/javascript" src="jquery.showPasswordCheckbox.js"></script>
<script type="text/javascript">
$(function(){
	$("input[type=password]").showPasswordCheckbox();
});
</script>

<!-- JS Page setting2.php -->
<script type="text/javascript">
function Change(id1)
{
if (id1== "Mo")
{
if(document.form1.Mo.checked == true)
{
document.form1.flagm1.checked = true;
document.form1.flagm2.checked = true;
document.form1.flagm3.checked = true;
document.form1.flagm4.checked = true;
document.form1.flagm5.checked = true;
document.form1.flagm6.checked = true;
document.form1.flagm7.checked = true;
document.form1.flagm8.checked = true;
document.form1.flagm9.checked = true;
document.form1.flagm10.checked = true;
document.form1.flagm11.checked = true;
document.form1.flagm12.checked = true;
}else
{
document.form1.flagm1.checked = false;
document.form1.flagm2.checked = false;
document.form1.flagm3.checked = false;
document.form1.flagm4.checked = false;
document.form1.flagm5.checked = false;
document.form1.flagm6.checked = false;
document.form1.flagm7.checked = false;
document.form1.flagm8.checked = false;
document.form1.flagm9.checked = false;
document.form1.flagm10.checked = false;
document.form1.flagm11.checked = false;
document.form1.flagm12.checked = false;
}
}
if (id1== "Di")
{
if(document.form1.Di.checked == true)
{
document.form1.flagt1.checked = true;
document.form1.flagt2.checked = true;
document.form1.flagt3.checked = true;
document.form1.flagt4.checked = true;
document.form1.flagt5.checked = true;
document.form1.flagt6.checked = true;
document.form1.flagt7.checked = true;
document.form1.flagt8.checked = true;
document.form1.flagt9.checked = true;
document.form1.flagt10.checked = true;
document.form1.flagt11.checked = true;
document.form1.flagt12.checked = true;
}else
{
document.form1.flagt1.checked = false;
document.form1.flagt2.checked = false;
document.form1.flagt3.checked = false;
document.form1.flagt4.checked = false;
document.form1.flagt5.checked = false;
document.form1.flagt6.checked = false;
document.form1.flagt7.checked = false;
document.form1.flagt8.checked = false;
document.form1.flagt9.checked = false;
document.form1.flagt10.checked = false;
document.form1.flagt11.checked = false;
document.form1.flagt12.checked = false;
}
}
if (id1== "Mi")
{
if(document.form1.Mi.checked == true)
{
document.form1.flagw1.checked = true;
document.form1.flagw2.checked = true;
document.form1.flagw3.checked = true;
document.form1.flagw4.checked = true;
document.form1.flagw5.checked = true;
document.form1.flagw6.checked = true;
document.form1.flagw7.checked = true;
document.form1.flagw8.checked = true;
document.form1.flagw9.checked = true;
document.form1.flagw10.checked = true;
document.form1.flagw11.checked = true;
document.form1.flagw12.checked = true;
}else
{
document.form1.flagw1.checked = false;
document.form1.flagw2.checked = false;
document.form1.flagw3.checked = false;
document.form1.flagw4.checked = false;
document.form1.flagw5.checked = false;
document.form1.flagw6.checked = false;
document.form1.flagw7.checked = false;
document.form1.flagw8.checked = false;
document.form1.flagw9.checked = false;
document.form1.flagw10.checked = false;
document.form1.flagw11.checked = false;
document.form1.flagw12.checked = false;
}
}

if (id1== "Do")
{
if(document.form1.Do.checked == true)
{
document.form1.flagth1.checked = true;
document.form1.flagth2.checked = true;
document.form1.flagth3.checked = true;
document.form1.flagth4.checked = true;
document.form1.flagth5.checked = true;
document.form1.flagth6.checked = true;
document.form1.flagth7.checked = true;
document.form1.flagth8.checked = true;
document.form1.flagth9.checked = true;
document.form1.flagth10.checked = true;
document.form1.flagth11.checked = true;
document.form1.flagth12.checked = true;
}else
{
document.form1.flagth1.checked = false;
document.form1.flagth2.checked = false;
document.form1.flagth3.checked = false;
document.form1.flagth4.checked = false;
document.form1.flagth5.checked = false;
document.form1.flagth6.checked = false;
document.form1.flagth7.checked = false;
document.form1.flagth8.checked = false;
document.form1.flagth9.checked = false;
document.form1.flagth10.checked = false;
document.form1.flagth11.checked = false;
document.form1.flagth12.checked = false;
}
}


if (id1== "Fr")
{
if(document.form1.Fr.checked == true)
{
document.form1.flagf1.checked = true;
document.form1.flagf2.checked = true;
document.form1.flagf3.checked = true;
document.form1.flagf4.checked = true;
document.form1.flagf5.checked = true;
document.form1.flagf6.checked = true;
document.form1.flagf7.checked = true;
document.form1.flagf8.checked = true;
document.form1.flagf9.checked = true;
document.form1.flagf10.checked = true;
document.form1.flagf11.checked = true;
document.form1.flagf12.checked = true;
}else
{
document.form1.flagf1.checked = false;
document.form1.flagf2.checked = false;
document.form1.flagf3.checked = false;
document.form1.flagf4.checked = false;
document.form1.flagf5.checked = false;
document.form1.flagf6.checked = false;
document.form1.flagf7.checked = false;
document.form1.flagf8.checked = false;
document.form1.flagf9.checked = false;
document.form1.flagf10.checked = false;
document.form1.flagf11.checked = false;
document.form1.flagf12.checked = false;
}
}



if (id1== "Sa")
{
if(document.form1.Sa.checked == true)
{
document.form1.flagsa1.checked = true;
document.form1.flagsa2.checked = true;
document.form1.flagsa3.checked = true;
document.form1.flagsa4.checked = true;
document.form1.flagsa5.checked = true;
document.form1.flagsa6.checked = true;
document.form1.flagsa7.checked = true;
document.form1.flagsa8.checked = true;
document.form1.flagsa9.checked = true;
document.form1.flagsa10.checked = true;
document.form1.flagsa11.checked = true;
document.form1.flagsa12.checked = true;
}else
{
document.form1.flagsa1.checked = false;
document.form1.flagsa2.checked = false;
document.form1.flagsa3.checked = false;
document.form1.flagsa4.checked = false;
document.form1.flagsa5.checked = false;
document.form1.flagsa6.checked = false;
document.form1.flagsa7.checked = false;
document.form1.flagsa8.checked = false;
document.form1.flagsa9.checked = false;
document.form1.flagsa10.checked = false;
document.form1.flagsa11.checked = false;
document.form1.flagsa12.checked = false;
}
}



if (id1== "So")
{
if(document.form1.So.checked == true)
{
document.form1.flagsu1.checked = true;
document.form1.flagsu2.checked = true;
document.form1.flagsu3.checked = true;
document.form1.flagsu4.checked = true;
document.form1.flagsu5.checked = true;
document.form1.flagsu6.checked = true;
document.form1.flagsu7.checked = true;
document.form1.flagsu8.checked = true;
document.form1.flagsu9.checked = true;
document.form1.flagsu10.checked = true;
document.form1.flagsu11.checked = true;
document.form1.flagsu12.checked = true;
}else
{
document.form1.flagsu1.checked = false;
document.form1.flagsu2.checked = false;
document.form1.flagsu3.checked = false;
document.form1.flagsu4.checked = false;
document.form1.flagsu5.checked = false;
document.form1.flagsu6.checked = false;
document.form1.flagsu7.checked = false;
document.form1.flagsu8.checked = false;
document.form1.flagsu9.checked = false;
document.form1.flagsu10.checked = false;
document.form1.flagsu11.checked = false;
document.form1.flagsu12.checked = false;
}
}



if (id1== "row1")
{
if(document.form1.row1.checked == true)
{
document.form1.flagm1.checked = true;
document.form1.flagt1.checked = true;
document.form1.flagw1.checked = true;
document.form1.flagth1.checked = true;
document.form1.flagf1.checked = true;
document.form1.flagsa1.checked = true;
document.form1.flagsu1.checked = true;
}else
{
document.form1.flagm1.checked = false;
document.form1.flagt1.checked = false;
document.form1.flagw1.checked = false;
document.form1.flagth1.checked = false;
document.form1.flagf1.checked = false;
document.form1.flagsa1.checked = false;
document.form1.flagsu1.checked = false;
}
}

if (id1== "row2")
{
if(document.form1.row2.checked == true)
{
document.form1.flagm2.checked = true;
document.form1.flagt2.checked = true;
document.form1.flagw2.checked = true;
document.form1.flagth2.checked = true;
document.form1.flagf2.checked = true;
document.form1.flagsa2.checked = true;
document.form1.flagsu2.checked = true;
}else
{
document.form1.flagm2.checked = false;
document.form1.flagt2.checked = false;
document.form1.flagw2.checked = false;
document.form1.flagth2.checked = false;
document.form1.flagf2.checked = false;
document.form1.flagsa2.checked = false;
document.form1.flagsu2.checked = false;
}
}

if (id1== "row3")
{
if(document.form1.row3.checked == true)
{
document.form1.flagm3.checked = true;
document.form1.flagt3.checked = true;
document.form1.flagw3.checked = true;
document.form1.flagth3.checked = true;
document.form1.flagf3.checked = true;
document.form1.flagsa3.checked = true;
document.form1.flagsu3.checked = true;
}else
{
document.form1.flagm3.checked = false;
document.form1.flagt3.checked = false;
document.form1.flagw3.checked = false;
document.form1.flagth3.checked = false;
document.form1.flagf3.checked = false;
document.form1.flagsa3.checked = false;
document.form1.flagsu3.checked = false;
}
}

if (id1== "row4")
{
if(document.form1.row4.checked == true)
{
document.form1.flagm4.checked = true;
document.form1.flagt4.checked = true;
document.form1.flagw4.checked = true;
document.form1.flagth4.checked = true;
document.form1.flagf4.checked = true;
document.form1.flagsa4.checked = true;
document.form1.flagsu4.checked = true;
}else
{
document.form1.flagm4.checked = false;
document.form1.flagt4.checked = false;
document.form1.flagw4.checked = false;
document.form1.flagth4.checked = false;
document.form1.flagf4.checked = false;
document.form1.flagsa4.checked = false;
document.form1.flagsu4.checked = false;
}
}

if (id1== "row5")
{
if(document.form1.row5.checked == true)
{
document.form1.flagm5.checked = true;
document.form1.flagt5.checked = true;
document.form1.flagw5.checked = true;
document.form1.flagth5.checked = true;
document.form1.flagf5.checked = true;
document.form1.flagsa5.checked = true;
document.form1.flagsu5.checked = true;
}else
{
document.form1.flagm5.checked = false;
document.form1.flagt5.checked = false;
document.form1.flagw5.checked = false;
document.form1.flagth5.checked = false;
document.form1.flagf5.checked = false;
document.form1.flagsa5.checked = false;
document.form1.flagsu5.checked = false;
}
}


if (id1== "row6")
{
if(document.form1.row6.checked == true)
{
document.form1.flagm6.checked = true;
document.form1.flagt6.checked = true;
document.form1.flagw6.checked = true;
document.form1.flagth6.checked = true;
document.form1.flagf6.checked = true;
document.form1.flagsa6.checked = true;
document.form1.flagsu6.checked = true;
}else
{
document.form1.flagm6.checked = false;
document.form1.flagt6.checked = false;
document.form1.flagw6.checked = false;
document.form1.flagth6.checked = false;
document.form1.flagf6.checked = false;
document.form1.flagsa6.checked = false;
document.form1.flagsu6.checked = false;
}
}


if (id1== "row7")
{
if(document.form1.row7.checked == true)
{
document.form1.flagm7.checked = true;
document.form1.flagt7.checked = true;
document.form1.flagw7.checked = true;
document.form1.flagth7.checked = true;
document.form1.flagf7.checked = true;
document.form1.flagsa7.checked = true;
document.form1.flagsu7.checked = true;
}else
{
document.form1.flagm7.checked = false;
document.form1.flagt7.checked = false;
document.form1.flagw7.checked = false;
document.form1.flagth7.checked = false;
document.form1.flagf7.checked = false;
document.form1.flagsa7.checked = false;
document.form1.flagsu7.checked = false;
}
}


if (id1== "row8")
{
if(document.form1.row8.checked == true)
{
document.form1.flagm8.checked = true;
document.form1.flagt8.checked = true;
document.form1.flagw8.checked = true;
document.form1.flagth8.checked = true;
document.form1.flagf8.checked = true;
document.form1.flagsa8.checked = true;
document.form1.flagsu8.checked = true;
}else
{
document.form1.flagm8.checked = false;
document.form1.flagt8.checked = false;
document.form1.flagw8.checked = false;
document.form1.flagth8.checked = false;
document.form1.flagf8.checked = false;
document.form1.flagsa8.checked = false;
document.form1.flagsu8.checked = false;
}
}

if (id1== "row9")
{
if(document.form1.row9.checked == true)
{
document.form1.flagm9.checked = true;
document.form1.flagt9.checked = true;
document.form1.flagw9.checked = true;
document.form1.flagth9.checked = true;
document.form1.flagf9.checked = true;
document.form1.flagsa9.checked = true;
document.form1.flagsu9.checked = true;
}else
{
document.form1.flagm9.checked = false;
document.form1.flagt9.checked = false;
document.form1.flagw9.checked = false;
document.form1.flagth9.checked = false;
document.form1.flagf9.checked = false;
document.form1.flagsa9.checked = false;
document.form1.flagsu9.checked = false;
}
}

if (id1== "row10")
{
if(document.form1.row10.checked == true)
{
document.form1.flagm10.checked = true;
document.form1.flagt10.checked = true;
document.form1.flagw10.checked = true;
document.form1.flagth10.checked = true;
document.form1.flagf10.checked = true;
document.form1.flagsa10.checked = true;
document.form1.flagsu10.checked = true;
}else
{
document.form1.flagm10.checked = false;
document.form1.flagt10.checked = false;
document.form1.flagw10.checked = false;
document.form1.flagth10.checked = false;
document.form1.flagf10.checked = false;
document.form1.flagsa10.checked = false;
document.form1.flagsu10.checked = false;
}
}

if (id1== "row11")
{
if(document.form1.row11.checked == true)
{
document.form1.flagm11.checked = true;
document.form1.flagt11.checked = true;
document.form1.flagw11.checked = true;
document.form1.flagth11.checked = true;
document.form1.flagf11.checked = true;
document.form1.flagsa11.checked = true;
document.form1.flagsu11.checked = true;
}else
{
document.form1.flagm11.checked = false;
document.form1.flagt11.checked = false;
document.form1.flagw11.checked = false;
document.form1.flagth11.checked = false;
document.form1.flagf11.checked = false;
document.form1.flagsa11.checked = false;
document.form1.flagsu11.checked = false;
}
}

if (id1== "row12")
{
if(document.form1.row12.checked == true)
{
document.form1.flagm12.checked = true;
document.form1.flagt12.checked = true;
document.form1.flagw12.checked = true;
document.form1.flagth12.checked = true;
document.form1.flagf12.checked = true;
document.form1.flagsa12.checked = true;
document.form1.flagsu12.checked = true;
}else
{
document.form1.flagm12.checked = false;
document.form1.flagt12.checked = false;
document.form1.flagw12.checked = false;
document.form1.flagth12.checked = false;
document.form1.flagf12.checked = false;
document.form1.flagsa12.checked = false;
document.form1.flagsu12.checked = false;
}
}


if (id1== "tMo")
{
if(document.form1.tMo.checked == true)
{
document.form1.flag_m1.checked = true;
document.form1.flag_m2.checked = true;
document.form1.flag_m3.checked = true;
document.form1.flag_m4.checked = true;
document.form1.flag_m5.checked = true;
document.form1.flag_m6.checked = true;
document.form1.flag_m7.checked = true;
document.form1.flag_m8.checked = true;
document.form1.flag_m9.checked = true;
document.form1.flag_m10.checked = true;
document.form1.flag_m11.checked = true;
document.form1.flag_m12.checked = true;
}else
{
document.form1.flag_m1.checked = false;
document.form1.flag_m2.checked = false;
document.form1.flag_m3.checked = false;
document.form1.flag_m4.checked = false;
document.form1.flag_m5.checked = false;
document.form1.flag_m6.checked = false;
document.form1.flag_m7.checked = false;
document.form1.flag_m8.checked = false;
document.form1.flag_m9.checked = false;
document.form1.flag_m10.checked = false;
document.form1.flag_m11.checked = false;
document.form1.flag_m12.checked = false;
}
}

if (id1== "tDi")
{
if(document.form1.tDi.checked == true)
{
document.form1.flag_t1.checked = true;
document.form1.flag_t2.checked = true;
document.form1.flag_t3.checked = true;
document.form1.flag_t4.checked = true;
document.form1.flag_t5.checked = true;
document.form1.flag_t6.checked = true;
document.form1.flag_t7.checked = true;
document.form1.flag_t8.checked = true;
document.form1.flag_t9.checked = true;
document.form1.flag_t10.checked = true;
document.form1.flag_t11.checked = true;
document.form1.flag_t12.checked = true;
}else
{
document.form1.flag_t1.checked = false;
document.form1.flag_t2.checked = false;
document.form1.flag_t3.checked = false;
document.form1.flag_t4.checked = false;
document.form1.flag_t5.checked = false;
document.form1.flag_t6.checked = false;
document.form1.flag_t7.checked = false;
document.form1.flag_t8.checked = false;
document.form1.flag_t9.checked = false;
document.form1.flag_t10.checked = false;
document.form1.flag_t11.checked = false;
document.form1.flag_t12.checked = false;
}
}
if (id1== "tMi")
{
if(document.form1.tMi.checked == true)
{
document.form1.flag_w1.checked = true;
document.form1.flag_w2.checked = true;
document.form1.flag_w3.checked = true;
document.form1.flag_w4.checked = true;
document.form1.flag_w5.checked = true;
document.form1.flag_w6.checked = true;
document.form1.flag_w7.checked = true;
document.form1.flag_w8.checked = true;
document.form1.flag_w9.checked = true;
document.form1.flag_w10.checked = true;
document.form1.flag_w11.checked = true;
document.form1.flag_w12.checked = true;
}else
{
document.form1.flag_w1.checked = false;
document.form1.flag_w2.checked = false;
document.form1.flag_w3.checked = false;
document.form1.flag_w4.checked = false;
document.form1.flag_w5.checked = false;
document.form1.flag_w6.checked = false;
document.form1.flag_w7.checked = false;
document.form1.flag_w8.checked = false;
document.form1.flag_w9.checked = false;
document.form1.flag_w10.checked = false;
document.form1.flag_w11.checked = false;
document.form1.flag_w12.checked = false;
}
}

if (id1== "tDo")
{
if(document.form1.tDo.checked == true)
{
document.form1.flag_th1.checked = true;
document.form1.flag_th2.checked = true;
document.form1.flag_th3.checked = true;
document.form1.flag_th4.checked = true;
document.form1.flag_th5.checked = true;
document.form1.flag_th6.checked = true;
document.form1.flag_th7.checked = true;
document.form1.flag_th8.checked = true;
document.form1.flag_th9.checked = true;
document.form1.flag_th10.checked = true;
document.form1.flag_th11.checked = true;
document.form1.flag_th12.checked = true;
}else
{
document.form1.flag_th1.checked = false;
document.form1.flag_th2.checked = false;
document.form1.flag_th3.checked = false;
document.form1.flag_th4.checked = false;
document.form1.flag_th5.checked = false;
document.form1.flag_th6.checked = false;
document.form1.flag_th7.checked = false;
document.form1.flag_th8.checked = false;
document.form1.flag_th9.checked = false;
document.form1.flag_th10.checked = false;
document.form1.flag_th11.checked = false;
document.form1.flag_th12.checked = false;
}
}


if (id1== "tFr")
{
if(document.form1.tFr.checked == true)
{
document.form1.flag_f1.checked = true;
document.form1.flag_f2.checked = true;
document.form1.flag_f3.checked = true;
document.form1.flag_f4.checked = true;
document.form1.flag_f5.checked = true;
document.form1.flag_f6.checked = true;
document.form1.flag_f7.checked = true;
document.form1.flag_f8.checked = true;
document.form1.flag_f9.checked = true;
document.form1.flag_f10.checked = true;
document.form1.flag_f11.checked = true;
document.form1.flag_f12.checked = true;
}else
{
document.form1.flag_f1.checked = false;
document.form1.flag_f2.checked = false;
document.form1.flag_f3.checked = false;
document.form1.flag_f4.checked = false;
document.form1.flag_f5.checked = false;
document.form1.flag_f6.checked = false;
document.form1.flag_f7.checked = false;
document.form1.flag_f8.checked = false;
document.form1.flag_f9.checked = false;
document.form1.flag_f10.checked = false;
document.form1.flag_f11.checked = false;
document.form1.flag_f12.checked = false;
}
}



if (id1== "tSa")
{
if(document.form1.tSa.checked == true)
{
document.form1.flag_sa1.checked = true;
document.form1.flag_sa2.checked = true;
document.form1.flag_sa3.checked = true;
document.form1.flag_sa4.checked = true;
document.form1.flag_sa5.checked = true;
document.form1.flag_sa6.checked = true;
document.form1.flag_sa7.checked = true;
document.form1.flag_sa8.checked = true;
document.form1.flag_sa9.checked = true;
document.form1.flag_sa10.checked = true;
document.form1.flag_sa11.checked = true;
document.form1.flag_sa12.checked = true;
}else
{
document.form1.flag_sa1.checked = false;
document.form1.flag_sa2.checked = false;
document.form1.flag_sa3.checked = false;
document.form1.flag_sa4.checked = false;
document.form1.flag_sa5.checked = false;
document.form1.flag_sa6.checked = false;
document.form1.flag_sa7.checked = false;
document.form1.flag_sa8.checked = false;
document.form1.flag_sa9.checked = false;
document.form1.flag_sa10.checked = false;
document.form1.flag_sa11.checked = false;
document.form1.flag_sa12.checked = false;
}
}



if (id1== "tSo")
{
if(document.form1.tSo.checked == true)
{
document.form1.flag_su1.checked = true;
document.form1.flag_su2.checked = true;
document.form1.flag_su3.checked = true;
document.form1.flag_su4.checked = true;
document.form1.flag_su5.checked = true;
document.form1.flag_su6.checked = true;
document.form1.flag_su7.checked = true;
document.form1.flag_su8.checked = true;
document.form1.flag_su9.checked = true;
document.form1.flag_su10.checked = true;
document.form1.flag_su11.checked = true;
document.form1.flag_su12.checked = true;
}else
{
document.form1.flag_su1.checked = false;
document.form1.flag_su2.checked = false;
document.form1.flag_su3.checked = false;
document.form1.flag_su4.checked = false;
document.form1.flag_su5.checked = false;
document.form1.flag_su6.checked = false;
document.form1.flag_su7.checked = false;
document.form1.flag_su8.checked = false;
document.form1.flag_su9.checked = false;
document.form1.flag_su10.checked = false;
document.form1.flag_su11.checked = false;
document.form1.flag_su12.checked = false;
}
}

if (id1== "trow1")
{
if(document.form1.trow1.checked == true)
{
document.form1.flag_m1.checked = true;
document.form1.flag_t1.checked = true;
document.form1.flag_w1.checked = true;
document.form1.flag_th1.checked = true;
document.form1.flag_f1.checked = true;
document.form1.flag_sa1.checked = true;
document.form1.flag_su1.checked = true;
}else
{
document.form1.flag_m1.checked = false;
document.form1.flag_t1.checked = false;
document.form1.flag_w1.checked = false;
document.form1.flag_th1.checked = false;
document.form1.flag_f1.checked = false;
document.form1.flag_sa1.checked = false;
document.form1.flag_su1.checked = false;
}
}

if (id1== "trow2")
{
if(document.form1.trow2.checked == true)
{
document.form1.flag_m2.checked = true;
document.form1.flag_t2.checked = true;
document.form1.flag_w2.checked = true;
document.form1.flag_th2.checked = true;
document.form1.flag_f2.checked = true;
document.form1.flag_sa2.checked = true;
document.form1.flag_su2.checked = true;
}else
{
document.form1.flag_m2.checked = false;
document.form1.flag_t2.checked = false;
document.form1.flag_w2.checked = false;
document.form1.flag_th2.checked = false;
document.form1.flag_f2.checked = false;
document.form1.flag_sa2.checked = false;
document.form1.flag_su2.checked = false;
}
}

if (id1== "trow3")
{
if(document.form1.trow3.checked == true)
{
document.form1.flag_m3.checked = true;
document.form1.flag_t3.checked = true;
document.form1.flag_w3.checked = true;
document.form1.flag_th3.checked = true;
document.form1.flag_f3.checked = true;
document.form1.flag_sa3.checked = true;
document.form1.flag_su3.checked = true;
}else
{
document.form1.flag_m3.checked = false;
document.form1.flag_t3.checked = false;
document.form1.flag_w3.checked = false;
document.form1.flag_th3.checked = false;
document.form1.flag_f3.checked = false;
document.form1.flag_sa3.checked = false;
document.form1.flag_su3.checked = false;
}
}

if (id1== "trow4")
{
if(document.form1.trow4.checked == true)
{
document.form1.flag_m4.checked = true;
document.form1.flag_t4.checked = true;
document.form1.flag_w4.checked = true;
document.form1.flag_th4.checked = true;
document.form1.flag_f4.checked = true;
document.form1.flag_sa4.checked = true;
document.form1.flag_su4.checked = true;
}else
{
document.form1.flag_m4.checked = false;
document.form1.flag_t4.checked = false;
document.form1.flag_w4.checked = false;
document.form1.flag_th4.checked = false;
document.form1.flag_f4.checked = false;
document.form1.flag_sa4.checked = false;
document.form1.flag_su4.checked = false;
}
}

if (id1== "trow5")
{
if(document.form1.trow5.checked == true)
{
document.form1.flag_m5.checked = true;
document.form1.flag_t5.checked = true;
document.form1.flag_w5.checked = true;
document.form1.flag_th5.checked = true;
document.form1.flag_f5.checked = true;
document.form1.flag_sa5.checked = true;
document.form1.flag_su5.checked = true;
}else
{
document.form1.flag_m5.checked = false;
document.form1.flag_t5.checked = false;
document.form1.flag_w5.checked = false;
document.form1.flag_th5.checked = false;
document.form1.flag_f5.checked = false;
document.form1.flag_sa5.checked = false;
document.form1.flag_su5.checked = false;
}
}


if (id1== "trow6")
{
if(document.form1.trow6.checked == true)
{
document.form1.flag_m6.checked = true;
document.form1.flag_t6.checked = true;
document.form1.flag_w6.checked = true;
document.form1.flag_th6.checked = true;
document.form1.flag_f6.checked = true;
document.form1.flag_sa6.checked = true;
document.form1.flag_su6.checked = true;
}else
{
document.form1.flag_m6.checked = false;
document.form1.flag_t6.checked = false;
document.form1.flag_w6.checked = false;
document.form1.flag_th6.checked = false;
document.form1.flag_f6.checked = false;
document.form1.flag_sa6.checked = false;
document.form1.flag_su6.checked = false;
}
}


if (id1== "trow7")
{
if(document.form1.trow7.checked == true)
{
document.form1.flag_m7.checked = true;
document.form1.flag_t7.checked = true;
document.form1.flag_w7.checked = true;
document.form1.flag_th7.checked = true;
document.form1.flag_f7.checked = true;
document.form1.flag_sa7.checked = true;
document.form1.flag_su7.checked = true;
}else
{
document.form1.flag_m7.checked = false;
document.form1.flag_t7.checked = false;
document.form1.flag_w7.checked = false;
document.form1.flag_th7.checked = false;
document.form1.flag_f7.checked = false;
document.form1.flag_sa7.checked = false;
document.form1.flag_su7.checked = false;
}
}


if (id1== "trow8")
{
if(document.form1.trow8.checked == true)
{
document.form1.flag_m8.checked = true;
document.form1.flag_t8.checked = true;
document.form1.flag_w8.checked = true;
document.form1.flag_th8.checked = true;
document.form1.flag_f8.checked = true;
document.form1.flag_sa8.checked = true;
document.form1.flag_su8.checked = true;
}else
{
document.form1.flag_m8.checked = false;
document.form1.flag_t8.checked = false;
document.form1.flag_w8.checked = false;
document.form1.flag_th8.checked = false;
document.form1.flag_f8.checked = false;
document.form1.flag_sa8.checked = false;
document.form1.flag_su8.checked = false;
}
}

if (id1== "trow9")
{
if(document.form1.trow9.checked == true)
{
document.form1.flag_m9.checked = true;
document.form1.flag_t9.checked = true;
document.form1.flag_w9.checked = true;
document.form1.flag_th9.checked = true;
document.form1.flag_f9.checked = true;
document.form1.flag_sa9.checked = true;
document.form1.flag_su9.checked = true;
}else
{
document.form1.flag_m9.checked = false;
document.form1.flag_t9.checked = false;
document.form1.flag_w9.checked = false;
document.form1.flag_th9.checked = false;
document.form1.flag_f9.checked = false;
document.form1.flag_sa9.checked = false;
document.form1.flag_su9.checked = false;
}
}

if (id1== "trow10")
{
if(document.form1.trow10.checked == true)
{
document.form1.flag_m10.checked = true;
document.form1.flag_t10.checked = true;
document.form1.flag_w10.checked = true;
document.form1.flag_th10.checked = true;
document.form1.flag_f10.checked = true;
document.form1.flag_sa10.checked = true;
document.form1.flag_su10.checked = true;
}else
{
document.form1.flag_m10.checked = false;
document.form1.flag_t10.checked = false;
document.form1.flag_w10.checked = false;
document.form1.flag_th10.checked = false;
document.form1.flag_f10.checked = false;
document.form1.flag_sa10.checked = false;
document.form1.flag_su10.checked = false;
}
}

if (id1== "trow11")
{
if(document.form1.trow11.checked == true)
{
document.form1.flag_m11.checked = true;
document.form1.flag_t11.checked = true;
document.form1.flag_w11.checked = true;
document.form1.flag_th11.checked = true;
document.form1.flag_f11.checked = true;
document.form1.flag_sa11.checked = true;
document.form1.flag_su11.checked = true;
}else
{
document.form1.flag_m11.checked = false;
document.form1.flag_t11.checked = false;
document.form1.flag_w11.checked = false;
document.form1.flag_th11.checked = false;
document.form1.flag_f11.checked = false;
document.form1.flag_sa11.checked = false;
document.form1.flag_su11.checked = false;
}
}

if (id1== "trow12")
{
if(document.form1.trow12.checked == true)
{
document.form1.flag_m12.checked = true;
document.form1.flag_t12.checked = true;
document.form1.flag_w12.checked = true;
document.form1.flag_th12.checked = true;
document.form1.flag_f12.checked = true;
document.form1.flag_sa12.checked = true;
document.form1.flag_su12.checked = true;
}else
{
document.form1.flag_m12.checked = false;
document.form1.flag_t12.checked = false;
document.form1.flag_w12.checked = false;
document.form1.flag_th12.checked = false;
document.form1.flag_f12.checked = false;
document.form1.flag_sa12.checked = false;
document.form1.flag_su12.checked = false;
}
}




}



</script>


<!-- JS Page setting5.php -->
<SCRIPT SRC="libdetect.js"></SCRIPT>
<SCRIPT SRC="libslider.js"></SCRIPT>
<SCRIPT SRC="slider.js"></SCRIPT>

<script type="text/javascript">
function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.nextbtn2.click(); 

}
function update( )
{


document.getElementById("test").value=window.frames['frame1'].document.getElementById('slider1').value;
document.getElementById("test1").value=window.frames['frame2'].document.getElementById('slider1').value;
document.getElementById("test2").value=window.frames['frame3'].document.getElementById('slider1').value;
document.getElementById("test3").value=window.frames['frame4'].document.getElementById('slider1').value;
document.getElementById("test4").value=window.frames['frame5'].document.getElementById('slider1').value;
}
</script>


<!-- JS Page register1.php -->
<script type="text/javascript"> 
function capitalize(form) {
value = form.value.toLowerCase();
newValue = '';
value = value.split(' ');
for(var i = 0; i < value.length; i++) {
newValue += value[i].substring(0,1).toUpperCase() +
value[i].substring(1,value[i].length) + ' ';
}
form.value = newValue;
}
function SwitchImage()

{

var imgSource = document.getElementById('Bild').src ;

var e = document.getElementById("Gechleht"); 
var strUser = e.options[e.selectedIndex].text; 
var k = 0;
 if (imgSource == 'http://manimano.ch/images/profile/no_picture_he.jpg')
k = 1;
 if (imgSource == 'http://manimano.ch/images/profile/no_picture_she.jpg')
k = 1;
 if (imgSource == 'http://www.manimano.ch/images/profile/no_picture_he.jpg')
k = 1;
 if (imgSource == 'http://www.manimano.ch/images/profile/no_picture_she.jpg')
k = 1;
if (k == 1)
{
if (strUser== 'männlich')
{

document.getElementById('Bild').src="http://www.manimano.ch/images/profile/no_picture_he.jpg"  ;

  
  document.getElementById('imgn').value="http://www.manimano.ch/images/profile/no_picture_he.jpg"  ;

document.getElementById('imgn1').value="no_picture_he.jpg";
}

if (strUser== 'weiblich')
{
document.getElementById('Bild').src="http://www.manimano.ch/images/profile/no_picture_she.jpg" ;

document.getElementById('imgn').value="http://www.manimano.ch/images/profile/no_picture_she.jpg"  ;

document.getElementById('imgn1').value="no_picture_she.jpg"  ;

}


}

}

function Change(x)
{


if (x==1)
{
value = document.getElementById("Vorname").value.toLowerCase();
newValue = '';
value = value.split(' ');
for(var i = 0; i < value.length; i++) {
newValue += value[i].substring(0,1).toUpperCase() +
value[i].substring(1,value[i].length) + ' ';
}
document.getElementById("Vorname").value= newValue;

document.getElementById("order").value = 1;

}


if (x==2)
{
document.getElementById("order").value = 2;

}

document.Form1.submit();

}

</script> 