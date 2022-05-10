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

insert into CategoryPage(category_id, title, body) values (1, "Books", "This is a page that contains all of my books");
insert into CategoryPage(category_id, title, body) values (2, "Movies", "This is a page that contains all of my movies");
insert into CategoryPage(category_id, title, body) values (4, "Video Games", "This is a page that contains all of my video games");
update Category set used = true where id in (1,2,4);

insert into Media(category_id, media_name, year, creator, genre) values(1, "Scythe", 2016, "Neal Shusterman", "Dystopian");
insert into MediaPage(media_id, title, heading, body) values (last_insert_id(), "Scythe", "Scythe", "My favorite book");
insert into Media(category_id, media_name, year, creator, genre) values(1, "Thunderhead", 2018, "Neal Shusterman", "Dystopian");
insert into MediaPage(media_id, title, heading, body) values (last_insert_id(), "Thunderhead", "Thunderhead", "Part of my favorite book series");
insert into Media(category_id, media_name, year, creator, genre) values(1, "The Toll", 2019, "Neal Shusterman", "Dystopian");
insert into MediaPage(media_id, title, heading, body) values (last_insert_id(), "The Toll", "The Toll", "Part of my favorite book series");
insert into Media(category_id, media_name, year, creator, genre) values(4, "Minecraft", 2011, "Mojang", "Sandbox");
insert into MediaPage(media_id, title, heading, body) values (last_insert_id(), "Minecraft", "Minecraft", "A great game");
