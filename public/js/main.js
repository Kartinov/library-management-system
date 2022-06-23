$(function () {
    // Categories listener
    $('.category-select').on('click', filterAndRenderBooks);

    filterAndRenderBooks(); // on page visit render books

    $('.category-checkbox').animate({ marginLeft: 0 }, 700); // show checkboxes
});

function filterAndRenderBooks() {
    const routeUrl = getRoute('/books/fetchbooks');

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

    $('.category:checked').each(function () {
        filter.push($(this).val());
    });

    return filter;
}

function renderBooks(booksData) {
    const booksWrapperDiv = $('#books-wrapper');

    booksWrapperDiv.empty();

    $.each(booksData, function (index, book) {
        let bookHtml = `
            <a href="./books/show/${book.id}" class="book-card opacity-0 flex flex-col items-center justify-center w-full max-w-2xl mx-auto duration-300 ease-in-out transition-transform transform hover:-translate-y-2">
                      <img class="object-cover w-full rounded-md h-64 xl:h-60" src="${book.image_url}" alt="${book.title}">

                      <div class="w-full mt-2">
                          <h5 class="text-lg font-semibold text-grey-700 h-20">${book.title}</h5>
                          <div class="pt-2 mt-2 border-t-2 border-indigo-100">
                              <p class="text-sm font-medium tracking-widest text-gray-500 uppercase">${book.a_first_name} ${book.a_last_name}</p>
                          </div>
                      </div>

                      <div class="flex justify-end w-full mt-3">
                          <p class="text-lg font-medium text-white bg-indigo-600 px-4 py-1 rounded-l-lg">${book.c_name}</p>
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
    pathname = pathname[0] + 'public';

    return pathname + route;
}
