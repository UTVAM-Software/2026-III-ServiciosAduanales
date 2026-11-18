ALTER TABLE medio_contacto RENAME old_medio_contacto;

CREATE TABLE `medio_contacto` (
    `id` bigint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `cliente_id` bigint DEFAULT NULL,
    `tipo` enum(
        'whats app',
        'facebook',
        'instagram',
        'messenger',
        'telefono',
        'correo'
    ) NOT NULL,
    `valor` varchar(50) NOT NULL,
    `proveedor_id` bigint unsigned DEFAULT NULL,
    CONSTRAINT `fk_medio_contacto_cliente02` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_medio_contacto_proveedor02` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

INSERT INTO medio_contacto (cliente_id, tipo, valor, proveedor_id)
SELECT cliente_id, tipo, valor, proveedor_id FROM old_medio_contacto;

DROP TABLE old_medio_contacto;
