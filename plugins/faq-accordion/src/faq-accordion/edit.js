/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InnerBlocks,
	RichText,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
// Moved up

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 *  @param {Object}   props               Properties passed to the function.
 *  @param {Object}   props.attributes    Available block attributes.
 *  @param {Function} props.setAttributes Function that updates block attributes.
 *  @param {string}   props.clientId      Unique ID of the block.
 *  @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes, clientId }) {
	const blockProps = useBlockProps();
	const { title } = attributes;

	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'faq-accordion-items' },
		{
			allowedBlocks: ['recruitment-task/faq-item'],
			template: [['recruitment-task/faq-item']],
			renderAppender: () => null
		}
	);

	return (
		<div {...blockProps}>
			<RichText
				tagName="h2"
				className="faq-accordion-title"
				value={title}
				onChange={(newTitle) => setAttributes({ title: newTitle })}
				placeholder={__('FAQ Title', 'recruitment-task')}
			/>
			<div {...innerBlocksProps} />
			<InnerBlocks.ButtonBlockAppender
				rootClientId={clientId}
				className="faq-add-item-button"
			/>
		</div>
	);
}
