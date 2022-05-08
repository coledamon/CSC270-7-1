drop database if exists MediaLibrary;
create database MediaLibrary;
use MediaLibrary;

CREATE USER if not exists 'MyUser'@'localhost' IDENTIFIED BY 'MyPass';
GRANT ALL PRIVILEGES ON MediaLibrary.* TO MyUser@localhost; 
FLUSH PRIVILEGES;

create table if not exists Users (
	primary key(id),
    id				int				not null	auto_increment,
	username		varchar(100)	not null	unique,
	password_hash	varchar(100)	not null
);

create table if not exists Category(
	primary key(id),
    id				int			not null	auto_increment,
    category_name	varchar(50)	not null,
    used			bit			default 0
);

create table if not exists Media(
	primary key(id),
    foreign key(category_id) references Category(id) on delete cascade,
    id				int		not null	auto_increment,
    category_id		int		not null,
    media_name		varchar(500) not null,
    year			year,
    creator			varchar(100),
    genre			varchar(200),
    link			varchar(5000)
);

create table if not exists CategoryPage (
	primary key(id),
    foreign key(category_id) references Category(id) on delete cascade,
	id				int				not null	auto_increment,
    category_id		int				not null	unique,
    title			varchar(50),
    body			varchar(5000)
);

create table if not exists MediaPage (
	primary key(id),
    foreign key(media_id) references Media(id) on delete cascade,
    id					int				not null	auto_increment,
    media_id			int				not null,
    title				varchar(50),
    heading				varchar(200),
    body				varchar(5000)
);

insert into Category(category_name) values('Book');
insert into Category(category_name) values('Movie');
insert into Category(category_name) values('Game');
insert into Category(category_name) values('Video Game');
insert into Category(category_name) values('Magazine');
insert into Category(category_name) values('Song');