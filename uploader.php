<?php
include ("includes/functions.php");
include ("includes/session.php");

$file = $_FILES['file'];

$allowedExtensions = array("txt", "rtf", "doc", "DOC", "RTF", "TXT", "PDF", "pdf", "docx", "DOCX", "ppt", "PPT", "XLS", "xls", "XLSX", "xlsx", "pptx", "PPTX");

function isAllowedExtension($fileName)
{
  global $allowedExtensions;
  return in_array(end(explode(".", $fileName)), $allowedExtensions);
}

if($file['error'] == UPLOAD_ERR_OK)
{
    echo $file['name'];
  if((isAllowedExtension($file['name'])) )     
  {
    echo "enteed";
    if ($_FILES["file"]["error"] > 0)
    {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        
      //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
      //echo "Type: " . $_FILES["file"]["type"] . "<br />";
      //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
      //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
      if (file_exists("docs/" . $_FILES["file"]["name"]))
      {
        //echo $_FILES["file"]["name"] . " already exists. ";
        redirect_to("noticeboard.php?up=rpt& mysel={$_POST['myselect']}");
      }
      else
      {
      
         
         //$path_parts = pathinfo($t);
        //$FileName = $path_parts['filename'];
        //echo $FileName;
        
        $actual_filename = basename($file['name']);
        //$extension = pathinfo($actual_filename, PATHINFO_EXTENSION);
        $new_filename = "{$_SESSION['user_id']}_{$_POST['myselect']}_{$file['name']}";
        
        move_uploaded_file($_FILES["file"]["tmp_name"],
        "docs/" . $new_filename);
        //echo "Stored in: " . "docs/" . $_FILES["file"]["name"];
         redirect_to("noticeboard.php?up=ok");
        
      }
    }
  }
}
else
{
  redirect_to("noticeboard.php?up=invalid");
}
?> 