/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

/* eslint-disable no-console */
function initializeFaqAccordion() {
	const faqContainers = document.querySelectorAll('.wp-block-recruitment-task-faq-accordion');

	if (!faqContainers.length) return;

	faqContainers.forEach((container) => {
		// Get a live collection of all items within this specific accordion.
		const items = container.querySelectorAll('.wp-block-recruitment-task-faq-item');
		if (!items.length) return;

		items.forEach((item, index) => {
			const question = item.querySelector('.faq-question');
			if (!question) return;

			const questionTextWrapper = item.querySelector('.faq-question-text-wrapper');
			// Add the number programmatically if it doesn't exist.
			if (questionTextWrapper && !questionTextWrapper.querySelector('.faq-number')) {
				const numberSpan = document.createElement('span');
				numberSpan.className = 'faq-number';
				numberSpan.textContent = `${index + 1}. `;
				questionTextWrapper.prepend(numberSpan);
			}

			question.addEventListener('click', () => {
				// Check if the item we just clicked is already open.
				const wasAlreadyOpen = item.classList.contains('is-open');

				// 1. First, loop through ALL items in this accordion and close them.
				items.forEach((siblingItem) => {
					siblingItem.classList.remove('is-open');
				});

				// 2. If the clicked item was NOT already open, then open it.
				// This prevents a click on an already-open item from immediately re-opening.
				if (!wasAlreadyOpen) {
					item.classList.add('is-open');
				}
			});
		});
	});
}

// Ensure the script runs after the page is loaded.
if (document.readyState === 'complete' || document.readyState === 'interactive') {
	initializeFaqAccordion();
} else {
	document.addEventListener('DOMContentLoaded', initializeFaqAccordion);
}
/* eslint-enable no-console */
