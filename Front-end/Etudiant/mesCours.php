<?php
require_once('../../Back-end/Classes/Inscription.php');
session_start();
$idE=$_SESSION['id_logged'];
$mycourses = Inscription::getMyCourses($idE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center space-x-8">
                    <a href="./index.php">
                        <img src="/api/placeholder/150/50" alt="Youdemy Logo">
                    </a>
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="./index.php" class="text-gray-900 hover:text-blue-500 transition-colors">Home</a>
                        <a href="#" class="text-blue-500 font-bold">My Courses</a>
                        <a href="#" class="text-gray-900 hover:text-blue-500 transition-colors">Browse Courses</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <img src="/api/placeholder/32/32" alt="User" class="w-8 h-8 rounded-full">
                        <span class="text-gray-700">John Doe</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">My Enrolled Courses</h1>
                <p class="text-gray-600 mt-2">Continue learning from where you left off</p>
            </div>

            <!-- Search Bar -->
            <div class="mb-8">
                <div class="relative max-w-md">
                    <input type="text" 
                           placeholder="Search your courses..." 
                           class="w-full p-3 pl-10 rounded-lg border border-gray-200 focus:outline-none focus:border-blue-400">
                    <i class="ri-search-line absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php foreach($mycourses as $value ): ?>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow border border-gray-100">
                        <img src="<?= '..' . $value->getImage() ?>" alt="Course thumbnail" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm"><?= $value->getTitre() ?></span>
                            <h3 class="font-semibold text-lg mt-3 text-gray-800"><?= $value->getTitre() ?></h3>
                            <p class="text-gray-600 mt-2 text-sm"><?= $value->getDescription() ?></p>
                            <div class="mt-4">
                                <a href="#" class="text-blue-500 hover:text-blue-600 font-medium inline-flex items-center">
                                    Continue Learning <i class="ri-arrow-right-line ml-2"></i>
                                </a>
                            </div>
                        </div>  
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white border-t mt-16">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600">&copy; 2024 Youdemy. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-600 hover:text-gray-900">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Terms of Service</a>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Help Center</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>