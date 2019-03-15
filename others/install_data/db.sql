CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `nick` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `revendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre_apellido` varchar(250) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `id_revendedor` int(11) NOT NULL,
  `id_pais_popup` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `categorias_footer` (
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(64) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `categorias_menu` (
  `id_cat_men` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `contact_fields` (
  `id_field` int(11) NOT NULL,
  `id_pagina` int(11) NOT NULL,
  `label` varchar(128) NOT NULL,
  `type` int(11) NOT NULL,
  `placeholder` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `temario` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `precio_usd` double NOT NULL,
  `fecha_comienzo` int(11) NOT NULL,
  `fecha_finalizacion` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `profesor` varchar(128) DEFAULT NULL,
  `keywords` text,
  `profe` int(11) NOT NULL,
  `aviso_enviado` int(11) NOT NULL,
  `key_seo` varchar(128) NOT NULL,
  `menu_name` varchar(128) DEFAULT 'Menu',
  `is_special` int(11) NOT NULL,
  `hora_inicio` int(11) NOT NULL,
  `minuto_inicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cursos_banners` (
  `id_banner` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `pos` int(11) NOT NULL,
  `blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cursos_menu` (
  `id_menu` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `link` varchar(250) NOT NULL,
  `position` int(2) NOT NULL,
  `blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cursos_revendedores` (
  `id_curso` int(11) NOT NULL,
  `id_revendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `encuesta` (
  `id_encuesta` int(11) NOT NULL,
  `nombre_encuesta` varchar(150) NOT NULL,
  `is_test` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `footer` (
  `id_item` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `categoria` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  `is_blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `home_bloques` (
  `id_bloque` int(11) NOT NULL,
  `icono_bloque` varchar(64) NOT NULL,
  `titulo_bloque` varchar(128) NOT NULL,
  `texto_bloque` text NOT NULL,
  `boton_bloque` varchar(250) NOT NULL,
  `link_boton` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `home_clientes` (
  `id_cliente` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `link` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `home_cursos` (
  `id_curso` int(11) NOT NULL,
  `foto_curso` varchar(250) NOT NULL,
  `link_curso` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `home_galeria` (
  `id_galeria` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `texto` text NOT NULL,
  `foto_superior` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `home_iconos` (
  `id_icono` int(11) NOT NULL,
  `icono` varchar(128) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `detalle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `home_noticias` (
  `id_noticia` int(11) NOT NULL,
  `foto_noticia` varchar(250) NOT NULL,
  `titulo_noticia` varchar(250) NOT NULL,
  `subtitulo_noticia` varchar(250) NOT NULL,
  `texto_noticia` text NOT NULL,
  `link_noticia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `inscripciones_cursos` (
  `codigo_inscripcion` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_revendedor` int(11) NOT NULL,
  `pago` int(11) NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `certificado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `menu` (
  `id_item` int(11) NOT NULL,
  `titulo` varchar(64) NOT NULL,
  `position` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  `is_blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `metodos_pago` (
  `id_metodo` int(11) NOT NULL,
  `nombre_metodo` varchar(250) NOT NULL,
  `instrucciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `metodos_pago` (`id_metodo`, `nombre_metodo`, `instrucciones`) VALUES
(1, 'Transferencia Bancaria', ''),
(2, 'MercadoPago', ''),
(3, '2CheckOut', ''),
(4, 'Presencial', '');


CREATE TABLE `metodos_revendedores` (
  `id_metodo` int(11) NOT NULL,
  `id_revendedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `multichoice_respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `niveles_cursos` (
  `id_nivel` int(11) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `noticias_banners` (
  `id_banner` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `pos` int(11) NOT NULL,
  `blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `noticias_menu` (
  `id_menu` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `link` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paginas_banners` (
  `id_banner` int(11) NOT NULL,
  `id_pagina` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `pos` int(11) NOT NULL,
  `blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paginas_cursos` (
  `id_pagina` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `titulo` varchar(64) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `is_public` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paginas_estaticas` (
  `id_pagina` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `tipo_menu` tinyint(4) NOT NULL,
  `keywords` text,
  `key_seo` varchar(128) NOT NULL,
  `contact` int(11) NOT NULL,
  `menu_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paginas_menu` (
  `id_menu` int(11) NOT NULL,
  `id_pagina` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `link` varchar(250) NOT NULL,
  `position` int(11) NOT NULL,
  `blank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paises` (
  `id_pais` int(11) NOT NULL,
  `nombre_pais` varchar(32) NOT NULL,
  `foto_pais` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paises_metodos` (
  `id_pais` int(11) NOT NULL,
  `id_metodo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `paises_popup` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `foto_pais` varchar(250) NOT NULL,
  `precio_usd` varchar(64) NOT NULL,
  `pos` int(11) NOT NULL,
  `nombre_moneda` varchar(64) NOT NULL,
  `horas_desplazamiento` int(11) NOT NULL,
  `minutos_desplazamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL,
  `nombre_pregunta` varchar(250) NOT NULL,
  `tipo` int(1) NOT NULL,
  `predef` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `usuario` varchar(128) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `apellido` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `respuestas` (
  `id_pregunta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `revendedores` (
  `id_revendedor` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `nombre_revendedor` varchar(32) NOT NULL,
  `precio_dolar` double NOT NULL,
  `nombre_moneda` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `solapas_cursos` (
  `id_solapa` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `contenido` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);


ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`,`id_revendedor`);


ALTER TABLE `categorias_footer`
  ADD PRIMARY KEY (`id_categoria`);


ALTER TABLE `categorias_menu`
  ADD PRIMARY KEY (`id_cat_men`);


ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`,`id_pais`);


ALTER TABLE `contact_fields`
  ADD PRIMARY KEY (`id_field`,`id_pagina`);


ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`,`id_nivel`);


ALTER TABLE `cursos_banners`
  ADD PRIMARY KEY (`id_banner`,`id_curso`);


ALTER TABLE `cursos_menu`
  ADD PRIMARY KEY (`id_menu`,`id_curso`);


ALTER TABLE `cursos_revendedores`
  ADD PRIMARY KEY (`id_curso`,`id_revendedor`);


ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id_encuesta`);


ALTER TABLE `footer`
  ADD PRIMARY KEY (`id_item`);


ALTER TABLE `home_bloques`
  ADD PRIMARY KEY (`id_bloque`);


ALTER TABLE `home_clientes`
  ADD PRIMARY KEY (`id_cliente`);


ALTER TABLE `home_cursos`
  ADD PRIMARY KEY (`id_curso`);


ALTER TABLE `home_galeria`
  ADD PRIMARY KEY (`id_galeria`);


ALTER TABLE `home_iconos`
  ADD PRIMARY KEY (`id_icono`);


ALTER TABLE `home_noticias`
  ADD PRIMARY KEY (`id_noticia`);


ALTER TABLE `inscripciones_cursos`
  ADD PRIMARY KEY (`codigo_inscripcion`,`id_alumno`,`id_curso`,`id_revendedor`);


ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_item`);


ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id_metodo`);


ALTER TABLE `metodos_revendedores`
  ADD PRIMARY KEY (`id_metodo`,`id_revendedor`);


ALTER TABLE `multichoice_respuestas`
  ADD PRIMARY KEY (`id_respuesta`,`id_pregunta`);


ALTER TABLE `niveles_cursos`
  ADD PRIMARY KEY (`id_nivel`);


ALTER TABLE `noticias_banners`
  ADD PRIMARY KEY (`id_banner`,`id_noticia`);


ALTER TABLE `noticias_menu`
  ADD PRIMARY KEY (`id_menu`,`id_noticia`);


ALTER TABLE `paginas_banners`
  ADD PRIMARY KEY (`id_banner`,`id_pagina`);


ALTER TABLE `paginas_cursos`
  ADD PRIMARY KEY (`id_pagina`,`id_curso`);


ALTER TABLE `paginas_estaticas`
  ADD PRIMARY KEY (`id_pagina`,`id_menu`);


ALTER TABLE `paginas_menu`
  ADD PRIMARY KEY (`id_menu`,`id_pagina`);


ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);


ALTER TABLE `paises_metodos`
  ADD PRIMARY KEY (`id_pais`,`id_metodo`);


ALTER TABLE `paises_popup`
  ADD PRIMARY KEY (`id_pais`);


ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`);


ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`);


ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_pregunta`,`id_usuario`);


ALTER TABLE `revendedores`
  ADD PRIMARY KEY (`id_revendedor`,`id_ciudad`);


ALTER TABLE `solapas_cursos`
  ADD PRIMARY KEY (`id_solapa`);


ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `categorias_footer`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `categorias_menu`
  MODIFY `id_cat_men` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `contact_fields`
  MODIFY `id_field` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `cursos_banners`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `cursos_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `encuesta`
  MODIFY `id_encuesta` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `footer`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `home_bloques`
  MODIFY `id_bloque` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `home_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `home_cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `home_galeria`
  MODIFY `id_galeria` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `home_iconos`
  MODIFY `id_icono` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `home_noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `inscripciones_cursos`
  MODIFY `codigo_inscripcion` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `menu`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `metodos_pago`
  MODIFY `id_metodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `multichoice_respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `niveles_cursos`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `noticias_banners`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `noticias_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `paginas_banners`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `paginas_cursos`
  MODIFY `id_pagina` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `paginas_estaticas`
  MODIFY `id_pagina` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `paginas_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `paises`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `paises_popup`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `revendedores`
  MODIFY `id_revendedor` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `solapas_cursos`
  MODIFY `id_solapa` int(11) NOT NULL AUTO_INCREMENT;

