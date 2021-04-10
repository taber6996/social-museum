CREATE TABLE Usuario (
	id_usuario int NOT NULL AUTO_INCREMENT,
    nick varchar(25),
    nombre varchar(25),
    passwd varchar(25),
    email varchar(25),
    es_admin boolean,
    es_artista boolean,
    es_premium boolean,
    es_juez boolean,
    primary key (id_usuario)
);
CREATE TABLE Exposicion(
	id_expo int NOT NULL AUTO_INCREMENT, 
    nombre varchar(25),
    es_premium boolean,
    activa boolean,
    PRIMARY KEY(id_expo)
);
CREATE TABLE Obra(
	id_obra int NOT NULL AUTO_INCREMENT,
    titulo varchar(25),
    id_autor int,
    descripcion varchar(255), 
    likes int,
    id_exposicion int,
    PRIMARY KEY(id_obra),
    CONSTRAINT FK_ObraUsuario FOREIGN KEY(id_autor) REFERENCES Usuario(id_usuario),
    CONSTRAINT FK_ObraExpo FOREIGN KEY(id_exposicion) REFERENCES Exposicion(id_expo)
);
CREATE TABLE Producto(
	id_producto int NOT NULL AUTO_INCREMENT,
    nombre varchar(25),
    precio double,
    descripcion varchar(255),
    unidades int,
    PRIMARY KEY(id_producto)
);
CREATE TABLE Dibujo(
	id_dibujo int NOT NULL AUTO_INCREMENT,
    nombre varchar(25),
    descripcion varchar(255),
    id_autor int NOT NULL,
    PRIMARY KEY(id_dibujo),
    CONSTRAINT FK_DibujoUsuario FOREIGN KEY(id_autor) REFERENCES Usuario(id_usuario)
);
CREATE TABLE Venta(
    id_venta int NOT NULL AUTO_INCREMENT
	id_usuario int NOT NULL, 
    id_producto int NOT NULL,
    PRIMARY KEY(id_venta),
    CONSTRAINT FK_VentaUsuario FOREIGN KEY(id_usuario) REFERENCES Usuario(id_usuario),
    CONSTRAINT FK_VentaProd FOREIGN KEY(id_producto) REFERENCES Producto(id_producto)
);
CREATE TABLE Puja(
	id_puja int NOT NULL AUTO_INCREMENT,
    id_propietario int NOT NULL,
    id_obra int NOT NULL,
    valor_ini double NOT NULL,
    valor_actual double NOT NULL,
    fecha_exp date NOT NULL,  
    ultimo_usuario int NOT NULL,
    PRIMARY KEY(id_puja),
    CONSTRAINT FK_PujaUsuario FOREIGN KEY(id_propietario) REFERENCES Usuario(id_usuario),
    CONSTRAINT FK_PujaUsuario2 FOREIGN KEY(ultimo_usuario) REFERENCES Usuario(id_usuario),
    CONSTRAINT FK_ObraPuja FOREIGN KEY(id_obra) REFERENCES Obra(id_obra)
);