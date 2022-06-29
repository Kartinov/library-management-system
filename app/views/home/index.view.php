<?php require '../app/views/partials/header.php'; ?>

<div class="bg-white" x-data="{ categoriesMobileMenu: false }">
    <div>

        <!-- Mobile filter dialog -->
        <div class="relative z-40 lg:hidden" role="dialog">

            <!-- Dark Overlay -->
            <div x-show="categoriesMobileMenu" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 hidden" class="fixed inset-0 bg-black bg-opacity-25"></div>

            <div x-show="categoriesMobileMenu" class="fixed inset-0 flex z-40">
                <div x-show="categoriesMobileMenu" @click.away="categoriesMobileMenu = false" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="ml-auto relative max-w-xs w-full h-full bg-white shadow-xl py-4 pb-12 flex flex-col overflow-y-auto">
                    <div class="px-4 flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>

                        <!-- Button Close Filter -->
                        <button @click="categoriesMobileMenu = false" type="button" class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Filters -->
                    <form class="mt-4 border-t border-gray-200">
                        <div class="border-t border-gray-200 px-4 py-6">
                            <div class="space-y-6">

                                <!-- Checkbox Mobile -->
                                <!-- List all categories from database -->
                                <?php foreach ($data['categories'] as $category) : ?>
                                    <div class="category-checkbox -ml-96">
                                        <label class="flex items-center ml-3 capitalize text-sm text-gray-600">
                                            <input type="checkbox" class="mr-2 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500 category-select category" value="<?= $category->id ?>">
                                            <?= $category->name ?>
                                        </label>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 flex lg:hidden items-baseline justify-between py-6">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900"></h1>

                <!-- Button Open Filter -->
                <button @click="categoriesMobileMenu = true" type="button" class="fixed right-0 p-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-l-md lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </button>
            </div>

            <section class="pt-6 pb-24">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-x-8 gap-y-10">
                    <!-- Filters -->
                    <form class="hidden lg:block">
                        <div class="py-6">

                            <div>
                                <div class="space-y-6">

                                    <!-- List all categories from database -->
                                    <?php foreach ($data['categories'] as $category) : ?>
                                        <div class="category-checkbox -ml-96">
                                            <label class="flex items-center ml-3 capitalize text-sm text-gray-600">
                                                <input type="checkbox" class="mr-2 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500 category-select category" value="<?= $category->id ?>">
                                                <?= $category->name ?>
                                            </label>
                                        </div>
                                    <?php endforeach ?>

                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Wrapper where all the books are listed-->
                    <div class="lg:col-span-4">
                        <div id="books-wrapper" class="grid grid-cols-2 gap-12 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5">

                            <!-- Books here -->

                        </div>
                    </div>
            </section>
        </main>
    </div>
</div>

<?php require '../app/views/partials/footer.php' ?>