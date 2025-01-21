<?php

require_once('../../Back-end/Classes/Cours.php');
require_once('../../Back-end/Classes/Tag.php');
require_once('../../Back-end/Classes/Categorie.php');


$tags=Tag::afficherTags();
$categorie=Categorie::afficherCategorie();

if (isset($_GET['idCours'])) {
    $idC=$_GET['idCours'];
    $cours = Cours::afficherCoursId($idC);
    $tagsCours = Cours::coursTags($idC);
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
<body class="bg-gray-50 min-h-screen">
    

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Actions buttons -->
        <div class="flex justify-end gap-4 mb-6">
            <button onclick="openModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                <i class="ri-edit-line mr-2"></i>
                Modifier
            </button>
            <button onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce cours?')) window.location.href='supprimer_cours.php?id=<?= $cours->getId() ?>'" 
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                <i class="ri-delete-bin-line mr-2"></i>
                Supprimer
            </button>
        </div>

        <!-- En-tête du cours -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-xl mb-8">
            <div class="relative h-64">
                <img src="../<?= $cours->getImage() ?>" alt="<?= $cours->getTitre() ?>" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 p-8">
                    <h1 class="text-4xl font-bold text-white mb-4"><?= $cours->getTitre() ?></h1>
                    <div class="flex flex-wrap gap-4 text-white/90 text-sm">
                        <span class="flex items-center">
                            <i class="ri-calendar-line mr-2"></i>
                            Mis à jour : 
                        </span>
                        <span class="flex items-center">
                            <i class="ri-user-line mr-2"></i>
                            Par : 
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contenu principal -->
            <div class="lg:col-span-2 space-y-8">
                <!-- À propos -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">À propos de ce cours</h2>
                    <div class="prose max-w-none text-gray-600">
                        <?= $cours->getDescription() ?>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-2">
                        <?php foreach ($tags as $tag): ?>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                #<?= $tag->getTitre() ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Contenu du cours -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Contenu du cours</h2>
                    <div class="prose max-w-none">
                        <?php $cours->afficherCours() ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-8 shadow-lg sticky top-8">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <span class="text-gray-600">Catégorie</span>
                            <span class="font-medium">Developpement</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                            <span class="text-gray-600">Type</span>
                            <span class="font-medium"><?= $cours->getType() ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de modification -->
    <dialog id="editModal" class="modal w-full max-w-4xl rounded-lg p-0 backdrop:bg-gray-600/50">
        <div class="relative bg-white rounded-lg">
            <div class="flex justify-between items-center p-5 border-b">
                <h3 class="text-xl font-semibold">Modifier le cours</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            
            <form action="../../Back-end/Actions/Cours/modifierCours.php" method="POST" enctype="multipart/form-data" class="p-5 space-y-6">
                <input type="hidden" name="idCours" value="<?= $cours->getId() ?>">
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Titre</label>
                    <input type="text" name="titre" value="<?= $cours->getTitre() ?>" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <textarea name="description" rows="4" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"><?= $cours->getDescription() ?></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="courseCategorie" class="block text-sm font-medium text-gray-700">Categorie</label>
                        <select 
                            id="courseCategorie" 
                            name="categorie" 
                            class="block px-3 py-2 w-full mt-1 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <?php
                            foreach ($categorie as $cat) {
                                echo "<option value='" . $cat->getId() . "'" . ($cours->getIdCategorie() == $cat->getId() ? " selected" : "") . ">" . htmlspecialchars($cat->getTitre()) . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Type</label>
                        <select disabled name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="video" <?= $cours->getType() == 'video' ? 'selected' : '' ?>>Vidéo</option>
                            <option value="text" <?= $cours->getType() == 'texte' ? 'selected' : '' ?>>Texte</option>
                        </select>
                    </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Tags</label>
                <div class="grid grid-cols-3 gap-4">
                    <?php foreach ($tags as $tag): ?>
                        <div class="flex items-center">
                            <input type="checkbox" name="tags[]" value="<?= $tag->getId() ?>" 
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="tag-<?= $tag->getId() ?>" class="ml-2 text-sm text-gray-900">
                                <?= htmlspecialchars($tag->getTitre()) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Image du cours</label>
                    <?php if ($cours->getImage()): ?>
                        <div class="mb-4">
                            <img src="../<?= $cours->getImage() ?>" alt="<?= htmlspecialchars($cours->getTitre()) ?>" class="w-1/2 h-45 rounded-lg">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" accept="image/*" 
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
                <?php if ($cours->getType()=='texte') :?>
                    
                    <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Contenu</label>
                        <textarea name="contenu" rows="10"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <?= htmlspecialchars($cours->getContenue()) ?>
                        </textarea>
                    </div>
                <?php endif ;?>
                <?php if ($cours->getType()=='video') :?>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Upload Video</label>
                        <input type="file" name="video"  
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                <?php endif ;?>


                <div class="flex justify-end gap-4">
                    <button type="button" onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    <style>
        dialog::backdrop {
            background: rgba(0, 0, 0, 0.5);
        }
        dialog[open] {
            animation: show 0.3s ease normal;
        }
        @keyframes show {
            from {
                transform: translateY(-10%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <script>
        const modal = document.getElementById('editModal');

        function openModal() {
            if (modal) {
                modal.showModal();
                // Empêcher le défilement du body quand le modal est ouvert
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal() {
            if (modal) {
                modal.close();
                // Réactiver le défilement du body
                document.body.style.overflow = 'auto';
            }
        }

        // Fermer le modal si on clique en dehors
        modal.addEventListener('click', (e) => {
            const dialogDimensions = modal.getBoundingClientRect();
            if (
                e.clientX < dialogDimensions.left ||
                e.clientX > dialogDimensions.right ||
                e.clientY < dialogDimensions.top ||
                e.clientY > dialogDimensions.bottom
            ) {
                closeModal();
            }
        });
    </script>
</body>
</html>