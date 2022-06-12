<?php require 'components/header.php'; ?>

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
                                <div class="flex items-center">
                                    <input id="filter-mobile-category-0" name="category[]" value="management" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-category-0" class="ml-3 min-w-0 flex-1 text-gray-500"> Management </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="filter-mobile-category-1" name="category[]" value="sale" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-category-1" class="ml-3 min-w-0 flex-1 text-gray-500"> Frontend </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="filter-mobile-category-2" name="category[]" value="backend" type="checkbox" checked class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-category-2" class="ml-3 min-w-0 flex-1 text-gray-500"> Backend </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="filter-mobile-category-3" name="category[]" value="data-science" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-category-3" class="ml-3 min-w-0 flex-1 text-gray-500"> Data Science </label>
                                </div>

                                <div class="flex items-center">
                                    <input id="filter-mobile-category-4" name="category[]" value="design" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="filter-mobile-category-4" class="ml-3 min-w-0 flex-1 text-gray-500"> Design </label>
                                </div>
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
                <button @click="categoriesMobileMenu = true" type="button" class="p-2 -m-2 ml-4 sm:ml-6 text-gray-400 hover:text-gray-500 lg:hidden">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <section class="pt-6 pb-24">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-10">
                    <!-- Filters -->
                    <form class="hidden lg:block">
                        <div class="py-6">
                            <!-- Filter section, show/hide based on section state. -->
                            <div class="" id="filter-section-1">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="filter-category-0" name="category[]" value="management" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-0" class="ml-3 text-sm text-gray-600"> Management </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-1" name="category[]" value="frontend" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-1" class="ml-3 text-sm text-gray-600"> Frontend </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-2" name="category[]" value="backend" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-2" class="ml-3 text-sm text-gray-600"> Backend </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-3" name="category[]" value="data-science" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-3" class="ml-3 text-sm text-gray-600"> Data Science </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-4" name="category[]" value="design" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-4" class="ml-3 text-sm text-gray-600"> Design </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Product grid -->
                    <div class="lg:col-span-3">
                        <div class="grid grid-cols-2 gap-8 mt-8 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">

                            <!-- Book Card -->
                            <a href="#" class="flex flex-col items-center justify-center w-full max-w-2xl mx-auto duration-300 ease-in-out transition-transform transform hover:-translate-y-2">
                                <img class="object-cover w-full rounded-md h-96 xl:h-80" src="https://www.designforwriters.com/wp-content/uploads/2017/10/design-for-writers-book-cover-tf-2-a-million-to-one.jpg" alt="Book">

                                <div class="w-full mt-2">
                                    <h5 class="text-xl font-semibold text-grey-700">A milion to one</h5>
                                    <div class="pt-2 mt-2 border-t-2 border-indigo-100">
                                        <p class="text-sm font-medium tracking-widest text-gray-500 uppercase">Tony Faggioli</p>
                                    </div>
                                </div>

                                <div class="flex justify-end w-full mt-3">
                                    <p class="text-lg font-medium text-white bg-indigo-600 px-4 py-1 rounded-l-lg">Action</p>
                                </div>
                            </a>





                        </div>
                    </div>
            </section>
        </main>
    </div>
</div>

<?php require 'components/footer.php' ?>