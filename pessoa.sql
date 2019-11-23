-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `Produto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Unidade` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
