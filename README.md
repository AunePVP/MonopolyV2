Monopoly Game
=============
## Monopoly Game, which connects the iconic bord game with the new technological world.

### Installation Walkthrough
**Create a Database called `monopoly`**
```
create database monopoly;
use monopoly;
```
**Create a user table**
```
create table users
(
    id int NOT NULL AUTO_INCREMENT,
    username    varchar(15) NOT NULL,
    displayname varchar(15) NOT NULL,
    password    varchar(100) NOT NULL,
    PRIMARY KEY (id)
);
```
**Create two Tables and insert data**
```
create table players1
(
id      int                     NOT NULL,
name    varchar(16) default '0' NOT NULL,
streets json                    NOT NULL,
money   int                     NOT NULL
);
INSERT INTO players1 VALUES (1,0,'[0]',1500),(2,0,'[0]',1500),(3,0,'[0]',1500),(4,0,'[0]',1500),(5,0,'[0]',1500),(6,0,'[0]',1500),(7,0,'[0]',1500),(8,0,'[0]',1500);
create table streets1
(
id     text NOT NULL,
houses int  NOT NULL
);
INSERT INTO streets1 VALUES ('I',0),('II',0),('III',0),('IV',0),('V',0),('VI',0),('VII',0),('VIII',0),('IX',0),('X',0),('XI',0),('XII',0),('XIII',0),('XIV',0),('XV',0),('XVI',0),('XVII',0),('XVIII',0),('XIX',0),('XX',0),('XXI',0),('XXII',0),('XXIII',0),('XXIV',0),('XXV',0),('XXVI',0),('XXVII',0),('XXVIII',0),('XXIX',0),('XXX',0);

```
 