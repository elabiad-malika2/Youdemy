<?php

require_once('../../Back-end/Classes/Cours.php');
require_once('../../Back-end/Classes/Inscription.php');
session_start();

if (isset($_SESSION['id_logged']) && $_SESSION['role']=='etudiant' ) {
    $idE=$_SESSION['id_logged'];

} else {
    header('Location: ../index.php');
}

if (isset($_GET['idCours'])) {
    $idC=(int)$_GET['idCours'];
    $cours = Cours::afficherCoursId($idC);
    $tags = Cours::coursTags($idC);
}
$idE=$_SESSION["id_logged"];
$inscris= new Inscription($idE,$idC);
$check=$inscris->checkCourseJoined($idC,$idE);
if (!isset($_SESSION['id_logged'])) {
    header('Location: ../');

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
<div class=" flex flex-col">

<div class="hidden md:block w-full bg-blue-500 text-white">
    <div class="container mx-auto px-4 py-2">
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center space-x-6">
                <span class="flex items-center">
                    <i class="ri-phone-line mr-2"></i> +212 772508881
                </span>
                <span class="flex items-center">
                    <i class="ri-mail-line mr-2"></i> contact@youdemy.com
                </span>
            </div>
            <span class="flex items-center">
                <i class="ri-map-pin-line mr-2"></i> Massira N641 Safi, Morocco
            </span>
        </div>
    </div>
</div>

<!-- Header -->
<header class="border-b bg-white ">
    <div class="container mx-auto px-4 ">
        <div class="flex items-center justify-between py-4">
            <a href="./index.php">
                <img src="../assets/images/Youdemy_Logo.svg" alt="Youdemy Platform">
            </a>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="./index.php" class="text-blue-400 font-bold hover:text-blue-500 transition-colors">Home</a>
                <a href="./Etudiant/mesCours.php"
                    class="text-gray-900 hover:text-blue-500 transition-colors">Courses</a>
                <a href="./mesCours.php"
                    class="text-gray-900 hover:text-blue-500 transition-colors">My Courses</a>
                
            </nav>
            <div class="flex items-center space-x-4">
            <?php if (!isset($_SESSION['id_logged'])): ?>
                        <button
                            class="p-2 hidden md:block px-4 bg-blue-400 text-white rounded-full hover:bg-white hover:text-blue-400 hover:border hover:border-blue-400 transition-colors">
                            <a href="./login.php">Login</a>
                        </button>
                        <button
                            class="p-2 hidden md:block px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                            <a href="./register.php">Register</a>
                        </button>
                        
                    
                    <?php else :?>
                    <button
                            class="p-2 hidden md:block px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                            <a href="../../Back-end/Actions/Auth/auth.php?logout=">Logout</a>
                        </button>
                    <?php endif ; ?>
                <button id="mobile-menu-btn" class="p-2 hover:text-blue-500 transition-colors md:hidden">
                    <i class="ri-menu-4-fill text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu Mobile -->
    <div id="sidebar-menu" class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
        <div class="fixed top-0 left-0 w-64 bg-white pt-2 h-full shadow-lg">
            <div class="flex justify-end items-center px-4">
                <button id="close-sidebar" class="text-gray-700 hover:text-blue-500">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            <nav class="flex flex-col space-y-4 px-4 py-6">
                <a href="./index.php"
                    class="text-gray-700 hover:text-blue-500 font-bold transition-colors">Home</a>
                <a href="./courses.php"
                    class="text-gray-700 hover:text-blue-500 transition-colors">Courses</a>
                <a href="./pricing.php"
                    class="text-gray-700 hover:text-blue-500 transition-colors">Pricing</a>
                <a href="./features.php"
                    class="text-gray-700 hover:text-blue-500 transition-colors">Features</a>
                <a href="./blog.php" class="text-gray-700 hover:text-blue-500 transition-colors">Blog</a>
                <a href="./contact.php" class="text-gray-700 hover:text-blue-500 transition-colors">Help
                    Center</a>
                <div class="flex flex-col space-y-4 mt-6">
                    <button
                        class="p-2 px-4 bg-blue-400 text-white rounded-full hover:bg-white hover:text-blue-400 hover:border hover:border-blue-400 transition-colors">
                        <a href="./login.php">Login</a>
                    </button>
                    <button
                        class="p-2 px-4 border border-blue-400 text-blue-400 rounded-full hover:bg-blue-400 hover:text-white transition-colors">
                        <a href="./register.php">Register</a>
                    </button>
                </div>
            </nav>
        </div>
    </div>
</header>
</div>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- En-tête du cours avec image de fond -->
        <div class="relative rounded-xl overflow-hidden mb-8 bg-gradient-to-r from-blue-600 to-blue-400 shadow-lg">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative p-8 md:p-12">
                <div class="max-w-3xl">
                    <h1 class="text-4xl font-bold text-white mb-4"><?= $cours->getTitre() ?></h1>
                    <div class="flex flex-wrap gap-4 text-white/90 text-sm">
                        <span class="flex items-center">
                            <i class="ri-calendar-line mr-2"></i>
                            Mis à jour : 19 jan. 2024
                        </span>
                        <span class="flex items-center">
                            <i class="ri-time-line mr-2"></i>
                            Durée : 2h 30min
                        </span>
                        <span class="flex items-center">
                            <i class="ri-user-line mr-2"></i>
                            Par : Nom de l'instructeur
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contenu principal -->
            <div class="lg:col-span-2 space-y-8">
                <!-- À propos -->
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">À propos de ce cours</h2>
                    <div class="p-6">
                        <p class="text-gray-600 leading-relaxed">
                            <?= $cours->getDescription() ?>
                        </p>
                    </div>

                    <div id="tag-list" class="mt-4 flex flex-wrap gap-2">
                        <?php
                            foreach ($tags as $tag) {
                                echo "<span class='px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm flex items-center'>#{$tag->getTitre()}
                                        
                                    </span>";
                            }
                        ?>
                    </div>
                </div>

                <!-- Tabs pour le contenu -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <?php $cours->afficherCours() ?>

                    
                </div>
            </div>

            <!-- Barre latérale -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow sticky top-4">
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-blue-600">49,99 €</span>
                    </div>
                    <?php if ($check['total'] == 0) :?>
                        <button class="w-full bg-blue-600 text-white py-4 px-6 rounded-lg hover:bg-blue-700 transition-colors mb-8 font-medium">
                            <a href="../../Back-end/Actions/Cours/addInscription.php?idC=<?= $cours->getId()?>" >
                                Rejoindre cours
                            </a>
                        </button>
                    <?php endif ;?>
                    

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="ri-time-line mr-2"></i>
                                Durée
                            </span>
                            <span class="font-medium">2h 30min</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="ri-file-list-line mr-2"></i>
                                Leçons
                            </span>
                            <span class="font-medium">12</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="ri-group-line mr-2"></i>
                                Étudiants
                            </span>
                            <span class="font-medium">1 234</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 flex items-center">
                                <i class="ri-trophy-line mr-2"></i>
                                Certificat
                            </span>
                            <span class="font-medium">Oui</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>