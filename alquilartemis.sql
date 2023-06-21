-- SQLBook: Code

-- Active: 1684843862427@@127.0.0.1@3306@phpmyadmin

CREATE DATABASE alquilartemis;

USE alquilartemis;

CREATE TABLE
    Cliente (
        cliente_id INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50),
        direccion VARCHAR(100),
        telefono INT,
        email VARCHAR(50)
    );

CREATE TABLE
    Empleado (
        empleado_id INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(50),
        direccion VARCHAR(100),
        telefono VARCHAR(20),
        email VARCHAR(50),
        cargo VARCHAR(50),
        password VARCHAR(50),
        salario INT
    );

CREATE TABLE
    Producto (
        producto_id INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100),
        descripcion VARCHAR(255),
        precio INT,
        stock INT,
        categoria VARCHAR(50)
    );

CREATE TABLE
    Obras (
        obra_id INT PRIMARY KEY AUTO_INCREMENT,
        cliente_id INT,
        nombre_obra VARCHAR(100),
        direccion VARCHAR(100),
        fechaInicio DATE,
        fechaFin DATE,
        presupuesto INT,
        estado VARCHAR(20),
        FOREIGN KEY (cliente_id) REFERENCES Cliente(cliente_id)
    );

CREATE TABLE
    Salida(
        salida_id INT PRIMARY KEY AUTO_INCREMENT,
        cliente_id INT,
        empleado_id INT,
        fecha_salida DATE,
        hora_salida DATETIME,
        subtotalPeso INT,
        placatransporte VARCHAR(15),
        observaciones VARCHAR(100),
        FOREIGN KEY (cliente_id) REFERENCES Cliente(cliente_id),
        FOREIGN KEY (empleado_id) REFERENCES Empleado(empleado_id)
    );

CREATE TABLE
    Salida_Detalle(
        salida_detalle_id INT PRIMARY KEY AUTO_INCREMENT,
        salida_id INT,
        producto_id INT,
        empleado_id INT,
        obra_id INT,
        cantidad_salida INT,
        cantidad_propia INT,
        cantidad_subalquilada INT,
        valorUnidad INT,
        fecha_standBye DATETIME,
        estado VARCHAR(50),
        valorTotal INT,
        FOREIGN KEY (salida_id) REFERENCES Salida(salida_id),
        FOREIGN KEY (producto_id) REFERENCES Producto(producto_id),
        FOREIGN KEY (empleado_id) REFERENCES Empleado(empleado_id),
        FOREIGN KEY (obra_id) REFERENCES Obras(obra_id)
    );

CREATE TABLE
    Entrada(
        entrada_id INT PRIMARY KEY AUTO_INCREMENT,
        salida_id INT,
        empleado_id INT,
        cliente_id INT,
        fecha_entrada DATE,
        hora_entrada DATETIME,
        observaciones VARCHAR(50),
        FOREIGN KEY (salida_id) REFERENCES Salida(salida_id),
        FOREIGN KEY (empleado_id) REFERENCES Empleado(empleado_id),
        FOREIGN KEY (cliente_id) REFERENCES Cliente(cliente_id)
    );

CREATE TABLE
    Entrada_Detalle(
        entrada_detalle_id INT PRIMARY KEY AUTO_INCREMENT,
        entrada_id INT,
        producto_id INT,
        obra_id INT,
        entrada_cantidad INT,
        entrada_cantidad_propia INT,
        entrada_cantidad_subalquilada INT,
        estado VARCHAR(50),
        FOREIGN KEY (entrada_id) REFERENCES Entrada(entrada_id),
        FOREIGN KEY (producto_id) REFERENCES Producto(producto_id),
        FOREIGN KEY (obra_id) REFERENCES Obras(obra_id)
    );

CREATE TABLE
    Inventario(
        inventario_id INT PRIMARY KEY AUTO_INCREMENT,
        producto_id INT,
        CantidadInicial INT,
        CantidadIngresos INT,
        CantidadSalidas INT,
        CantidadFinal INT,
        FechaInventario DATE,
        TipoOperacion VARCHAR(50),
        FOREIGN KEY (producto_id) REFERENCES Producto(producto_id)
    );

CREATE TABLE
    Liquidacion(
        liquidacion_id INT PRIMARY KEY AUTO_INCREMENT,
        cliente_id INT,
        empleado_id INT,
        salida_id INT,
        entrada_id INT,
        obra_id INT,
        producto_id INT,
        FOREIGN KEY (cliente_id) REFERENCES Cliente(cliente_id),
        FOREIGN KEY (empleado_id) REFERENCES Empleado(empleado_id),
        FOREIGN KEY (salida_id) REFERENCES Salida(salida_id),
        FOREIGN KEY (entrada_id) REFERENCES Entrada(entrada_id),
        FOREIGN KEY (obra_id) REFERENCES Obras(obra_id),
        FOREIGN KEY (producto_id) REFERENCES Producto(producto_id)
    )