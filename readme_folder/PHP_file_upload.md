<upload_html.html : 이미지를 업로드 하기 위해 client에 보여질 html 페이지>

```html
<!DOCTYPE html>
<html>
	<head>
		<body>
			<form method="post" action="upload_php.php" enctype="multipart/form-data">
				<!-- hidden : file 보다 위에 지정되어야 파일의 크기를 정할 수 있다.-->
				<input type="hidden" value="30000" name="MAX_FILE_SIZE">  
				<input type="file" name="userfile">
				<input type="submit" value="upload">
			</form>
		</body>
	</head>
</html>
```

<upload_php.php : image를 실제로 업로드 하기 위한 php 파일>

```php+HTML
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
		ini_set("display error", "1");  
		$uploaddir = '/Applications/mampstack-7.3.6-2/apache2/htdocs/number_php/files/';
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']); 
		echo '<pre>';
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
			echo "유효한 파일, 업로드 성공\n";
		} else {
			echo "파일 업로드 공격 가능성\n";
		}
		echo '자세한 디버깅 정보:';
		print_r($_FILES);
		print "</pre>";
		?>
		<img src="files/<?=$_FILES['userfile']['name']?>">
	</body>
</html>
```

**ini_set("display error", "1")**: runtime 설정 (upload 시, 에러가 많이 발생하기 때문에 에러 출력)

**$uploaddir**: 임시 디렉토리에 저장된 파일을 uploaddir에 저장하기 위해 사용

**\$uploadfile**: 실제 저장되기 위해 사용될 파일 이름과 위치 지정

**basename**: 경로를 제외한 실제 파일 이름을 리턴한다. -> 보안상 경로를 노출시키지 않기 위해 사용

**$_FILES**: file의 정보를 나타냄

- **\['userfile']**: html로 부터 넘어온 name='userfile'
- **\['name']**: file의 실제 이름

**move_uploaded_file()**: file 경로, 이동 경로 - 내부적으로 유효성 검사를 하기 때문에 파일 이동 시 이 함수를 사용해야한다.

- **\['temp_name]**: 임시 디렉토리 주소
  - 파일은 실제로 한꺼번에 넘어오지 않고 임시 디렉토리에 저장 -> 유효성 검사-> 지정된 디렉토리에 저장

**$print_r** : var_dump와 유사한 기능





# Image(GD)

```php
<?php
	header("Content-type: image/png");
	$string = $_GET['text'];
	$im = imagecreatefrompng("button.png");
	$orange = imagecolorallocate($im, 60, 87, 156);
	$px = (imagesx($im) - 7.5 * strlen($string)) / 2;
	imagestring($im, 4, $px, 9, $string, $orange);
	imagepng($im)
	imagedestroy($im)
?>
```



