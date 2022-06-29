       <div class="relative z-40" role="dialog">

           <!-- Dark Overlay -->
           <div x-show="notesMenu" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 hidden" class="fixed inset-0 bg-black bg-opacity-25"></div>

           <div x-show="notesMenu" class="fixed inset-0 flex z-40">
               <div x-show="notesMenu" @click.away="notesMenu = false" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="ml-auto relative max-w-sm w-full h-full bg-white shadow-xl py-4 pb-12 flex flex-col overflow-y-auto">
                   <div class="px-4 flex items-center justify-between">
                       <h2 class="text-lg font-medium text-gray-900">Notes</h2>

                       <!-- Button Close Filter -->
                       <button @click="notesMenu = false" type="button" class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400">
                           <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                           </svg>
                       </button>
                   </div>

                   <!-- Notes-->
                   <div class="p-5">
                       <div class="mb-3">
                           <div id="error-empty-note" class="hidden w-full text-white bg-red-500 mb-3">
                               <div class="container flex items-center justify-between px-6 py-2 mx-auto">
                                   <div class="flex">
                                       <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                           <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"></path>
                                       </svg>

                                       <p class="mx-3">You can not insert an empty note.</p>
                                   </div>
                               </div>
                           </div>

                           <label class="text-gray-700" for="textarea_note">
                               <textarea class="appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" id="textarea_note" placeholder="Enter your note" name="textarea_note" rows="2" cols="30"></textarea>
                               <input type="hidden" id="book_id" value="<?= $data['book']->id ?>">
                           </label>

                           <button id="createNoteBtn" type="button" class="py-2 px-4 mt-2 bg-indigo-600 hover:bg-indigo-700 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md rounded-lg ">
                               Create
                           </button>
                       </div>

                       <div id="notesDiv"></div>

                   </div>
               </div>
           </div>
       </div>