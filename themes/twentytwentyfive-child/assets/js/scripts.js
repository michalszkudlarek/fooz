document.addEventListener('DOMContentLoaded', () => {
    // Check the GLOBAL window object for data from WordPress.
    // This object only exists on single book pages.
    if (typeof window.bookLoaderAjax !== 'undefined') {

        // If the data exists, we know we're on a page that needs the loader.
        // Then dynamically import the specific module for this functionality.
        import('./ajax-books-loader.js')
            .then(({ initBookLoader }) => {
                // Call the exported function from the module and pass it the data.
                initBookLoader(window.bookLoaderAjax);
            })
            .catch((error) => {
                // This will run if there's a network error loading the module.
                console.error('Failed to load the book loader module:', error);
            });
    }
});