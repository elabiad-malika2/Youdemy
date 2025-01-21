<?php
require_once('../../Back-end/Classes/Inscription.php');
session_start();
$idE=$_SESSION['id_logged'];
$mycourses = Inscription::getMyCourses($idE);

if (!isset($_SESSION['id_logged'])) {
    header('Location: ../');

}
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
                        <a href="../index.php" class="text-blue-400 font-bold hover:text-blue-500 transition-colors">Home</a>
                        <a href="./mesCours.php"
                            class="text-gray-900 hover:text-blue-500 transition-colors">Courses</a>
                        <a href=""
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
                            <a href="../Back-end/Actions/Auth/auth.php?logout=">Logout</a>
                        </button>
                    <?php endif ; ?>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
</div>

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