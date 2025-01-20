<?php

require_once('../../Back-end/Classes/Cours.php');

if (isset($_GET['idCours'])) {
    $idC=$_GET['idCours'];
    $cours = Cours::afficherCoursId($idC);
    $tags = Cours::coursTags($idC);
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
                    <p class="text-gray-600 leading-relaxed">
                    <div class="p-6">
                        <?= $cours->getDescription() ?>
                    </div>
                    </p>
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
                    <button class="w-full bg-blue-600 text-white py-4 px-6 rounded-lg hover:bg-blue-700 transition-colors mb-8 font-medium">
                        <a href="../../Back-end/Actions/Cours/addInscription.php?idC=<?= $cours->getId()?>" >
                            Rejoindre cours
                        </a>
                    </button>
                    

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