<?php	
	# Activer le mécanisme des sessions
	session_start();
	
		# Constantes globales
	define('CHEMIN_VUES', 'views/');
	define('CHEMIN_CONTROLEURS', 'controllers/');
	define('EMAIL1', 'lucien.lambert@student.vinci.be');
	define('EMAIL2', 'claudy.bougna@student.vinci.be');
	define('DATEDUJOUR', date("j/m/Y"));
	define('SESSION_ID', session_id());
	
	# Require automatisé des classes de la couche modèle 
	function chargerClasse($classe) {
		require_once 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); 
	
	# Connexion à la db;
	$db = Db::getInstance();

	# Pour le header : admin ou login selon que la variable de session 'authentifie' existe ou pas
	if (empty($_SESSION['authentifie'])) {
		$actionloginmember = 'login';
		$libelleloginmember = 'Login';
	} else {
		$actionloginmember = 'member';
		$libelleloginmember = 'Member Zone';
	}
	# Ecrire ici le header de toutes pages HTML
	require_once(CHEMIN_VUES . 'header.php');

	# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...
	$action = (isset($_GET['action'])) ? $_GET['action'] : 'default';
	# Quelle action est demandée dans l'URL ?
	switch($action) {
        case 'categories':
			require_once(CHEMIN_CONTROLEURS . 'CategoryController.php');
			$controller = new CategoryController($db);
			break;
        case 'answer':
			require_once(CHEMIN_CONTROLEURS . 'AnswerController.php');
			$controller = new AnswerController($db);
			break;
		case 'vote':
			require_once(CHEMIN_CONTROLEURS . 'VoteController.php');
			$controller = new VoteController($db);
			break;
		case 'question':
			require_once(CHEMIN_CONTROLEURS . 'QuestionController.php');
			$controller = new QuestionController($db);
			break;
		case 'login':
			require_once('controllers/LoginController.php');	
			$controller = new LoginController($db);
			break;	
		case 'member':
			require_once('controllers/MemberController.php');
			$controller = new MemberController($db);
			break;
        case 'admin':
            require_once('controllers/AdminController.php');
            $controller = new AdminController($db);
            break;
		case 'logout':
			require_once('controllers/LogoutController.php');	
			$controller = new LogoutController();
			break;
		default: # Par défaut, le contrôleur de l'accueil est sélectionné
			require_once(CHEMIN_CONTROLEURS.'HomeController.php');
			$controller = new HomeController($db);
			break;
	}
	# Exécution du contrôleur correspondant à l'action demandée
	$controller->run();
	
		# Ecrire ici le footer du site de toutes pages HTML
	require_once(CHEMIN_VUES . 'footer.php');

?>