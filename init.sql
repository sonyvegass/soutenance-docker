CREATE DATABASE IF NOT EXISTS `docker`;
USE `docker`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `genre` tinyint(1) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(70) DEFAULT NULL,
  `date_inscription` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_naissance` DATE DEFAULT NULL,
  `numero_telephone` varchar(15) DEFAULT NULL,
  `indicatif_telephonique` varchar(5) DEFAULT NULL,
  `bloque` tinyint(1) DEFAULT NULL,
  `supprime` tinyint(1) DEFAULT NULL,
  `accepte` tinyint(1) DEFAULT NULL,
  `code_banque` varchar(20) DEFAULT NULL,
  `code_guichet` varchar(20) DEFAULT NULL,
  `numero_de_compte` varchar(50) DEFAULT NULL,
  `cle_rib` varchar(10) DEFAULT NULL,
  `iban` varchar(50) DEFAULT NULL,
  `bic` varchar(20) DEFAULT NULL,
  `nom_banque` varchar(100) DEFAULT NULL,
  `url_rib` varchar(255) DEFAULT NULL,
  `administrateur` tinyint(1) DEFAULT NULL,
  `bailleur_accept` tinyint(1) DEFAULT NULL,
  `bailleur` tinyint(1) DEFAULT NULL,
  `bailleur_refus` tinyint(1) DEFAULT NULL,
  `voyageur` tinyint(1) DEFAULT NULL,
  `prestataire_accept` tinyint(1) DEFAULT NULL,
  `prestataire` tinyint(1) DEFAULT NULL,
  `prestataire_refus` tinyint(1) DEFAULT NULL,
  `raison_refus` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL
);


INSERT INTO `utilisateur` (`id_utilisateur`, `genre`, `nom`, `prenom`, `email`, `mot_de_passe`, `date_inscription`, `date_naissance`, `numero_telephone`, `indicatif_telephonique`, `bloque`, `supprime`, `accepte`, `code_banque`, `code_guichet`, `numero_de_compte`, `cle_rib`, `iban`, `bic`, `nom_banque`, `url_rib`, `administrateur`, `bailleur_accept`, `bailleur`, `bailleur_refus`, `voyageur`, `prestataire_accept`, `prestataire`, `prestataire_refus`, `raison_refus`, `token`, `token_expiration`, `newsletter`)
VALUES
(20, 0, 'Vavichandran', 'Remi', 'messiremi10@gmail.com', '$2y$10$PZIIvqfpCJZANCOkHK8hXetvxyi3rJbvl7w8F8U/e3M2.mwEEcdJu', '2024-06-29 21:07:59', '2000-05-24', '0749419845', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'b2a392a95b03ceab46d3f2c2263e97cf', '2024-07-05 13:38:55', 0),
(22, 0, 'Vavichandran', 'Remi', 'xbddbdbshhs10@gmail.com', '$2y$10$0Wbi0h4juV//.S.i0tasZ.MBLyHPRJnICEHgV.BPdzuYprMnr7ffq', '2024-06-29 21:29:31', '2002-01-24', '', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fecac2f310b496e2de723860f4cd2f27', '2024-07-03 13:41:47', 1),
(23, 0, 'Vavichandran', 'Remi', 'messirem@gmail.com', '$2y$10$8vk5Riq391mH0x7Rx8bjJeuuAapj3n8eMP/3b27Fi5NlaxMrwukSS', '2024-06-29 21:31:17', '2002-01-24', '0749419845', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fecac2f310b496e2de723860f4cd2f27', '2024-07-03 13:41:47', 1),
(8, 0, 'Bailleur', 'Bailleur', 'bailleur@gmail.com', '$2y$10$/vC8YNHL05N/kkZSguYtK.jx6bOvQBsoaNiyDyAQu1.qANdyaVZH6', '2024-06-30 20:23:22', '2002-06-24', '0749419845', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3aed9e66f0f7009c98e0a2ee5e1b58ef', '2024-07-05 13:36:45', 0),
(27, 0, 'Prestataire', 'Prestataire', 'prestataire@gmail.com', '$2y$10$toPG0Z1xrMIsVh3h24qpK.03GuXfjpJuDAlcx2dRVubrcPTe5Y4S2', '2024-07-03 20:36:38', '2002-06-24', '0749419845', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fecac2f310b496e2de723860f4cd2f27', '2024-07-03 20:36:38', 0),
(28, 0, 'Vavichandran', 'Remi', 'docker@gmail.com', '$2y$10$EWIV26PnNvnWeBjOEipxX.b64isx81/tDWlN5hIzTcGtlvMVVQaUW', '2024-07-05 16:10:58', '2005-06-24', '0749419845', '33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '230c30b995c9c7a978cf5aa26263168f', '2024-07-05 16:10:58', 0);

COMMIT;