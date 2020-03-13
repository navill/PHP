### DB Table - PHP(MySQL)

```mysql
CREATE TABLE board_post (
    id  int(11) NOT NULL AUTO_INCREMENT,
		user_number int(11) NOT NULL, 
    title  varchar(255) NOT NULL ,
    description  text NULL ,
    created  datetime NOT NULL ,
    PRIMARY KEY (id),
		FOREIGN KEY (user_number) REFERENCES board_user (number) ON DELETE CASCADE
);

CREATE TABLE board_user (
    number  int(11) NOT NULL AUTO_INCREMENT,
    id char(20) NOT NULL ,
    password char(15) NOT NULL ,
    name char(10) NOT NULL, 
    PRIMARY KEY (number),
);
```

**회원 등록 query** : INSERT INTO board_user (id, password, name) VALUES ('amdin_id', '1234', 'jihoon');

**게시글 등록 query** : INSERT INTO board_post (user_number, title, description, created) VALUES ('1', 'test', 'test description', now());



UPDATE

```
-- 갱신
UPDATE board_user SET id='admin_id' WHERE number='1';
-- 삭제
DELETE FROM dept WHERE dept_no='1003';
```





### html에 작성된 php 코드가 주석처리 될 경우 

**/ect/httpd/conf/httpd.conf**

**-> "my root : /apache2/conf/httpd.conf & ~/conf/original/httpd.conf"**

**AddType application/x-httpd-php .ph .php .php3 .inc .html** 