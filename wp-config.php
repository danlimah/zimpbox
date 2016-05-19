<?php
/**
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'zimpbox');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'zimpbox');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '8YW6]o(WiKF');

/** nome do host do MySQL */
define('DB_HOST', 'mysql857.umbler.com');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

define ('WPLANG', 'pt_BR');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'nn92@+vEU,+xs,N[M#2pJ@A8Y/6o9an8pQa;H%>M-s}49],JbT<R+>H=-Y>%@s@J');
define('SECURE_AUTH_KEY',  'd<]|bh,Zh(62HaQ?81<zNas%39u|L>C7w~C=bXe ([3_SxSZJ[|=M9W4,)E { 2f');
define('LOGGED_IN_KEY',    'DNv9cqZ[3`P=KJ{{$oE+J:W^|?sTldPMGSc4QP-`-c>kK.eIulc+WQ>^qSi)~08P');
define('NONCE_KEY',        'xqf%zzMUK`r~tF0t{[)$U?+9rLihs6qePfm*=/lF_7-KJB}d+u~iYD>O|#VO+CMW');
define('AUTH_SALT',        '%cOmgGJ+o;DdMGMQDlZlM{cvLj+bv2n#uNLU?[l9Fxz+rK4p,pCJW-=_;M7-`gHh');
define('SECURE_AUTH_SALT', ':X#)c}npV*;jj/w<I7$iMF4~Xo~O+bd_cflhWh0N}y2uraoYI2*~S,5Ce*h|SQAg');
define('LOGGED_IN_SALT',   'r2?i6F:5ow7z{&[Osk=9CW8G2X8;6+<v?ZCMJH&q.{ &k,<^vH/`b-RIa1B{>VAE');
define('NONCE_SALT',       'f=n?o4}J~bWU,unraTnL(@j?n47c&oy4%}#+0yTGWJPB]e_o9(N0lF<jUt/)*`77');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
