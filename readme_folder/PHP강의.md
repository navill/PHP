# PHP

### Server Side Script(Tech)

서버는 apach, nginx IIS - PHP, python, java - MySQL, Oracle 으로 구성된다.

Web Server : Apach, IIS, Nginx, ...

Middleware : uwsgi, tomcat, … 

Web Application : PHP, python, java, ...

**CGI(Common Gateway Interface)** : Web server 와 application engine 사이의 통신 규약

--------------------------------

### **PHP(Hypertext(html) Preprocessor)** - 대부분 web hosting에 기본적으로 설치가 되어있다.



#### php array[https://www.php.net/manual/en/ref.array.php]

- array_shift : list의 맨 앞 값을 제거
- array_unshift : list의 맨 앞에 값을 추가
- array_push : list의 맨 뒤에 값을 추가
- array_pop : list의 맨 뒤에 값을 제거
- sort : list 정렬
- rsort : list 역으로 정렬

#####  연관 배열(associative array - python의 dictionary와 유사)

```php
<?php
$grades = array('egoing'=>10, 'k11'=>20);
$grades2 = [];
$grades2['egoing'] = 10;
$grades2['k11'] = 20;
?>
```

##### 열거 - 배열에 담긴 값을 하나씩 추출

```php
<?php
$grades = array('egoing'=>10, 'k11'=>20);
foreach($grades as $key => $value){
  echo "key:{key} value:{$value} <br/>"
}
?>
```



- include(include_once) : 포함하려는 파일이 없거나 permission이 없을 경우 warning
- require(require_once) : 포함하려는 파일이 없거나 permission이 없을 경우 fatal 에러 발생

##### namespace

```php
# greeting_en.php
<?php
namespace language\en;
function welcome(){
	return 'hello';
}
?>
# greeting_ko.php
<?php
namespace language\en;
function welcome(){
	return '안녕';
}
?>
# greeting.php
<?php
  require_once 'greeting_ko.php';
  require_once 'greeting_en.php';
	echo language\ko\welcome();
	echo language\en\welcome();
?>
```



### File[https://www.php.net/manual/en/function.file.php]

```php
# file copy
<?php
$file = 'readme.txt';  # 원본
$newfile = 'example.txt.bak';  # 복사될 새 파일
 
if (!copy($file, $newfile)) {
 echo "failed to copy $file...\n";
}
?>
# file delete
<?php
	unlink('delete.txt');  # 삭제 대상
?>
```

##### Read & write

```php
# file_get_contents
<?php 
$file = './readme.txt';
echo file_get_contents($file);  # text 형태의 파일을 불러올 때 사용
?>
# file_put_contents
<?php
$file = './writeme.txt';
file_put_contents($file); # 파일을 읽어들일 때 사용할 수 있다.
?>
  
<?php
  $homepage = file_get_contents(;http://php.net/manual/en/function.file-get-contents.php');
?>
```

- ##### **fopen**

  ```php
  # definition of fopen
  fopen ( string $filename , string $mode [, bool $use_include_path = FALSE [, resource $context ]] ) : resource
  # example fopen 
  <?php
  $handle = fopen("/home/rasmus/file.txt", "r");
  $handle = fopen("/home/rasmus/file.gif", "wb");
  $handle = fopen("http://www.example.com/", "r");
  $handle = fopen("ftp://user:password@example.com/somefile.txt", "w");
  ?>
  ```

  

**파일을 다룰 때 permission 문제가 발생 할 경우(읽기)** 

```ubuntu:/var/www/file$ sudo chown www-data{그룹} readme.txt``` : readme.txt의 소유권을 www-data 그룹에 부여한다.

**파일을 다룰 때 permission 문제가 발생 할 경우(쓰기)**

- 실행 파일이 있는 디렉토리에 write 권한이 있어야 한다.

```ubuntu:/var/www/file$ sudo chown www-data{그룹} .``` : 현재 디렉토리의 소유권을 www-data 그룹에 부여한다.

- 읽거나 쓰기 여부 확인

  ```php
  # read
  if (is_readable($filename)){
  ...
  } else{
  	echo "can't read data";
  }
  # write
  if (is_writable($filename)){
  ...
  } else{
  	echo "can't write data"
  }
  # exist
  if (file_exists($filename)){
    ehco "this file $filename exists";
  } else{
    ...
  }
  ```

##### 디렉토리 제어하기

```php
<?php
  echo getcwd().<br/>;  # 현재 경로 확인
	chdir('../');  # 부모 디렉토리로 경로 변경
  echo getcwd().<br/>;
?>
```

##### **디렉토리 탐색 / 생성**

```php
# directory 탐색
<?php
  $dir = './';
	$file1 = scandir($dir);  # directory 검색 후 출력
	$file2 = scandir($dir, 1);  # 역정렬된 directory 출력

	print_r($fiel1); 
	print_r($fiel2);
?>
# directory 생성
<?php
  mkdir("1/2/3/4", 0700, true);
	# mkdir(directory name, chmod, 경로가 없을 경우 새로 생성)
?>
```

