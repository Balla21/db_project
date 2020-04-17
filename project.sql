/*
drop table myclientsession cascade constraints;
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
    student_user_type numeric(1),
    admin_user_type numeric(1),
    user_stud_id varchar2(8),
    user_stud_lname varchar2(10),
    user_stud_fname varchar2(20),
    user_stud_age numeric(2),
    user_stud_address varchar2(40),
    user_stud_city varchar2(40),
    user_stud_state varchar2(40),
    user_stud_zipcode varchar2(6),
    user_stud_type numeric(1), --undergraduate(1)/graduate(2)
    user_stud_gpa numeric(3,2),
    user_stud_probation numeric(1) --no probation(0)/probation(1)
   );


--insertion of user student type
insert into project_user (id,password,user_type,student_user_type,admin_user_type,user_stud_id,user_stud_lname,user_stud_fname,user_stud_age,user_stud_address,user_stud_city,user_stud_state,user_stud_zipcode,user_stud_type,user_stud_gpa,user_stud_probation) 
values ('toto','toto123',1,1,0,'tj123456','toto','jack',18,'101 uco park','edmond','oklahoma','73034',1,3.5,0);

commit;

/*
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
*/

