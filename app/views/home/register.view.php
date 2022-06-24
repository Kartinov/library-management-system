<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create an account</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Already have an account?
                    <a href="<?= route('home/login') ?>" class="font-medium text-indigo-600 hover:text-indigo-500"> Sign In </a>
                </p>
            </div>

            <form class="mt-8 space-y-6" action="<?= route('users/store') ?>" method="POST">
                <?php if (session_has('errors')) : ?>

                    <div class="p-3">
                        <?php foreach (session_once('errors') as $error) : ?>
                            <p class="first-letter:uppercase text-red-500">
                                <?= $error ?>
                            </p>
                        <?php endforeach ?>
                    </div>

                <?php endif ?>
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <input id="first_name" name="first_name" type="text" autocomplete="off" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="First Name" value="<?= old('first_name') ?>">
                    </div>
                    <div>
                        <input id="last_name" name="last_name" type="text" autocomplete="off" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Last Name" value="<?= old('last_name') ?>">
                    </div>
                    <div>
                        <input id="email" name="email" type="text" autocomplete="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" value="<?= old('email') ?>">
                    </div>
                    <div>
                        <input id="password" name="password" type="password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>