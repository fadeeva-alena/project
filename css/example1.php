<?php
   include("geocode.class.php");
?>
<html>
   <head>
      <title>Geocode class test</title>
   </head>
   <body>
      <H1>Geocode class test</H1>
      <FORM method="POST">
         <TABLE border="1" cellpadding="3" cellspacing="2">
            <TR>
               <TD>Location:</TD>
               <TD><INPUT type="text" name="location" size="100" value="<?php echo $location; ?>" /></TD>
            </TR>
            <TR>
               <TD>Address:</TD>
               <TD><INPUT type="text" name="address" size="100" value="<?php echo $address; ?>" /></TD>
            </TR>
            <TR>
               <TD>City:</TD>
               <TD><INPUT type="text" name="city" size="100" value="<?php echo $city; ?>" /></TD>
            </TR>
            <TR>
               <TD>Country:</TD>
               <TD><INPUT type="text" name="country" size="100" value="<?php echo $country; ?>" /></TD>
            </TR>
            <TR>
               <TD>State:</TD>
               <TD><INPUT type="text" name="state" size="100" value="<?php echo $state; ?>" /></TD>
            </TR>
            <TR>
               <TD>Zip:</TD>
               <TD><INPUT type="text" name="zip" size="100" value="<?php echo $zip; ?>" /></TD>
            </TR>
            <TR>
               <TD>Zoom level:</TD>
               <TD><INPUT type="text" name="level" size="100" value="<?php echo $level; ?>" /></TD>
            </TR>
            <TR>
               <TD>Result:</TD>
               <TD><INPUT type="radio" name="result" value="1" checked /> Lat/Long array
                   <INPUT type="radio" name="result" value="2" <?php echo $result==2 ? " checked" : ""; ?>/> Google Maps API
                   <INPUT type="radio" name="result" value="3" <?php echo $result==3 ? " checked" : ""; ?>/> Virtual Earth API
               </TD>
            </TR>
            <TR>
               <TD align="right" colspan="2"><INPUT type="submit" name="Seek" value="Seek" /></TD>
            </TR>
         </TABLE>
      </FORM>
      <?php
         if( $Seek ) {
            $tmp = new geocode( $location, $address, $city, $country, $state, $zip );
            if( $result == 2 ) {
               echo "<PRE>" . $tmp->api( $level, "gm" ) . "</PRE>";
            } elseif( $result == 3 ) {
               echo "<PRE>" . $tmp->api( $level, "ve" ) . "</PRE>";
            } else {
               echo "<PRE>"; print_r( $tmp->locate() ); echo "</PRE>";
            }
         }
      ?>
   </body>
</html>      