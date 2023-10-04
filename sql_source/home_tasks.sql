create table home_access
(
    id_user int not null,
    id_home int not null
);

create table homes
(
    id        int auto_increment
        primary key,
    creator   int                  not null,
    name      text                 not null,
    protected tinyint(1) default 1 not null,
    password  text                 null
);

create table tokenlink
(
    id    int  not null,
    token text not null
);

alter table tokenlink
    add primary key (id);

alter table tokenlink
    add constraint id
        unique (id);

alter table tokenlink
    add constraint token
        unique (token) using hash;

create table users
(
    id       int auto_increment
        primary key,
    username text not null,
    password text not null
);

alter table homes
    add constraint fk_homes_creator_id
        foreign key (creator) references users (id)
            on update cascade on delete cascade;

alter table tokenlink
    add constraint fk_tokenlink_id
        foreign key (id) references users (id)
            on update cascade on delete cascade;

alter table users
    add constraint username
        unique (username) using hash;

