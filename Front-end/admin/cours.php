<?php
require_once('../../Back-end/Classes/Categorie.php');
require_once('../../Back-end/Classes/Cours.php');
$categories=Categorie::afficherCategorie();
$idC=null;
if (isset($_GET['edit_id'])) {
    $idC=$_GET['edit_id'];
    $categorie = Categorie::afficherCategorieId($idC);
}
$coursProf= Cours::afficherCoursProfs();




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses & Categories - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <aside class="fixed top-0 left-0 h-screen w-64 bg-white border-r shadow-sm">
        <div class="p-4">
            <img src="/api/placeholder/150/50" alt="Youdemy Logo" class="mb-8">
            <nav class="space-y-2">
                <a href="./index.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-dashboard-line text-lg"></i>
                    <span>Dashboard</span>
                </a>
                <a href="./teacher.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-user-follow-line text-lg"></i>
                    <span>Teacher Validation</span>
                </a>
                <a href="./users.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-user-settings-line text-lg"></i>
                    <span>User Management</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-blue-500 bg-blue-50 rounded-lg">
                    <i class="ri-book-open-line text-lg"></i>
                    <span>Courses & Categories</span>
                </a>
                <a href="./tags.php" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class="ri-price-tag-3-line text-lg"></i>
                    <span>Tags Management</span>
                </a>
                <a href="../../Back-end/Actions/Auth/auth.php?logout=" class="flex items-center space-x-3 p-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <span>Logout</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Courses & Categories</h1>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-gray-600 hover:text-blue-500">
                    <i class="ri-notification-3-line text-xl"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <img src="/api/placeholder/32/32" alt="Admin" class="w-8 h-8 rounded-full">
                    <span class="text-gray-700">Admin</span>
                </div>
            </div>
        </header>

        <!-- Pending Courses Section -->
        <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pending Courses</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Course</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Teacher</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Category</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-gray-500 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php
                        foreach ($coursProf as $cours) {
                            // Extraction des données
                            $courseName = htmlspecialchars($cours['titre']); // Titre du cours
                            $teacherName = htmlspecialchars($cours['fullName']); // Nom de l'enseignant
                            $category = htmlspecialchars($cours['titreC']); // Catégorie du cours
                            $courseId = htmlspecialchars($cours['id']); // ID du cours pour l'acceptation ou le rejet

                            // Affichage du tableau
                            echo "<tr class='hover:bg-gray-50'>
                                    <td class='px-6 py-4 max-w-xs overflow-hidden text-ellipsis'>
                                        <div class='flex items-center space-x-3'>
                                            <img src='../".$cours['image']."' alt='Course' class='w-12 h-12 rounded-lg'>
                                            <div>
                                                <p class='font-medium text-gray-800'>{$courseName}</p>
                                                <p class='text-sm text-gray-500'>12 lessons</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='px-6 py-4 max-w-xs overflow-hidden text-ellipsis text-gray-800'>{$teacherName}</td>
                                    <td class='px-6 py-4 max-w-xs overflow-hidden text-ellipsis text-gray-800'>{$category}</td>
                                    <td class='px-6 py-4'>
                                        <span class='px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm'>{$cours['status']}</span>
                                    </td>
                                    <td class='px-6 py-4'>
                                        <div class='flex space-x-2'>
                                            <a href='../../Back-end/Actions/Cours/modifierStatus.php?idC=$courseId' class='px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600'>
                                                Accept
                                            </a>
                                            <a href='../../Back-end/Actions/Cours/modifierStatus.php?idR=$courseId' class='px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600'>
                                                Reject
                                            </a>
                                        </div>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>


                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Add Category Modal -->
            <div id="addCategoryModal" class="bg-white rounded-lg shadow-sm border border-blue-100 p-6 <?php if (isset($idC)) {
                echo "hidden";
            } ?> ">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Add Category</h2>
                <form method="POST" action="../../Back-end/Actions/Categorie/addCategorie.php" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Category Name</label>
                        <input type="text" name="category_name" class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" placeholder="Enter category name">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Description</label>
                        <textarea name="category_description" rows="4" class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" placeholder="Enter category description"></textarea>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                            Save Category
                        </button>
                        <button type="reset" class="w-full px-4 py-2 border border-blue-400 text-blue-400 rounded-lg hover:bg-blue-50">
                            Reset
                        </button>
                    </div>
                </form>
            </div>

            <!-- Edit Category Modal -->
            <div id="editCategoryModal" class="bg-white rounded-lg shadow-sm border border-blue-100 p-6 <?php if (!isset($idC)) {
                echo "hidden";
            } ?> ">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Edit Category</h2>
                <form method="POST" action="../../Back-end/Actions/Categorie/modifierCategorie.php" class="space-y-4">
                    <div>
                    <input type="hidden" name="idEdit"
                        <?php if (isset($categorie)) {?>
                            value="<?= $categorie->getID()?>"
                            <?php } ?>
                            class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" placeholder="Enter category name">
                        <label class="block text-gray-700 mb-2">Category Name</label>
                        <input type="text" name="titreEdit"
                        <?php if (isset($categorie)) {?>
                            value="<?= $categorie->getTitre()?>"
                            <?php } ?>
                        
                        class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" placeholder="Enter category name">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Description</label>
                        <textarea name="descriptionEdit" 
                        class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400"
                        placeholder="Enter category description"><?php if (isset($categorie)) {?><?= $categorie->getDescription()?><?php } ?></textarea>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                            Save Changes
                        </button>
                        <button type="reset" class="w-full px-4 py-2 border border-blue-400 text-blue-400 rounded-lg hover:bg-blue-50">
                            Reset
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories List -->
            <div class="bg-white rounded-lg shadow-sm border border-blue-100 p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Categories List</h2>
                <div class="space-y-4">
                <?php
                    foreach ($categories as $c) {
                        echo "<div class='flex items-center justify-between p-3 bg-gray-50 rounded-lg'>
                                <div>
                                    <p class='font-medium text-gray-800'>{$c->getTitre()}</p>
                                    <p class='text-sm text-gray-500'>{$c->getDescription()}</p>
                                </div>
                                <div class='flex space-x-2'>
                                    <button onclick='window.location.href=\"?edit_id={$c->getId()}\"' class='p-2 text-blue-400 hover:text-blue-600'>
                                        <i class='ri-edit-line'></i>
                                    </button>
                                    <button class='p-2 text-red-400 hover:text-red-600'>
                                        <i class='ri-delete-bin-line'></i>
                                    </button>
                                </div>
                            </div>";
                    }
                ?>

                </div>
            </div>
        </div>
    </main>
    <script>
    
    </script>
</body>
</html>