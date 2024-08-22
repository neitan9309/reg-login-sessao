Pequeno código PHP em que simulo um sistema de registro, login e sessão.

Para rodar em sua máquina, crie uma tabela no seu banco de dados (no meu caso, fakebook) com o seguinte comando:

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `senha` char(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_reg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

Feito com XAMPP.
