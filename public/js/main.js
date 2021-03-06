$(function () {
    // Categories listener
    $('.category-select').on('click', filterAndRenderBooks);

    // Notes listeners
    $('#createNoteBtn').on('click', addUserNote);
    $('#notesDiv').on('click', '.deleteNoteBtn', deleteUserNote);
    $('#notesDiv').on('click', '.editNoteBtn', editUserNote);

    filterAndRenderBooks();

    fetchAndPrintQuote();

    renderUserNotes();

    scrollTopBtnInit();
});

function scrollTopBtnInit() {
       const topBtn = $('#topButton');

       $(window).scroll(function () {
           $(this).scrollTop() > 40 ? topBtn.fadeIn() : topBtn.fadeOut(300);
       });

       topBtn.on('click', () => $('html, body').animate({ scrollTop: 0 }, 400));
}

function fetchAndPrintQuote() {
    const quoteText = $('#quote-text');

    if (quoteText) {
        const apiUrl = 'https://api.quotable.io/random';

        $.get(apiUrl, data => quoteText.html(data.content));
    }
}

function editUserNote() {
    const routeUrl = getRoute('notes/edit');
    const noteId = $(this).data('note');

    const noteText = $(`#note-body-${noteId} .note-text`);
    const noteTextEdit = $(`#note-body-${noteId} .note-text-edit`);
    const editFooter = $(`#note-footer-${noteId} .edit-footer`);
    const actualFooter = $(`#note-footer-${noteId} .actual-footer`);

    const cancelEditBtn = $(`#note-footer-${noteId} .cancelEditBtn`);
    const saveEditedBtn = $(`#note-footer-${noteId} .saveEditedBtn`);

    actualFooter.fadeOut(200, () => {
        editFooter.fadeIn(200);
        noteText.hide();
        noteTextEdit.show();
    });

    cancelEditBtn.on('click', () => {
        editFooter.fadeOut(200, () => {
            actualFooter.fadeIn(200);
            noteTextEdit.hide();
            noteText.show();
        });
    });

    saveEditedBtn.on('click', () => {
        $.ajax({
            type: 'POST',
            url: routeUrl,
            data: {
                action: 'editUserNote',
                noteId: noteId,
                noteText: noteTextEdit.val(),
            },
            success: data => {
                editFooter.fadeOut(200, () => {
                    actualFooter.fadeIn(200);
                    noteTextEdit.hide();

                    noteText.html(noteTextEdit.val());

                    noteText.show();
                });
            },
        });
    });
}

function deleteUserNote() {
    const routeUrl = getRoute('notes/delete');
    const noteId = $(this).data('note');

    $.ajax({
        type: 'POST',
        url: routeUrl,
        data: {
            action: 'deleteUserNote',
            noteId: noteId,
        },
        success: data => renderUserNotes(),
    });
}

function addUserNote() {
    const textareaNote = $('#textarea_note');

    if (textareaNote.val().length > 0) {
        $('#error-empty-note').slideUp();

        const bookId = $('#book_id').val();
        const noteText = textareaNote.val();

        textareaNote.val('');

        const routeUrl = getRoute('notes/store');

        $.ajax({
            type: 'POST',
            url: routeUrl,
            data: {
                action: 'storeUserNote',
                bookId: bookId,
                noteText: noteText,
            },
            success: data => renderUserNotes(),
        });
    } else {
        $('#error-empty-note').slideDown();

        setTimeout(() => $('#error-empty-note').slideUp(), 4000);
    }
}

