<?php require '../app/views/partials/header.php'; ?>

<div class="bg-white" x-data="{ notesMenu: false }">
    <div>

        <?php

        if (session_has('user')) {
            require '../app/views/books/components/_notes.php';
        }

        ?>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 flex items-baseline justify-between py-6">
                <?php if (session_has('user')) : ?>
                    <!-- Button Open notes menu -->
                    <button @click="notesMenu = true" type="button" class="p-3 md:py-4 md:px-4 flex 
                            fixed z-10 right-0 justify-center items-center bg-indigo-600 hover:bg-indigo-700 text-white transition ease-in duration-200 text-center text-base font-semibold rounded-l-md ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Notes
                    </button>
                <?php endif ?>
            </div>

            <div class="max-w-7xl mx-auto px-4 py-5 sm:px-6">

                <?php

                require '../app/views/books/components/_book.php';
                require '../app/views/books/components/_comments.php';

                ?>

            </div>
        </main>
    </div>
</div>

<?php require '../app/views/partials/footer.php' ?>