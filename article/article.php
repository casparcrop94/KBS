<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="../scripts/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
		language : "en",
 
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,|,jbimages",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
 
		// This is required for the image paths to display properly
		relative_urls : false,
 
		// Style formats (OPTIONAL)
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		]
	});
</script>


</head>

<body>
<?php
//Include files to connect with database
include DOCROOT . 'inc/mysql.inc.php';
//include function.php
include DOCROOT . 'article/function.php';

//Check if form is submitted
if(isset($_POST['submit']))
{
    //Get data from form and set data into variable.
    $option = $_POST['option'];
	$id = $_POST['id'];
	
	$title = $_POST['title'];	
	$category = $_POST['category'];
    $date_added = $_POST['date_added'];
    $date_edited = $_POST['date_edited'];
    $text = $_POST['text'];
	$published = $_POST['published'];
	
	$date_added = date('Y-m-d H:i:s', strtotime($date_added));
    $date_edited = date('Y-m-d H:i:s', strtotime($date_edited));
	
	if($option=='new')
	{
		//Insert new article
		$db = connectToDatabase();
		$sth = $db->prepare ("INSERT INTO article (cat_id, date_added, date_edited, title, text, published) 
		VALUES ('$category','$date_added','$date_edited','$title', '$text','$published')");
		$result=$sth->execute();
	}
	elseif($option=='edit')
	{
		//Edit an article
		$db = connectToDatabase();
		$sth = $db->prepare ("UPDATE article SET 
								cat_id='$category',
								date_added='$date_added',
								date_edited='$date_edited',
								title='$title',
								text='$text',
								published='$published'
								WHERE ID=$id");
		$result=$sth->execute();
	}
	
	if($result==1)
	{
		$case="succes";
	}
	else
	{
		$case="fail";
	}
header("Location: index.php?case=".$case);

}

//Get option
$option= isset($_GET["option"])?$_GET['option']:'new';

//Check which option is to be used.
if($option=='new'){
	$date_added=date('d-m-Y H:i:s');
	$date_edited=date('d-m-Y H:i:s');
	$title =''; 
	$category ='';
	$text = '';
	$published =" selected";
	$unpublished ='';
}
elseif($option=='edit'){
	$id= isset($_GET["id"])?$_GET['id']:'';
	$content = get_content($id);
	foreach($content as $row)
	{
		$title =$row["title"]; 
		$category =$row["cat_id"];
		$date_added =$row["date_added"];
		$date_added = date('d-m-Y H:i:s', strtotime($date_added));
		$date_edited =date('d-m-Y H:i:s');
		$text = $row["text"];
		$published = $row["published"];
	}
	if($published==1)
	{
		$published=" selected";
		$unpublished='';
	}
	else
	{
		$published='';
		$unpublished=" selected";
	}
}


?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input name="option" type="hidden" value="<?php echo $option; ?>" />
<input name="id" type="hidden" value="<?php echo $id; ?>" />	
<table>
	<tr>
    	<td colspan="2">
        	Titel:
        </td>
    </tr>
    <tr>
        <td colspan="2">
        	<input name="title" type="text" size="80" value="<?php echo $title; ?>"/>
        </td>
    </tr>
    <tr>
    	<td width="150">
        	Categorie:
        </td>
        <td>
        	<select name="category">
    		<?php 
			$cat = getcategory();
			foreach($cat as $row)
			{
				$id = $row["cat_id"];
				$name = $row["name"];
				if($id==$category)
				{
					$selected=" selected";
				}
				else
				{
					$selected='';
				}
				print("<option value=$id".$selected.">"); 
				print($name."</option>"); 
			}
        	?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>
        	Aanmaakdatum:
        </td>
        <td>
        	<input name="date_added" type="text" value="<?php echo $date_added; ?>"/>
        </td>
    </tr>
    <tr>
    	<td>
        	Laatst bijgewerkt op:
        </td>
        <td>
        	<input name="date_edited" type="text" value="<?php echo $date_edited; ?>"/>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	Text:
       	</td>
    </tr>
    <tr>
        <td colspan="2">
        	<textarea name="text" rows="20" cols="70"><?php echo $text; ?></textarea>
        </td>
    <tr />
    <tr>
    	<td>
        	Status:
        </td>
        <td>
        	<select name="published">
    			<option value="1"<?php echo $published; ?>>Gepubliceerd</option>
        		<option value="0"<?php echo $unpublished; ?>>Gedepubliceerd</option>
   			 </select>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	<input type="submit" value="Opslaan" name="submit" />
            <input type="button" name="Cancel" value="Annuleren" onclick="window.location = 'overview.php' " />
        </td>
    </tr>
</table> 
	
</form>


</body>
</html>