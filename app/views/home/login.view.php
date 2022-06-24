<?php require '../app/views/partials/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6">
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Don't have an account yet?
                    <a href="<?= route('home/register') ?>" class="font-medium text-indigo-600 hover:text-indigo-500"> Sign Up </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" action="<?= route('users/authenticate') ?>" method="POST">

                <?php if (session_has('success')) : ?>

                    <div class="p-3 text-center">
                        <p class="first-letter:uppercase text-green-600">
                            <?= session_once('success'); ?>
                        </p>
                    </div>

                <?php elseif (session_has('errors')) : ?>
                    <div class="p-3">
                        <?php foreach (session_once('errors') as $error) : ?>

                            <p class="first-letter:uppercase text-red-500">
                                <?= $error; ?>
                            </p>

                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                    </div>
                    <div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>