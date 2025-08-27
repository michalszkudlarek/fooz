# WordPress Developer Screening Task: Twenty Twenty-Five Child Theme

This project is a comprehensive solution to a WordPress developer screening task. It involves creating a child theme for the default Twenty Twenty-Five theme and implementing a series of custom features, including custom post types, AJAX-powered templates, and a modern, full-featured Gutenberg block built with React.

The entire development process emphasizes modern WordPress and web development best practices, focusing on code that is modular, performant, maintainable, and scalable.

## Tech Stack & Tools

![WordPress](https://img.shields.io/badge/WordPress-21759B?style=for-the-badge&logo=wordpress&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) ![React](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB) ![Sass](https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white) ![Node.js](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white) ![npm](https://img.shields.io/badge/npm-CB3837?style=for-the-badge&logo=npm&logoColor=white) ![Prettier](https://img.shields.io/badge/Prettier-F7B93E?style=for-the-badge&logo=prettier&logoColor=black) ![Stylelint](https://img.shields.io/badge/Stylelint-263238?style=for-the-badge&logo=stylelint&logoColor=white)

## Tasks Completed

This project successfully fulfills all the requirements outlined in the screening task:

*   **Task #1 (Custom CSS):** A child theme was established as the correct, update-safe location for all custom CSS, which is organized using the 7-1 SCSS pattern.
*   **Task #2 (JavaScript Loading):** A custom JavaScript file (`assets/js/scripts.js`) is correctly enqueued and loaded in the footer of the site.
*   **Task #3 (CPT & Taxonomy):** A custom post type "Books" (with slug `/library/`) and a custom taxonomy "Genre" (with slug `/book-genre/`) were created with full, translatable labels. The logic is cleanly separated into its own file (`/inc/post-types.php`).
*   **Task #4.1 (Single Book Template):** A `single-book.php` template was created to display book details. It features a dynamically loaded list of 20 other books, fetched via a secure WordPress AJAX endpoint and rendered with modern JavaScript (`fetch`, dynamic `import()`).
*   **Task #4.2 (Taxonomy Archive Template):** A `taxonomy-genre.php` template was created to list all books within a specific genre. The page is paginated, displaying 5 books per page, implemented in a highly performant way by modifying the main WordPress query.
*   **Task #5 (Custom Gutenberg Block):** A full-featured "FAQ Accordion" block was developed from scratch. It meets all requirements, including:
    *   A parent/child structure using `InnerBlocks` for repeatable Q&A items.
    *   A fully functional front-end accordion with smooth animations.
    *   Programmatically added numeric ordering for questions.
    *   A polished and intuitive editor experience with a custom "Add Question" button.
    *   An editable main heading.
    *   Inline SVG icons for the accordion toggle, with color and rotation controlled by CSS.

## Architectural Decisions & Best Practices

The primary goal was to demonstrate a professional approach to WordPress development. The following key decisions were made:

1.  **Modular Development Environments:** This project utilizes two separate, specialized Node.js environments.
    *   **The Theme:** The child theme has its own `package.json` to manage tooling for theme-level concerns like SCSS compilation, code formatting (Prettier), and code quality (Stylelint).
    *   **The Block Plugin:** The "FAQ Accordion" block is built as a **standalone plugin**. It has its own `package.json` and dependencies managed by the official `@wordpress/scripts` package. This approach makes the block self-contained, portable, and prevents any dependency conflicts between the theme's build tools and the block's specific React-based build tools.

2.  **Modern SCSS with the 7-1 Pattern:** All stylesheets are written in SCSS and organized using a 7-1 pattern (`abstracts`, `base`, etc.). The modern `@use` and `@forward` rules are used for a clean, modular, and performant CSS architecture that avoids global scope issues.

3.  **Performant Querying (`pre_get_posts`):** For the paginated genre archive (Task #4.2), the `pre_get_posts` hook was used to modify the main WordPress query. This is a significant performance best practice, as it results in only one database query for the page, as opposed to creating a new `WP_Query` in the template, which would run a second, unnecessary query. The hook is carefully scoped with `is_main_query()` and `is_tax()` to prevent it from affecting any other queries on the site.

4.  **Modern & Efficient JavaScript:**
    *   ES Modules (`import`/`export`) are used for modularity.
    *   Data is passed from PHP to JavaScript using the standard `wp_localize_script`, but is accessed via the `window` object to respect module scope.
    *   **Dynamic `import()`** is used for the AJAX book loader. This is a key performance technique (code-splitting) that ensures the JavaScript for this feature is only downloaded on the pages where it's actually needed.

5.  **Robust Gutenberg Block Development:**
    *   **Parent/Child Pattern:** The block was built using two separate block definitions (`faq-accordion` and `faq-item`) to properly leverage the `InnerBlocks` component. This is the standard for creating repeatable, complex layouts.
    *   **Polished Editor Experience:** The default block appender was replaced with a custom `InnerBlocks.ButtonBlockAppender` for a more intuitive user experience. Custom editor styles (`editor.scss`) are used to create a clean, form-like editing interface, disabling front-end animations to prevent user confusion.
    *   **Validation-Proof `save` function:** The final implementation of the SVG icon uses `dangerouslySetInnerHTML` to inject a raw HTML string. This is the definitive solution to a common Gutenberg issue where the block serializer cannot correctly convert React components (like imported SVGs) into a static HTML string, thus preventing block validation errors.

## Final Project Structure
```text
/wp-content
├── /plugins
│   └── /faq-accordion/
│       ├── /build/
│       ├── /src/
│       │   ├── assets/
│       │   │   └── chevron-down.svg
│       │   ├── faq-accordion/
│       │   │   ├── block.json
│       │   │   ├── edit.js
│       │   │   ├── editor.scss
│       │   │   ├── index.js
│       │   │   ├── save.js
│       │   │   ├── style.scss
│       │   │   └── view.js
│       │   └── faq-item/
│       │       ├── block.json
│       │       ├── edit.js
│       │       ├── index.js
│       │       └── save.js
│       ├── faq-accordion.php
│       └── package.json
│
└── /themes
    └── /twentytwentyfive-child/
        ├── assets/
        │   ├── fonts/
        │   │   ├── DoppioOne-Regular.ttf
        │   │   └── Roboto-VariableFont_wdth,wght.ttf
        │   ├── js/
        │   │   ├── ajax-books-loader.js
        │   │   └── scripts.js
        │   └── styles/
        │       ├── abstracts/
        │       │   ├── _colors.scss
        │       │   └── _typography.scss
        │       ├── base/
        │       │   └── _base.scss
        │       ├── pages/
        │       │   └── _taxonomy-genre.scss
        │       └── main.scss
        ├── inc/
        │   ├── acf-fields/
        │   │   └── blocks/
        │   │       └── blok-akordeon-faq.json
        │   ├── blocks/
        │   │   └── faq.php
        │   ├── acf-fields.php
        │   ├── ajax-handlers.php
        │   ├── post-types.php
        │   └── query-modifications.php
        ├── template-parts/
        │   └── blocks/
        │       └── accordion.php
        ├── .prettierignore
        ├── .prettierrc.json
        ├── footer.php
        ├── functions.php
        ├── header.php
        ├── package.json
        ├── single-book.php
        ├── style.css
        ├── stylelint.config.js
        └── taxonomy-genre.php
```


## Getting Started & Commands

To set up the development environment, you need to run commands in **two separate terminal windows**.

### For the Theme

1.  **Navigate to the theme directory:**
    ```bash
    cd wp-content/themes/twentytwentyfive-child
    ```
2.  **Install Dependencies:**
    ```bash
    npm install
    ```
3.  **Start the development server (watches SCSS, formats files, etc.):**
    ```bash
    npm run dev
    ```

### For the Block Plugin

1.  **Navigate to the plugin directory:**
    ```bash
    cd wp-content/plugins/faq-accordion
    ```
2.  **Install Dependencies:**
    ```bash
    npm install
    ```
3.  **Start the development server (watches and compiles blocks):**
    ```bash
    npm start
    ```

### Available Commands

#### In the Theme Directory:
*   `npm run dev`: Starts the development server for watching SCSS and formatting files.
*   `npm run format`: Formats all theme files using Prettier.
*   `npm run lint:css`: Lints all theme SCSS files using Stylelint.

#### In the Plugin Directory:
*   `npm start`: Starts the development server for watching and compiling Gutenberg blocks.
*   `npm run build`: Creates a production-ready build of the Gutenberg blocks.