function renderUserNotes() {
    const routeUrl = getRoute('notes/fetchUserNotes');
    const bookId = $('#book_id').val();
    const notesDiv = $('#notesDiv');

    if (notesDiv.length && bookId) {
        notesDiv.empty(); //clear

        $.ajax({
            type: 'POST',
            url: routeUrl,
            data: {
                action: 'fetchUserNotes',
                bookId: bookId,
            },
            success: function (data) {
                const notes = JSON.parse(data);

                if (notes.length) {
                    $.each(notes, function (index, note) {
                        notesDiv.append(`
                        <div class="w-full flex flex-col justify-between bg-white rounded-lg border border-gray-400 mb-6 py-5 px-4 shadow">
                                <div id="note-body-${note.id}" class="mb-6">
                                    <p class="text-gray-800 text-base note-text">
                                        ${note.note_text}
                                    </p>
                                    <textarea class="note-text-edit hidden appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" id="textarea_note" placeholder="Enter your note" name="textarea_note" rows="2" cols="30">${note.note_text}</textarea>
                                </div>
                                <div id="note-footer-${note.id}" class='h-8'>
                                <div class='edit-footer hidden'>
                                    <div class='flex'>
                                        <button class="saveEditedBtn py-1 px-2 bg-green-600 hover:bg-green-700 text-white shadow-md font-semibold rounded-md mr-3">
                                            Save
                                        </button>
                                        <button class="cancelEditBtn py-1 px-2 bg-yellow-600 hover:bg-yellow-700 text-white shadow-md font-semibold rounded-md">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                                <div class='actual-footer'>
                                    <div class="flex items-center justify-between text-gray-800">
                                        <p class="text-sm">
                                            Last modified: <br>
                                            ${note.updated_at}
                                        </p>
                                        <div class="flex">

                                            <button data-note='${note.id}' class="editNoteBtn w-8 h-8 p-1 mr-2 rounded-full text-gray-800 flex items-center justify-center hover:text-blue-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>

                                            <button id='note-${note.id}' data-note='${note.id}' class="deleteNoteBtn w-8 h-8 p-1 rounded-full text-gray-800 flex items-center justify-center hover:text-red-700">
                                                <svg xmlns=" http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                     `);
                    });
                }
            },
        });
    }
}

function filterAndRenderBooks() {
    $('.category-checkbox').animate({ marginLeft: 0 }, 700); // show checkboxes

    const routeUrl = getRoute('books/fetchbooks');

    let checkedCategories = getCheckedCategories();

    $.ajax({
        type: 'POST',
        url: routeUrl,
        data: { action: 'fetchBooks', checkedCategories: checkedCategories },
        success: data => renderBooks(JSON.parse(data)),
    });
}

function getCheckedCategories() {
    let filter = [];
    let windowWidth = $(window).width();

    if (windowWidth < 1024) {
        $('.category-mobile:checked').each(function () {
            filter.push($(this).val());
        });
    } else {
        $('.category:checked').each(function () {
            filter.push($(this).val());
        });
    }

    return filter;
}

function renderBooks(booksData) {
    const booksWrapperDiv = $('#books-wrapper');

    booksWrapperDiv.empty();

    $.each(booksData, function (index, book) {
        let bookHtml = `
            <a href="${getRoute('./books/show/' + book.id)}" 
            class="book-card opacity-0 overflow-hidden bg-white rounded-lg shadow-xl duration-300 ease-in-out transition-transform transform hover:-translate-y-2">
                <img class="object-cover object-center w-full h-56" 
                    src="${book.image_url}" alt="${book.title}">
                
                <div class="p-2 bg-gray-900">
                    <h1 class="text-lg font-semibold text-white first-letter:capitalize">
                        ${book.c_name}
                    </h1>
                </div>

                <div class="p-2">
                    <h1 class="text-xl font-semibold text-gray-800 mb-3">
                        ${book.title}
                    </h1>
                    <p class="text-sm font-medium tracking-widest text-gray-500 uppercase">
                        ${book.a_first_name} ${book.a_last_name}
                    </p>
                </div>
            </a>
        `;

        booksWrapperDiv.append(bookHtml);

        $('.book-card').animate(
            {
                opacity: 1,
            },
            700
        );
    });
}

function getRoute(route) {
    let pathname = window.location.pathname;

    pathname = pathname.split('public');
    pathname = pathname[0] + 'public/';

    return pathname + route;
}
