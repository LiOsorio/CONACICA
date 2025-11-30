use conacica

create table  promocional(
	promocionalId int primary key not null auto_increment,
	titulo VARCHAR(100) not NULL,
	descripcion varchar(400) not null,
	url varchar(200) not null,
	img varchar(100)
);
drop table promocional

insert into promocional values (1,'Sabor autentico con productos 100% mexicanos',' En nuestro restaurante, la autenticidad es la base. Utilizamos ingredientes 100% mexicanos, frescos y de origen local, para recrear los sabores tradicionales que cuentan la historia de nuestro país.
Conozca nuestra cocina, un punto de encuentro entre la tradición y el sabor más puro.','#','promocional.jpg');

create table alianzas(
	id int primary key auto_increment,
	img varchar(100) not null,
	nombre varchar(150) not null,
	active bool
);


