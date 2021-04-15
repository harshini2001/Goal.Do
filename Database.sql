create database GoalTracker;
use GoalTracker;
create table User(
u_id int,
u_name varchar(20),
mail_id varchar(20),
password varchar(20),
u_profession varchar(20),
primary key(u_id)
);

create table GoalHistory(
g_id int,
g_name varchar(20),
g_desc varchar(100),
startDate date,
endDate date,
isCompleted bool,
g_category varchar(15),
isRemainderRequired bool,
reminderTiming datetime,
doRemainderrepeat bool,
u_id int,
primary key(g_id),
foreign key(u_id) references User(u_id)
);
desc User;
desc GoalHistory;

select * from User;
use GoalTracker;
drop database GoalTracker;

insert into user values(1,'Hars','12','ad@','dfd');