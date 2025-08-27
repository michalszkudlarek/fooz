import { useBlockProps, RichText, InnerBlocks } from '@wordpress/block-editor';

const iconSVGString  = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>';
export default function save({ attributes }) {
	const blockProps = useBlockProps.save();
	const { question } = attributes;

	return (
		<div {...blockProps}>
			<h3 className="faq-question">
				<div className="faq-question-text-wrapper">
					<RichText.Content
						tagName="span"
						className="faq-question-text"
						value={question}
					/>
				</div>
				<div
					className="faq-question-icon"
					dangerouslySetInnerHTML={{ __html: iconSVGString }}
				/>
			</h3>
			<div className="faq-answer">
				<InnerBlocks.Content />
			</div>
		</div>
	);
}
