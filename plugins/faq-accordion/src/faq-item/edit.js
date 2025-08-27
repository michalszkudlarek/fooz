import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

const TEMPLATE = [['core/paragraph', {placeholder: __('Enter an answer...', 'recruitment-task')}]];

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();

	return (
		<div {...blockProps}>
			<h3 className="faq-question">
				<div className="faq-question-text-wrapper">
					<RichText
						tagName="span"
						className="faq-question-text"
						value={attributes.question}
						onChange={(question) => setAttributes({ question })}
						placeholder={__('Enter a question...', 'recruitment-task')}
					/>
				</div>
				<span className="faq-question-icon"/>
			</h3>

			<div className="faq-answer">
				<InnerBlocks template={TEMPLATE} />
			</div>
		</div>
	);
}
