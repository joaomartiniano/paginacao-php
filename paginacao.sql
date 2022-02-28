DROP DATABASE IF EXISTS paginacao;
CREATE DATABASE paginacao;
USE paginacao;

CREATE TABLE produtos (
	ID			INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Designacao	VARCHAR(255),
    Preco		DECIMAL(7,2),
    TaxaIva		FLOAT
);