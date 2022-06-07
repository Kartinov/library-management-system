<div class="bg-white">
    <div>
        <!--
      Mobile filter dialog

      Off-canvas filters for mobile, show/hide based on off-canvas filters state.
    -->
        <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
            <!--
        Off-canvas menu backdrop, show/hide based on off-canvas menu state.

        Entering: "transition-opacity ease-linear duration-300"
          From: "opacity-0"
          To: "opacity-100"
        Leaving: "transition-opacity ease-linear duration-300"
          From: "opacity-100"
          To: "opacity-0"
      -->
            <div class="fixed inset-0 bg-black bg-opacity-25"></div>

            <div class="fixed inset-0 flex z-40">
                <!--
          Off-canvas menu, show/hide based on off-canvas menu state.

          Entering: "transition ease-in-out duration-300 transform"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transition ease-in-out duration-300 transform"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
                <div class="ml-auto relative max-w-xs w-full h-full bg-white shadow-xl py-4 pb-12 flex flex-col overflow-y-auto">
                    <div class="px-4 flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                        <button type="button" class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400">
                            <span class="sr-only">Close menu</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Filters -->
                    <form class="mt-4 border-t border-gray-200">
                        <div class="border-t border-gray-200 px-4 py-6">
                            <div class="" id="filter-section-mobile-1">
                                <div class="space-y-6">
                                    <div class="flex items-center">
                                        <input id="filter-mobile-category-0" name="category[]" value="new-arrivals" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-category-0" class="ml-3 min-w-0 flex-1 text-gray-500"> Management </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-mobile-category-1" name="category[]" value="sale" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-category-1" class="ml-3 min-w-0 flex-1 text-gray-500"> Frontend </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-mobile-category-2" name="category[]" value="travel" type="checkbox" checked class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-category-2" class="ml-3 min-w-0 flex-1 text-gray-500"> Backend </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-mobile-category-3" name="category[]" value="organization" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-category-3" class="ml-3 min-w-0 flex-1 text-gray-500"> Data Science </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-mobile-category-4" name="category[]" value="accessories" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-mobile-category-4" class="ml-3 min-w-0 flex-1 text-gray-500"> Design </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 flex items-baseline justify-between pt-24 pb-6 border-b border-gray-200">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Books</h1>

                <div class="flex items-center">
                    <button type="button" class="p-2 -m-2 ml-4 sm:ml-6 text-gray-400 hover:text-gray-500 lg:hidden">

                        <span class="sr-only">Filters</span>

                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <section aria-labelledby="products-heading" class="pt-6 pb-24">
                <h2 id="products-heading" class="sr-only">Products</h2>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-10">
                    <!-- Filters -->
                    <form class="hidden lg:block">
                        <h3 class="sr-only">Categories</h3>

                        <div class="py-6">

                            <!-- Filter section, show/hide based on section state. -->
                            <div class="" id="filter-section-1">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="filter-category-0" name="category[]" value="new-arrivals" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-0" class="ml-3 text-sm text-gray-600"> Management </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-1" name="category[]" value="sale" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-1" class="ml-3 text-sm text-gray-600"> Frontend </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-2" name="category[]" value="travel" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-2" class="ml-3 text-sm text-gray-600"> Backend </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-3" name="category[]" value="organization" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-3" class="ml-3 text-sm text-gray-600"> Data Science </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="filter-category-4" name="category[]" value="accessories" type="checkbox" class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                        <label for="filter-category-4" class="ml-3 text-sm text-gray-600"> Design </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Product grid -->
                    <div class="lg:col-span-3">
                        <!-- Replace with your content -->
                        <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 lg:h-full"></div>
                        <!-- /End replace -->
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>