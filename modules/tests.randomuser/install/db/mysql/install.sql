create table if not exists b_tests_randomuser_user(
  id int(18) not null auto_increment,
  gender char(6) not null,
  name_title varchar(255) not null,
  name_first varchar(255) not null,
  name_last varchar(255) not null,
  location_street varchar(255) not null,
  location_city text not null,
  location_state varchar(255) not null,
  location_postcode varchar(255) not null,
  email varchar(255) not null,
  login_username varchar(255) not null,
  login_password varchar(255) not null,
  login_salt varchar(255) not null,
  dob timestamp not null default now(),
  registered timestamp not null default now(),
  nat char(2) not null,
  picture_large text not null,
  picture_medium text not null,
  picture_thumbnail text not null,
  primary key (id)
);