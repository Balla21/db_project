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
  
-- drop all tables
drop table project_user cascade constraints;
drop table course cascade constraints;
drop table crse_section cascade constraints;
drop table enroll cascade constraints;

-- user and student table
CREATE TABLE project_user (
    id varchar2(15) ,
    password varchar2(15),
    user_type numeric(1),
    student_user_type numeric(1),
    admin_user_type numeric(1),
    user_stud_id varchar2(8) primary key,
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

-- course table
  create table course(
    crse_numb varchar2(8) primary key,
    title varchar2(50) not null,
    description varchar2(100),
    credit_hrs numeric(1) not null
  );

-- section table
  create table crse_section(
    sect_id varchar2(10) primary key,
    sect_time varchar2(20),
    sect_semester varchar2(15),
    sect_year varchar2(4),
    sect_num_student numeric(2),
    sect_max_stud numeric(2),
    sect_deadline varchar2(15),
    sect_crse_numb varchar2(8) references course
  );

--enrollment table
create table enroll(
  enr_stud_id varchar2(8),
  enr_sect_id varchar2(10),
  enr_grade varchar2(1),
  enr_deadline varchar2(15),
  primary key (enr_stud_id,enr_sect_id),
  foreign key (enr_stud_id) references project_user(user_stud_id),
  foreign key (enr_sect_id) references crse_section(sect_id)
);


--insertion of user student type
insert into project_user (id,password,user_type,student_user_type,admin_user_type,user_stud_id,user_stud_lname,user_stud_fname,user_stud_age,user_stud_address,user_stud_city,user_stud_state,user_stud_zipcode,user_stud_type,user_stud_gpa,user_stud_probation) 
values ('toto','toto123',1,1,0,'tj123456','toto','jack',18,'101 uco park','edmond','oklahoma','73034',1,3.5,0);

-- insertion of courses
-- database
insert into course (crse_numb,title,description,credit_hrs)
values ('cmsc4003','database management','learning about the fundamentals of database',3);

-- linear algebra
insert into course (crse_numb,title,description,credit_hrs)
values ('math3143','linear algebra','fundamentals of matrices',3);

-- english
insert into course (crse_numb,title,description,credit_hrs)
values ('eng1113','english compostion','basics of general english',3);


-- insertion of section
-- database 
insert into crse_section (sect_id,sect_time,sect_semester,sect_year,sect_num_student,sect_max_stud,sect_crse_numb,sect_deadline)
values ('22090','4:15-5:30pm','Spring','2020',1,10,'cmsc4003','05-01-2020');

--linear algebra
insert into crse_section (sect_id,sect_time,sect_semester,sect_year,sect_num_student,sect_max_stud,sect_crse_numb,sect_deadline)
values ('22264','12:00-1:15pm','Spring','2020',1,10,'math3143','05-01-2020');

--english
insert into crse_section (sect_id,sect_time,sect_semester,sect_year,sect_num_student,sect_max_stud,sect_crse_numb,sect_deadline)
values ('31010','8:00-9:15am','Spring','2020',0,10,'eng1113','05-01-2020');

insert into crse_section (sect_id,sect_time,sect_semester,sect_year,sect_num_student,sect_max_stud,sect_crse_numb,sect_deadline)
values ('31000','10:15-11:55am','fall','2020',0,10,'eng1113','05-01-2020');

-- insertion into enroll
insert into enroll(enr_stud_id,enr_sect_id,enr_grade,enr_deadline) values ('tj123456','22090','B','05-01-2020');
insert into enroll(enr_stud_id,enr_sect_id,enr_grade, enr_deadline) values ('tj123456','22264','A','05-01-2020');



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

