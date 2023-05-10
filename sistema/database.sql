CREATE DATABASE sistema;

USE sistema;

CREATE TABLE estabelecimentos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nome_fantasia VARCHAR(255) NOT NULL,
  endereco VARCHAR(255) NOT NULL,
  cidade VARCHAR(255) NOT NULL,
  num_lojas INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cadastro (
id INT(11) NOT NULL AUTO_INCREMENT,
nome VARCHAR(50) NOT NULL,
marca VARCHAR(255) NOT NULL,
tamanho_quantidade VARCHAR(20) NOT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE produtos (
  id INT(11) NOT NULL AUTO_INCREMENT,
  produto_id INT(11) NOT NULL,
  estabelecimento_id INT(11) NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (produto_id) REFERENCES cadastro(id),
  FOREIGN KEY (estabelecimento_id) REFERENCES estabelecimentos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO estabelecimentos (nome_fantasia, endereco, cidade, num_lojas) 
VALUES 
('Supermercado do Bairro', 'Rua das Flores, 123', ' São Paulo', 1),
('Loja de Conveniência Express', ' Avenida Brasil, 456', 'Rio de Janeiro', 3),
('Casa das Bebidas', 'Rua das Árvores, 789', 'Belo Horizonte', 2),
('Padaria Delícia', 'Praça da Matriz, 456', 'Salvador', 5);

INSERT INTO cadastro ( nome, marca, tamanho_quantidade) 
VALUES 
("Uva", "Fazenda Feliz", "1000"),
("Laranja", "Enox Frutas", "1000"),
("Banana", "Feira Agro", "1000"),
("Goiaba", "Passagem Celestial", "1000"),
("Pêssego", "Fazenda Feliz", "1000"),
("Abacaxi", "Enox Frutas", "1000"),
("Acerola", "Feira Agro", "1000"),
("Cereja", "Aurora", "1000"),
("Coco", "Paisagem Dourada", "1000"),
("Framboesa", "Torre das Frutas", "1000");

SHOW TABLES;
DESCRIBE produtos;
SELECT produto_id FROM produtos;