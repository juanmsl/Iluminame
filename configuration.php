<?php
require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

include ('php/configuration_content.php');

if(isset($_SESSION['configuration_result'])) {
	echo "<script>
		Push.create('" . (($_SESSION['emoji'] == 'sad') ? '¡ Wooops!' : '¡Que bien!' ) . "', {
			body: '" . $_SESSION['configuration_result'] . "',
			icon: 'resources/emojis/" . $_SESSION['emoji'] . "-2.png',
			timeout: 5000
		});
	</script>";
	unset($_SESSION['configuration_result']);
}

?>
