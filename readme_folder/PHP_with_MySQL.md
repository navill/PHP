# PHP7(PDO) + MySQL

### **Connection**

```php
$db = new PDO("mysql:dbname=board_test;host=localhost:3306", "jihoon", "1234");
```

- db에 접속하기 위해 new PDO 객체를 생성한다.
- 쿼리는 prepare함수를 이용한 쿼리 셋팅 -> 쿼리에 들어갈 변수 및 변수 값 할당 -> 실행(execute()) 순서로 진행된다.

### Insert

```php
$stmt = $dbh->prepare("INSERT INTO topic (title, description, created) VALUES (:title, :description, now())");
$stmt->bindParam(':title',$title);
$stmt->bindParam(':description',$description);

$title = $_POST['title'];
$description = $_POST['description'];
$stmt->execute();

```

- ```bindParam``` : query문에 사용된 values의 값과 php에서 사용될 변수를 바인딩하기 위해 사용되는 함수.
  - ```bindParam``` vs ```bindValue``` : bindParam은 레퍼런스를 바인딩하기 때문에 변수를 할당하면 values에 바인딩된 값에 반영되지만, bindValue는 값을 반환하기 때문에 변수에 새로운 값을 할당하여도 values에 해당하는 값은 반영되지 않는다. 

- ```stmt->excute()``` : ```$db_object->preapre("query statements");``` 에 해당하는 실제 쿼리문이 동작하도록 실행한다.

### Update

```php
$stmt = $dbh->prepare('UPDATE topic SET title = :title, description = :description WHERE id = :id');
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':id', $id);

$title = $_POST['title'];
$description = $_POST['description'];
$id = $_POST['id'];
$stmt->execute();
header("Location: list.php?id={$_POST['id']}");
```



### Delete

```php
$stmt = $dbh->prepare('DELETE FROM topic WHERE id = :id');
$stmt->bindParam(':id', $id);

$id = $_POST['id'];
$stmt->execute();
header("Location: list.php"); 
break;
```

