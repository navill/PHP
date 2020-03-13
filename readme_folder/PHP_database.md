### MySQL

###### ```CREATE DATABASE opentutorials CHARACTER SET utf8 COLLATE utf8_general_ci;```

데이터베이스 opentutorials를 선택

```
use opentutorials;
```

데이터베이스 opentutorials 내에 테이블 topic을 생성

```
CREATE TABLE topic (
 id int(11) NOT NULL AUTO_INCREMENT,
 title varchar(255) NOT NULL ,
 description text NULL ,
 created datetime NOT NULL ,
 PRIMARY KEY (id)
);
```

show tables;

desc topic

### MySQL(DB) 제어

-----------

**4개의 제어문 : insert, select, delete, update**

**INSERT**

```INSERT INTO topic (title, descriptions, created) VALUES('html', 'html이란 무엇인가?', now());``` : table에 컬럼 추가

- now() : 현재 시간을 반환하는 database의 내장 함수 

**SELECT**

```SELECT * FROM topic;``` : topic의 모든 컬럼 조회

```SELECT id, title, created FROM topic;```

```SELECT * FROM topic WHERE id=1 OR id=1;``` : or을 이용한 복수의 아이템 검색

```SELECT * FROM topic ORDER BY id DESC; ``` : 오름차순 내림차순을 이용한 정렬

**UPDATE**

```UPDATE topic SET title='cascading style sheet', description='아름다움을 위한 언어' WHERE id=2;``` : field값 수정

**DELETE**

```DELETE FROM topic WHERE id=2;``` : id가 2에 해당하는 row(행)을 삭제





### PHP를 이용한 MySQL 연동

---

```mysql_connect('localhost', 'root', '1234');``` == ```mysql -uroot -p1234 -hlocalhost```

```mysql_select_db('opentutorials');``` == ```mysql$ use opentutorials```

```mysql_real_escape_string()``` : 외부 보안 공격을 막기 위해서 사용자가 값을 입력할 경우 반드시 사용해야한다.