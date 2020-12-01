create table users (
	id int(11) primary key auto_increment,
    username varchar(255) not null unique,
    password varchar(255) not null,
    email varchar(255) not null
);

create table todo (
	id int(11) primary key auto_increment,
    todo varchar(255) not null,
    user int(11),
    foreign key (user) references users (id)
    );
    
insert into users values (null, 'ricardo', 123456789, 'rochedooo@hotmail.com');
insert into users values (null, 'adriana', 123456789, 'adrianagreco@hotmail.com');

alter table users add (email varchar(255) not null unique);