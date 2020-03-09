/*drop table myclientsession cascade constraints;
drop table myclient cascade constraints;

create table myclient (
  clientid varchar2(8) primary key,
  password varchar2(12)
);

create table myclientsession (
  sessionid varchar2(32) primary key,
  clientid varchar2(8),
  sessiondate date,
  foreign key (clientid) references myclient
);
*/
  
 
drop table project_user cascade constraints;

CREATE TABLE project_user (
    id varchar2(15) primary key,
    password varchar2(15),
    user_type numeric(1),
    student_user_type numeric(1) ,
    admin_user_type numeric(1) );


--insertion of user student type
insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('toto','toto123',1,1,0);

insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('tata','tata123',1,0,0);

insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('tutu','tutu123',1,0,0);

insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('titi','titi123',1,0,0);    


--insertion of user administrator type
insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('john','john123',1,0,1);

insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('sue','sue123',1,0,1);

insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('doe','doe123',1,0,1);

insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('karl','karl123',1,0,1);    


--insertion of user student-administrator type
insert into project_user (id,password,user_type,student_user_type,admin_user_type) 
values ('kone','kone123',1,1,1);


commit;