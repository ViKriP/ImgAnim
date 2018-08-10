<?php
define( 'DIRSYS', __DIR__ );
define( 'DIRDB1DB', DIRSYS . '/imganim.db' );
define( 'DIRDB1', DIRSYS . '/core/includes/db1.php' );
define( 'PL_IMG', DIRSYS . '/img' );

define( 'PL_SELF_SRVNO', str_replace( $_SERVER['DOCUMENT_ROOT'], '', DIRSYS ));

define( 'PW_HOSTNAME', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
define( 'PW_SELF', PW_HOSTNAME . PL_SELF_SRVNO );
define( 'PW_IMG', PW_SELF . '/img' );

define( 'DN_UPD', 'upd' );


function URLSELF($dir) {

return str_replace( $_SERVER['DOCUMENT_ROOT'], '', $dir );

}
