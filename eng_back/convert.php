<?php
  $strInput = "search.php";
  $strOutput = "new-es.php";

  if ($objInput = fopen($strInput, "r"))
  {
    if ($objOutput = fopen($strOutput, "w"))
    {
      $iByteCounter = 0;
      // Copy the file, ignoring the first three bytes
      while (($cByte = fgetc($objInput)) !== false)
        if ($iByteCounter++ > 2)
          fwrite($objOutput, $cByte);

      echo "<p>Removed Byte-Order Mark from $strInput into $strOutput.</p>\n";
      fclose($objOutput);
    }
    else
      echo "<p>Can't open the output file</p>\n";
    fclose($objInput);
  }
  else
    echo "<p>Can't open the input file</p>\n";
?>