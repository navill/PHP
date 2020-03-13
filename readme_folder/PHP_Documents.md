# PHP documents

##### Date and Time Related Extensions

- 날짜 및 시간 관련 함수

##### Image Processing and Generation

- GD : 이미지 처리를 위해 주로 사용되는 라이브러리

##### Mail Related Extensions

- Mail : 메일 송수신을 위한 라이브러리

##### Database Extensions



# Session

```php
if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
    if(session_status() == PHP_SESSION_NONE) {
        session_start(array(
          'cache_limiter' => 'private',
          'read_and_close' => true,
)); }
}
```

- 에러 없이 session이 없을 때, 세션을 생성하는 코드

---

- 다음과 같은 코드는 SQL injection에 매우 위험하다.

```php
$sql = 'SELECT name, email, user_level FROM users WHERE userID = ' . $_GET['user'];
$conn->query($sql);
```

- 따라서 다음과 같이 named placeholder를 이용하거나 positional placeholder 방식을 이용해야 한다.

```php
// using named placeholders
$sql = 'SELECT name, email, user_level FROM users WHERE userID = :user';
$prep = $conn->prepare($sql);
$prep->execute(['user' => $_GET['user']]); // associative array
$result = $prep->fetchAll();

// using question-mark placeholders
$sql = 'SELECT name, user_level FROM users WHERE userID = ? AND user_level = ?';
$prep = $conn->prepare($sql);
$prep->execute([$_GET['user'], $_GET['user_level']]); // indexed array
$result = $prep->fetchAll();
```

