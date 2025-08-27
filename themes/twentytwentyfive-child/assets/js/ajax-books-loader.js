export function initBookLoader(ajaxData) {
    const container = document.getElementById('related-books-container');

    // Make sure the page has the container and the data
    if (!container || !ajaxData) return;

    const USER_ERROR_MESSAGE = '<p>Sorry, something went wrong while loading books. Please try again later.</p>';

    // This function to fetch and display the books
    const fetchRelatedBooks = async () => {
        // Prepare the data to send
        const formData = new FormData();
        formData.append('action', 'load_related_books');
        formData.append('security', ajaxData.nonce);
        formData.append('current_book_id', ajaxData.current_book_id);

        try {
            const response = await fetch(ajaxData.ajax_url, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                console.error('Network error:', response.statusText);
                container.innerHTML = USER_ERROR_MESSAGE;
                return;
            }

            const result = await response.json();

            if (result.success) {
                // Clear the "Loading..." message
                container.innerHTML = '';

                // Build the HTML for the book list
                const ul = document.createElement('ul');
                ul.className = 'related-books-list';

                result.data.forEach((book) => {
                    const li = document.createElement('li');
                    // 1. Check if the genres array exists and has items.
                    const hasGenres = book.genres && book.genres.length > 0;
                    // 2. Map the array of genre objects to an array of HTML anchor tags.
                    const genreLinks = hasGenres
                        ? book.genres.map(genre => `<a href="${genre.link}">${genre.name}</a>`).join(', ')
                        : 'N/A'; // Fallback text if there are no genres
                    li.innerHTML = `
                        <h3 class="book-title"><a href="${book.permalink}">${book.title}</a></h3>
                        <p class="book-meta"><strong>Date:</strong> ${book.date}</p>
                        <p class="book-meta"><strong>Genre:</strong> ${genreLinks}</p>
                        <div class="book-excerpt">${book.excerpt}</div>
                    `;
                    ul.appendChild(li);
                });
                container.appendChild(ul);
            } else {
                // This is a "soft" failure, e.g., "No books found".
                // The message from the server IS user-friendly.
                container.innerHTML = `<p>${result.data.message}</p>`;
            }
        } catch (error) {
            // This catches network failures or JSON parsing errors.
            // Log the detailed, technical error for the developer.
            console.error('There was a problem with the fetch operation:', error);
            // Show the generic, friendly message to the user.
            container.innerHTML = USER_ERROR_MESSAGE;
        }
    }

    // Automatically fetch the books when the page loads
    (async ()=> {
        await fetchRelatedBooks();
    })();
}