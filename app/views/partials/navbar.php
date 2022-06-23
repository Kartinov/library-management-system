<div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">

            <!-- LOGO -->
            <div class="flex justify-start lg:w-0 lg:flex-1">
                <a href="<?= route() ?>">
                    <h1 class="text-xl font-bold">BRAINSTER<span class="font-normal">LIBRARY</span>
                    </h1>
                </a>
            </div>

            <!-- Sign Up / Sign In Buttons -->
            <div class="flex items-center justify-end md:flex-1 lg:w-0">
                <a href="<?= route('home/login') ?>" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900 cursor-pointer">
                    Sign in
                </a>

                <a href="<?= route('home/register') ?>" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</div>