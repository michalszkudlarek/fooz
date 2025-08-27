/** @type {import('stylelint').Config} */
export default {
    extends: ['stylelint-config-standard-scss'],
    rules: {
        // Disable the kebab-case enforcement for class selectors (mainly because of WP classes)
        'selector-class-pattern': null,
    },
};
