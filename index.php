<!DOCTYPE html>
<head>
	<title>Serwer dom</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div>
		<h4>Kontrola komputera:</h4>
		<ul>
			<li>Wy³¹cz</li>
			<li>Restart</li>
		</ul>
	</div>
<?php
	
	function display_folders($path, $folders)
	{
		if ($path != 'Publiczny/')
		{
			echo '<img src="Images/folder.png" height="32" width="32" alt="Folder" />';
			echo ('<a href="?path='.$path.'../">Cofnij</a><br />'); 
		}
		foreach($folders as $item)
		{
			echo '<img src="Images/folder.png" height="32" width="32" alt="Folder" />';
			echo ('<a href="?path='.$path.$item.'/">'.$item.'</a><br />'); 
		}
	}
	
	/*function display_gallery($path, $images)
	{
		echo ('<div class="css_gallery"><ul>');
		foreach($images as $img)
		{
			echo ('<li><img class="mini_pic" src="'.$path.$img.'" alt="'.$img.'" /><div><img class="mini_pic" src="'.$path.$img.'" alt="'.$img.'" /><p></p></div></li>');
		}
		echo ('</ul></div>');
	}*/
	function display_gallery($path, $images)
	{
		echo '<ul id="left">';
		$i = 0;
		foreach($images as $img)
		{
			echo '<li><a href="#i'.$i++.'">'.$img.'</a>';
		}
		echo '</ul><ul id="right">';
		$i = 0;
		foreach($images as $img)
		{
			echo '<li id="i'.$i++.'"><img src="'.$path.$img.'" alt="Zdjecie nie zaladowane"></li>';
		}
		echo '</ul>';
	}
	
	
	function display_other_files($path, $files)
	{
		foreach($files as $item)
		{
			echo '<img src="Images/file.png" height="32" width="32" alt="File" />';
			echo ('<a href="download.php?download_file='.$path.$item.'">'.$item.'</a><br />'); 
		}
	}
	
	function show_directory($path) 
	{
		$folders = array();
		$images = array();
		$others = array();
		//echo ( '<img src="Images/folder.gif" alt="Folder" /><a href="?path='.$path.'../">cofnij</a><br />'); 
		$dir = opendir($path);
		while(false !== ($file = readdir($dir)))
		{
		  if($file != '.' && $file != '..') 
		  {
			if ( is_dir($path.$file) )
			{
				$folders[] = $file;
			}
			else 
			{
				$inf = pathinfo($path.$file);
				$ext = strtolower($inf['extension']);
				if ($ext =="jpg" || $ext =="pjpeg" || $ext =="jpeg" || $ext =="gif")
				{
					$images[] = $file;
				}
				else 
				{
					$others[] = $file;
				}
			}
		  }
		}
		
		display_folders($path, $folders);
		display_other_files($path, $others);
		display_gallery($path, $images);
	}
	
	$path = 'Publiczny/';
	if (isset($_GET['path']) )
		$path = $_GET['path'];
	
	echo $path.'<br />';
	
	show_directory($path);
?>

</body>
</html>