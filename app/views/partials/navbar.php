<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center border-b-2 border-gray-100 py-6">

            <!-- LOGO -->
            <div class="flex justify-start lg:w-0 lg:flex-1 mb-3 sm:mb-0">
                <a href="<?= route() ?>">
                    <h1 class="text-xl font-bold">
                        BRAINSTER<span class="font-normal">LIBRARY</span>
                    </h1>
                </a>
            </div>

            <?php if (!session_has('user')) : ?>
                <div class="text-center flex flex-1 justify-center mb-3 sm:mb-0">
                    <a href="<?= route() ?>" class="flex items-center text-gray-600 hover:text-gray-800 border-b-transparent border-b-2 hover:border-b-indigo-600 transition-border duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        <span class="text-lg">Home</span>
                    </a>
                </div>
            <?php endif ?>

            <div class="flex items-center justify-end md:flex-1 lg:w-0">

                <?php if (session_has('user')) : ?>
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-data="{ profileOpen: false }">
                        <div>
                            <button type="button" @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button">
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="User">
                            </button>
                        </div>

                        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-20" x-show="profileOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
                            <a href="<?= route('home/index') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Home
                            </a>
                            <?php if (session_get('user')->role == 'admin') : ?>
                                <a href="<?= route('books/table') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Books
                                </a>
                                <a href="<?= route('categories/table') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Categories
                                </a>
                                <a href="<?= route('authors/table') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Authors
                                </a>
                                <a href="<?= route('comments/table') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Comments
                                </a>
                            <?php endif ?>
                            <a href="<?= route('users/logout') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 ">
                                Sign out
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <a href=" <?= route('home/login') ?>" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 cursor-pointer">
                        Sign in
                    </a>

                    <a href="<?= route('home/register') ?>" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                        Sign up
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>